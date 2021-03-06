<?php

/**
 * Models_Solaria_Base_JobFile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $JobFileID
 * @property integer $JobID
 * @property integer $FileTypeID
 * @property string $FileName
 * @property boolean $AttorneyReposAccess
 * @property boolean $StaffReposAccess
 * @property boolean $SentToRepository
 * @property string $ReposFileName
 * @property Models_Solaria_Job $Job
 * @property Models_Solaria_FileType $FileType
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_JobFile extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('JobFile');
        $this->hasColumn('JobFileID', 'integer', 4, array(
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
        $this->hasColumn('FileTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('FileName', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('AttorneyReposAccess', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('StaffReposAccess', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('SentToRepository', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ReposFileName', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
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
        $this->hasOne('Models_Solaria_Job as Job', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasOne('Models_Solaria_FileType as FileType', array(
             'local' => 'FileTypeID',
             'foreign' => 'FileTypeID'));
    }
}
