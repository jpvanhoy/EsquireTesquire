<?php

/**
 * Models_Solaria_Base_Contact
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ContactID
 * @property integer $PersonID
 * @property integer $ContactTypeID
 * @property boolean $CopyOnEmailNotices
 * @property Models_Solaria_Person $Person
 * @property Models_Solaria_ContactType $ContactType
 * @property Doctrine_Collection $AttorneyContact
 * @property Doctrine_Collection $ClientContact
 * @property Doctrine_Collection $Job
 * @property Doctrine_Collection $Orders
 * @property Doctrine_Collection $StaffClientSales
 * @property Doctrine_Collection $StaffCommission
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_Contact extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('Contact');
        $this->hasColumn('ContactID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('PersonID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ContactTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CopyOnEmailNotices', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Models_Solaria_Person as Person', array(
             'local' => 'PersonID',
             'foreign' => 'PersonID'));

        $this->hasOne('Models_Solaria_ContactType as ContactType', array(
             'local' => 'ContactTypeID',
             'foreign' => 'ContactTypeID'));

        $this->hasMany('Models_Solaria_AttorneyContact as AttorneyContact', array(
             'local' => 'ContactID',
             'foreign' => 'ContactID'));

        $this->hasMany('Models_Solaria_ClientContact as ClientContact', array(
             'local' => 'ContactID',
             'foreign' => 'ContactID'));

        $this->hasMany('Models_Solaria_Job as Job', array(
             'local' => 'ContactID',
             'foreign' => 'ContactID'));

        $this->hasMany('Models_Solaria_Orders as Orders', array(
             'local' => 'ContactID',
             'foreign' => 'ContactID'));

        $this->hasMany('Models_Solaria_StaffClientSales as StaffClientSales', array(
             'local' => 'ContactID',
             'foreign' => 'ContactID'));

        $this->hasMany('Models_Solaria_StaffCommission as StaffCommission', array(
             'local' => 'ContactID',
             'foreign' => 'ContactID'));
    }
}
