<?php

class Rest_IndexController extends Zend_Rest_Controller
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
        $config = Esquire_Config_Factory::getApplicationConfig();
		$payment = Esquire_Payment_Factory::getInstance($config);

        $params = $this->_getAllParams();
		if (empty($params)) {
			$this->getResponse()
				 ->setHttpResponseCode(400)
				 ->appendBody('No search parameters given.');
			$this->view->data = array('error_message' => 'No search parameters given.');
		} else {
            try {
                /**
                 * Get a new Esquire_DB_QueryBuilder instance.
                 */
                
                $queryBuilder = new Esquire_Db_QueryBuilder($params['table'], $params);
                $query = $queryBuilder->getQuery();
                $results = $query->execute();

                if (empty($results)) {
                    $this->getResponse()
                         ->setHttpResponseCode(404)
                         ->appendBody('No record found for id: ' . $params['id']);
                    $this->view->data = array('error_message' => 'No record found for id: ' . $params['id']);
                } else {
                    $this->getResponse()
                        ->setHttpResponseCode(200);
                    $this->view->data = $results->toArray();
                }
            } catch (Exception $e) {
                $this->getResponse()
				 ->setHttpResponseCode(500)
				 ->appendBody('Database query error.');
                $this->view->data = array('error_message' => $e->getMessage(),
                                            'error_trace' => $e->getTraceAsString());
            }
            
		}
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
}
