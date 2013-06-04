<?php

class Monitor_ExternalsController extends Zend_Controller_Action
{
	public function indexAction() 
	{
        $this->_helper->layout()->setLayout('plain');

		$this->view->results = array();

		try {
			$payment = Esquire_Payment_Factory::getInstance(
				Esquire_Config_Factory::getApplicationConfig()
			);

			/**
			 * Payment requests to NPC are made over HTTP.  The method 
			 * below throws an Exception if the HTTP response is not 200, 
			 * which should be enough for us to say whether their service 
			 * is running or not. 
			 */
			$payment->getPaymentStatus(array('ordernumber' => 123));
			$this->view->results['NPC'] = true;
		} catch (Exception $e) {
			$this->view->results['NPC'] = false;
		}
	}
}
