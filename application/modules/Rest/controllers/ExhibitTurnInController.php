<?php
require_once 'AbstractController.php';

class Rest_ExhibitTurnInController extends Rest_AbstractController
{
	public function indexAction() {
		$this->setService(Esquire_Service_Factory::getService('Exhibit'));
		
		$this->logger->log('Exhibit Turn-In list requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$result = $this->getService()->getExhibitTurnInList($this->token);
				$this->processResult($result);
			} else {
				$this->setResponseCode(Rest_RestHelper::HTTP_FORBIDDEN);
				$this->setResponseData('Invalid or expired token provided.', TRUE);
			}
		} catch(Exception $e) {
			$this->processException($e);
		}
	}
	
	public function getAction() 
	{
		
	}
	
	public function postAction() {
		
	}
	
	public function putAction() {
		
	}
	
	public function deleteAction() 
	{
		
	}
	
	protected function parseIncomingData() {
		return NULL;
	}
}
