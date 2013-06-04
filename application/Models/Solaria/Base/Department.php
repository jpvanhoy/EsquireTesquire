<?php

/**
 * Models_Solaria_Base_Department
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $DepartmentID
 * @property integer $CompanyID
 * @property string $Description
 * @property boolean $IsActive
 * @property boolean $IsSystemDefined
 * @property integer $StaffID
 * @property Models_Solaria_Company $Company
 * @property Doctrine_Collection $Staff
 * @property Doctrine_Collection $ProductTask
 * @property Doctrine_Collection $Task
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_Department extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('Department');
        $this->hasColumn('DepartmentID', 'integer', 4, array(
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
        $this->hasColumn('StaffID', 'integer', 4, array(
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
        $this->hasOne('Models_Solaria_Company as Company', array(
             'local' => 'CompanyID',
             'foreign' => 'CompanyID'));

        $this->hasMany('Models_Solaria_Staff as Staff', array(
             'local' => 'DepartmentID',
             'foreign' => 'DepartmentID'));

        $this->hasMany('Models_Solaria_ProductTask as ProductTask', array(
             'local' => 'DepartmentID',
             'foreign' => 'DepartmentID'));

        $this->hasMany('Models_Solaria_Task as Task', array(
             'local' => 'DepartmentID',
             'foreign' => 'DepartmentID'));
    }
}
