<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Intranet_DlmanQueueType', 'intranet');

/**
 * Models_Intranet_Base_DlmanQueueType
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
abstract class Models_Intranet_Base_DlmanQueueType extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('dlman_queue_type');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => true,
             ));
        $this->hasColumn('description', 'string', 10, array(
             'type' => 'string',
             'length' => '10',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}