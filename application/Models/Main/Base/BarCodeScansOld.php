<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Main_BarCodeScansOld', 'main');

/**
 * Models_Main_Base_BarCodeScansOld
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $DataID
 * @property string $SerialData
 * @property timestamp $DataTime
 * @property string $Action
 * @property string $Status
 * @property string $Scanner
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Main_Base_BarCodeScansOld extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('bar_code_scans_old');
        $this->hasColumn('DataID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('SerialData', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('DataTime', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('Action', 'string', 85, array(
             'type' => 'string',
             'length' => 85,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('Status', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => 'New',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('Scanner', 'string', 5, array(
             'type' => 'string',
             'length' => 5,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}