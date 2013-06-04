<?php



require_once 'RestHelper.php';


/**
 * Abstract base class for all RESTful service layer controllers.
 * 
 * @author jason.vanhoy @ Jul 26, 2012 9:01:03 AM
 * @see Zend_Rest_Controller
 */
abstract class Rest_AbstractController extends Zend_Rest_Controller
{
	
	const PREVIOUS_CALL = 1; 
	protected $config;
	protected $logger;
	protected $token;
	protected $companyId;
	private $_service;
	private $_responseCode;
	private $_responseData;
	

	
	/**
	 * Perform initilization functions for the object instance such as determining perferred data format and creating contexts for specific actions.
	 * 
	 * @see Zend_Controller_Action::init()
	 */
	public function init() {
		$format = $this->_getParam('format');
		if(empty($format)) {
			$format = 'json';
		}
		$this->_setParam('format', $format);
		
		$this->companyId = $this->_getParam('CompanyID');
	
		$this->config = Esquire_Config_Factory::getApplicationConfig();
		$this->logger = Esquire_Log_Factory::getLogger($this->config, get_class($this));
	
		$contextSwitcher = $this->_helper->getHelper('contextSwitch');
		$contextSwitcher->addActionContext('index', 'json');
		$contextSwitcher->addActionContext('get', 'json');
		$contextSwitcher->addActionContext('put', 'json');
		$contextSwitcher->addActionContext('post', 'json');
		$contextSwitcher->addActionContext('delete', 'json');
		$contextSwitcher->initContext();
	}
	
	
	/**
	 * Invokes the Service Layer security features to determine whether or not a consumer has access for a given request. If access is granted the service is provided with a companyId for company-specific data activities.
	 * 
	 * @throws Exception
	 * @return boolean TRUE if the consumer is allowed to perform the requested function, otherwise FALSE.
	 * @see Esquire_Service_Security
	 */
	protected function validateCredentials() {
		$isValid = false;
		$key = $this->_getParam('key');
		$token = $this->_getParam('token');
		$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);		
		$action = $trace[self::PREVIOUS_CALL]['function'];
		
		if(empty($this->_service)) {
			throw new Exception($action . '--Service not yet defined.', -1);
		}
		
		if(empty($token)) {
			$this->token = $this->_service->getSecurityToken($key, $action);
			$isValid = true;
		} else {
			if(Esquire_Service_Security::hasActiveSession($token, $this->_service->getName())) {
				$this->token = $token;
				$isValid = true;
			} else {
				$isValid = false;
			}
			
		}
		
		if(!$isValid) {
			$this->logger->log('Invalid security provided from ' . $_SERVER['REMOTE_ADDR'] . ', details are as follows: [key: ' . $key . '][token: ' . $token . ']', Zend_Log::WARN);
		}
		
		return $isValid;
	}
	
	
	/**
	 * A standardized way to handle the service result from any given action. Sets response codes and whatnot.
	 * 
	 * @param Esquire_Service_Result $result
	 */
	protected function processResult(Esquire_Service_Result $result) {
		$logger = Esquire_Log_Factory::getLogger(Esquire_Config_Factory::getApplicationConfig());
		$logger->log('RESULTDATA: ' . $result->data, Zend_Log::DEBUG);
		$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);		
		$action = $trace[self::PREVIOUS_CALL]['function'];
		
		if (Esquire_Service_Result::SUCCESS == $result->returnCode) {
			$this->setResponseData($result->data);
			$this->setResponseCode(Rest_RestHelper::HTTP_OK);
		} elseif (Esquire_Service_Result::NO_RESULTS == $result->returnCode) {
			$this->setResponseData(NULL);
			$this->setResponseCode(Rest_RestHelper::HTTP_NO_CONTENT);
		} elseif (Esquire_Service_Result::RECORD_NOT_FOUND == $result->returnCode) {
			$this->setResponseData($result, TRUE);
			$this->setResponseCode(Rest_RestHelper::HTTP_NOT_FOUND);
		} elseif (Esquire_Service_Result::SECURITY_FAILED == $result->returnCode) {
			$this->setResponseData($result, TRUE);
			$this->setResponseCode(Rest_RestHelper::HTTP_FORBIDDEN);
		} else {
			$this->setResponseCode(Rest_RestHelper::HTTP_INTERNAL_ERROR);
			$this->setResponseData($result, TRUE);
			$this->logger->log($action . ' received nonzero return code from service ' . $this->_service->getName() . '. Return code: ' . $result->returnCode . ' & message ' . $result->faultString, Zend_Log::ERR);
		}
	}
	
	/**
	 * A standardized way of handling exceptions generated from a service call. Handles logging the error as well.
	 * 
	 * @param Exception $exception
	 */
	protected function processException(Exception $exception) {
		$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);		
		$action = $trace[self::PREVIOUS_CALL]['function'];
		
		$this->setResponseCode(Rest_RestHelper::HTTP_INTERNAL_ERROR);
		$this->setResponseData($exception->getMessage(), TRUE);
		$this->logger->log('Error caught in ' . $action . '--Error Code ' . $exception->getCode() . ': ' . $exception->getMessage() . PHP_EOL . $exception->getTraceAsString(), Zend_Log::ERR);
	}
	
	
	
	
	/**
	 * Mutator method for responseData parameter. Maintains token across requests.
	 * 
	 * @param <mixed, multi-type:> $data
	 * @param boolean $isError
	 */
	protected function setResponseData($data, $isError = FALSE) {
		$outputData = $data;
		if (is_object($data)) {
			if (method_exists($data, 'toArray')) {
				$outputData = $data->toArray();
			} else {
				$outputData = serialize($data);
			}
		}
		
		if($isError) {
			$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
			$action = $trace[self::PREVIOUS_CALL]['function'];
			$message = $action . ' has registered an error. Further information may be available.';
			$this->logger->log($message, Zend_Log::ERR);
		}
		
        $this->_responseData = array('token' => $this->token, 'isError' => $isError, 'data' => $outputData);
		$this->view->esquire_data_package = $this->getResponseData();
	}
	
	
	
	/**
	 * Accessor method for responseData method.
	 * 
	 * @return <mixed, multitype:> The current responseData       
	 */
	protected function getResponseData() {
		return $this->_responseData;
	}
		
	
	/**
	 * Mutator method for responseCode parameter. Checks provided code against list of allowed values.
	 * 
	 * @param integer $code a valid HTTP response code.
	 * @throws Exception
	 * @see Rest_RestHelper
	 */
	protected function setResponseCode($code) {
		$constantsClass = new ReflectionClass('Rest_RestHelper');
		$allowedValues = $constantsClass->getConstants();
		if(in_array($code, $allowedValues)) {
			$this->_responseCode = $code;
			$this->getResponse()->setHttpResponseCode($this->getResponseCode());
		} else {
			throw new Exception('Invalid response code set. See Rest_RestHelper for possible values.', -1);
		}
	}
	
	
	/**
	 * Accessor method for responseCode parameter.
	 * 
	 * @return integer the currently-set response code
	 */
	protected function getResponseCode() {
		return $this->_responseCode;
	}
	
	
	
	/**
	 * This method must be overridden in each child class to parse incoming data bound for the service layer (such as in POST or PUT actions).
	 * 
	 * @return <mixed, multitype:>
	 */
	protected function parseIncomingData() {
		// Required, but must be overridden to provide service-specific parsing.
		return NULL;
	}
	
	
	/**
	 * Set the active service for this controller to the provided service. Provided object must be a child of Services_Base. Also sets the companyId on the service from the one provided in creation.
	 * @param Services_Base $service
	 */
	protected function setService(Services_Base $service) {
		$this->_service = $service;
		
		if(empty($this->companyId)) {
			$this->logger->log('Empty CompanyID provided to during ' . __METHOD__ . '. This probably caused downstream problems.', Zend_Log::WARN);
		}
		
		$this->_service->companyId = $this->companyId;
		
		$this->logger->log('Setting the companyId on the service ' . $this->getService()->getName() . ' to ' . $this->companyId . ' based on object var.', Zend_Log::DEBUG);
	}
	
	/**
	 * @return The current service set on this controller, provided by the Service Factory.
	 * @see Esquire_Service_Factory
	 */
	protected function getService() {
		return $this->_service;
	}
	
	
}
