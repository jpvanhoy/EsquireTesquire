<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Main_Trackingtime', 'main');

/**
 * Models_Main_Base_Trackingtime
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $TimeID
 * @property integer $TrackingGroup
 * @property timestamp $TimeStamp
 * @property string $IsRunning
 * @property integer $TrackingUserID
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Main_Base_Trackingtime extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('trackingtime');
        $this->hasColumn('TimeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('TrackingGroup', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
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
        $this->hasColumn('IsRunning', 'string', 5, array(
             'type' => 'string',
             'length' => 5,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('TrackingUserID', 'integer', 4, array(
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