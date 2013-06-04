<?php
require_once 'AbstractController.php';

class Rest_SignatureProtocolController extends Rest_AbstractController
{
	public function indexAction() 
	{
		$this->setService(Esquire_Service_Factory::getService('SignatureProtocol'));
		$service = $this->getService();
		$service instanceof Services_SignatureProtocol;
		
		$this->logger->log('SignatureProtocol list requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$result = $service->getSignatureProtocolList($this->token);
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
		$this->setResponseData('[Record insert functionality not yet implemented.]');
	}
	
	public function putAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Record update functionality not yet implemented.]');
	}
	
	public function deleteAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Record delete functionality not yet implemented.]');
	}
	
	protected function parseIncomingData() {
		// RECOMMEND: For future functionality.
		
		return NULL;
	}
}
