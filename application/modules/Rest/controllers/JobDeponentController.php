<?php

class Rest_JobDeponentController extends Zend_Rest_Controller
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
	 * Takes params and gets a Models_Solaria_JobDeponent record. $params['id'] is
     * the JobDeponentID. With it we can get the complete job record.
     *
     * @param void Uses $_REQUEST params.
     * @return string $json
     * @access public
     * @todo This method is not currently behaving properly.  Someone performing 
     * GET f2/Rest/Jobdeponent/123 would be expecting a JobDeponent record, not 
     * just a listing of files.  The files should be an optional attribute added 
     * to the record if requested, maybe something like:
     * GET f2/Rest/Jobdeponent/123?related={JobDeponent.Files}
	 */
	public function getAction()
	{
        $config = Esquire_Config_Factory::getApplicationConfig();
        $logger = Esquire_Log_Factory::getLogger($config);

		try {
			$jobDeponentId = null;
			$solariaCompanyId = null;
			$params = $this->_getAllParams();

			$jobDeponentId = $params['id'];
			$solariaCompanyId = $params['company_id'];

			if (is_null($jobDeponentId) || is_null($solariaCompanyId)) {
				$this->getResponse()
				 ->setHttpResponseCode(400);
				return false;
			}

			/**
			 * Get the JobDeponent record.
			 */
			$jobDeponent = $this->_getJobDeponent($solariaCompanyId, $jobDeponentId);

			if (!$jobDeponent instanceof Models_Solaria_JobDeponent) {
				$this->getResponse()->setHttpResponseCode(404);
				$this->view->data = array(
					'success' => false,
					'error_message' => 'Unable to find Job Deponent record'
				);
				return;
			}

			$fileObjects = $jobDeponent->getFileObjects(
				$config, 
				Esquire_Config_Factory::getFileConfig(),
				$logger
			);
			$filePaths = $this->_createPathsFromObjects($fileObjects);

			/**
			 * Add deponent name like this LASTNAME.FIRSTNAME. Used by Download Manager.
			 * This method call returns an array with 'deponentName' and 'volumeNumber' keys.
			 */
			$data = $this->_formatDeponentName($jobDeponent);
			$filePaths['deponentName'] = $data['deponentName'];
			$filePaths['deponentId'] = $data['deponentId'];
			$filePaths['volumeNumber'] = $data['volumeNumber'];
			
			$this->getResponse()->setHttpResponseCode(200);
			$this->view->data = array(
				'success' => true,
				'filePaths' => $filePaths
			);
		} catch (Exception $e) {
			$this->getResponse()->setHttpResponseCode(500);
			$this->view->data = array(
				'success' => false,
				'error_message' => $e->getMessage() . ' -- ' . $e->getTraceAsString()
			);
		}
	}

    /**
     * Method to take file objects and create an array of paths.
     *
     * @param array $fileObjects An array of Generic_File and PDF_File objects.
     * @return array $filePaths
     * @access private
     */
    private function _createPathsFromObjects($fileObjects)
    {
        $filePaths = array();
        foreach ($fileObjects as $key => $file) {
            if (!is_array($file) && isset($file)) {
                $filePaths[$key] = $file->getFilePath();
            } else {
                foreach ($file as $dirFile) {
                    $filePaths[$key][] = $dirFile->getFilePath();
                }
            }
        }
        return $filePaths;
    }

	/**
	 * NOT IMPLEMENTED
	 */
	public function postAction()
	{
		
	}

	/**
	 * NOT IMPLEMENTED
	 */
	public function putAction()
	{

	}

	/**
	 * NOT IMPLEMENTED
	 */
	public function deleteAction()
	{

	}

    /**
     * Get a Doctrine Collection of companies from the MySQL main database. Used
     * to set companies in SolariaQuery.
     *
     * @param array $solariaCompanyIds
     * @return Doctrine_Collection $companies From MySQL company table.
     * @todo Change database from main to intranet
     */
    private function _getCompanyObjects($solariaCompanyIds)
    {
        $mainConn = Esquire_Db_Connection_Factory::getConnection(
			'main',
			Doctrine_Manager::getInstance(),
			Esquire_Config_Factory::getApplicationConfig()
		);

        $inStatement = "(" . implode(', ', $solariaCompanyIds) . ")";

		$query = Doctrine_Query::create();
		$query->select('c.*');
		$query->from('Models_Main_Company c');
		$query->where("c.SolCompID IN $inStatement");
		$query->orWhere("c.SolCompDepID IN $inStatement");
		$companies = $query->execute();

        return $companies;
    }

    /**
     * Method to get the JobDeponent and related tables from Solaria.
     *
     * @param integer $solariaCompanyId
     * @param integer $jobDeponentId
     * @return Models_Solaria_Jobdeponent $jobDeponent
     */
    private function _getJobDeponent($solariaCompanyId, $jobDeponentId)
    {
		$company = $this->_getCompanyObjects(array($solariaCompanyId));
		$database = $company[0]->ConnName;

		$conn = Esquire_Db_Connection_Factory::getConnection(
			$database,
			Doctrine_Manager::getInstance(),
			Esquire_Config_Factory::getApplicationConfig()
		);
		
		$query = Doctrine_Query::create($conn);
		$query->select('jd.*, j.*, c.*, d.*, p.*');
		$query->from('Models_Solaria_JobDeponent jd');
		$query->leftJoin('jd.Job j');
		$query->leftJoin('j.Cases c');
		$query->leftJoin('jd.Deponent d');
		$query->leftJoin('d.Person p');
		$query->where("jd.JobDeponentID = $jobDeponentId");
		$jobDeponent = $query->execute()->getFirst();

        return $jobDeponent;
    }

    /**
     * We need to add the deponent name to the array so we get it and
     * format it here. It needs to be in this format LASTNAME.FIRSTNAME
     *
     * @param Models_Solaria_JobDeponent $jobDeponent
     * @return array $data Contains the keys 'deponentName' and 'volumeNumber'
     * @access private
     */
    private function _formatDeponentName($jobDeponent)
    {
        $data = array();
        $volumeNumber = $jobDeponent->VolumeNumber;
        $firstName = $jobDeponent->Deponent->Person->FirstName;
        $lastName = $jobDeponent->Deponent->Person->LastName;
        $deponentId = $jobDeponent->Deponent->DeponentID;

        $namePieces = explode(' ', $firstName);
        $firstName = $namePieces[0];
        if (($firstName) && ($lastName)){
            $nameForPath = $lastName . '.' . $firstName;
        }
        else if ($lastName) {
            $nameForPath = $lastName;
        }
        else if ($firstName) {
            $nameForPath = $firstName;
        }

        $data['deponentName'] = $nameForPath;
        $data['deponentId'] = $deponentId;
        $data['volumeNumber'] = $volumeNumber;

        return $data;
    }
}

