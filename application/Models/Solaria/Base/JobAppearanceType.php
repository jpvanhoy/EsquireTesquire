<?php

/**
 * Models_Solaria_Base_JobAppearanceType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $JobAppearanceTypeID
 * @property integer $JobID
 * @property integer $AppearanceTypeID
 * @property boolean $Value
 * @property Models_Solaria_Job $Job
 * @property Models_Solaria_AppearanceType $AppearanceType
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_JobAppearanceType extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('JobAppearanceType');
        $this->hasColumn('JobAppearanceTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
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
        $this->hasColumn('AppearanceTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('Value', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Models_Solaria_Job as Job', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasOne('Models_Solaria_AppearanceType as AppearanceType', array(
             'local' => 'AppearanceTypeID',
             'foreign' => 'AppearanceTypeID'));
    }
}
