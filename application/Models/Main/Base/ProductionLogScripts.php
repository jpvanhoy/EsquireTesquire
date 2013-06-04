<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Main_ProductionLogScripts', 'main');

/**
 * Models_Main_Base_ProductionLogScripts
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $LogID
 * @property string $ScriptName
 * @property string $Variables
 * @property timestamp $TimeStamp
 * @property integer $SortOrder
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Main_Base_ProductionLogScripts extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('production_log_scripts');
        $this->hasColumn('LogID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ScriptName', 'string', 65, array(
             'type' => 'string',
             'length' => 65,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('Variables', 'string', 145, array(
             'type' => 'string',
             'length' => 145,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('TimeStamp', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('SortOrder', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}