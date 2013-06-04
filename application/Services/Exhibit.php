<?php
/**
 * Exhibits are per deponent. This class has methods to populate the front end drop-downs
 * in the Exhibits fieldset.
 * @author michael.locke @ Dec 21, 2012 8:27:54 AM
 */
class Services_Exhibit extends Services_Base {
	
	public function getExhibitInstructionList($token) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->select('ei.*');
				$query->from('Models_Solaria_ExhibitInstruction ei');
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
	
	public function getExhibitTurnInList($token) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->select('eti.*');
				$query->from('Models_Solaria_ExhibitTurnIn eti');
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
}