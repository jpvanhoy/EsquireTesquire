<?php

/**
 * Models_Solaria_Base_DeliveryType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $DeliveryTypeID
 * @property string $Description
 * @property boolean $IsActive
 * @property boolean $IsSystemDefined
 * @property integer $DaysUntilDue
 * @property Doctrine_Collection $AttorneyProductPrice
 * @property Doctrine_Collection $ClientProductPrice
 * @property Doctrine_Collection $Invoice
 * @property Doctrine_Collection $Job
 * @property Doctrine_Collection $JobCheckIn
 * @property Doctrine_Collection $JobTypeProductPrice
 * @property Doctrine_Collection $Orders
 * @property Doctrine_Collection $ProductPayTemplate
 * @property Doctrine_Collection $ProductPriceTemplate
 * @property Doctrine_Collection $StaffInvoiceItem
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_DeliveryType extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('DeliveryType');
        $this->hasColumn('DeliveryTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
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
        $this->hasColumn('IsActive', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsSystemDefined', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('DaysUntilDue', 'integer', 4, array(
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
        $this->hasMany('Models_Solaria_AttorneyProductPrice as AttorneyProductPrice', array(
             'local' => 'DeliveryTypeID',
             'foreign' => 'DeliveryTypeID'));

        $this->hasMany('Models_Solaria_ClientProductPrice as ClientProductPrice', array(
             'local' => 'DeliveryTypeID',
             'foreign' => 'DeliveryTypeID'));

        $this->hasMany('Models_Solaria_Invoice as Invoice', array(
             'local' => 'DeliveryTypeID',
             'foreign' => 'DeliveryTypeID'));

        $this->hasMany('Models_Solaria_Job as Job', array(
             'local' => 'DeliveryTypeID',
             'foreign' => 'DeliveryTypeID'));

        $this->hasMany('Models_Solaria_JobCheckIn as JobCheckIn', array(
             'local' => 'DeliveryTypeID',
             'foreign' => 'DeliveryTypeID'));

        $this->hasMany('Models_Solaria_JobTypeProductPrice as JobTypeProductPrice', array(
             'local' => 'DeliveryTypeID',
             'foreign' => 'DeliveryTypeID'));

        $this->hasMany('Models_Solaria_Orders as Orders', array(
             'local' => 'DeliveryTypeID',
             'foreign' => 'DeliveryTypeID'));

        $this->hasMany('Models_Solaria_ProductPayTemplate as ProductPayTemplate', array(
             'local' => 'DeliveryTypeID',
             'foreign' => 'DeliveryTypeID'));

        $this->hasMany('Models_Solaria_ProductPriceTemplate as ProductPriceTemplate', array(
             'local' => 'DeliveryTypeID',
             'foreign' => 'DeliveryTypeID'));

        $this->hasMany('Models_Solaria_StaffInvoiceItem as StaffInvoiceItem', array(
             'local' => 'DeliveryTypeID',
             'foreign' => 'DeliveryTypeID'));
    }
}