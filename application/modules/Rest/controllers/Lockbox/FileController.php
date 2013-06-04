<?php

/**
 * This class will handle the appropriate actions needed for lockbox retrieval
 * and record insertion into the appropriate tables that store lockbox file information.
 *
 * @package Cash_App
 * @author Michael Locke
 * @jira EC-161
 */
class Rest_Lockbox_FileController extends Zend_Rest_Controller
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
	 * This method will take the lockbox name from the POST and 
     * return id of the inserted file record.
     *
     * @access public
     * @param void Gets lockbox name from $_REQUEST
     * @return int  $id
	 */
	public function postAction()
	{
		try {
			$config = Esquire_Config_Factory::getApplicationConfig();

			$logger = Esquire_Log_Factory::getLogger($config, 'Lockbox');

			$lockbox = $this->_getParam('lockbox');
			if (empty($lockbox)) {
				$this->getResponse()
					 ->setHttpResponseCode(400);
				$this->view->data = array(
					'error_message' => 'No lockbox name provided',
					'error_code' => 0
				);
				return;
			}

			$retriever = Esquire_Lockbox_Retriever_Factory::getInstance(
				$config, $lockbox, $logger
			);
			$fileList = $retriever->retrieve();
			$wachoviaFileIds = array(); // Will hold the ids of the inserted rows.

			/**
			 * Write to the WachoviaFiles table
			 */
			foreach ($fileList as $file) {
				$timestamp = date('Y-m-d H:i:s', time());
				$personnelId = $_SESSION['permissions']['user']['id'];
				$fileName = $file->getFileName();
				$status = 1;
				$batchTypeId = $file->getBatchTypeId();

				/**
				 * The date is in the file name in this format:
				 * FILENAME.YYMMDDHHMMSS. We parse the date here
				 * and put it in this format YYYY-MM-DD.
				 */
				$date = explode('.', $fileName);
				$date = $date[1];
				$year = '20' . substr($date, 0, 2);
				$month = substr($date, 2, 2);
				$day = substr($date, 4, 2);
				$batchDate = $year . '-' . $month . '-' . $day;

				$wachoviaFile = new Models_Main_WachoviaFile();
				$wachoviaFile->personnel_id = $personnelId;
				$wachoviaFile->filename = $fileName;
				$wachoviaFile->status = $status;
				$wachoviaFile->batch_date = $batchDate;
				$wachoviaFile->batch_type_id = $batchTypeId;

				$wachoviaFile->save();

				/**
				 * Grab the id of the inserted record
				 */
				$wachoviaFileIds[] = $wachoviaFile->id;
				$wachoviaFileIds = json_encode($wachoviaFileIds);
			}

			$this->getResponse()->setHttpResponseCode(201);
			$this->view->data = array(
				'ids' => $wachoviaFileIds
			);
			return;

		} catch (Exception $e) {
			$logger->log('ERROR MESSAGE: ' . $e->getMessage(), Zend_Log::CRIT);
			$logger->log('TRACE: ' . $e->getTraceAsString(), Zend_Log::CRIT);
		}
			
		$this->getResponse()
			 ->setHttpResponseCode(500);
		$this->view->data = array(
			'error_message' => 'A server error occurred', 
			'error_code' => 0
		);
		return;
	}

	public function putAction()
	{

	}

	public function deleteAction()
	{

	}
}

