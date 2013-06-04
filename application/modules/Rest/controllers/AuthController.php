<?php

class Rest_AuthController extends Zend_Rest_Controller
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

	}

	/**
	 * Log in - this is currently a small replacement for EsquireCentral 
	 * user access.  Currently this is just useful for determining whether 
	 * user credentials are valid.  Eventually this should perform a full 
	 * log in - session handling, etc.
	 * 
	 */
	public function postAction()
	{
		$username = $this->_getParam('username');
		if (empty($username)) {
			$this->getResponse()
				 ->setHttpResponseCode(400);
			$this->view->data = array(
				'error_message' => 'No username provided',
				'error_code' => 108
			);
			return;
		}

		$users = $this->_findUser();

		if ($users->count() > 1) {
			$this->getResponse()
				 ->setHttpResponseCode(404);
			$this->view->data = array(
				'error_message' => 'Password/username combination is invalid',
				'error_code' => 101
			);
			return;
		}

		if ($users->count() < 1) {
			$this->getResponse()
				 ->setHttpResponseCode(404);
			$this->view->data = array(
				'error_message' => 'Password/username combination is invalid',
				'error_code' => 102
			);
			return;
		}

		$user = $users->getFirst();

		$password = $this->_getParam('password');
		if (strlen($password) < 1) {
			$this->getResponse()
				 ->setHttpResponseCode(406);
			$this->view->data = array(
				'error_message' => 'No password given',
				'error_code' => 103
			);
			return;
		} else {
			/**
			 * If the user has Active Directory information we will no longer
			 * consider their EsquireCentral information.  EsquireCentral 
			 * authentication remains for a few users who can't be linked with 
			 * AD.
			 */
			$config = Esquire_Config_Factory::getApplicationConfig();
			if (!empty($user->ad_username)) {
				$adapter = Esquire_Auth_Adapter_Factory::getAdapter(
					$config,
					$this->_getParam('username'), 
					$password
				);
				$result = $adapter->authenticate();

				if ($result->isValid() === true 
						|| $password == $config->auth->db->master_password) {
					$this->getResponse()
						 ->setHttpResponseCode(201);
					/**
					 * TODO
					 * Ideally this auth activity would create a session, etc 
					 * and return an identifier to the new resource.  Currently 
					 * log-ins are still handled by the older framework so this 
					 * implementation is incomplete.
					 */
					return;
				} else {
					$logger = Esquire_Log_Factory::getLogger($config, 'AD');
					$logger->log(print_r($result->getMessages(), true), Zend_Log::CRIT);

					$this->getResponse()
						 ->setHttpResponseCode(406);
					$this->view->data = array(
						'error_message' => 'Password/username combination is invalid',
						'error_code' => 104
					);
					return;
				}
			} else {
				if ($user->doesPasswordMatch($password) === true) {
					if (strtotime($user->pw_expiration_date) < time()) {
						$this->getResponse()
							 ->setHttpResponseCode(406);
						$this->view->data = array(
							'error_message' => 'Your password has expired',
							'error_code' => 105
						);
						return;
					} else {
						$this->getResponse()
							 ->setHttpResponseCode(201);
						/**
						 * TODO
						 * Ideally this auth activity would create a session, etc 
						 * and return an identifier to the new resource.  Currently 
						 * log-ins are still handled by the older framework so this 
						 * implementation is incomplete.
						 */
						return;
					}
				} else {
					$this->getResponse()
						 ->setHttpResponseCode(406);
					$this->view->data = array(
						'error_message' => 'Password/username combination is invalid',
						'error_code' => 106
					);
					return;
				}
			}
		}

		/**
		 * Fail by default
		 */
		$this->getResponse()
			 ->setHttpResponseCode(500);
		$this->view->data = array(
			'error_message' => 'A server error occurred',
			'error_code' => 107
		);
	}

	/**
	 * Update session
	 */
	public function putAction()
	{

	}

	/**
	 * Log out 
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

		if (empty($id) && empty($username)) {
			return false;
		}

		$manager = Doctrine_Manager::getInstance();
		$query = Doctrine_Query::create($manager->getConnection('main'));
		$query->from('Models_Main_Personnel');
		if (!empty($id)) {
			$query->andWhere('ID_number = ?', $id);
		}
		if (!empty($username)) {
			$query->andWhere('(username = ? OR ad_username = ?)', array($username, $username));
		}
		$query->andWhere('active = "yes"');
		$users = $query->execute();

		return $users;
	}
}

