<?php


require_once 'AbstractController.php';


/**
 *
 * @author jason.vanhoy @ Nov 14, 2012 8:21:47 AM
 */
class Rest_AttorneyController extends Rest_AbstractController {
	
	
	public function indexAction() {
		$this->setService(Esquire_Service_Factory::getService('Attorney'));
		$this->logger->log('Attorney list requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
		
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$filterString = $this->_getParam('filterString');
				$maxResults = $this->_getParam('maxResults');
				$clientId = $this->_getParam('ClientID');
				$result = $this->getService()->getAttorneyList($this->token, $filterString, $maxResults, $clientId);
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
		$this->setService(Esquire_Service_Factory::getService('Attorney'));
		$this->logger->log('Specific Attorney requested. Ask me more later, time is of the essence right now.', Zend_Log::DEBUG);
		
		$service = $this->getService();
		$service instanceof Services_Firm;
		
		try {
			$valid = $this->validateCredentials();
			
			if($valid) {
				$clirmId = $this->_getParam('id');
				$result = $service->getAttorneyById($this->token, $clirmId);
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
		$this->setService(Esquire_Service_Factory::getService('Attorney'));
		
		// RECOMMEND: include duplicate check if asked for (see below).
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$attorney = $this->parseIncomingData();
				
				if(empty($attorney)) {
					$this->logger->log(__METHOD__ . '--Empty attorney object given in POST transaction. This is not allowed.', Zend_Log::ERR);
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Empty attorney object provided.', TRUE);
				} else {
					$result = $this->getService()->storeAttorney($this->token, $attorney);
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
		$this->setService(Esquire_Service_Factory::getService('Attorney'));
		
		// RECOMMEND: include duplicate check if asked for (see below).
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$attorney = $this->parseIncomingData();
				
				if(empty($attorney)) {
					$this->logger->log(__METHOD__ . '--Empty attorney object given in POST transaction. This is not allowed.', Zend_Log::ERR);
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Empty attorney object provided.', TRUE);
				} elseif(empty($attorney->AttorneyID)) {
					$this->logger->log(__METHOD__ . '--Attorney object has empty ID in PUT transaction. This is not allowed.', Zend_Log::ERR);
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Client object has empty ID in PUT transaction.', TRUE);			
				} else {
					$result = $this->getService()->storeAttorney($this->token, $attorney);
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
			$attorneyData = json_decode(stripslashes($payload), true);
			if (!is_array($attorneyData) || !array_key_exists('PersonID', $attorneyData)) {
				throw new Exception('The received data is invalid or missing');
			}
		} elseif (strpos($content_type, 'application/xml') !== false) {
			// TODO: implement XML handling
		} elseif (strpos($content_type, 'application/x-www-form-urlencoded') !== false) {
			parse_str($this->getRequest()->getRawBody(), $postvars);
			foreach($postvars as $field => $value) {
				$attorneyData[$field] = $value;
			}
		}
		
		$attorney = $this->getService()->fromArray($this->token, $attorneyData);
		
		// NOTE: per Jira EC-1463
		$attorney = Esquire_Utility_Common::uppercaseObjectOrArray($attorney);
		
		return $attorney;
	}
	
}
