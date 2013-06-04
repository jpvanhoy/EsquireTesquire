<?php

/**
 * Base (or "generic") Class for all serivces.
 * @author jason.vanhoy (6/22/2012)
 *
 */
class Services_Base
{
	/**
	 * @var string the main database DSN
	 */
	const MAIN_DB_CONN_NAME = 'main';
    const SOLARIA_RECORD_PREFIX = 'Models_Solaria_';

	public $companyId;

	protected $serviceResult;
	protected $doctrineManager;
	protected $logger;
	protected $config;
	protected $serviceName;
	protected $requiresToken;
	protected $security;

	
	/**
	 * Create a new object instance of this class.
	 * 
	 * @param boolean $requiresToken Whether or not a particular service requires a security token to be accessed. Defaults to TRUE.
	 * @param Esquire_Service_Security $security The service security manager to use for this service. 
	 * @param Doctrine_Manager $doctrineManager The Doctrine manager to use for this service.
	 */
	public function __construct($requiresToken = TRUE, Esquire_Service_Security $security = null, Doctrine_Manager $doctrineManager = NULL) {
        if (!defined('JASON_EPOCH')) {
            define('JASON_EPOCH', date('1972-05-22'));
        }
				
		$this->serviceName = get_class($this) . '_Service';
		$this->doctrineManager = $doctrineManager == null ? Doctrine_Manager::getInstance() : $doctrineManager;
		$this->config = Esquire_Config_Factory::getApplicationConfig();
		$this->logger = Esquire_Log_Factory::getLogger($this->config, $this->serviceName);
		$this->serviceResult = new Esquire_Service_Result(Esquire_Service_Result::GENERAL_ERROR);

		if(empty($security)) {
			$this->security = new Esquire_Service_Security();
		} else {
			$this->security = $security;
		}

		$this->requiresToken = $requiresToken;
	}


	/**
	 * Get the service name of this object instance.
	 * 
	 * @return string The name of the current service object.
	 */
	public function getName() {
		return $this->serviceName;
	}
	
	
	/**
	 * Obtain a security token to use for this service on future calls.
	 * 
	 * @param String $key Public key to determine access permissions
	 * @param String $action The action being requested (e.g. GET, POST)
	 * @return string|NULL Returns either a valid token for reuse, or NULL if permission is not granted.
	 */
	public function getSecurityToken($key, $action) {
		if($this->requiresToken) {
			$token = $this->security->getSecurityToken($this->serviceName, $action, $key);
			return $token;
		}

		return NULL;
	}
	
	
	
	/**
	 * Get a connection to the appropriate company database based on a company ID.
	 * 
	 * @param integer $solariaCompanyId The Solaria company ID for the connection to be established.
	 * @throws Exception
	 * @return Doctrine_Connection The Doctrine Connection object for the requested company.
	 */
	protected function getCompanyDataConnection($solariaCompanyId = NULL) {
		// TODO: Change database from main to intranet
		// RECOMMEND: Not sure what the above note actually means. Someone should look into this. 
		$solariaCompanyId = $solariaCompanyId == null ? $this->companyId : $solariaCompanyId; 

        /*
         * Some entries in the main.company table have null values for SolCompID and 
         * SolCompDepID because they represent locations outside of business 
         * transactions.  If $solariaCompanyId is allowed to be null then we will 
         * end up with those companies as results, and they don't represent any 
         * Solaria database.
         */
        if (is_null($solariaCompanyId)) {
            throw new Exception('Company information not provided; unable to determine database connection');
        }

		$mainConn = Esquire_Db_Connection_Factory::getConnection(
				self::MAIN_DB_CONN_NAME,
				$this->doctrineManager,
				$this->config
		);

		$query = Doctrine_Query::create();
		$query->select('c.ConnName');
		$query->from('Models_Main_Company c');
		$query->where("c.SolCompID = ?", $solariaCompanyId);
		$query->orWhere("c.SolCompDepID = ?", $solariaCompanyId);
		$companies = $query->execute(null, Doctrine_Core::HYDRATE_ARRAY);
		
		if(sizeof($companies) == 0) {
			throw new Exception('No list of companies found.', -1);
		} 

		$database = $companies[0]['ConnName'];
		
		$conn = $this->getSpecificDataConnection($database);
		return $conn;
	}
	
	
	
	/**
	 * Andrew...?
	 * 
	 * @param unknown_type $database
	 * @throws Exception
	 * @return Ambigous <Doctrine_Connection, multitype:>
	 */
	protected function getSpecificDataConnection($database) {
		if(empty($database)) {
			$this->logger->log('Empty datasource given to ' . __METHOD__, Zend_Log::ERR);
			throw new Exception('Empty datasource given to ' . __METHOD__);
		}
		
		$this->logger->log('Tried to get connection to ' . $database, Zend_Log::DEBUG);
		
		$conn = Esquire_Db_Connection_Factory::getConnection(
				$database,
				$this->doctrineManager,
				$this->config
		);
		
		if(empty($conn)) {
			$this->logger->log('Connection to ' . $database . ' failed like a mother.', Zend_Log::ERR);
			throw new Exception('Connection to ' . $database . ' failed like a mother.');
		}
		
		return $conn;
	}
	
	protected function sayBadSecurity() {
		$returnCode = Esquire_Service_Result::SECURITY_FAILED;
		$result = new Esquire_Service_Result($returnCode);
		$result->faultString = 'Security not provided, failed, or expired.';
		$result->data = NULL;
		
		return $result;
	}


}
