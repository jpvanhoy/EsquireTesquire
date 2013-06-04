<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Models_Intranet_FormHistoryClientcareContest', 'intranet');

/**
 * Models_Intranet_Base_FormHistoryClientcareContest
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $IDNumber
 * @property timestamp $DateofEntry
 * @property string $BeCommended
 * @property string $OfficeBeCommended
 * @property string $DepBeCommended
 * @property string $EmailBeCommended
 * @property string $RecognizedBy
 * @property string $DepRecognizedBy
 * @property string $EmailRecognizedBy
 * @property string $Fact
 * @property string $Impact
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Intranet_Base_FormHistoryClientcareContest extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('FormHistory_clientcare_contest');
        $this->hasColumn('IDNumber', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('DateofEntry', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('BeCommended', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('OfficeBeCommended', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('DepBeCommended', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EmailBeCommended', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('RecognizedBy', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('DepRecognizedBy', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EmailRecognizedBy', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('Fact', 'string', 2147483647, array(
             'type' => 'string',
             'length' => '2147483647',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('Impact', 'string', 2147483647, array(
             'type' => 'string',
             'length' => '2147483647',
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
        
    }
}