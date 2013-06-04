<?php
/**
 *
 * @author jason.vanhoy @ Nov 13, 2012 1:50:25 PM
 */
class Services_Firm extends Services_Base {
	
	
	public function getFirmByName($token, $name) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
				
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->from('Models_Solaria_Client c');
				$query->where('c.Name = ?', $name);
				$resultSet = $query->execute();
	
				if(sizeof($resultSet) == 0) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No results found';
					$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
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
	
	
	
	public function getFirmById($token, $firmId) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
		
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->from('Models_Solaria_Client c');
				$query->where('c.ClientID = ?', $firmId);
				$resultSet = $query->execute();
		
				if(sizeof($resultSet) == 0) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No results found';
					$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
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
	
	
	public function storeFirm($token, Models_Solaria_Client $firm, $suppressDuplicateWarning = FALSE) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			try {
				$this->companyId = $firm->CompanyID;
				$connection = $this->getCompanyDataConnection($firm->CompanyID);
				$duplicateFirm = $this->isDuplicate($token, $firm);
	
				if($duplicateFirm && !$suppressDuplicateWarning) {
					$this->serviceResult->returnCode = Esquire_Service_Result::DATABASE_ERROR;
					$this->serviceResult->data = $firm;
					$this->serviceResult->faultString = 'Duplicate record.';
				} else {
					$firm->save($connection);
					$this->serviceResult->data = $firm;
					$this->serviceResult->returnCode = Esquire_Service_Result::SUCCESS;
					$this->serviceResult->faultString = null;
				}
	
			} catch(Exception $e) {
				$this->serviceResult->data = null;
				$this->serviceResult->returnCode = Esquire_Service_Result::GENERAL_ERROR;
				$this->serviceResult->faultString = $e->getMessage();
			}
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
	
		return $this->serviceResult;
	}
	
	
	
	
	public function getFirmList($token, $filterString = '', $maxResults = 1000000) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
				
			$conn = $this->getCompanyDataConnection($this->companyId);
			$filterString = '%' . $filterString . '%';
				
			if(empty($maxResults)) {
				$maxResults = 1000000;
			}
				
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->select('c.*');
				$query->from('Models_Solaria_Client c');
				$query->leftJoin('c.Company o');
				$query->where('c.Name LIKE ?', $filterString);
				$query->limit($maxResults);
				$resultSet = $query->execute();

				//echo "RESULTS - " . print_r($resultSet->toArray());
				//$this->logger->log('RESULTS: ' . print_r($resultSet->toArray(), true), Zend_Log::DEBUG);
	
				if(sizeof($resultSet) == 0) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No results found';
					$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
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
	
	
	public function fromArray($token, array $firmData) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$firm = new Models_Solaria_Client();
			$firm->fromArray($firmData, true);
			return $firm;
		} else {
			$this->logger->log('Firm service has registered a call to ' . __METHOD__ . ' with improper security.', Zend_log::ERR);
			return NULL;
		}

		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$this->companyId = $firmData['CompanyID'];
			$connection = $this->getCompanyDataConnection($this->companyId);
			$manager = Doctrine_Manager::getInstance();
			$manager->setCurrentConnection($manager->getConnectionName($connection));
			Doctrine_Core::getTable('Models_Solaria_Client')->setConnection($connection);

			$firm = new Models_Solaria_Client();
			if (array_key_exists('ClientID', $firmData) && $firmData['ClientID'] > 0) {
				$firm->assignIdentifier($firmData['ClientID']);
			}
			$firm->fromArray($firmData, true);
		} else {
			$this->logger->log('Firm service has registered a call to ' . __METHOD__ . ' with improper security.', Zend_log::ERR);
			return NULL;
		}
		return $attorney;
	}
	
	
	protected function isDuplicate($token, Models_Solaria_Client $firm) {
		$isDuplicate = TRUE;
	
		$result = $this->getFirmByName($token, $firm->Name);
	
		if($result->returnCode == Esquire_Service_Result::RECORD_NOT_FOUND) {
			$isDuplicate = FALSE;
		} else {
			$isDuplicate = TRUE;
		}
		
		return $isDuplicate;
	}
}
