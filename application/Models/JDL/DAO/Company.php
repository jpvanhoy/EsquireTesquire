<?php
/**
 *
 * @author jason.vanhoy @ Apr 2, 2013 2:22:05 PM
 */
class Models_JDL_DAO_Company extends Models_JDL_DAO_Base {
	
	
	public $companyid;
	public $name;
	public $directphone;
	public $tollfreephone;
	public $fax;
	public $taxid;
	public $logoimage;
	public $useimage;
	public $useinfooninvoice;
	public $emailaddress;
	public $webaddress;
	public $effectivedate;
	public $expiredate;
	public $emailccaddress;
	public $paytemplateid;
	public $defaultpayaccount;
	public $defaultrcvaccount;
	public $printstaffinvtype;
	public $defaulttaxrateid;
	public $emailbccaddress;
	public $reposdsn;
	public $repospath;
	public $reposaccountid;
	public $companyuid;
	public $code;
	public $laststaffinvoiceidnoorders;
	public $lastjobidoldcommissions;
	public $lastjobidnocsdfields;
	public $isseparatecollections;
	public $lastclosingdate;
	public $currentclosingdate;
	public $intercompanyclientid;
	public $schedulingemailaddress;
	public $productionemailaddress;
	public $billingemailaddress;
	
	
	public function __construct() {
		$this->table = 'Company';
		$this->uniqueIdentifier = 'companyId';
		
	}
	
}