<?php

/**
 * Models_Solaria_Base_Deliverable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $DeliverableID
 * @property string $Description
 * @property string $Name
 * @property integer $SortOrder
 * @property boolean $IsActive
 * @property integer $CentralID
 * @property Doctrine_Collection $OrderDeponentDeliverable
 * @property Doctrine_Collection $Product
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_Deliverable extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('Deliverable');
        $this->hasColumn('DeliverableID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('Description', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('Name', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('SortOrder', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsActive', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CentralID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
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
        $this->hasMany('Models_Solaria_OrderDeponentDeliverable as OrderDeponentDeliverable', array(
             'local' => 'DeliverableID',
             'foreign' => 'DeliverableID'));

        $this->hasMany('Models_Solaria_Product as Product', array(
             'local' => 'DeliverableID',
             'foreign' => 'DeliverableID'));
    }
}
