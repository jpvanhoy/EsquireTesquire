<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Intranet_ProductionPrintJob', 'intranet');

/**
 * Models_Intranet_Base_ProductionPrintJob
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $solaria_job_id
 * @property integer $solaria_company_id
 * @property integer $solaria_job_number
 * @property integer $intranet_company_id
 * @property integer $dlman_jobdata_id
 * @property timestamp $timestamp
 * @property integer $personnel_id
 * @property string $nuvera
 * @property integer $summary_release_for
 * @property integer $summary_queue_job_validation_id
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Intranet_Base_ProductionPrintJob extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('production_print_job');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => true,
             ));
        $this->hasColumn('solaria_job_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('solaria_company_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('solaria_job_number', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('intranet_company_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('dlman_jobdata_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('timestamp', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('personnel_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('nuvera', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('summary_release_for', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('summary_queue_job_validation_id', 'integer', 4, array(
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
        
    }
}