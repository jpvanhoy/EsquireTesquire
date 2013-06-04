<?php
/**
 * Service to manage Orders. 
* @author jason.vanhoy @ Nov 6, 2012 10:32:51 AM
*
*/
class Services_Order extends Services_Base
{
	
	public function getOrderListByJobId($token, $jobId, $maxResults = 1000000) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
				
			$conn = $this->getCompanyDataConnection($this->companyId);
				
			if(empty($maxResults)) {
				$maxResults = 1000000;
			}
			
				
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->from('Models_Solaria_Orders o');
				$query->leftJoin('o.Attorney a');
				$query->leftJoin('a.Person p');
				$query->leftJoin('o.Client f');
				$query->leftJoin('o.ShippingClient sc');
				$query->leftJoin('o.BillingClient bc');
				$query->leftJoin('o.BillingAttorney ba');
				$query->leftJoin('ba.Person billing_person');
				$query->leftJoin('o.ShippingAttorney sa');
				$query->leftJoin('sa.Person shipping_person');
				$query->where('o.JobID = ?', $jobId);
				$query->limit($maxResults);
				$resultSet = $query->execute();
				
				if(sizeof($resultSet) == 0) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No results found';
					$this->serviceResult->returnCode = Esquire_Service_Result::NO_RESULTS;
				} else {
					$this->serviceResult = new Esquire_Service_Result(Esquire_Service_Result::SUCCESS);
					$this->serviceResult->data = $resultSet;
				}
			}
		
			return $this->serviceResult;
		}
	}
	
	
	public function storeOrder($token, Models_Solaria_Orders $order) {
		$serviceResult = new Esquire_Service_Result(Esquire_Service_Result::GENERAL_ERROR);
		
		$this->companyId = $order->CompanyID;
		
		
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			
			if(empty($this->companyId)) {
				$serviceResult->returnCode = Esquire_Service_Result::BAD_DATA;
				$serviceResult->faultString = 'No company ID provided for save order request.';
			} elseif(empty($order)) {
				$serviceResult->returnCode = Esquire_Service_Result::BAD_DATA;
				$serviceResult->faultString = 'Tried to store empty order.';
			} else {
				$order = $this->applyMissingDefaults($order);
				
				try {
					$this->persistOrder($order);
					$order->refresh(true);
					$serviceResult->returnCode = Esquire_Service_Result::SUCCESS;
					$serviceResult->data = $order;
				} catch(Exception $e) {
					$serviceResult->data = $order;
					$serviceResult->returnCode = Esquire_Service_Result::DATABASE_ERROR;
					$serviceResult->faultString = $e->getMessage();
				}				
			}
			
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		
		return $serviceResult;
		
	}
	
	private function applyMissingDefaults(Models_Solaria_Orders $order) {
		$result = new Esquire_Service_Result(Esquire_Service_Result::UNKNOWN_ERROR);
		$config = Esquire_Config_Factory::getApplicationConfig();

		if (empty($order->UserID)) {
			$defaultUser = Doctrine_Core::getTable('Models_Solaria_SystemUser')->findOneByLoginName($config->services->default_solaria_user->login_name);
			$order->UserID = $defaultUser->UserID;
		}

		if (empty($order->ShippingMethodID)) {
			$defaultShippingMethod = Doctrine_Core::getTable('Models_Solaria_ShippingMethod')->findOneByDescription($config->services->default_solaria_shipping_method->description);
			$order->ShippingMethodID = $defaultShippingMethod->ShippingMethodID;
		}
		
		// RECOMMEND: Check this against the CodeComplete book to see if I'm an idiot.
		// all non-null properties of a Models_Solaria_Orders obejct.
		$order->CompanyID = empty($order->CompanyID) ? $this->companyId : $order->CompanyID;
		$order->JobID = empty($order->JobID) ? 0 : $order->JobID;
		$order->ClientID = empty($order->ClientID) ? 0 : $order->ClientID;

		/*
		 * Removed empty() check - false is considered empty which prevented the record from being saved with a value of false.
		 *
		 * @see Services_OrderTest::testAbleToUpdateIsShipSameAsBillField()
		 */
		$order->IsShipSameAsBill = ($order->IsShipSameAsBill !== false) ? true : false;

		$order->IsVoided = empty($order->IsVoided) ? false : $order->IsVoided;
		$order->RepositoryAccess = empty($order->RepositoryAccess) ? false : $order->RepositoryAccess;
		$order->IsRecurring = empty($order->IsRecurring) ? false : $order->IsRecurring;
		$order->RecurType = empty($order->RecurType) ? 0 : $order->RecurType;
		$order->RecurNumMonths = empty($order->RecurNumMonths) ? 0 : $order->RecurNumMonths;
		
		return $order;
	}
	
	private function persistOrder(Models_Solaria_Orders $order) {
		$connection = $this->getCompanyDataConnection($this->companyId);
		if(empty($order->CompanyID)) {
			$order->CompanyID = $this->companyId;
		}
		$order->save($connection);
		return $order;
	}
	
	public function fromArray($token, array $orderData) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$this->companyId = $orderData['CompanyID'];
			$connection = $this->getCompanyDataConnection($this->companyId);
			$manager = Doctrine_Manager::getInstance();
			$manager->setCurrentConnection($manager->getConnectionName($connection));
			Doctrine_Core::getTable('Models_Solaria_Orders')->setConnection($connection);

			/*
			 * The assignIdentifier() call is necessary to make the new record aware that it actually represents an existing row.
			 *   It also marks the record "clean".  The fromArray() call will mark it "dirty" (assuming the array contains 
			 * modified data) so the fromArray() call must follow the assignIdentifier() call.
			 *
			 * @see Services_OrderTest::testModifiedFieldsAreProperlySaved()
			 */
			$order = new Models_Solaria_Orders();
			if (array_key_exists('OrderID', $orderData) && $orderData['OrderID'] > 0) {
				$order->assignIdentifier($orderData['OrderID']);
			}
			$order->fromArray($orderData, true);

		} else {
			$this->logger->log('Order service has registered a call to ' . __METHOD__ . ' with improper security.', Zend_log::ERR);
			return NULL;
		}
		return $order;
	}
}
