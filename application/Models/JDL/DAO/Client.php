<?php
/**
 *
 * @author jason.vanhoy @ Apr 4, 2013 12:37:07 PM
 */
class Models_JDL_DAO_Client extends Models_JDL_DAO_Base {
	
	// TODO: add relationships for Company, CilentType
	public $clientid;
	public $name;
	public $directphone;
	public $tollFreephone;
	public $fax;
	public $effectivedate;
	public $expiredate;
	public $warningtext;
	public $orderremarks;
	public $reposdefaultpwd;
	public $reposdefaultuser;
	
	
	
	public function __construct() {
		$this->table = 'Client';
		$this->uniqueIdentifier = 'clientId';
	}
	
	
	
}