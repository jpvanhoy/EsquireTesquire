<?php

class Monitor_DatabasesController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->_helper->layout()->setLayout('plain');

		$this->view->results = array();

		$config = Esquire_Config_Factory::getApplicationConfig();
		$connectionIdentifiers = array_keys($config->database->toArray());
        
		foreach ($connectionIdentifiers as $connectionIdentifier) {
			try {
				$connection = Esquire_Db_Connection_Factory::getConnection(
					$connectionIdentifier, 
					Doctrine_Manager::getInstance(), 
					Esquire_Config_Factory::getApplicationConfig()
				);
				$this->view->results[$connectionIdentifier] = $connection;
			} catch (PDOException $e) {
				$this->view->results[$connectionIdentifier] = $e;
			}
       }        
    }
}

