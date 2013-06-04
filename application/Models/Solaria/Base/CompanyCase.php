<?php

/**
 * Models_Solaria_Base_CompanyCase
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $CompanyCaseID
 * @property integer $CompanyID
 * @property integer $CaseID
 * @property string $UserReferenceNumber
 * @property Models_Solaria_Company $Company
 * @property Models_Solaria_Cases $Cases
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_CompanyCase extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('CompanyCase');
        $this->hasColumn('CompanyCaseID', 'integer', 4, array(
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
        $this->hasColumn('CaseID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('UserReferenceNumber', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
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

        $this->hasOne('Models_Solaria_Cases as Cases', array(
             'local' => 'CaseID',
             'foreign' => 'CaseID'));
    }
}
