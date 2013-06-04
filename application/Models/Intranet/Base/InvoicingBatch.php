<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Intranet_InvoicingBatch', 'intranet');

/**
 * Models_Intranet_Base_InvoicingBatch
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $directory
 * @property integer $status_id
 * @property integer $batch_type_id
 * @property string $batch_data
 * @property timestamp $batch_date
 * @property Models_Intranet_InvoicingBatchStatus $InvoicingBatchStatus
 * @property Models_Intranet_InvoicingBatchType $InvoicingBatchType
 * @property Doctrine_Collection $InvoicingBatchFiles
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Intranet_Base_InvoicingBatch extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('invoicing_batch');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('directory', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('status_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('batch_type_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('batch_data', 'string', 2147483647, array(
             'type' => 'string',
             'length' => '2147483647',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('batch_date', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'default' => '(getdate())',
             'primary' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Models_Intranet_InvoicingBatchStatus as InvoicingBatchStatus', array(
             'local' => 'status_id',
             'foreign' => 'id'));

        $this->hasOne('Models_Intranet_InvoicingBatchType as InvoicingBatchType', array(
             'local' => 'batch_type_id',
             'foreign' => 'id'));

        $this->hasMany('Models_Intranet_InvoicingBatchFiles as InvoicingBatchFiles', array(
             'local' => 'id',
             'foreign' => 'batch_id'));
    }
}