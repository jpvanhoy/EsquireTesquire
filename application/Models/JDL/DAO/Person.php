<?php
/**
 *
 * @author jason.vanhoy @ Apr 2, 2013 10:00:19 AM
 */
class Models_JDL_DAO_Person extends Models_JDL_DAO_Base {
	
	public $personid;
	public $firstname;
	public $middleinitial;
	public $lastname;
	public $suffix;
	public $fullname;
	public $directphone;
	public $mobilephone;
	public $pager;
	public $fax;
	public $emailaddress;
	public $birthdate;
	public $effectivedate;
	public $expiredate;
	public $initials;
	
	
	public $company;
	
	
	public function __construct() {
		$this->table = 'Person';
		$this->uniqueIdentifier = 'personId';
		
		$relationship = new Esquire_JDL_Relationship();
		$relationship->parameter = 'company';
		$relationship->object = 'Models_JDL_DAO_Company';
		$this->relationships[] = $relationship;
	}
	
	
	
}