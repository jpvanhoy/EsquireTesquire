<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Intranet_RepositoryFileStatus', 'intranet');

/**
 * Models_Intranet_Base_RepositoryFileStatus
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
abstract class Models_Intranet_Base_RepositoryFileStatus extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('repository_file_status');
        $this->hasColumn('id', 'integer', 1, array(
             'type' => 'integer',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => true,
             ));
        $this->hasColumn('description', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
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