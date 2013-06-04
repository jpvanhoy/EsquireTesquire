<?php

/**
 * Models_Solaria_Base_PayTemplate
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $PayTemplateID
 * @property string $Description
 * @property boolean $IsActive
 * @property boolean $IsMasterTemplate
 * @property timestamp $EditedOn
 * @property integer $UserID
 * @property Models_Solaria_SystemUser $SystemUser
 * @property Doctrine_Collection $Company
 * @property Doctrine_Collection $CompanyJobPayTemplate
 * @property Doctrine_Collection $ProductPayTemplate
 * @property Doctrine_Collection $Staff
 * @property Doctrine_Collection $StaffInvoice
 * @property Doctrine_Collection $StaffJobPayTemplate
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_PayTemplate extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('PayTemplate');
        $this->hasColumn('PayTemplateID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('Description', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsActive', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsMasterTemplate', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'default' => '(0)',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EditedOn', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('UserID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
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
        $this->hasOne('Models_Solaria_SystemUser as SystemUser', array(
             'local' => 'UserID',
             'foreign' => 'UserID'));

        $this->hasMany('Models_Solaria_Company as Company', array(
             'local' => 'PayTemplateID',
             'foreign' => 'PayTemplateID'));

        $this->hasMany('Models_Solaria_CompanyJobPayTemplate as CompanyJobPayTemplate', array(
             'local' => 'PayTemplateID',
             'foreign' => 'PayTemplateID'));

        $this->hasMany('Models_Solaria_ProductPayTemplate as ProductPayTemplate', array(
             'local' => 'PayTemplateID',
             'foreign' => 'PayTemplateID'));

        $this->hasMany('Models_Solaria_Staff as Staff', array(
             'local' => 'PayTemplateID',
             'foreign' => 'PayTemplateID'));

        $this->hasMany('Models_Solaria_StaffInvoice as StaffInvoice', array(
             'local' => 'PayTemplateID',
             'foreign' => 'PayTemplateID'));

        $this->hasMany('Models_Solaria_StaffJobPayTemplate as StaffJobPayTemplate', array(
             'local' => 'PayTemplateID',
             'foreign' => 'PayTemplateID'));
    }
}