<?php

require_once 'BaseAddressController.php';

/**
 *
 * @author jason.vanhoy @ Jan 24, 2013 9:13:03 AM
 */
class Rest_ClientAddressController extends Rest_BaseAddressController {
	public function indexAction() {
		$this->setService(Esquire_Service_Factory::getService('Address'));
		$this->logger->log('Address list requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
	
		try {
			$valid = $this->validateCredentials();
	
			if($valid) {
				$maxResults = $this->_getParam('maxResults');
				$clientId = $this->_getParam('ClientID');
				
				$this->logger->log(var_export($this->_getAllParams(), true), Zend_Log::DEBUG);
				
				$this->logger->log('Requesting an index of addresses for clientId: ' . $clientId . '.', Zend_Log::DEBUG);
				
				$result = $this->getService()->getAddressListForFirm($this->token, $clientId, $maxResults);
				$this->processResult($result);
			} else {
				$this->setResponseCode(Rest_RestHelper::HTTP_FORBIDDEN);
				$this->setResponseData('Invalid or expired token provided.', TRUE);
			}
		} catch(Exception $e) {
			$this->processException($e);
		}
	}
	
	
	
	
	
	// NOTE: getAction implemented in parent class.
	
	
	
	
	
	public function postAction() {
		$this->setService(Esquire_Service_Factory::getService('Address'));
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$clientAddress = $this->parseIncomingData();
				$clientAddress instanceof Models_Solaria_ClientAddress;
				
				if(empty($clientAddress)) {
					$this->logger->log(__METHOD__ . '--Empty ClientAddress object given in POST transaction. This is not allowed.', Zend_Log::ERR);
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Empty ClientAddress object provided.', TRUE);
				} elseif(!empty($clientAddress->Address->AddressID)) {
					$this->logger->log(__METHOD__ . '--Address object inside ClientAddress already has ID in POST transaction. This is not allowed.', Zend_Log::ERR);
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Address object inside ClientAddress already has ID in POST transaction.', TRUE);					
				} else {
					$result = $this->getService()->storeAddress($this->token, $clientAddress);
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
		$this->setService(Esquire_Service_Factory::getService('Address'));
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$clientAddress = $this->parseIncomingData();
				$clientAddress instanceof Models_Solaria_ClientAddress;
				
				if(empty($clientAddress)) {
					$this->logger->log(__METHOD__ . '--Empty ClientAddress object given in POST transaction. This is not allowed.', Zend_Log::ERR);
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Empty ClientAddress object provided.', TRUE);
				} elseif(empty($clientAddress->Address->AddressID)) {
					$this->logger->log(__METHOD__ . '--Address object inside ClientAddress doesn\'t have ID in PUT transaction. This is not allowed.', Zend_Log::ERR);
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('Address object inside ClientAddress doesn\'t have ID in PUT transaction.', TRUE);					
				} else {
					$result = $this->getService()->storeAddress($this->token, $clientAddress);
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
			$addressData = json_decode(stripslashes($payload), true);
			if (!is_array($addressData)) {
				throw new Exception('The received data is invalid or missing');
			}
		} elseif (strpos($content_type, 'application/xml') !== false) {
			// TODO: implement XML handling
		} elseif (strpos($content_type, 'application/x-www-form-urlencoded') !== false) {
			parse_str($this->getRequest()->getRawBody(), $postvars);
			foreach($postvars as $field => $value) {
				$addressData[$field] = $value;
			}
		}
	
		$address = $this->getService()->fromArray($this->token, $addressData);
	
		return $address;
	}
	
}