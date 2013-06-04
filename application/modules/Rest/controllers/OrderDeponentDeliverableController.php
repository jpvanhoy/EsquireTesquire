<?php

require_once 'AbstractController.php';


/**
 *
 * @author jason.vanhoy @ Mar 5, 2013 2:18:20 PM
 */
class Rest_OrderDeponentDeliverableController extends Rest_AbstractController {
	public function indexAction() {
		$orderId = $this->_getParam('orderId');
		$deponentId = $this->_getParam('deponentId');
		
		$this->setService(Esquire_Service_Factory::getService('Deliverable'));
		
		if(empty($orderId)) {
			$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
			$this->setResponseData('Specific record requested, but record identifier not provided.', TRUE);
			$this->logger->log(__METHOD__ . $this->responseData, Zend_Log::ERR);
		}
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$result = $this->getService()->getOrderDeponentDeliverable($this->token, $orderId, $deponentId);
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
		$this->setService(Esquire_Service_Factory::getService('Deliverable'));
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$orderDeponentDeliverable = $this->parseIncomingData();
				$result = $this->getService()->saveOrderDeponentDeliverable($this->token, $orderDeponentDeliverable);
				$this->processResult($result);
			} else {
				$this->setResponseCode(Rest_RestHelper::HTTP_FORBIDDEN);
				$this->setResponseData('Invalid or expired token provided.', TRUE);
			}
		} catch(Exception $e) {
			$this->processException($e);
		}
		
	}
	
	public function putAction() {
		$this->setService(Esquire_Service_Factory::getService('Deliverable'));
		
		try {
			$valid = $this->validateCredentials();
		
			if($valid) {
				$orderDeponentDeliverable = $this->parseIncomingData();
		
				if(empty($orderDeponentDeliverable->OrderID)) {
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('No OrderID found for requested update.', TRUE);
				} else {
					$result = $this->getService()->saveOrderDeponentDeliverable($this->token, $orderDeponentDeliverable);
					$this->processResult($result);
				}
			} else {
				$this->setResponseCode(Rest_RestHelper::HTTP_FORBIDDEN);
				$this->setResponseData('Invalid or expired token provided.', TRUE);
			}
		} catch(Exception $e) {
			$this->processException($e);
		}
	}
	
	public function deleteAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_METHOD_NOT_ALLOWED);
		$this->setResponseData('Method not implemented.', TRUE);
	}
	
	protected function parseIncomingData() {
		if(isset($_SERVER['CONTENT_TYPE'])) {
			$content_type = $_SERVER['CONTENT_TYPE'];
		} else {
			$content_type = 'application/json';
		}
		
		if (strpos($content_type, 'application/json') !== false) {
			$payload = $this->getRequest()->getRawBody();
			$deliverableData = json_decode(stripslashes($payload), true);
			
			if (!is_array($deliverableData)) {
				throw new Exception('The received data is invalid or missing');
			}
		} elseif (strpos($content_type, 'application/xml') !== false) {
			// TODO: implement XML handling
		} elseif (strpos($content_type, 'application/x-www-form-urlencoded') !== false) {
			parse_str($this->getRequest()->getRawBody(), $postvars);
			foreach($postvars as $field => $value) {
				$deliverableData[$field] = $value;
			}
		}
		
		$orderDeponentDeliverable = $this->getService()->fromArray($this->token, $deliverableData);
		
		return $orderDeponentDeliverable;
	}
	
}
