<?php

require_once 'AbstractController.php';

class Rest_ReporterWorksheetController extends Rest_AbstractController
{
	public function indexAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Record list functionality not yet implemented.]');
	}
	
	public function getAction() {
		$id = $this->_getParam('id');
		
		$this->setService(Esquire_Service_Factory::getService('Job'));
		$service = $this->getService();
		$service instanceof Services_Job;

		if(empty($id)) {
			$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
			$this->setResponseData('Specific record requested, but record identifier not provided.', TRUE);
			$this->logger->log(__METHOD__ . $this->responseData, Zend_Log::ERR);
		}
		
		try {
			$valid = $this->validateCredentials();
			
			if($valid) {
                $result = $service->getJobBySuperId(
                    $this->token, $id, null,
                    array(
                        'JobReporterCost.ReporterCost', 'JobPerformedService.PerformedService',
                        'JobReporterTimeAndDistance.ReporterTimeAndDistance', 'ReporterWorksheetStatus',
                        'BypassProductionReason', 'JobAppearanceType.AppearanceType',
                        'Cases.Jurisdiction', 'JobPriorityType',
                        'JobLocation.Address',
                        'Client'
                    )
                );
				$this->processResult($result);
			} else {
				$this->setResponseCode(Rest_RestHelper::HTTP_FORBIDDEN);
				$this->setResponseData('Invalid or expired token provided.', TRUE);
			}
		} catch(Exception $e) {
			$this->processException($e);
		}		
	}
	
	public function postAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Record insert/edit functionality not yet implemented.]');
	}
	
	public function putAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Record insert/edit functionality not yet implemented.]');
	}
	
	public function deleteAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Record delete functionality not yet implemented.]');
	}
}
