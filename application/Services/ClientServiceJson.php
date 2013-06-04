<?php

require_once 'ClientService.php';

class Services_ClientServiceJson extends Services_ClientService
{
	public function getClientById($id) {
		$response = parent::getClientById($id);
		$response->data = json_encode($response->data);
		return $response;
	}
}