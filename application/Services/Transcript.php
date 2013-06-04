<?php
/**
 * Transcripts are also known as Deponents. Which are actually people. Yeah, word.
 * @author jason.vanhoy @ Nov 20, 2012 8:27:54 AM
 */
class Services_Transcript extends Services_Base {
	
	public function getTranscriptList($token, $jobId) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			
			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->from('Models_Solaria_JobDeponent jd');
				$query->leftJoin('jd.Deponent d');
				$query->leftJoin('d.Person p');
				$query->leftJoin('jd.ReadAndSign rs');
				$query->leftJoin('jd.Exhibit je');
				$query->where('jd.JobId = ?', $jobId);
				
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
	
	public function getConfidentialityTypesList($token) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->select('c.*');
				$query->from('Models_Solaria_Confidentiality c');
				$query->orderBy('sortorder');
				
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
	
	public function getTranscriptTypesList($token) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->select('t.*');
				$query->from('Models_Solaria_TranscriptType t');
				$query->orderBy('sortorder');
				
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
	
	
	public function deleteTranscript($token, Models_Solaria_JobDeponent $transcript) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			
			
			if(empty($this->companyId)) {
				$this->companyId = $transcript->Deponent->Person->CompanyID;
			}
			
			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = NULL;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				try {
					$query = Doctrine_Query::create($conn);
					$query->from('Models_Solaria_OrderItem oi');
					$query->leftJoin('oi.Orders o');
					$query->where('DeponentID = ' . $transcript->DeponentID);
					$query->andWhere('o.IsVoided = 0');
					
					$orderItems = $query->execute();
					
					if($orderItems->count() > 0) {
						$this->serviceResult->data = $transcript;
						$this->serviceResult->returnCode = Esquire_Service_Result::DATABASE_ERROR;
						$this->serviceResult->faultString = 'Deponent related to existing, unvoided order, cannot delete.';
					} else {
						/*
						 * Note regarding unexpected complexity:
						 * $transcript->delete() and $transcript->delete($conn) both fail here, 
						 * but the following code works. Yay.
						 * --JPV @ Dec 6, 2012 12:34:20 PM
						 */
						$query = Doctrine_Query::create($conn)->delete('Models_Solaria_JobDeponent');
						$query->where('JobDeponentID = ' . $transcript->JobDeponentID);
						$success = $query->execute();
						
						$this->logger->log('Return value of $query->execute() in ' . __METHOD__ . ' is: ' . $success, Zend_Log::DEBUG);
						
						if($success) {
							$this->serviceResult->data = NULL;
							$this->serviceResult->faultString = NULL;
							$this->serviceResult->returnCode = Esquire_Service_Result::SUCCESS;
						} else {
							$this->serviceResult->data = $success;
							$this->serviceResult->returnCode = Esquire_Service_Result::UNKNOWN_ERROR;
							$this->serviceResult->faultString = 'Unknown error occurred deleting JobDeponent, there may be additional info in the logs.';
						}
					}
					
				} catch(Exception $e) {
					$this->serviceResult->data = $transcript;
					$this->serviceResult->faultString = $e->getMessage();
					$this->serviceResult->returnCode = Esquire_Service_Result::DATABASE_ERROR;
				}
			}
			
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}
	
	public function saveConfidentialityType($token, Models_Solaria_Confidentiality $confidentialityType) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$confidentialityType->save($conn);
				$this->serviceResult->returnCode = Esquire_Service_Result::SUCCESS;
				$this->serviceResult->faultString = NULL;
				$this->serviceResult->data = $confidentialityType;
			}
			
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}
	
	public function saveTranscriptType($token, Models_Solaria_TranscriptType $transcriptType) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$transcriptType->save($conn);
				$this->serviceResult->returnCode = Esquire_Service_Result::SUCCESS;
				$this->serviceResult->faultString = NULL;
				$this->serviceResult->data = $transcriptType;
			}
			
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}

	public function fromArray($token, array $transcriptData) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$this->companyId = $transcriptData['Deponent']['Person']['CompanyID'];
			$connection = $this->getCompanyDataConnection($this->companyId);
			$manager = Doctrine_Manager::getInstance();
			$manager->setCurrentConnection($manager->getConnectionName($connection));
			Doctrine_Core::getTable('Models_Solaria_JobDeponent')->setConnection($connection);
			$transcript = new Models_Solaria_JobDeponent();
			$transcript->fromArray($transcriptData, true);
			return $transcript;
		} else {
			$this->logger->log('Firm service has registered a call to ' . __METHOD__ . ' with improper security.', Zend_log::ERR);
			return NULL;
		}
	}
}
