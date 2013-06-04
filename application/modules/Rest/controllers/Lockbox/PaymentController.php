<?php

class Rest_Lockbox_PaymentController extends Zend_Rest_Controller
{
	public function init()
	{
		$contextSwitcher = $this->_helper->getHelper('contextSwitch');
		$contextSwitcher->addActionContext('get', 'json');
		$contextSwitcher->addActionContext('put', 'json');
		$contextSwitcher->addActionContext('post', 'json');
		$contextSwitcher->addActionContext('delete', 'json');
		$contextSwitcher->initContext();
	}

	public function indexAction()
	{

	}

	/**
	 * 
	 */
	public function getAction()
	{

	}

	/**
	 * Create a set of payments from a given lockbox file.
	 */
	public function postAction()
	{
		$id = $this->_getParam('id');
		$lockbox = $this->_getParam('lockbox');

		if (empty($id) || empty($lockbox)) {
			$this->getResponse()
				 ->setHttpResponseCode(400);
			$this->view->data = array(
				'error_message' => 'Both an id and lockbox identifier are required.',
				'error_code' => 0
			);
			return;
		}

		$file = Doctrine_Core::getTable('Models_Main_WachoviaFile')->findOneById($id);

		if (! $file instanceof Models_Main_WachoviaFile) {
			$this->getResponse()
				 ->setHttpResponseCode(404);
			$this->view->data = array(
				'error_message' => 'No file was found for the given id.',
				'error_code' => 0
			);
			return;
		}

		try {
			$config = Esquire_Config_Factory::getApplicationConfig();
			$filepath = $config->lockbox->boa->file_storage_path . '/' . $file->filename;

			if (!file_exists($filepath)) {
				$this->getResponse()
					 ->setHttpResponseCode(400);
				$this->view->data = array(
					'error_message' => 'Lockbox file could not be located.',
					'error_code' => 0
				);
				return;
			}

			$file = Esquire_File_Factory::getFile($filepath, $lockbox);
			$parser = $file->getParser();
			$payments = $parser->parse();
			$payments->save();

			$this->getResponse()
				 ->setHttpResponseCode(200);
			$this->view->data = array(
				'ids' => $payments->getPrimaryKeys()
			);
			return;
		} catch (Exception $e) {
			$this->getResponse()
				 ->setHttpResponseCode(500);
			$this->view->data = array(
				'error_message' => 'A server error occurred - ' . $e->getMessage(),
				'error_code' => 0
			);
		}

		/**
		 * Fail by default
		 */
		$this->getResponse()
			 ->setHttpResponseCode(500);
		$this->view->data = array(
			'error_message' => 'A server error occurred',
			'error_code' => 0
		);
	}

	/**
	 * Update session
	 */
	public function putAction()
	{

	}

	/**
	 * Log out 
	 */
	public function deleteAction()
	{

	}
}

