<?php
require_once 'AbstractController.php';

class Rest_ReporterTimeAndDistanceController extends Rest_AbstractController
{
	public function indexAction() {
		$this->setService(Esquire_Service_Factory::getService('ReporterTimeAndDistance'));
		$service = $this->getService();
		$service instanceof Services_ReporterTimeAndDistance;
		
		$this->logger->log('ReporterTimeAndDistance list requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$result = $service->getReporterTimeAndDistanceList($this->token);
				$this->processResult($result);
			} else {
				$this->setResponseCode(Rest_RestHelper::HTTP_FORBIDDEN);
				$this->setResponseData('Invalid or expired token provided.', TRUE);
			}
		} catch(Exception $e) {
			$this->processException($e);
		}
	}
	
	public function getAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Record retrieval functionality not yet implemented.]');
	}
	
	public function postAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Functionality not yet implemented.]');
	}
	
	public function putAction(){
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Functionality not yet implemented.]');	
	}
	
	public function deleteAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Functionality not yet implemented.]');	
	}
	
	protected function parseIncomingData() {
		return NULL;	
	}
}
