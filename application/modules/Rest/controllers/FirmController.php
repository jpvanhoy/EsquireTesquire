<?php


require_once 'AbstractController.php';


/**
 *
 * @author jason.vanhoy @ Nov 14, 2012 8:21:47 AM
 */
class Rest_FirmController extends Rest_AbstractController {
	
	
	public function indexAction() {
		$this->setService(Esquire_Service_Factory::getService('Firm'));
		$this->logger->log('Clirm list requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
		
		$service = $this->getService();
		$service instanceof Services_Firm;
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$filterString 	= $this->_getParam('filterString');
				$maxResults		= $this->_getParam('maxResults');
				$result 		= $service->getFirmList($this->token, $filterString, $maxResults);
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
		$this->setService(Esquire_Service_Factory::getService('Firm'));
		$this->logger->log('Specific Clirm requested. Ask me more later, time is of the essence right now.', Zend_Log::DEBUG);
		
		$service = $this->getService();
		$service instanceof Services_Firm;
		
		try {
			$valid = $this->validateCredentials();
			
			if($valid) {
				$clirmId = $this->_getParam('id');
				$result = $service->getFirmById($this->token, $clirmId);
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
		$this->setService(Esquire_Service_Factory::getService('Firm'));
		
		$suppressDuplicateWarning = $this->_getParam('suppressDuplicateWarning');
		$suppressDuplicateWarning = empty($suppressDuplicateWarning) ? FALSE : $suppressDuplicateWarning;
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$client = $this->parseIncomingData();
				
				if(empty($client)) {
					$this->logger->log(__METHOD__ . '--Empty client object given in POST transaction. This is not allowed.', Zend_Log::ERR);
					
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Empty CLIENT object provided.', TRUE);
				} else {
					$result = $this->getService()->storeFirm($this->token, $client, $suppressDuplicateWarning);
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
		$this->setService(Esquire_Service_Factory::getService('Firm'));
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$client = $this->parseIncomingData();
				
				if(empty($client)) {
					$this->logger->log(__METHOD__ . '--Empty client object given in POST transaction. This is not allowed.', Zend_Log::ERR);
					
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Empty CLIENT object provided.', TRUE);
				} elseif(empty($client->ClientID)) {
					$this->logger->log(__METHOD__ . '--Client object with empty ClientID given in PUT transaction. This is not allowed.', Zend_Log::ERR);
					
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Client object provided, but with empty ClientID.', TRUE);					
				} else {
					$result = $this->getService()->storeFirm($this->token, $client);
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
	
	protected final function parseIncomingData() {
		if(isset($_SERVER['CONTENT_TYPE'])) {
			$content_type = $_SERVER['CONTENT_TYPE'];
		}
		
		if (strpos($content_type, 'application/json') !== false) {
			$payload = $this->getRequest()->getRawBody();
			$firmData = json_decode(stripslashes($payload), true);
			if (!is_array($firmData) || !array_key_exists('ClientID', $firmData)) {
				throw new Exception('The received data is invalid or missing');
			}
		} elseif (strpos($content_type, 'application/xml') !== false) {
			// TODO: implement XML handling
		} elseif (strpos($content_type, 'application/x-www-form-urlencoded') !== false) {
			parse_str($this->getRequest()->getRawBody(), $postvars);
			foreach($postvars as $field => $value) {
				$firmData[$field] = $value;
			}
		}
		
		$firm = $this->getService()->fromArray($this->token, $firmData);
		
		return $firm;
	}
	
}
