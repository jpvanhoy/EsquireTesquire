<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Main_Notetype', 'main');

/**
 * Models_Main_Base_Notetype
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $NoteTypeID
 * @property string $Description
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Main_Base_Notetype extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('notetype');
        $this->hasColumn('NoteTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('Description', 'string', 95, array(
             'type' => 'string',
             'length' => 95,
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