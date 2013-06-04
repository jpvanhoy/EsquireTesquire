<?php

class Monitor_SystemController extends Zend_Controller_Action
{
	public function indexAction()
	{
		/**
		 * @todo A lot of items below can/should be config driven.  These 
		 * scripts are needed ASAP so it will have to be added later. 
		 */

        $this->_helper->layout()->setLayout('plain');

		$this->view->results = array();

		/**
		 * ActivePDF Toolkit 
		 */	
		try {
			$pdf = new Esquire_File_Pdf(CACHE_PATH . DIRECTORY_SEPARATOR . time() . '.pdf');
			$pdf->activePdf->SetFont('Arial', 20, 0);
			$pdf->activePdf->PrintText(30, 400, 'HELLO WORLD');
			$pdf->activePdf->CloseOutputFile();
			$this->view->results['APToolkit'] = true;
		} catch (Exception $e) {
			$this->view->results['APToolkit'] = false;
		}

		if (file_exists($pdf->getFilePath())) {
			unlink($pdf->getFilePath());
		}

		$shares = array(
			'//idc-netapp04.esquire.corp/Production_P',
			'//idc-netapp04.esquire.corp/CD_Temp',
			'//idc-netapp04.esquire.corp/Production_U',
			'//doculex.gordian.local/Exhibits',
			'//agallo8.gordian.local/Solaria_Access'
		);
		foreach ($shares as $share) {
			try {
				if (is_dir($share)) {
					$this->view->results[$share] = true;
				} else {
					$this->view->results[$share] = false;
				}
			} catch (Exception $e) {
				$this->view->results[$share] = false;
			}
		}
	}
}