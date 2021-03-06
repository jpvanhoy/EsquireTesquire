<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Main_CaselistPaulson', 'main');

/**
 * Models_Main_Base_CaselistPaulson
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ID_number
 * @property integer $caseID
 * @property string $servicelist
 * @property string $cmo
 * @property string $status
 * @property string $prop
 * @property string $keep_exhibit
 * @property string $bill_cd
 * @property string $color_code
 * @property string $room
 * @property string $shelf
 * @property string $edited_by
 * @property timestamp $edited_on
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Main_Base_CaselistPaulson extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('caselist_paulson');
        $this->hasColumn('ID_number', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('caseID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('servicelist', 'string', 12, array(
             'type' => 'string',
             'length' => 12,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('cmo', 'string', 12, array(
             'type' => 'string',
             'length' => 12,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('status', 'string', 12, array(
             'type' => 'string',
             'length' => 12,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('prop', 'string', 12, array(
             'type' => 'string',
             'length' => 12,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('keep_exhibit', 'string', 12, array(
             'type' => 'string',
             'length' => 12,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('bill_cd', 'string', 12, array(
             'type' => 'string',
             'length' => 12,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('color_code', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('room', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('shelf', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('edited_by', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('edited_on', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}