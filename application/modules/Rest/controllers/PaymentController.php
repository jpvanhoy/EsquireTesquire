<?php

class Rest_PaymentController extends Zend_Rest_Controller
{
	public function init()
	{
		$contextSwitcher = $this->_helper->getHelper('contextSwitch');
		$contextSwitcher->addActionContext('get', 'json');
		$contextSwitcher->addActionContext('put', 'json');
		$contextSwitcher->addActionContext('post', 'json');
		$contextSwitcher->addActionContext('delete', 'json');
		$contextSwitcher->initContext();
	}

	public function indexAction()
	{

	}

	/**
	 * Retrieve one or more transaction records. This action forwards to the
     * IndexController getAction(). That controller does the work and passes
     * results on to its view. This action is not revisited by call to getAction
     * in IndexController.
     *
     * @param void
     * @return Models_Intranet_NpcPayment $results Transaction records.
     * @access public
	 */
	public function getAction()
	{
        $config = Esquire_Config_Factory::getApplicationConfig();
        $params = $this->_getAllParams();
        $this->_setParam($params);

        $this->_forward('get', 'index', null, $params);
	}

	/**
	 * Create a transaction record (resource).
	 *
     * @param array $values Specific transaction information with an invoice key.
     * @return integer $paymentId Id of the record from the ncp_payment table insert.
     * @access public
	 */
	public function postAction()
	{
		$config = Esquire_Config_Factory::getApplicationConfig();
		$logger = Esquire_Log_Factory::getLogger($config, 'payment');
		$logger->log('Beginning new payment request', Zend_Log::INFO);

		$invoiceObjects = null;
		$paymentId = null;
		$values = json_decode(stripslashes($this->_getParam('values')), true);
        $values['payment_amount'] = number_format(
			preg_replace('/[^\d\.]/', '', $values['payment_amount']), 
			2, 
			'.', 
			''
		);
        $source = $this->_getParam('source');
        
		try {
			
			$payment = Esquire_Payment_Factory::getInstance($config);

            /**
             * If coming from cashapp interface the structure of the parameters are
             * different. We add in a couple of keys that are named differently on ECN.
             */
            if (isset($values['PaymentDistribution'])) {
                $invoiceArray = $values['PaymentDistribution'];
            } elseif (isset($values['invoices'])) {
                $invoiceArray = $values['invoices'];
            }
            $logger->log('Invoice Array: ' . print_r($invoiceArray, true), Zend_Log::INFO);
            
			if (count($invoiceArray) > 0) {
				$invoiceObjects = $this->_getInvoiceObjects($invoiceArray);
				if ($invoiceObjects instanceof Doctrine_Collection) {
					$logger->log('Got invoice objects ' . $invoiceObjects->count(), Zend_Log::INFO);
				} else {
					$logger->log('Got NO invoices', Zend_Log::INFO);
				}
			}

			if (count($invoiceArray) > 0) {
				$invoices = $payment->setAmountAppliedToInvoice($invoiceArray, $invoiceObjects);
			}
			$success = $payment->createPayment($values, $invoices);
			$logger->log('Payment creation success: ' . $success, Zend_Log::INFO);

			if ($success === false) {
				$logger->log(
					'Payment creation error: ' . $payment->getErrorMessage(), 
					Zend_Log::ERR
				);
				$this->getResponse()
					 ->setHttpResponseCode(500);
				$this->view->data = array(
					'success' => false,
					'error_code' => 10,
					'error_message' => $payment->getErrorMessage()
				);
				return;
			}

			$paymentId = $payment->getPaymentId();
		} catch (Exception $e) {
			$this->getResponse()
				 ->setHttpResponseCode(500);
			$this->view->data = array(
				'success' => false,
				'error_code' => 11,
				'error_message' => 'A system error occurred.'
			);
			$logger->log($e->getMessage(), Zend_Log::ERR);
			$logger->log($e->getTraceAsString(), Zend_Log::ERR);
			return;
		}

		$commitMessage = '';

        /**
         * Call ModPayController. Format $params first in a way that ModPay expects.
         * ModPay will commit payments to Solaria.
         */
        $params = array (
			'card_name' => $values['card_name'],
			'email' => $values['cc_email'], // Customer's billing email address
			'address' => $values['cc_address'],
			'city' => $values['cc_city'],
			'state' => $values['cc_state'],
			'zipcode' => $values['cc_zipcode'],
			'shiptophone' => $values['cc_shiptophone'],
			'card_number' => $values['card_number'],
			'expiration_date' => $values['expiration_date'],
			'payment_amount' => $values['payment_amount'],
			'cvv2' => $values['cvv2'],
			'npc_payment_id' => $paymentId,
            'source' => $source,
			'payor_name' => $values['card_name'],
            'transaction_date' => $values['transaction_date']
		);

        if ($invoiceObjects instanceof Doctrine_Collection && $invoiceObjects->count() > 0) {
            $serverBaseUrl = $config->server->url;
            $url = $serverBaseUrl . '/cashapp.php?control=modpay';

			/**
			 * The old cash app system expects a "PaymentType" string:
			 * CREDIT-AMERICAN EXPRESS
			 * CREDIT-MC
			 * CREDIT-VISA
			 * CREDIT-DISCOVER
			 */
			switch(substr($values['card_number'], 0, 1)) {
				case 6:
					$params['PaymentType'] = 'CREDIT-DISCOVER';
                    $paymentType = 'CREDIT-DISCOVER';
					break;
				case 5:
					$params['PaymentType'] = 'CREDIT-MC';
                    $paymentType = 'CREDIT-MC';
					break;
				case 4:
					$params['PaymentType'] = 'CREDIT-VISA';
                    $paymentType = 'CREDIT-VISA';
					break;
				default:
					$params['PaymentType'] = 'CREDIT-AMERICAN EXPRESS';
                    $paymentType = 'CREDIT-AMERICAN EXPRESS';
					break;
			}

            $client = Esquire_Http_Builder::getInstance($config, $url);
            
            $postVars = array(
                    'control' => 'modpay',
                    'action' => 'processcreditcard',
                    'values' => json_encode($params),
                    'invoices' => json_encode($invoiceArray),
					'PaymentType' => $paymentType,
                    'entered_login' => $config->system->sys_account_name,
                    'entered_password' => $config->system->sys_key,
                    'login' => $config->system->sys_account_name,
                    'password' => $config->system->sys_key,
                    'paymentId' => $paymentId
                );
            
            $client->setParameterPost(
                $postVars
            );

			$json = null;

			/**
			 * Errors from Modpay shouldn't bubble up
			 */
			try {
				$logger->log('Modpay params -- ' . print_r($postVars, true), Zend_Log::INFO);
				$logger->log('Modpay URL -- ' . $url, Zend_Log::INFO);
				$response = $client->request('POST');
				$body = $response->getBody();
				$logger->log('Modpay Response -- ' . $body, Zend_Log::INFO);
				$json = json_decode($body, true);
			} catch (Exception $e) {
				$logger->log(
					'Caught exception when processing payment - ' . $e->getMessage(), 
					Zend_Log::ERR
				);
			}

			$transactionNumber = $paymentId;
			while(strlen($transactionNumber) < 10) {
				$transactionNumber = '0' . $transactionNumber;
			}

			if (!empty($json) && $json['success'] == 1) {
				$commitMessage = 'Payment successfully applied to invoices.  '
							   . 'Your transaction number is ' . $transactionNumber;
			} else {
				$commitMessage = '<b>Warning: </b>We were unable to successfully '
							   . 'apply this payment to your invoices.  Our support '
							   . 'staff have been notified of the issue and will '
							   . 'contact you to resolve it.'
							   . '<br /><br />'
							   . 'Your transaction number is ' . $transactionNumber;
			}
        } 

		$this->getResponse()
			 ->setHttpResponseCode(200);

        $this->view->data = array(
			'success' => true,
			'message' => $commitMessage,
			'payment_id' => $paymentId
		);
	}

	/**
	 * NOT IMPLEMENTED
	 */
	public function putAction()
	{

	}

	/**
	 * NOT IMPLEMENTED
	 */
	public function deleteAction()
	{

	}

    /**
     * Get a collection of Doctrine Invoice objects.
     *
     * @param array $invoices Array with InvoiceNumber, CompanyID and amount_applied.
     * @return Doctrine_Collection $results Invoices
     * @access private
     */
    private function _getInvoiceObjects($invoices)
    {
        $config = Esquire_Config_Factory::getApplicationConfig();
        
        /**
         * We want to take the company_id out of the $invoices array
         * and get an array of Company objects from the main database.
         */
        foreach ($invoices as $invoice) {
            $solariaCompanyIds[] = $invoice['company_id'];
        }

        $companyObjects = $this->_getCompanyObjects($solariaCompanyIds);

        foreach ($invoices as $invoice) {
            $invoiceNumbers[] = $invoice['invoice_number'];
        }

        $inStatement = "(" . implode(', ', $invoiceNumbers) . ")";

		$solariaQuery = new Doctrine_SolariaQuery();
		$solariaQuery->setConfig($config);
		$solariaQuery->setConnectionsByCompany($companyObjects);
		$solariaQuery->select('i.*');
		$solariaQuery->from('Models_Solaria_Invoice i');
		$solariaQuery->where("i.InvoiceNumber IN $inStatement");
		$records = $solariaQuery->execute();

        return $records;
    }

    /**
     * Get a Doctrine Collection of companies from the MySQL main database. Used
     * to set companies in SolariaQuery.
     *
     * @param array $solariaCompanyIds
     * @return Doctrine_Collection $companies From MySQL company table.
     */
    private function _getCompanyObjects($solariaCompanyIds)
    {
        $config = Esquire_Config_Factory::getApplicationConfig();
        
        $mainConn = Esquire_Db_Connection_Factory::getConnection(
                'main',
                Doctrine_Manager::getInstance(),
                Esquire_Config_Factory::getApplicationConfig()
            );

        $inStatement = "(" . implode(', ', $solariaCompanyIds) . ")";

		$query = Doctrine_Query::create();
		$query->select('c.*');
		$query->from('Models_Main_Company c');
		$query->where("c.SolCompID IN $inStatement");
		$query->orWhere("c.SolCompDepID IN $inStatement");
		$companies = $query->execute();
        
        return $companies;
    }
}

