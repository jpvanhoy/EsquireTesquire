<?php
require_once 'AbstractController.php';

class Rest_ConfidentialityController extends Rest_AbstractController
{
	public function indexAction() {
		$this->setService(Esquire_Service_Factory::getService('Transcript'));
		
		$this->logger->log('Confidentiality list requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$result = $this->getService()->getConfidentialityTypesList($this->token);
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
		
	}
	
	public function postAction() {
		// CREATE
		$this->setService(Esquire_Service_Factory::getService('Transcript'));
		
		try {
			$valid = $this->validateCredentials();
		
			if($valid) {
				$confidentialityType = $this->parseIncomingData();
				$result = $this->getService()->saveTranscriptType($confidentialityType);
				
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
		
	}
	
	public function deleteAction() 
	{
		
	}
	
	protected function parseIncomingData() {
		$confidentialityType = new Models_Solaria_Confidentiality();
				
		if(isset($_SERVER['CONTENT_TYPE'])) {
			$content_type = $_SERVER['CONTENT_TYPE'];
		}
		
		if (strpos($content_type, 'application/json') !== false) {
			$payload = $this->getRequest()->getRawBody();
			$confidentialityTypeData = json_decode(stripslashes($payload), true);
			$confidentialityType->fromArray($confidentialityTypeData);
			
		} elseif (strpos($content_type, 'application/xml') !== false) {
			// TODO: implement XML handling
		} elseif (strpos($content_type, 'application/x-www-form-urlencoded') !== false) {
			parse_str($this->getRequest()->getRawBody(), $postvars);
			foreach($postvars as $field => $value) {
				$jobData[$field] = $value;
			}
		}
		
		return $confidentialityType;
	}
}
