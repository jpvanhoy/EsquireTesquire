<?php

/**
 * Models_Solaria_Base_StaffClientSales
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $StaffClientSalesID
 * @property integer $StaffID
 * @property integer $ClientID
 * @property decimal $CommissionPercentOriginal
 * @property decimal $CommissionPercentCopy
 * @property decimal $CommissionPercentMisc
 * @property timestamp $CommissionStartDate
 * @property timestamp $CommissionEndDate
 * @property integer $AttorneyID
 * @property boolean $OnJobsOnly
 * @property integer $AttyCommType
 * @property string $CommissionsOnCode
 * @property integer $ContactID
 * @property integer $CaseID
 * @property integer $CommissionTemplateID
 * @property integer $CSDTypeID
 * @property decimal $SplitPercent
 * @property decimal $BaselineAmount
 * @property decimal $BaselinePercent
 * @property boolean $IsECS
 * @property Models_Solaria_Staff $Staff
 * @property Models_Solaria_Client $Client
 * @property Models_Solaria_Attorney $Attorney
 * @property Models_Solaria_Contact $Contact
 * @property Models_Solaria_Cases $Cases
 * @property Models_Solaria_CommissionTemplate $CommissionTemplate
 * @property Models_Solaria_CSDType $CSDType
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_StaffClientSales extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('StaffClientSales');
        $this->hasColumn('StaffClientSalesID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('StaffID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ClientID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CommissionPercentOriginal', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CommissionPercentCopy', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CommissionPercentMisc', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CommissionStartDate', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CommissionEndDate', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('AttorneyID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('OnJobsOnly', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('AttyCommType', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CommissionsOnCode', 'string', 4, array(
             'type' => 'string',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ContactID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CaseID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CommissionTemplateID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CSDTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('SplitPercent', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('BaselineAmount', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('BaselinePercent', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsECS', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => '(0)',
             'primary' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Models_Solaria_Staff as Staff', array(
             'local' => 'StaffID',
             'foreign' => 'StaffID'));

        $this->hasOne('Models_Solaria_Client as Client', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasOne('Models_Solaria_Attorney as Attorney', array(
             'local' => 'AttorneyID',
             'foreign' => 'AttorneyID'));

        $this->hasOne('Models_Solaria_Contact as Contact', array(
             'local' => 'ContactID',
             'foreign' => 'ContactID'));

        $this->hasOne('Models_Solaria_Cases as Cases', array(
             'local' => 'CaseID',
             'foreign' => 'CaseID'));

        $this->hasOne('Models_Solaria_CommissionTemplate as CommissionTemplate', array(
             'local' => 'CommissionTemplateID',
             'foreign' => 'CommissionTemplateID'));

        $this->hasOne('Models_Solaria_CSDType as CSDType', array(
             'local' => 'CSDTypeID',
             'foreign' => 'CSDTypeID'));
    }
}
