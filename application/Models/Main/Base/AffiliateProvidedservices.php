<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Main_AffiliateProvidedservices', 'main');

/**
 * Models_Main_Base_AffiliateProvidedservices
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $affiliateServiceID
 * @property integer $affiliateID
 * @property integer $serviceID
 * @property string $notes
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Main_Base_AffiliateProvidedservices extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('affiliate_providedservices');
        $this->hasColumn('affiliateServiceID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('affiliateID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('serviceID', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('notes', 'string', 350, array(
             'type' => 'string',
             'length' => 350,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}