<?php

class Repository_UploadController extends Zend_Controller_Action
{
	public function indexAction()
	{

	}

	/**
	 * Retrieve one or more transaction records. This action forwards to the
     * IndexController getAction(). That controller does the work and passes
     * results on to its view. This action is not revisited by call to getAction
     * in IndexController.
     *
     * @param void
     * @return Models_Intranet_NpcPayment $results Transaction records.
     * @access public
	 */
	public function readfromhotfolderAction()
	{
        $config = Esquire_Config_Factory::getApplicationConfig();
        $logger = Esquire_Log_Factory::getLogger(Esquire_Config_Factory::getApplicationConfig(), 'Repository');
        
        $listDir = array(); // This will hold a listing of all files in the hot_folder directory
        $hotFolder = $config->repository->hot_folder;
        $serverUrl = $config->server->url;
        $sysKey = $config->system->sys_key;
        $deleteHotFolderFiles = true;
        $deleteHotFolderFiles = $config->repository->delete_hot_folder_files;
        
        $listDir = $this->_readDirectory($hotFolder);
        
        if (empty($listDir)) {
            return false;
        }
        
        foreach ($listDir as $file) {
            $fileContents[] = file_get_contents($hotFolder . '/' . $file);
        }
        
        /**
         * Repository class expects a json encoded array that looks like <JobNumber>_<CompanyID>.
         */
        $params = array();
        foreach ($fileContents as $data) {
            $temp = array();
            $temp = json_decode($data, true);
            $string = '';
            $string = $temp['invoice_number'] . '_' . $temp['company_id'];
            $strings[] = $string;
        }

        foreach ($strings as $string) {
            $params['rows'] = '[' . json_encode(addslashes($string)) . ']';
            $params['app'] = 'client';
            $params['control'] = 'client';
            $params['action'] = 'preparefilesforupload';
            $params['format'] = 'json';
            $params['entered_login'] = 'mlocke';
            $params['entered_password'] = $sysKey;
            
            $client = new Zend_Http_Client($serverUrl . "/request_router.php");
            $client->setParameterPost($params);
            $response = $client->request('POST');
        }

        if ($response->getStatus() !== 200) {
            throw new Exception ('Error sending files to repository');
        }
        
        if ($response->getStatus() === 200 && $deleteHotFolderFiles === true) {
            foreach ($listDir as $file) {
                unlink ($dir . '/' . $file);
            }
        }
	}

    /**
     * Read the repository.hot_folder directory.
     * 
     * @param string $dir
     * @return array $listDir 
     */
    private function _readDirectory($dir)
    {
        $listDir = array();
        if ($handler = opendir($dir)) {
            while (($sub = readdir($handler)) !== FALSE) {
                if ($sub != "." && $sub != ".." && $sub != "Thumb.db" && $sub != "Thumbs.db") {
                    if(is_file($dir . "/" . $sub)) {
                        $listDir[] = $sub;
                    }elseif(is_dir($dir . "/" . $sub)){
                        $listDir[$sub] = $this->_readDirectory($dir . "/" .$sub);
                    }
                }
            }
            closedir($handler);
        }
        return $listDir;
    }
}

