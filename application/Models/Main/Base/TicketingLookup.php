<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Main_TicketingLookup', 'main');

/**
 * Models_Main_Base_TicketingLookup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ID
 * @property integer $LookupID
 * @property string $Entry
 * @property string $Type
 * @property string $Value
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Main_Base_TicketingLookup extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('ticketing_lookup');
        $this->hasColumn('ID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('LookupID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('Entry', 'string', 80, array(
             'type' => 'string',
             'length' => 80,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('Type', 'string', 40, array(
             'type' => 'string',
             'length' => 40,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => 'ID',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('Value', 'string', 80, array(
             'type' => 'string',
             'length' => 80,
             'fixed' => false,
             'unsigned' => false,
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