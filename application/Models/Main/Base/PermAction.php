<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Main_PermAction', 'main');

/**
 * Models_Main_Base_PermAction
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $description
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Main_Base_PermAction extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('perm_action');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('description', 'string', 70, array(
             'type' => 'string',
             'length' => 70,
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