<?php

require_once 'AbstractController.php';

/**
 *
 * @author jason.vanhoy @ Jan 29, 2013 10:24:06 AM
 */
class Rest_BaseAddressController extends Rest_AbstractController {
	// To be implemented elsewhere...
	public function indexAction(){ }
	public function postAction(){ }
	public function putAction(){ }
	public function deleteAction(){ }
	
	
	
	public function getAction() {
		$id = $this->_getParam('id');
		
		$this->setService(Esquire_Service_Factory::getService('Address'));
		
		if(empty($id)) {
			$this->setResponseCode(Rest_RestHelper::HTTP_BAD_REQUEST);
			$this->setResponseData('Specific record requested, but record identifier not provided.', TRUE);
			$this->logger->log(__METHOD__ . $this->responseData, Zend_Log::ERR);
		}
	
		try {
			$valid = $this->validateCredentials();
	
			if($valid) {
				$result = $this->getService()->getAddressById($this->token, $id, true);
				$this->processResult($result);
			} else {
				$this->setResponseCode(Rest_RestHelper::HTTP_FORBIDDEN);
				$this->setResponseData('Invalid or expired token provided.', TRUE);
			}
		} catch(Exception $e) {
			$this->processException($e);
		}
	}
}