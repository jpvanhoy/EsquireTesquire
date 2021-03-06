<?php

/**
 * Models_Solaria_Base_Product
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ProductID
 * @property string $ProductTypeCode
 * @property string $Description
 * @property string $InvoiceDescription
 * @property boolean $IsTaxable
 * @property string $UnitTypeCode
 * @property boolean $IsActive
 * @property boolean $IsGrouped
 * @property string $Code
 * @property string $GLCode
 * @property string $GLCodeLOB
 * @property integer $CentralID
 * @property integer $DeliverableID
 * @property boolean $IsPriceLocked
 * @property Models_Solaria_Deliverable $Deliverable
 * @property Doctrine_Collection $AttorneyProductPrice
 * @property Doctrine_Collection $ClientProductPrice
 * @property Doctrine_Collection $CommissionProductRate
 * @property Doctrine_Collection $CompanyProduct
 * @property Doctrine_Collection $JobProductTask
 * @property Doctrine_Collection $JobTypeProductPrice
 * @property Doctrine_Collection $OrderItem
 * @property Doctrine_Collection $ProductPayTemplate
 * @property Doctrine_Collection $ProductPriceTemplate
 * @property Doctrine_Collection $ProductTask
 * @property Doctrine_Collection $ProductTemplate
 * @property Doctrine_Collection $ServiceProduct
 * @property Doctrine_Collection $StaffInvoiceItem
 * @property Doctrine_Collection $TaxRateProduct
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_Product extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('Product');
        $this->hasColumn('ProductID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ProductTypeCode', 'string', 4, array(
             'type' => 'string',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('Description', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('InvoiceDescription', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsTaxable', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('UnitTypeCode', 'string', 4, array(
             'type' => 'string',
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
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsGrouped', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('Code', 'string', 6, array(
             'type' => 'string',
             'length' => '6',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('GLCode', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('GLCodeLOB', 'string', 5, array(
             'type' => 'string',
             'length' => '5',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
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
        $this->hasColumn('DeliverableID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsPriceLocked', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => '((0))',
             'primary' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Models_Solaria_Deliverable as Deliverable', array(
             'local' => 'DeliverableID',
             'foreign' => 'DeliverableID'));

        $this->hasMany('Models_Solaria_AttorneyProductPrice as AttorneyProductPrice', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_ClientProductPrice as ClientProductPrice', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_CommissionProductRate as CommissionProductRate', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_CompanyProduct as CompanyProduct', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_JobProductTask as JobProductTask', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_JobTypeProductPrice as JobTypeProductPrice', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_OrderItem as OrderItem', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_ProductPayTemplate as ProductPayTemplate', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_ProductPriceTemplate as ProductPriceTemplate', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_ProductTask as ProductTask', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_ProductTemplate as ProductTemplate', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_ServiceProduct as ServiceProduct', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_StaffInvoiceItem as StaffInvoiceItem', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));

        $this->hasMany('Models_Solaria_TaxRateProduct as TaxRateProduct', array(
             'local' => 'ProductID',
             'foreign' => 'ProductID'));
    }
}
