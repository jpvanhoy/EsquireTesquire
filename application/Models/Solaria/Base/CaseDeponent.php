<?php

/**
 * Models_Solaria_Base_CaseDeponent
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $CaseID
 * @property integer $DeponentID
 * @property Models_Solaria_Cases $Cases
 * @property Models_Solaria_Deponent $Deponent
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_CaseDeponent extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('CaseDeponent');
        $this->hasColumn('CaseID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('DeponentID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Models_Solaria_Cases as Cases', array(
             'local' => 'CaseID',
             'foreign' => 'CaseID'));

        $this->hasOne('Models_Solaria_Deponent as Deponent', array(
             'local' => 'DeponentID',
             'foreign' => 'DeponentID'));
    }
}
