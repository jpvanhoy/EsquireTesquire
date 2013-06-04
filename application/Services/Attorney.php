<?php
/**
 *
 * @author jason.vanhoy @ Nov 9, 2012 1:24:03 PM
 *  
 */

class Services_Attorney extends Services_Base {
	/**
	 * Return a list of attorneys with their client information based on a given [optional] filter string. Searches name and initials fields. Not case-sensitive. Performs partial match on filter string. (e.g., 'Mar' returns attorneys named "Mark" or attorneys with the initials 'MAR')
	 * 
	 * @param String $token Security token provided in first Service interaction. Required for all subsequent interactions.
	 * @param String $filterString [optional] String to filter the results by, partial matches allowed, non-case-sensitive.
	 * @param int $maxResults [optional] Maximum number of results to return.
	 * @return Esquire_Service_Result
	 */
	public function getAttorneyList($token, $filterString = '', $maxResults = 1000000, $clientId = 0) {
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
				$transport = new Esquire_JDL_Transport();
				$filterset = new Esquire_JDL_FilterSet();
				
				$filterset->addFilter(new Esquire_JDL_Filter('FullName', $filterString, TRUE));
				$filterset->addFilter(new Esquire_JDL_Filter('Initials', $filterString, TRUE));
				if($clientId != 0) {
					$filterset->addFilter(new Esquire_JDL_Filter('ClientID', $clientId));
				}
				
				$transport->action = Esquire_JDL_Transport::SEARCH;
				$transport->filter = $filterset;
				$transport->target = 'Models_JDL_VO_Attorney';
				
				$resultSet = $transport->execute();
				
				
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
	
	
	
	public function getAttorneyById($token, $attorneyId) {
		// FIXME: Fucking attorney/person/firm/client crap...
		
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			
			if(empty($attorneyId)) {
				$this->serviceResult->data = NULL;
				$this->serviceResult->faultString = 'Empty ID given for specific record retrieval.';
				$this->serviceResult->returnCode = Esquire_Service_Result::BAD_DATA;
			} else {
				$conn = $this->getCompanyDataConnection($this->companyId);
				
				if(empty($conn)) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
					$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
				} else {
					$query = Doctrine_Query::create($conn);
					$query->from('Models_Solaria_Attorney a');
					$query->leftJoin('a.Person p');
					$query->where('a.AttorneyID = ?', $attorneyId);
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
			}
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}
	
	
	
	public function storeAttorney($token, $attorney, $suppressDuplicateWarning = FALSE) {		
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			try {
				/*
				$connection = $this->getCompanyDataConnection($attorney->CompanyID);
				$duplicateAttorney = $this->isDuplicate($attorney); 
				if($duplicateAttorney && !$suppressDuplicateWarning) {
					$this->serviceResult->returnCode = Esquire_Service_Result::DATABASE_ERROR;
					$this->serviceResult->data = $attorney;
					$this->serviceResult->faultString = 'Duplicate record.';
				} else {
					$attorney->save($connection);					
					$this->serviceResult->data = $attorney;
					$this->serviceResult->returnCode = Esquire_Service_Result::SUCCESS;
					$this->serviceResult->faultString = null;
				}
				*/
				
				
				$transport = new Esquire_JDL_Transport();
				$transport->action = Esquire_JDL_Transport::INPUT;
				$transport->data = $attorney;
				$transport->target = 'Models_JDL_VO_Attorney';
				$transport->execute();
				
				
				
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
	
	
	
	
	public function fromArray($token, array $attorneyData) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$this->companyId = $attorneyData['CompanyID'];
			$connection = $this->getCompanyDataConnection($this->companyId);
			$manager = Doctrine_Manager::getInstance();
			$manager->setCurrentConnection($manager->getConnectionName($connection));
			Doctrine_Core::getTable('Models_Solaria_Person')->setConnection($connection);

			$attorney = new Models_Solaria_Person();
			if (array_key_exists('PersonID', $attorneyData) && $attorneyData['PersonID'] > 0) {
				$attorney->assignIdentifier($attorneyData['PersonID']);
			}
			$attorney->fromArray($attorneyData, true);
		} else {
			$this->logger->log('Attorney service has registered a call to ' . __METHOD__ . ' with improper security.', Zend_log::ERR);
			return NULL;
		}
		return $attorney;
	}
	
	
	protected function isDuplicate(Models_Solaria_Person $attorney) {
		$isDuplicate = TRUE;
		
		/*
		 * "fuzzy logic" check, To be finished at a later date
		$duplicateString = $attorney->Person->FullName;
		$duplicateString .= $attorney->Client->Name;
		$duplicateString .= $attorney->Client->Company->TaxID;   
		
		$duplicateString = strtolower($duplicateString);
		$vowels = '/[aeiou\s.,-\/\&]/';
		$duplicateString = preg_replace($vowels, '', $duplicateString);
		
		$sql  = 'SELECT * FROM attorney a ';
		$sql .= 'LEFT JOIN person p ON (a.personid = p.personid) ';
		$sql .= 'LEFT JOIN client c ON (a.clientid = c.clientid) ';
		$sql .= 'LEFT JOIN company o ON (c.companyid = o.companyid) ';
		$sql .= 'WHERE CONCAT(p.fullname, c.name, o.taxid) = ' . $duplicateString;
		*/
		// TODO: figure out how to do the vowel removal in Doctrine
		
		$query = Doctrine_Query::create();
		$query->from('Models_Solaria_Person p');
		$query->innerJoin('p.Attorney a');
		$query->where('p.FullName = ?', $attorney->FullName);
		$resultSet = $query->execute();
		
		
		
		if(sizeof($resultSet) == 0) {
			$isDuplicate = FALSE;
		} 
		
		return $isDuplicate;
	}
	
}
