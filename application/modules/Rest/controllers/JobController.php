<?php

require_once 'AbstractController.php';

class Rest_JobController extends Rest_AbstractController
{
	public function indexAction() {
		$this->setService(Esquire_Service_Factory::getService('Job'));
		$this->logger->log('Job list requested from ' . __METHOD__ . ' by ' . $_SERVER['REMOTE_ADDR'], Zend_Log::DEBUG);
	
		try {
			$valid = $this->validateCredentials();
			
			if($valid) {
				$fromDate 	= $this->_getParam('fromDate');
				$toDate 	= $this->_getParam('toDate');
				$result 	= $this->getService()->getJobList($this->token, $fromDate, $toDate);
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
		$id = $this->_getParam('id');
		$this->setService(Esquire_Service_Factory::getService('Job'));

		if(empty($id)) {
			$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
			$this->setResponseData('Specific record requested, but record identifier not provided.', TRUE);
			$this->logger->log(__METHOD__ . $this->responseData, Zend_Log::ERR);
		}
		
		try {
			$valid = $this->validateCredentials();
			
			if($valid) {
                $result = $this->getService()->getJobBySuperId($this->token, $id, true);
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
		$this->setService(Esquire_Service_Factory::getService('Job'));

		try {
			$valid = $this->validateCredentials();
			
			if($valid) {
				$job = $this->parseIncomingData();
				$result = $this->getService()->storeJob($this->token, $job);
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
		$this->setService(Esquire_Service_Factory::getService('Job'));

		try {
			$valid = $this->validateCredentials();
				
			if($valid) {
				$job = $this->parseIncomingData();
				
				if(empty($job->JobID)) {
					$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
					$this->setResponseData('No JobID found for requested update.', TRUE);
				} else {
					$result = $this->getService()->storeJob($this->token, $job);
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
	
   	
	/**
	 * Accepts incoming data and parses it into Doctrine Job object(s). 
	 * 
	 * @see Rest_AbstractController::parseIncomingData()
	 * @see Models_Solaria_Job
	 */
	protected function parseIncomingData() {
		if(isset($_SERVER['CONTENT_TYPE'])) {
			$content_type = $_SERVER['CONTENT_TYPE'];
		}

		if (strpos($content_type, 'application/json') !== false) {
			$payload = $this->getRequest()->getRawBody();
			$jobData = json_decode(stripslashes($payload), true);
			if (!is_array($jobData) || !array_key_exists('JobID', $jobData)) {
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
		
		$job = $this->getService()->fromArray($this->token, $jobData);

		return $job;
	}
}
