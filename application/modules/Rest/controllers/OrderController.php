<?php
require_once 'AbstractController.php';

class Rest_OrderController extends Rest_AbstractController
{
	public function indexAction() {
		$this->setService(Esquire_Service_Factory::getService('Order'));
		$service = $this->getService();
		$service instanceof Services_Order;
		
		$this->logger->log('Order list requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
	
		try {
			$valid = $this->validateCredentials();
			
			if($valid) {
				$jobId = $this->_getParam('JobID');

				$result	= $service->getOrderListByJobId($this->token, $jobId);
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
		$this->setService(Esquire_Service_Factory::getService('Order'));
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$order = $this->parseIncomingData();
				$order instanceof Models_Solaria_Orders;
				
				if(empty($order)) {
					$this->logger->log(__METHOD__ . '--Empty order object given in POST transaction. This is not allowed.', Zend_Log::ERR);
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Empty ORDER object provided. You must include an Attorney or something. Right Andrew?', TRUE);
				} elseif(!empty($order->OrderID)) {
					$this->logger->log(__METHOD__ . '--Order object already has ID in POST transaction. This is not allowed.', Zend_Log::ERR);
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Order object already has ID in POST transaction.', TRUE);					
				} else {
					$result = $this->getService()->storeOrder($this->token, $order);
					$this->processResult($result);
				}
			} else {
				$this->logger->log(__METHOD__ . 'Invalid or expired security token (' . $this->token . ') provided from ' . $_SERVER['REMOTE_ADDR'], Zend_Log::ERR);
				$this->setResponseCode(Rest_RestHelper::HTTP_FORBIDDEN);
				$this->setResponseData('Invalid or expired token provided.', TRUE);
			}
		} catch(Exception $e) {
			$this->processException($e);
		}
	}
	
	
	public function putAction() {
		$this->setService(Esquire_Service_Factory::getService('Order'));
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$order = $this->parseIncomingData();
				$order instanceof Models_Solaria_Orders;
				
				if(empty($order)) {
					$this->logger->log(__METHOD__ . '--Empty order object given in POST transaction. This is not allowed.', Zend_Log::ERR);
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Empty ORDER object provided.', TRUE);
				} elseif(empty($order->OrderID)) {
					$this->logger->log(__METHOD__ . '--Order object with empty OrderID given in PUT transaction. This is not allowed.', Zend_Log::ERR);
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('ORDER object provided, but with empty OrderID.', TRUE);					
				} else {
					$result = $this->getService()->storeOrder($this->token, $order);
					$this->processResult($result);
				}
			} else {
				$this->logger->log(__METHOD__ . 'Invalid or expired security token (' . $this->token . ') provided from ' . $_SERVER['REMOTE_ADDR'], Zend_Log::ERR);
				$this->setResponseCode(Rest_RestHelper::HTTP_FORBIDDEN);
				$this->setResponseData('Invalid or expired token provided.', TRUE);
			}
		} catch(Exception $e) {
			$this->processException($e);
		}
	}
	
	
	public function deleteAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Record delete functionality not yet implemented.]');
	}
	
	
	
	protected function parseIncomingData() {
		if(isset($_SERVER['CONTENT_TYPE'])) {
			$content_type = $_SERVER['CONTENT_TYPE'];
		}

		if (strpos($content_type, 'application/json') !== false) {
			$payload = $this->getRequest()->getRawBody();
			
			$this->logger->log('RAW DATA: ' . var_export($payload, true), Zend_Log::DEBUG);
			
			$orderData = json_decode(stripslashes($payload), true);
			
			$this->logger->log('DECODED DATA: ' . var_export($orderData, true), Zend_Log::DEBUG);
			
			if (!is_array($orderData) || !array_key_exists('OrderID', $orderData)) {
				throw new Exception('The received data is invalid or missing');
			}
		} elseif (strpos($content_type, 'application/xml') !== false) {
			// TODO: implement XML handling
		} elseif (strpos($content_type, 'application/x-www-form-urlencoded') !== false) {
			parse_str($this->getRequest()->getRawBody(), $postvars);
			foreach($postvars as $field => $value) {
				$jobData[$field] = $value;
			}
		}
		
		$order = $this->getService()->fromArray($this->token, $orderData);
		
		return $order;
	}
	
}
