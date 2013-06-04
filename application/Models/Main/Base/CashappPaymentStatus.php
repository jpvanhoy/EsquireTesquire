<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Main_CashappPaymentStatus', 'main');

/**
 * Models_Main_Base_CashappPaymentStatus
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $status
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Main_Base_CashappPaymentStatus extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('cashapp_payment_status');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('status', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}