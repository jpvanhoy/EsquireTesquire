<?php
/**
 *
 * @author jason.vanhoy @ Jan 23, 2013 9:39:17 AM
 */
class Services_Address extends Services_Base {
	
	
	
	public function getAddressListForFirm($token, $clientId, $maxResults = 1000000) {
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
				$query->from('Models_Solaria_Address a');
				$query->leftJoin('a.ClientAddress ca');
				$query->where('ca.ClientID = ' . $clientId);
				$query->limit($maxResults);
				
				$this->logger->log('Attempting to pull addresses for clientId of ' . $clientId . ' which gives the SQL output of [' . $query->getSqlQuery() . ']', Zend_Log::DEBUG);
							
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
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}
	
	
	
	
	public function getAddressById($token, $addressId) {
		$this->serviceResult = new Esquire_Service_Result(Esquire_Service_Result::GENERAL_ERROR);
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
		
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->from('Models_Solaria_Address a');
				$query->where('AddressID = ?', $addressId);
				
				$addressList = $query->execute();

				
				if($addressList->count() == 0) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No results found';
					$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
				} else {
					$address = $addressList->getFirst();
					$this->serviceResult->data = $address;
					$this->serviceResult->returnCode = Esquire_Service_Result::SUCCESS;
					$this->serviceResult->faultString = NULL;
				}
			}				
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}
	
	
	public function storeAddress($token, $address) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			if($address instanceof Models_Solaria_ClientAddress) {
				$this->serviceResult = $this->storeClientAddress($address);
			} else {
				$this->serviceResult->returnCode = Esquire_Service_Result::BAD_DATA;
				$this->serviceResult->faultString = 'Unrecognized Address type submitted, cannot save.';
				$this->serviceResult->data = NULL;
			}
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}
	
	
	
	
	public function fromArray($token, $addressData) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$connection = $this->getCompanyDataConnection($this->companyId);
			$manager = Doctrine_Manager::getInstance();
			$manager->setCurrentConnection($manager->getConnectionName($connection));
			Doctrine_Core::getTable('Models_Solaria_Address')->setConnection($connection);
			Doctrine_Core::getTable('Models_Solaria_ClientAddress')->setConnection($connection);
			
			if(array_key_exists('ClientID', $addressData)) {
				$address = new Models_Solaria_ClientAddress();
				$address->fromArray($addressData, TRUE);				
				$this->logger->log('ClientAddress ostensibly created from incoming array:', Zend_Log::DEBUG);
			} else {
				$this->logger->log('Did not find ClientID array key, so presuming generic address object...', Zend_Log::DEBUG);
				$address = new Models_Solaria_Address();
				$address->fromArray($addressData, true);				
			}
			
		
		} else {
			$this->logger->log('Address service has registered a call to ' . __METHOD__ . ' with improper security.', Zend_log::ERR);
			return NULL;
		}
		
		return $address;
	}
	
	
	
	private function storeClientAddress(Models_Solaria_ClientAddress $address) {
		$result = new Esquire_Service_Result(Esquire_Service_Result::UNKNOWN_ERROR);
		
		if(empty($address->ClientID) && empty($address->Client)) {
			$result->returnCode = Esquire_Service_Result::BAD_DATA;
			$result->faultString = 'No ClientID provided with ClientAddress, therefore record not saved. Bad data reattached for examination.';
			$result->data = $address;
			$this->logger->log(__METHOD__ . ' says ClientAddress object supplied without clientId.', Zend_Log::ERR);
		} else {
			if(empty($this->companyId)) {
				$result->returnCode = Esquire_Service_Result::BAD_DATA;
				$result->faultString = 'No CompanyID provided during ClientAddress transaction, therefore record not saved.';
				$result->data = $address;
				$this->logger->log(__METHOD__ . ' says ClientAddress transaction attempted without companyId.', Zend_Log::ERR);
			} else {
				$connection = $this->getCompanyDataConnection($this->companyId);
				$address->save($connection);
				$address->refresh(TRUE);
				$result->returnCode = Esquire_Service_Result::SUCCESS;
				$result->data = $address;		
				$result->faultString = NULL;
			}
		}
		
		
		return $result;	
		
		
	}
	
	
}
