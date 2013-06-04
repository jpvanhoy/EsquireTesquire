<?php
require_once 'AbstractController.php';

class Rest_TranscriptTypeController extends Rest_AbstractController
{
	public function indexAction() 
	{
		$this->setService(Esquire_Service_Factory::getService('Transcript'));
				
		$this->logger->log('TranscriptType list requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$result = $this->getService()->getTranscriptTypesList($this->token);
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
		// CREATE
		$this->setService(Esquire_Service_Factory::getService('Transcript'));
		
		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$transcriptType = $this->parseIncomingData();
				$result = $this->getService()->saveTranscriptType($transcriptType);
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
		// EDIT
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Record edit functionality not yet implemented.]');
	}
	
	public function deleteAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		$this->setResponseData('[Record delete functionality not yet implemented.]');
	}
	
	protected function parseIncomingData() {
		$transcriptType = new Models_Solaria_TranscriptType();
				
		if(isset($_SERVER['CONTENT_TYPE'])) {
			$content_type = $_SERVER['CONTENT_TYPE'];
		}
		
		if (strpos($content_type, 'application/json') !== false) {
			$payload = $this->getRequest()->getRawBody();
			$transcriptTypeData = json_decode(stripslashes($payload), true);
			
		} elseif (strpos($content_type, 'application/xml') !== false) {
			// TODO: implement XML handling
		} elseif (strpos($content_type, 'application/x-www-form-urlencoded') !== false) {
			parse_str($this->getRequest()->getRawBody(), $postvars);
			foreach($postvars as $field => $value) {
				$transcriptTypeData[$field] = $value;
			}
		}
		
		$transcriptType->fromArray($transcriptTypeData);
		return $transcriptType;
	}
}
