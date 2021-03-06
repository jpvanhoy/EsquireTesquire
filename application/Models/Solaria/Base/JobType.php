<?php

/**
 * Models_Solaria_Base_JobType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $JobTypeID
 * @property string $Description
 * @property boolean $IsActive
 * @property boolean $IsSystemDefined
 * @property Doctrine_Collection $AttorneyProductPrice
 * @property Doctrine_Collection $ClientProductPrice
 * @property Doctrine_Collection $CompanyJobPayTemplate
 * @property Doctrine_Collection $Job
 * @property Doctrine_Collection $JobTypeProductPrice
 * @property Doctrine_Collection $StaffJobPayTemplate
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_JobType extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('JobType');
        $this->hasColumn('JobTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('Description', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
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
             'default' => '(1)',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsSystemDefined', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => '(1)',
             'primary' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Models_Solaria_AttorneyProductPrice as AttorneyProductPrice', array(
             'local' => 'JobTypeID',
             'foreign' => 'JobTypeID'));

        $this->hasMany('Models_Solaria_ClientProductPrice as ClientProductPrice', array(
             'local' => 'JobTypeID',
             'foreign' => 'JobTypeID'));

        $this->hasMany('Models_Solaria_CompanyJobPayTemplate as CompanyJobPayTemplate', array(
             'local' => 'JobTypeID',
             'foreign' => 'JobTypeID'));

        $this->hasMany('Models_Solaria_Job as Job', array(
             'local' => 'JobTypeID',
             'foreign' => 'JobTypeID'));

        $this->hasMany('Models_Solaria_JobTypeProductPrice as JobTypeProductPrice', array(
             'local' => 'JobTypeID',
             'foreign' => 'JobTypeID'));

        $this->hasMany('Models_Solaria_StaffJobPayTemplate as StaffJobPayTemplate', array(
             'local' => 'JobTypeID',
             'foreign' => 'JobTypeID'));
    }
}
