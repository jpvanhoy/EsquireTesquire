<?php

class Rest_UserController extends Zend_Rest_Controller
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
	 * Retrieve one or more users.
	 */
	public function getAction()
	{
		$user = $this->_findUser();

		if (! $user instanceof Models_Main_Personnel) {
			$this->getResponse()
				 ->setHttpResponseCode(404)
				 ->appendBody('Requested User was not found');
			$this->view->data = array('error_message' => 'Requested User was not found.');
		} else {
			$this->getResponse()
				 ->setHttpResponseCode(200);
			$this->view->data = $user->toArray();
		}
	}

	/**
	 * Create a new user.
	 * 
	 * NOT IMPLEMENTED
	 */
	public function postAction()
	{

	}

	/**
	 * Edit an existing user
	 */
	public function putAction()
	{
		$user = $this->_findUser();

		if (! $user instanceof Models_Main_Personnel) {
			$this->getResponse()
				 ->setHttpResponseCode(404)
				 ->appendBody('Requested User was not found');
			$this->view->data = array('error_message' => 'Requested User was not found.');
			return;
		} else {
			$password = $this->_getParam('password');
			if (!empty($password)) {
				/**
				 * Make sure the user provides the correct current password 
				 * so we aren't allowing them to change data related to 
				 * another user.
				 * 
				 * This is currently bypassed by the presence of an "admin" flag.
				 * That NEEDS to be removed at some point for security.
				 */
				if ($this->_getParam('admin') != 1) {
					$currentPassword = $this->_getParam('current_password');
					if ($user->doesPasswordMatch($currentPassword) !== true) {
						$this->getResponse()
							 ->setHttpResponseCode(403);
						$this->view->data = array(
							'error_message' => 'Current password does not match.',
							'error_code' => 'NONMATCH'
						);
						return;
					}
				}

				$config = Esquire_Config_Factory::getApplicationConfig();

				/**
				 * Admin users are able to reset passwords without being restricted 
				 * by the minimum days setting.
				 */
				if ($this->_getParam('admin') == 1) {
					$config->removeReadOnly();
					$config->auth->password_security->minimum_days_before_next_change = 0;
				}
				$validationResponse = $user->validatePassword($password, $config);
				if ($validationResponse === true) { 
					$user->storePassword($password);
					$user->save();
					/**
					 * TODO
					 * 
					 * A 201 response wasn't desired here (a 204 was preferred) 
					 * but there seems to be IE issues and Ext JS issues with 
					 * HTTP 204 status codes.
					 */
					$this->getResponse()
						 ->setHttpResponseCode(201);
					return;
				} else {
					if (is_array($validationResponse)) {
						$this->getResponse()
							 ->setHttpResponseCode(406);
						$this->view->data = array(
							'error_message' => 'Password validation failure - <br /><br />'
											 . implode("<br />", $validationResponse),
							'error_code' => 'VALIDATION'
						);
						return;
					} else {
						$this->getResponse()
							 ->setHttpResponseCode(500);
						$this->view->data = array(
							'error_message' => 'Password validation failure - '
											 . 'system was unable to provide feedback',
							'error_code' => 'VALIDATION'
						);
						return;
					}
				}
			}
		}

		$this->getResponse()
			 ->setHttpResponseCode(500);
		$this->view->data = array(
			'error_message' => 'The system could not properly handle the request',
			'error_code' => 'SYSTEM'
		);
	}

	/**
	 * Expire a user account
	 * 
	 * NOT IMPLEMENTED
	 */
	public function deleteAction()
	{

	}

	/**
	 * Find a user by parsing incoming parameters
	 * 
	 * @return Models_Main_Personnel
	 */
	private function _findUser()
	{
		$id = $this->_getParam('id');
		$username = $this->_getParam('username');

		if (!empty($id)) {
			$user = Doctrine_Core::getTable('Models_Main_Personnel')->findOneByID_number($id);
		} elseif (!empty($username)) {
			$user = Doctrine_Core::getTable('Models_Main_Personnel')->findOneByUsername($username);
		}

		return $user;
	}
}

