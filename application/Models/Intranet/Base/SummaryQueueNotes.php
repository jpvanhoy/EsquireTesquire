<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Intranet_SummaryQueueNotes', 'intranet');

/**
 * Models_Intranet_Base_SummaryQueueNotes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property timestamp $date_added
 * @property string $text
 * @property integer $summary_queue_id
 * @property integer $summary_queue_deponent_id
 * @property Models_Intranet_SummaryQueue $SummaryQueue
 * @property Models_Intranet_SummaryQueueDeponent $SummaryQueueDeponent
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Intranet_Base_SummaryQueueNotes extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('summary_queue_notes');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('user_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('username', 'string', 35, array(
             'type' => 'string',
             'length' => '35',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('date_added', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('text', 'string', 2147483647, array(
             'type' => 'string',
             'length' => '2147483647',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('summary_queue_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('summary_queue_deponent_id', 'integer', 4, array(
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
        $this->hasOne('Models_Intranet_SummaryQueue as SummaryQueue', array(
             'local' => 'summary_queue_id',
             'foreign' => 'id'));

        $this->hasOne('Models_Intranet_SummaryQueueDeponent as SummaryQueueDeponent', array(
             'local' => 'summary_queue_deponent_id',
             'foreign' => 'id'));
    }
}