<?php

/**
 * Models_Solaria_Base_Client
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ClientID
 * @property integer $CompanyID
 * @property integer $ClientTypeID
 * @property string $Name
 * @property string $DirectPhone
 * @property string $TollFreePhone
 * @property string $Fax
 * @property timestamp $EffectiveDate
 * @property timestamp $ExpireDate
 * @property string $WarningText
 * @property string $OrderRemarks
 * @property string $ReposDefaultPwd
 * @property string $ReposDefaultUser
 * @property Models_Solaria_Company $Company
 * @property Models_Solaria_ClientType $ClientType
 * @property Doctrine_Collection $Attorney
 * @property Doctrine_Collection $CaseECSClient
 * @property Doctrine_Collection $ClientAddress
 * @property Doctrine_Collection $ClientContact
 * @property Doctrine_Collection $ClientDeliverableOption
 * @property Doctrine_Collection $ClientPrefs
 * @property Doctrine_Collection $ClientProductPrice
 * @property Doctrine_Collection $Collection
 * @property Doctrine_Collection $Invoice
 * @property Doctrine_Collection $Job
 * @property Doctrine_Collection $JobAttorneyPresent
 * @property Doctrine_Collection $JobLocation
 * @property Doctrine_Collection $Orders
 * @property Doctrine_Collection $Orders_10
 * @property Doctrine_Collection $StaffClientSales
 * @property Doctrine_Collection $StaffCommission
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_Client extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('Client');
        $this->hasColumn('ClientID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('CompanyID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ClientTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('Name', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('DirectPhone', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('TollFreePhone', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('Fax', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EffectiveDate', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ExpireDate', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('WarningText', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('OrderRemarks', 'string', 2147483647, array(
             'type' => 'string',
             'length' => '2147483647',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ReposDefaultPwd', 'string', 10, array(
             'type' => 'string',
             'length' => '10',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ReposDefaultUser', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Models_Solaria_Company as Company', array(
             'local' => 'CompanyID',
             'foreign' => 'CompanyID'));

        $this->hasOne('Models_Solaria_ClientType as ClientType', array(
             'local' => 'ClientTypeID',
             'foreign' => 'ClientTypeID'));

        $this->hasMany('Models_Solaria_Attorney as Attorney', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_CaseECSClient as CaseECSClient', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_ClientAddress as ClientAddress', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_ClientContact as ClientContact', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_ClientDeliverableOption as ClientDeliverableOption', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_ClientPrefs as ClientPrefs', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_ClientProductPrice as ClientProductPrice', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_Collection as Collection', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_Invoice as Invoice', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_Job as Job', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_JobAttorneyPresent as JobAttorneyPresent', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_JobLocation as JobLocation', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_Orders as Orders', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_Orders as Orders_10', array(
             'local' => 'ClientID',
             'foreign' => 'ShipToClientID'));

        $this->hasMany('Models_Solaria_StaffClientSales as StaffClientSales', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasMany('Models_Solaria_StaffCommission as StaffCommission', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));
    }
}