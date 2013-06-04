<?php

/**
 * Models_Solaria_Base_InvoiceChargeRate
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $InvoiceChargeRateID
 * @property integer $InvoiceChargeTypeID
 * @property integer $CompanyID
 * @property float $Rate
 * @property Models_Solaria_InvoiceChargeType $InvoiceChargeType
 * @property Models_Solaria_Company $Company
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_InvoiceChargeRate extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('InvoiceChargeRate');
        $this->hasColumn('InvoiceChargeRateID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('InvoiceChargeTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
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
        $this->hasColumn('Rate', 'float', 18, array(
             'type' => 'float',
             'length' => '18',
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
        $this->hasOne('Models_Solaria_InvoiceChargeType as InvoiceChargeType', array(
             'local' => 'InvoiceChargeTypeID',
             'foreign' => 'InvoiceChargeTypeID'));

        $this->hasOne('Models_Solaria_Company as Company', array(
             'local' => 'CompanyID',
             'foreign' => 'CompanyID'));
    }
}
