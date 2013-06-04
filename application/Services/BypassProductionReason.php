<?php
/**
 * A service to provide a BypassProductionReason list and so forth and whatnot.
 * @author Michael Locke @ Nov 13, 2012 10:35:45 AM
 */
class Services_BypassProductionReason extends Services_Base
{
	public function getBypassProductionReasonList($token, $maxResults = 1000000) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = null;
			if ($this->companyId > 0) {
				$conn = $this->getCompanyDataConnection($this->companyId);
			}
			
			$query = Doctrine_SolariaQuery::create($conn);
			$query->select('bpr.*');
			$query->from('Models_Solaria_BypassProductionReason bpr');
			$query->limit($maxResults);
			$resultSet = $query->execute();

			if($resultSet->count() == 0) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No results found';
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$this->serviceResult = new Esquire_Service_Result(Esquire_Service_Result::SUCCESS);
				$this->serviceResult->data = $resultSet;
			}
			
			return $this->serviceResult;
		}
	}
}
