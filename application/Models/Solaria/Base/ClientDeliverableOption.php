<?php

/**
 * Models_Solaria_Base_ClientDeliverableOption
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ClientDeliverableOptionID
 * @property integer $ClientID
 * @property integer $DeliverableID
 * @property integer $DeliverableOptionID
 * @property Models_Solaria_Client $Client
 * @property Models_Solaria_Deliverable $Deliverable
 * @property Models_Solaria_DeliverableOption $DeliverableOption
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_ClientDeliverableOption extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('ClientDeliverableOption');
        $this->hasColumn('ClientDeliverableOptionID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
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
        $this->hasColumn('DeliverableID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('DeliverableOptionID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
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
        $this->hasOne('Models_Solaria_Client as Client', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasOne('Models_Solaria_Deliverable as Deliverable', array(
             'local' => 'DeliverableID',
             'foreign' => 'DeliverableID'));

        $this->hasOne('Models_Solaria_DeliverableOption as DeliverableOption', array(
             'local' => 'DeliverableOptionID',
             'foreign' => 'DeliverableOptionID'));
    }
}