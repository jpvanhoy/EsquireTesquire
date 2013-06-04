<?php
/**
 *
 * @author jason.vanhoy @ Apr 1, 2013 11:13:57 AM
 */


class Models_JDL_DAO_Attorney extends Models_JDL_DAO_Base {
	
	
	public $attorneyid;
	public $warningtext;
	public $orderremarks;
	
	public $client;
	public $person;
	
	public function __construct() {
		
		$this->table = 'Attorney';
		$this->uniqueIdentifier = 'attorneyid';
		
		$relationship = new Esquire_JDL_Relationship();
		$relationship->parameter = 'client';
		$relationship->object = 'Models_JDL_DAO_Client';
		$this->relationships[] = $relationship;
		
		unset($relationship);
		$relationship = new Esquire_JDL_Relationship();
		$relationship->parameter = 'person';
		$relationship->object = 'Models_JDL_DAO_Person';
		$this->relationships[] = $relationship;
	}

		
	
}