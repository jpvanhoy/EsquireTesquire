<?php

/**
 * Models_Solaria_Base_Workstation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $WorkstationID
 * @property string $OmnisSerialNum
 * @property string $IdentifierNum
 * @property string $IdentifierKey
 * @property string $WordPath
 * @property string $WordDocsPath
 * @property integer $LastUserID
 * @property timestamp $LastLoginDate
 * @property integer $FaxSystem
 * @property string $FaxPrinter
 * @property integer $EmailSystem
 * @property string $EmailServer
 * @property integer $EmailType
 * @property string $EmailAttachPrinter
 * @property integer $ZetaFaxOption
 * @property string $EmailPDFIniFile
 * @property integer $PDF995DelaySeconds
 * @property integer $PDFType
 * @property Doctrine_Collection $WorkstationApp
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_Workstation extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('Workstation');
        $this->hasColumn('WorkstationID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('OmnisSerialNum', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IdentifierNum', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IdentifierKey', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('WordPath', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('WordDocsPath', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('LastUserID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('LastLoginDate', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('FaxSystem', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('FaxPrinter', 'string', 250, array(
             'type' => 'string',
             'length' => '250',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EmailSystem', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EmailServer', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EmailType', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EmailAttachPrinter', 'string', 250, array(
             'type' => 'string',
             'length' => '250',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ZetaFaxOption', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EmailPDFIniFile', 'string', 250, array(
             'type' => 'string',
             'length' => '250',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PDF995DelaySeconds', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PDFType', 'integer', 4, array(
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
        $this->hasMany('Models_Solaria_WorkstationApp as WorkstationApp', array(
             'local' => 'WorkstationID',
             'foreign' => 'WorkstationID'));
    }
}