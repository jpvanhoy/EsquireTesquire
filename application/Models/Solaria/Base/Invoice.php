<?php

/**
 * Models_Solaria_Base_Invoice
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $InvoiceID
 * @property integer $CompanyID
 * @property integer $JobID
 * @property integer $OrderID
 * @property integer $ClientID
 * @property integer $AttorneyID
 * @property integer $BillingAddressID
 * @property integer $InvoiceTypeID
 * @property integer $InvoiceTermID
 * @property timestamp $OriginalSentOn
 * @property timestamp $PaymentDueOn
 * @property timestamp $ResentOn
 * @property integer $TaxRateID
 * @property decimal $FederalTax
 * @property decimal $StateTax
 * @property decimal $LocalTax
 * @property decimal $OtherTax
 * @property decimal $AmountDue
 * @property decimal $AmountPaid
 * @property decimal $Balance
 * @property integer $InvoiceStatus
 * @property string $PrintedComment
 * @property timestamp $EditedOn
 * @property integer $UserID
 * @property integer $InvoiceNumber
 * @property boolean $IsVoided
 * @property timestamp $PaidOn
 * @property boolean $PrintShipping
 * @property timestamp $ExportedOn
 * @property decimal $AmountVoided
 * @property integer $JobInsuranceID
 * @property timestamp $SentToCollectionsOn
 * @property timestamp $CompletedCollectionsOn
 * @property integer $CollectionID
 * @property timestamp $ClosedDate
 * @property integer $CSDTypeID
 * @property string $Attention
 * @property integer $PriceTemplateID
 * @property integer $DeliveryTypeID
 * @property boolean $IsPriceTemplateOverride
 * @property integer $ClientMatterID
 * @property integer $ReportingPriceTemplateID
 * @property Models_Solaria_Company $Company
 * @property Models_Solaria_Job $Job
 * @property Models_Solaria_Orders $Orders
 * @property Models_Solaria_Client $Client
 * @property Models_Solaria_Attorney $Attorney
 * @property Models_Solaria_Attorney $Attorney_6
 * @property Models_Solaria_InvoiceType $InvoiceType
 * @property Models_Solaria_InvoiceTerm $InvoiceTerm
 * @property Models_Solaria_TaxRate $TaxRate
 * @property Models_Solaria_SystemUser $SystemUser
 * @property Models_Solaria_JobInsurance $JobInsurance
 * @property Models_Solaria_Collection $Collection
 * @property Models_Solaria_CSDType $CSDType
 * @property Models_Solaria_PriceTemplate $PriceTemplate
 * @property Models_Solaria_DeliveryType $DeliveryType
 * @property Models_Solaria_ClientMatter $ClientMatter
 * @property Doctrine_Collection $InvoiceDeponent
 * @property Doctrine_Collection $InvoiceItem
 * @property Doctrine_Collection $InvoiceItem_3
 * @property Doctrine_Collection $OrderItem
 * @property Doctrine_Collection $StaffCommission
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_Invoice extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('Invoice');
        $this->hasColumn('InvoiceID', 'integer', 4, array(
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
        $this->hasColumn('JobID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('OrderID', 'integer', 4, array(
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
             'notnull' => true,
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
        $this->hasColumn('BillingAddressID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('InvoiceTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('InvoiceTermID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('OriginalSentOn', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PaymentDueOn', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ResentOn', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('TaxRateID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('FederalTax', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('StateTax', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('LocalTax', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('OtherTax', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('AmountDue', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('AmountPaid', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('Balance', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('InvoiceStatus', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PrintedComment', 'string', 500, array(
             'type' => 'string',
             'length' => '500',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EditedOn', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('UserID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('InvoiceNumber', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsVoided', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PaidOn', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PrintShipping', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ExportedOn', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('AmountVoided', 'decimal', 21, array(
             'type' => 'decimal',
             'length' => '21',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('JobInsuranceID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('SentToCollectionsOn', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CompletedCollectionsOn', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CollectionID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ClosedDate', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
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
        $this->hasColumn('Attention', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PriceTemplateID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('DeliveryTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsPriceTemplateOverride', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'default' => '(0)',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ClientMatterID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ReportingPriceTemplateID', 'integer', 4, array(
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
        $this->hasOne('Models_Solaria_Company as Company', array(
             'local' => 'CompanyID',
             'foreign' => 'CompanyID'));

        $this->hasOne('Models_Solaria_Job as Job', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasOne('Models_Solaria_Orders as Orders', array(
             'local' => 'OrderID',
             'foreign' => 'OrderID'));

        $this->hasOne('Models_Solaria_Client as Client', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasOne('Models_Solaria_Attorney as Attorney', array(
             'local' => 'AttorneyID',
             'foreign' => 'AttorneyID'));

        $this->hasOne('Models_Solaria_Attorney as Attorney_6', array(
             'local' => 'AttorneyID',
             'foreign' => 'AttorneyID'));

        $this->hasOne('Models_Solaria_InvoiceType as InvoiceType', array(
             'local' => 'InvoiceTypeID',
             'foreign' => 'InvoiceTypeID'));

        $this->hasOne('Models_Solaria_InvoiceTerm as InvoiceTerm', array(
             'local' => 'InvoiceTermID',
             'foreign' => 'InvoiceTermID'));

        $this->hasOne('Models_Solaria_TaxRate as TaxRate', array(
             'local' => 'TaxRateID',
             'foreign' => 'TaxRateID'));

        $this->hasOne('Models_Solaria_SystemUser as SystemUser', array(
             'local' => 'UserID',
             'foreign' => 'UserID'));

        $this->hasOne('Models_Solaria_JobInsurance as JobInsurance', array(
             'local' => 'JobInsuranceID',
             'foreign' => 'JobInsuranceID'));

        $this->hasOne('Models_Solaria_Collection as Collection', array(
             'local' => 'CollectionID',
             'foreign' => 'CollectionID'));

        $this->hasOne('Models_Solaria_CSDType as CSDType', array(
             'local' => 'CSDTypeID',
             'foreign' => 'CSDTypeID'));

        $this->hasOne('Models_Solaria_PriceTemplate as PriceTemplate', array(
             'local' => 'PriceTemplateID',
             'foreign' => 'PriceTemplateID'));

        $this->hasOne('Models_Solaria_DeliveryType as DeliveryType', array(
             'local' => 'DeliveryTypeID',
             'foreign' => 'DeliveryTypeID'));

        $this->hasOne('Models_Solaria_ClientMatter as ClientMatter', array(
             'local' => 'ClientMatterID',
             'foreign' => 'ClientMatterID'));

        $this->hasMany('Models_Solaria_InvoiceDeponent as InvoiceDeponent', array(
             'local' => 'InvoiceID',
             'foreign' => 'InvoiceID'));

        $this->hasMany('Models_Solaria_InvoiceItem as InvoiceItem', array(
             'local' => 'InvoiceID',
             'foreign' => 'InvoiceID'));

        $this->hasMany('Models_Solaria_InvoiceItem as InvoiceItem_3', array(
             'local' => 'InvoiceID',
             'foreign' => 'InvoiceID'));

        $this->hasMany('Models_Solaria_OrderItem as OrderItem', array(
             'local' => 'InvoiceID',
             'foreign' => 'InvoiceID'));

        $this->hasMany('Models_Solaria_StaffCommission as StaffCommission', array(
             'local' => 'InvoiceID',
             'foreign' => 'ClientInvoiceID'));
    }
}