<?php

class ReportBuilder_IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $reportIdentifier = preg_replace('/[^\w\d]/', '', $this->_getParam('report_identifier'));

        try {
            $reportConfig = new Zend_Config_Ini(
				APPLICATION_PATH . '/configs/report_builder/' . $reportIdentifier . '.ini', 
				APPLICATION_ENV
			);
        } catch (Zend_Config_Exception $e) {
            $this->view->exception = $e;
            return;
        }

        $this->view->reportConfig = $reportConfig;
    }
}

