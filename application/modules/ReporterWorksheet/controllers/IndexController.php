<?php

class ReporterWorksheet_IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
		require_once realpath(dirname(__FILE__) . '/../../Rest/controllers/RestHelper.php');

        $this->_helper->layout()->setLayout('crp_worksheet');

    	$config = Esquire_Config_Factory::getApplicationConfig();
        $logger = Esquire_Log_Factory::getLogger($config);       
		$print = false;
    	$id = $this->_getParam('id');
    	$print = $this->_getParam('print'); // Possible future use. Need to pass it to the view below.

		// TODO - authenticate user

		$this->view->servicesKey = $config->services->reporter_worksheet->reporters->private_key;
    	
     	/*
		 * Retrieve base job info and related data needed to load 
		 * a reporter worksheet.
    	 */
		$this->view->jobData = $this->_loadData(
			$config->rest->base_url . '/Job/' . $id, 
			array(
				'format' => 'json',
				'id' => $id
			)
		);
		$this->view->jobPriorityTypeData = $this->_loadData(
			$config->rest->base_url . '/JobPriorityType', 
			array(
				'format' => 'json',
				'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
			)
		);
		$this->view->appearanceTypeData = $this->_loadData(
			$config->rest->base_url . '/AppearanceType', 
			array(
				'format' => 'json',
				'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
			)
		);
		$this->view->reporterCostData = $this->_loadData(
			$config->rest->base_url . '/ReporterCost', 
			array(
				'format' => 'json',
				'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
			)
		);
		$this->view->jurisdictionData = $this->_loadData(
			$config->rest->base_url . '/Jurisdiction', 
			array(
				'format' => 'json',
				'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
			)
		);
		$this->view->reporterTimeAndDistanceData = $this->_loadData(
				$config->rest->base_url . '/ReporterTimeAndDistance',
				array(
						'format' => 'json',
						'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
				)
		);
		$this->view->bypassProductionReasonData = $this->_loadData(
				$config->rest->base_url . '/BypassProductionReason',
				array(
						'format' => 'json',
						'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
				)
		);
		$this->view->confidentialityData = $this->_loadData(
				$config->rest->base_url . '/Confidentiality',
				array(
						'format' => 'json',
						'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
				)
		);
		$this->view->transcriptTypeData = $this->_loadData(
				$config->rest->base_url . '/TranscriptType',
				array(
						'format' => 'json',
						'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
				)
		);
		$this->view->signatureProtocolData = $this->_loadData(
				$config->rest->base_url . '/SignatureProtocol',
				array(
						'format' => 'json',
						'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
				)
		);
		$this->view->exhibitInstructionData = $this->_loadData(
				$config->rest->base_url . '/ExhibitInstruction',
				array(
						'format' => 'json',
						'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
				)
		);
		$this->view->exhibitTurnInData = $this->_loadData(
				$config->rest->base_url . '/ExhibitTurnIn',
				array(
						'format' => 'json',
						'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
				)
		);
		$this->view->orderData = $this->_loadData(
				$config->rest->base_url . '/Order',
				array(
						'format' => 'json',
						'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID'],
						'JobID' => $this->view->jobData['esquire_data_package']['data']['JobID']
				)
		);
		$this->view->onBehalfOfTypeData = $this->_loadData(
				$config->rest->base_url . '/OnBehalfOfType',
				array(
						'format' => 'json',
						'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
				)
		);
		$this->view->proofOfOrderingData = $this->_loadData(
				$config->rest->base_url . '/ProofOfOrdering',
				array(
						'format' => 'json',
						'CompanyID' => $this->view->jobData['esquire_data_package']['data']['CompanyID']
				)
		);
    }

	/**
	 * Retrieve data from (currently) remote provider.
	 *
	 * @todo - The new portal server may not have the 
	 * 		   same restrictions as the old.  It should 
	 * 		   be possible to load data directly by having 
	 * 		   the Reporter Worksheet load via esquirecentral.
	 */
	private function _loadData($url, $params = array())
	{
    	$client = new Zend_Http_Client($url);
		if (count($params) > 1) {
			$client->setParameterGet($params);
		}
    	$client->setConfig(array('timeout' => 120));
    	$response = $client->request('GET'); 
		$logger = Esquire_Log_Factory::getLogger(Esquire_Config_Factory::getApplicationConfig());
		$logger->log('++++++++++++++RESPONSE: ' . $response->getBody(), Zend_Log::DEBUG);
    	$data = json_decode($response->getBody(), true);
		if ($response->getStatus() !== Rest_RestHelper::HTTP_NO_CONTENT && $data['esquire_data_package']['isError'] !== false) {
			throw new Exception('Unable to load necessary data from ' . $url . ' -0- ' . $response->getStatus());
		}
		return $data;
	}
}

