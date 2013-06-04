<?php
/**
 * Case Service to provide case information to all comers.
 * @author jason.vanhoy @ 6-25-2012
 *
 */
class Services_Case extends Services_Base
{

	public function getCaseById($token, $caseId, array $desiredColumns = NULL) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$this->serviceResult = new Esquire_Service_Result(Esquire_Service_Result::SUCCESS);
			
			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} elseif(empty($caseId)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'Specific record requested but no identifier provided.';
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->select('c.*');
				$query->from('Models_Solaria_Cases c');
				$query->where('CaseId = ?' , array($caseId));
				$record = $query->execute()->getData();
				
				if(empty($record)) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No results found';
					$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
				} else {
					$case = $record[0]->getData();
					
					if(!empty($desiredColumns)) {
						foreach($case as $param => $val) {
							if(!in_array($param, $desiredColumns)) {
								unset($case[$param]);
							}
						}
					}
					
					$this->serviceResult->data = $case;
				}
			}
			
			return $this->serviceResult;
		}
	}

	public function getCaseByJobId($token, $jobId, array $desiredColumns = NULL) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$this->serviceResult = new Esquire_Service_Result(Esquire_Service_Result::SUCCESS);
			
			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'Unable to get database connection.';
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} elseif(empty($jobId)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'Specific record requested but no identifier provided.';
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->select('c.*');
				$query->from('Models_Solaria_Cases c');
				$query->leftJoin('c.Job j');
				$query->where('j.JobId = ?', array($jobId));
				$record = $query->execute()->getData();
				
				if(empty($record)) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No results found';
					$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
				} else {
					$case = $record[0]->getData();
					
					if(!empty($desiredColumns)) {
						foreach($case as $param => $val) {
							if(!in_array($param, $desiredColumns)) {
								unset($case[$param]);
							}
						}
					}
					
					$this->serviceResult->data = $case;
				}
			}
			
			return $this->serviceResult;
		}
	}

	public function getCaseList($token, $fromDate = null, $toDate = null) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			
			if(empty($fromDate)) {
				$fromDate = date('1972-05-22');
			}

			if(empty($toDate)) {
				$toDate = date('Y-m-d');
			}

			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->select('c.*');
				$query->from('Models_Solaria_Cases c');
				$query->where('TrialDate BETWEEN \'' . $fromDate . '\' AND \'' . $toDate . '\'');
				$query->limit(10);
				
				$resultSet = $query->execute(null, Doctrine_Core::HYDRATE_ARRAY);
				
				
				if(empty($resultSet)) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No results found';
					$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
				} else {
					$this->serviceResult = new Esquire_Service_Result(Esquire_Service_Result::SUCCESS);
					$this->serviceResult->data = $resultSet;							
				}
			}

			return $this->serviceResult;
		}
	}

	public function deleteCase($caseId) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$this->serviceResult = new Esquire_Service_Result(Esquire_Service_Result::RECORD_NOT_FOUND);
			$this->serviceResult->faultString = "This feature not yet implemented";
			return $this->serviceResult;
		}
	}
}