<?php

require_once 'AbstractController.php';


/**
 *
 * @author jason.vanhoy @ Mar 5, 2013 2:18:20 PM
 */
class Rest_DeliverableController extends Rest_AbstractController {
	public function indexAction() {
		$this->setService(Esquire_Service_Factory::getService('Deliverable'));
		
		$this->logger->log('List requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
		
		try {
			$valid = $this->validateCredentials();
		
			if($valid) {
				$result = $this->getService()->getListOfBaseDeliverables($this->token);
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
		$this->setResponseCode(Rest_RestHelper::HTTP_METHOD_NOT_ALLOWED);
		$this->setResponseData('Method not implemented.', TRUE);
	}
	
	public function postAction() {
		// CREATE
		$this->setResponseCode(Rest_RestHelper::HTTP_METHOD_NOT_ALLOWED);
		$this->setResponseData('Method not implemented.', TRUE);		
	}
	
	public function putAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_METHOD_NOT_ALLOWED);
		$this->setResponseData('Method not implemented.', TRUE);
	}
	
	public function deleteAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_METHOD_NOT_ALLOWED);
		$this->setResponseData('Method not implemented.', TRUE);
	}
	
	protected function parseIncomingData() {
		
	}
	
}