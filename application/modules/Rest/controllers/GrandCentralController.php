<?php

/**
 * Main central controller for rest calls. Most all rest calls are
 * handled here.
 * 
 * @author Michael Locke
 * @package Rest
 */

class Rest_GrandCentralController extends Zend_Rest_Controller
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
       $config = Esquire_Config_Factory::getApplicationConfig();
//       $logger = Esquire_Log_Factory::getLogger($config, 'GrandCentral');
//       $logger->log(__FILE__, Zend_Log::CRIT);
       die('IN GC Controller index action');
	}
    
    public function getAction()
    {
        $config = Esquire_Config_Factory::getApplicationConfig();
//        $logger = Esquire_Log_Factory::getLogger($config, 'GrandCentral');
//        $logger->log(__FILE__, Zend_Log::CRIT);
        die('IN GC Controller get action');
    }
    
    public function postAction()
    {
        die('IN GC Controller post action');
    }
    
    public function putAction()
    {
        die('IN GC Controller put action');
    }
    
    public function deleteAction()
    {
        die('IN GC Controller delete action');
    }
}