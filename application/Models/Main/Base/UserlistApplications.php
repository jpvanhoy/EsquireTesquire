<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Main_UserlistApplications', 'main');

/**
 * Models_Main_Base_UserlistApplications
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $appname
 * @property string $translator
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Main_Base_UserlistApplications extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('userlist_applications');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('appname', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('translator', 'string', 60, array(
             'type' => 'string',
             'length' => 60,
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