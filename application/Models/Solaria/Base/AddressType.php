<?php

/**
 * Models_Solaria_Base_AddressType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $AddressTypeID
 * @property string $Description
 * @property boolean $IsActive
 * @property boolean $IsSystemDefined
 * @property Doctrine_Collection $Address
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_AddressType extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('AddressType');
        $this->hasColumn('AddressTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('Description', 'string', 75, array(
             'type' => 'string',
             'length' => '75',
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
             'primary' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Models_Solaria_Address as Address', array(
             'local' => 'AddressTypeID',
             'foreign' => 'AddressTypeID'));
    }
}