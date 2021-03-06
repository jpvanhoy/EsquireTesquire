<?php

/**
 * Models_Solaria_Base_MasterDepartment
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $MasterDepartmentID
 * @property string $Description
 * @property boolean $IsActive
 * @property boolean $IsSystemDefined
 * @property boolean $SubmitsInvoices
 * @property integer $CentralID
 * @property Doctrine_Collection $Staff
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_MasterDepartment extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('MasterDepartment');
        $this->hasColumn('MasterDepartmentID', 'integer', 4, array(
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
             'default' => '((0))',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsSystemDefined', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => '((0))',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('SubmitsInvoices', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => '((0))',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CentralID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => '((0))',
             'primary' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Models_Solaria_Staff as Staff', array(
             'local' => 'MasterDepartmentID',
             'foreign' => 'MasterDepartmentID'));
    }
}
