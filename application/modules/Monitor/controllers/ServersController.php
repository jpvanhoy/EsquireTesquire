<?php

class Monitor_ServersController extends Zend_Controller_Action
{
    public function indexAction() 
	{
        $this->_helper->layout()->setLayout('plain');

		$this->view->results = array();

        for ($counter = 2; $counter < 8; $counter++) {
			$client = new Zend_Http_Client();
			$client->setConfig(array('timeout' => 30));
			$client->setUri(
				'http://idc-ecntrlapp0' . $counter . '/info.php'
			);
			$this->view->results['idc-ecntrlapp0' . $counter] = $client->request();
        }
    }
}

