<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Intranet_InvoicingBatchStatus', 'intranet');

/**
 * Models_Intranet_Base_InvoicingBatchStatus
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $description
 * @property Doctrine_Collection $InvoicingBatch
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Intranet_Base_InvoicingBatchStatus extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('invoicing_batch_status');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('description', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
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
        $this->hasMany('Models_Intranet_InvoicingBatch as InvoicingBatch', array(
             'local' => 'id',
             'foreign' => 'status_id'));
    }
}