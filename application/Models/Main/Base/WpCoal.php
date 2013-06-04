<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Main_WpCoal', 'main');

/**
 * Models_Main_Base_WpCoal
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $CoaL_userid
 * @property string $CoaL_cats
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Main_Base_WpCoal extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('wp_coal');
        $this->hasColumn('CoaL_userid', 'integer', 8, array(
             'type' => 'integer',
             'length' => 8,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('CoaL_cats', 'string', null, array(
             'type' => 'string',
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