<?php

/**
 * Models_Solaria_Base_OrderDeponentDeliverableOption
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $OrderDeponentDeliverableOptionID
 * @property integer $OrderDeponentDeliverableID
 * @property integer $DeliverableOptionID
 * @property Models_Solaria_OrderDeponentDeliverable $OrderDeponentDeliverable
 * @property Models_Solaria_DeliverableOption $DeliverableOption
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_OrderDeponentDeliverableOption extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('OrderDeponentDeliverableOption');
        $this->hasColumn('OrderDeponentDeliverableOptionID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('OrderDeponentDeliverableID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('DeliverableOptionID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
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
        $this->hasOne('Models_Solaria_OrderDeponentDeliverable as OrderDeponentDeliverable', array(
             'local' => 'OrderDeponentDeliverableID',
             'foreign' => 'OrderDeponentDeliverableID'));

        $this->hasOne('Models_Solaria_DeliverableOption as DeliverableOption', array(
             'local' => 'DeliverableOptionID',
             'foreign' => 'DeliverableOptionID'));
    }
}