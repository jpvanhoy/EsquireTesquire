<?php


require_once 'AbstractController.php';

class Rest_CaseController extends Rest_AbstractController
{



	public function indexAction() {
		$companyId = $this->_getParam('companyId');
		$this->setService(Esquire_Service_Factory::getService('Case'));
		
		try {
			$valid = $this->validateCredentials();
			
			if($valid) {
				$fromDate 	= $this->_getParam('fromDate');
				$toDate 	= $this->_getParam('toDate');
				$result 	= $this->getService()->getCaseList($this->token, $fromDate, $toDate);
				$this->processResult($result);
			} else {
				$this->setResponseCode(Rest_RestHelper::HTTP_FORBIDDEN);
				$this->setResponseData('Invalid or expired token provided.', TRUE);
			}
		} catch(Exception $e) {
			$this->processException($e);
		}

		$this->getResponse()->setHttpResponseCode($this->getResponseCode());
		
		// TODO: Catch up with the times, dawg.
		$this->view->esquire_data_package = $this->getResponseData();
	}





	public function getAction() {
		$id = $this->_getParam('id');
		
		$this->setService(Esquire_Service_Factory::getService('Case'));


		if(empty($id)) {
			$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
			$this->setResponseData('Specific record requested, but record identifier not provided.', TRUE);
			$this->logger->log(__METHOD__ . $this->responseData, Zend_Log::ERR);
		}

		
		try {
			$valid = $this->validateCredentials();
			
			if($valid) {
				$result = $this->getService()->getCaseById($this->token, $id);
				$this->processResult($result);
			} else {
				$this->setResponseCode(Rest_RestHelper::HTTP_FORBIDDEN);
				$this->setResponseData('Invalid or expired token provided.', TRUE);
			}
		} catch(Exception $e) {
			$this->processException($e);
		}		
		
		
		$this->getResponse()->setHttpResponseCode($this->getResponseCode());
		$this->view->esquire_data_package = $this->getResponseData();
	}

	public function postAction() {
		// Rest_RestHelper::HTTP_CREATED;
	}

	public function putAction() {
		// Rest_RestHelper::HTTP_OK;
	}

	public function deleteAction() {
		// Rest_RestHelper::HTTP_NO_CONTENT;
	}
}