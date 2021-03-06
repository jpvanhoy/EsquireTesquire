<?php

/**
 * Models_Solaria_Base_ServiceTagService
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ServiceTagID
 * @property integer $CentralID
 * @property Models_Solaria_ServiceTag $ServiceTag
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_ServiceTagService extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('ServiceTagService');
        $this->hasColumn('ServiceTagID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('CentralID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Models_Solaria_ServiceTag as ServiceTag', array(
             'local' => 'ServiceTagID',
             'foreign' => 'ServiceTagID'));
    }
}
