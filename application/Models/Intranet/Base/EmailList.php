<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Intranet_EmailList', 'intranet');

/**
 * Models_Intranet_Base_EmailList
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property Doctrine_Collection $AttorneyCasesEmail
 * @property Doctrine_Collection $AttorneyEmail
 * @property Doctrine_Collection $EmailListToEmail
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Intranet_Base_EmailList extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('email_list');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
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
        $this->hasMany('Models_Intranet_AttorneyCasesEmail as AttorneyCasesEmail', array(
             'local' => 'id',
             'foreign' => 'email_list_id'));

        $this->hasMany('Models_Intranet_AttorneyEmail as AttorneyEmail', array(
             'local' => 'id',
             'foreign' => 'email_list_id'));

        $this->hasMany('Models_Intranet_EmailListToEmail as EmailListToEmail', array(
             'local' => 'id',
             'foreign' => 'email_list_id'));
    }
}