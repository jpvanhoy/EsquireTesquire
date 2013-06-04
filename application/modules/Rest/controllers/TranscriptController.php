<?php
/**
 *
 * @author jason.vanhoy @ Dec 5, 2012 9:52:02 AM
 */


require_once 'AbstractController.php';


class Rest_TranscriptController extends Rest_AbstractController {
	
	public function indexAction() {
		$this->setService(Esquire_Service_Factory::getService('Transcript'));
		$this->logger->log('Transcript list requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
		
		try {
			$valid = $this->validateCredentials();
			
			if($valid) {
				$jobId = $this->_getParam('jobId');
				$result = $this->getService()->getTranscriptList($this->token, $$jobId);
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
		$this->setResponseCode(Rest_RestHelper::HTTP_METHOD_NOT_ALLOWED);
		$this->setResponseData('Method not implemented.', TRUE);
	}
	
	
	
	public function putAction() {
		$this->setResponseCode(Rest_RestHelper::HTTP_METHOD_NOT_ALLOWED);
		$this->setResponseData('Method not implemented.', TRUE);
	}
	
	
	public function deleteAction() {
		$this->setService(Esquire_Service_Factory::getService('Transcript'));
		$service = $this->getService();
		$service instanceof Services_Transcript;
		
		$this->logger->log('Delete requested from ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
		
		try {
			$valid = $this->validateCredentials();
			
			if($valid) {
				$transcript = $this->parseIncomingData();
				
				if(empty($transcript->JobDeponentID)) {
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('No JobDeponentID found for requested update.', TRUE);
				} else {
					$result = $service->deleteTranscript($this->token, $transcript);
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
	
	
	protected function parseIncomingData() {
		if(isset($_SERVER['CONTENT_TYPE'])) {
			$content_type = $_SERVER['CONTENT_TYPE'];
		}
	
		if (strpos($content_type, 'application/json') !== false) {
			$payload = $this->getRequest()->getRawBody();
			$transcriptData = json_decode(stripslashes($payload), true);
			
			if (!is_array($transcriptData) || !array_key_exists('JobDeponentID', $transcriptData)) {
				throw new Exception('The received data is invalid or missing');
			}
			
		} elseif (strpos($content_type, 'application/xml') !== false) {
			// TODO: implement XML handling
		} elseif (strpos($content_type, 'application/x-www-form-urlencoded') !== false) {
			parse_str($this->getRequest()->getRawBody(), $postvars);
			foreach($postvars as $field => $value) {
				$transcriptData[$field] = $value;
			}
		}

		$transcript = $this->getService()->fromArray($this->token, $transcriptData);
	
	
		return $transcript;
	}
	
	
}
