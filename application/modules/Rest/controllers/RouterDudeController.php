<?php

class Rest_RouterDudeController extends Zend_Controller_Action
{
	public function indexAction() {
		$this->_dudeItUp();
	}

	public function getAction() {
		$this->_dudeItUp();
	}

	public function postAction() {
		$this->_dudeItUp();
	}

	public function putAction() {
		$this->_dudeItUp();
	}

	public function deleteAction() {
		$this->_dudeItUp();
	}

    /**
     * Handle general Zend routing via the config.
     */
	private function _dudeItUp() {
		$this->_helper->viewRenderer->setRender('index');
        $this->_helper->layout()->setLayout('plain');
    	$config = Esquire_Config_Factory::getApplicationConfig();
        $logger = Esquire_Log_Factory::getLogger($config);       
        $client = new Zend_Http_Client();
        
        $front = Zend_Controller_Front::getInstance();
		$request = $front->getRequest();

		$uri = $config->service->url . $request->getRequestUri();
		
		$request->setParam('_skipCustomRouting', true);
		$request->setParam('controller', null);
		$request->setParam('action', null);
		
		if ($request->getMethod() == 'GET') {
			$client->setParameterGet($request->getParams());
		} else if ($request->getMethod() == 'PUT') {
			$client->setRawData($request->getRawBody(), 'application/json');
			$client->setParameterPost($request->getParams());
			$uri .= http_build_query($request->getParams());
		} else {
			$client->setParameterPost($request->getParams());
		}

		$client->setUri($uri);
		$client->setMethod($request->getMethod());
        $timeout = $config->zend->http->timeout;
        $client->setConfig(array('timeout' => $timeout));
		
		$response = $client->request();
		
		$this->getResponse()
		->setHttpResponseCode($response->getStatus());
		
		$data = json_decode($response->getBody(), true);
				
		$this->view->response = $response;
    }
}

