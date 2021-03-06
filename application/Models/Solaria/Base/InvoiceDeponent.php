<?php

/**
 * Models_Solaria_Base_InvoiceDeponent
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $InvoiceDeponentID
 * @property integer $InvoiceID
 * @property integer $DeponentID
 * @property string $InvoiceText
 * @property Models_Solaria_Invoice $Invoice
 * @property Models_Solaria_Deponent $Deponent
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_InvoiceDeponent extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('InvoiceDeponent');
        $this->hasColumn('InvoiceDeponentID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('InvoiceID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('DeponentID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('InvoiceText', 'string', 150, array(
             'type' => 'string',
             'length' => '150',
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
        $this->hasOne('Models_Solaria_Invoice as Invoice', array(
             'local' => 'InvoiceID',
             'foreign' => 'InvoiceID'));

        $this->hasOne('Models_Solaria_Deponent as Deponent', array(
             'local' => 'DeponentID',
             'foreign' => 'DeponentID'));
    }
}
