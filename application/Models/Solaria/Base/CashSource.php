<?php

/**
 * Models_Solaria_Base_CashSource
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $CashSourceID
 * @property string $Code
 * @property string $Description
 * @property boolean $IsActive
 * @property boolean $IsSystemDefined
 * @property Doctrine_Collection $Transactions
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_CashSource extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('CashSource');
        $this->hasColumn('CashSourceID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('Code', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
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
        $this->hasMany('Models_Solaria_Transactions as Transactions', array(
             'local' => 'CashSourceID',
             'foreign' => 'CashSourceID'));
    }
}
