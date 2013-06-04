<?php

require_once 'AbstractController.php';


/**
 *
 * @author jason.vanhoy @ Mar 5, 2013 2:18:20 PM 
 */
class Rest_DeliverableOptionController extends Rest_AbstractController {
	public function indexAction() {
		$this->setService(Esquire_Service_Factory::getService('Deliverable'));
		$this->logger->log('List requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
		
		$service = $this->getService();
		$service instanceof Services_Deliverable;
		
		try {
			$valid = $this->validateCredentials();
		
			if($valid) {
				$result	= $service->getListOfBaseDeliverableOptions($this->token);
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
		$orderDeponenetDeliverableId = $this->_getParam('orderDeponenetDeliverableId');
		
		$this->setService(Esquire_Service_Factory::getService('Deliverable'));
		
		if(empty($orderId)) {
			$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
			$this->setResponseData('Specific record requested, but record identifier not provided.', TRUE);
			$this->logger->log(__METHOD__ . $this->responseData, Zend_Log::ERR);
		}
		
		try {
			$valid = $this->validateCredentials();
		
			if($valid) {
				$result = $this->getService()->getDeliverableOptionsForOrderDeponentDeliverable($this->token, $orderDeponenetDeliverableId);
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
		return NULL;
	}
	
}