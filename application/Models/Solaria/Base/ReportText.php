<?php

/**
 * Models_Solaria_Base_ReportText
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ReportTextID
 * @property integer $CompanyID
 * @property string $InvoiceText
 * @property string $InvEmailText
 * @property string $StatementText
 * @property string $StateEmailText
 * @property string $ConfirmText
 * @property string $ConfEmailText
 * @property string $StaffInvText
 * @property string $StaffInvEmailText
 * @property string $StaffConfirmText
 * @property string $StaffConfEmailText
 * @property string $ReceiptText
 * @property string $ReceiptEmailText
 * @property string $PaymentText
 * @property string $PaymentEmailText
 * @property string $CaseStatementText
 * @property string $CaseStateEmailText
 * @property string $StaffStatementText
 * @property string $StaffStateEmailText
 * @property string $RateSheetText
 * @property string $RateSheetEmailText
 * @property string $OrderText
 * @property string $OrderEmailText
 * @property string $ReposNotifyEmailText
 * @property string $CollStateText
 * @property string $CollStateEmailText
 * @property Models_Solaria_Company $Company
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_ReportText extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('ReportText');
        $this->hasColumn('ReportTextID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('CompanyID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('InvoiceText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('InvEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('StatementText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('StateEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ConfirmText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ConfEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('StaffInvText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('StaffInvEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('StaffConfirmText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('StaffConfEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ReceiptText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ReceiptEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PaymentText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PaymentEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CaseStatementText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CaseStateEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('StaffStatementText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('StaffStateEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('RateSheetText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('RateSheetEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('OrderText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('OrderEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ReposNotifyEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CollStateText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CollStateEmailText', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
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
        $this->hasOne('Models_Solaria_Company as Company', array(
             'local' => 'CompanyID',
             'foreign' => 'CompanyID'));
    }
}
