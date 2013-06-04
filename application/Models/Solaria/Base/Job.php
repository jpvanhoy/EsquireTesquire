<?php

/**
 * Models_Solaria_Base_Job
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $JobID
 * @property integer $CompanyID
 * @property integer $ClientID
 * @property integer $AttorneyID
 * @property integer $JobStatusID
 * @property integer $CaseID
 * @property integer $JobTypeID
 * @property integer $ContactID
 * @property integer $JobLocationID
 * @property integer $ConferenceRoomID
 * @property boolean $IsInConferenceRoom
 * @property timestamp $TimeOrdered
 * @property timestamp $JobDate
 * @property boolean $IsAllDay
 * @property timestamp $TimeStart
 * @property float $EstimatedLength
 * @property timestamp $ConfirmedOn
 * @property string $ConfirmedBy
 * @property timestamp $EditedOn
 * @property integer $UserID
 * @property boolean $JobCanceled
 * @property boolean $ClientNotified
 * @property integer $JobColorCodeID
 * @property timestamp $FilingDate
 * @property boolean $PrintNotesOnStaffConfirm
 * @property integer $ScheduledBy
 * @property string $TimeZoneCode
 * @property string $SpecialInstructions
 * @property string $ConfirmNote
 * @property boolean $IsRescheduled
 * @property string $OpposingCounsel
 * @property timestamp $SendToRepository
 * @property boolean $IsStatusOverwritten
 * @property integer $ClientAddressID
 * @property integer $JobConfirmStatusID
 * @property integer $JobUserCodeID
 * @property integer $DeliveryTypeID
 * @property string $PreOrderInfo
 * @property timestamp $TranscriptReceivedOn
 * @property timestamp $DeliverByDate
 * @property integer $JobNumber
 * @property integer $JobTrackingTypeID
 * @property integer $JobPriorityTypeID
 * @property integer $CSDTypeID
 * @property string $ECNNumber
 * @property integer $InterCompanyType
 * @property integer $InterCompanyJobID
 * @property integer $InterCompanyID
 * @property integer $ClientMatterID
 * @property string $TerritoryPostalCode
 * @property boolean $IsV1InterCompany
 * @property timestamp $EmailDueDate
 * @property timestamp $HardCopyDueDate
 * @property boolean $HasOvertimeRates
 * @property boolean $HasSpecialRates
 * @property boolean $HasDigitalSignature
 * @property boolean $BypassProduction
 * @property integer $BypassProductionReasonID
 * @property integer $ReporterWorksheetStatusID
 * @property Models_Solaria_Company $Company
 * @property Models_Solaria_Client $Client
 * @property Models_Solaria_Attorney $Attorney
 * @property Models_Solaria_JobStatus $JobStatus
 * @property Models_Solaria_Cases $Cases
 * @property Models_Solaria_JobType $JobType
 * @property Models_Solaria_Contact $Contact
 * @property Models_Solaria_JobLocation $JobLocation
 * @property Models_Solaria_ConferenceRoom $ConferenceRoom
 * @property Models_Solaria_SystemUser $SystemUser
 * @property Models_Solaria_JobColorCode $JobColorCode
 * @property Models_Solaria_TimeZone $TimeZone
 * @property Models_Solaria_Address $Address
 * @property Models_Solaria_JobConfirmStatus $JobConfirmStatus
 * @property Models_Solaria_JobUserCode $JobUserCode
 * @property Models_Solaria_DeliveryType $DeliveryType
 * @property Models_Solaria_JobTrackingType $JobTrackingType
 * @property Models_Solaria_JobPriorityType $JobPriorityType
 * @property Models_Solaria_CSDType $CSDType
 * @property Models_Solaria_ClientMatter $ClientMatter
 * @property Models_Solaria_BypassProductionReason $BypassProductionReason
 * @property Models_Solaria_ReporterWorksheetStatus $ReporterWorksheetStatus
 * @property Doctrine_Collection $Invoice
 * @property Doctrine_Collection $JobAppearanceType
 * @property Doctrine_Collection $JobAttorneyDeponent
 * @property Doctrine_Collection $JobAttorneyPresent
 * @property Doctrine_Collection $JobCheckIn
 * @property Doctrine_Collection $JobDeponent
 * @property Doctrine_Collection $JobFile
 * @property Doctrine_Collection $JobInsurance
 * @property Doctrine_Collection $JobProductTask
 * @property Doctrine_Collection $JobReporterCost
 * @property Doctrine_Collection $JobReporterTimeAndDistance
 * @property Doctrine_Collection $JobService
 * @property Doctrine_Collection $JobTask
 * @property Doctrine_Collection $Orders
 * @property Doctrine_Collection $StaffInvoice
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Models_Solaria_Base_Job extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('Job');
        $this->hasColumn('JobID', 'integer', 4, array(
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
        $this->hasColumn('ClientID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('AttorneyID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('JobStatusID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CaseID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('JobTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ContactID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('JobLocationID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ConferenceRoomID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsInConferenceRoom', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('TimeOrdered', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('JobDate', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsAllDay', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('TimeStart', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EstimatedLength', 'float', 8, array(
             'type' => 'float',
             'length' => '8',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ConfirmedOn', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ConfirmedBy', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EditedOn', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('UserID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('JobCanceled', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ClientNotified', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('JobColorCodeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('FilingDate', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PrintNotesOnStaffConfirm', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ScheduledBy', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('TimeZoneCode', 'string', 4, array(
             'type' => 'string',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('SpecialInstructions', 'string', 250, array(
             'type' => 'string',
             'length' => '250',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ConfirmNote', 'string', 250, array(
             'type' => 'string',
             'length' => '250',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsRescheduled', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('OpposingCounsel', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('SendToRepository', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsStatusOverwritten', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ClientAddressID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('JobConfirmStatusID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('JobUserCodeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('DeliveryTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PreOrderInfo', 'string', 125, array(
             'type' => 'string',
             'length' => '125',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('TranscriptReceivedOn', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('DeliverByDate', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('JobNumber', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('JobTrackingTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('JobPriorityTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('CSDTypeID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ECNNumber', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('InterCompanyType', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('InterCompanyJobID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('InterCompanyID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ClientMatterID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('TerritoryPostalCode', 'string', 10, array(
             'type' => 'string',
             'length' => '10',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('IsV1InterCompany', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('EmailDueDate', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('HardCopyDueDate', 'timestamp', 16, array(
             'type' => 'timestamp',
             'length' => '16',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('HasOvertimeRates', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('HasSpecialRates', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('HasDigitalSignature', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('BypassProduction', 'boolean', 1, array(
             'type' => 'boolean',
             'length' => '1',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'default' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('BypassProductionReasonID', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ReporterWorksheetStatusID', 'integer', 4, array(
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
        $this->hasOne('Models_Solaria_Company as Company', array(
             'local' => 'CompanyID',
             'foreign' => 'CompanyID'));

        $this->hasOne('Models_Solaria_Client as Client', array(
             'local' => 'ClientID',
             'foreign' => 'ClientID'));

        $this->hasOne('Models_Solaria_Attorney as Attorney', array(
             'local' => 'AttorneyID',
             'foreign' => 'AttorneyID'));

        $this->hasOne('Models_Solaria_JobStatus as JobStatus', array(
             'local' => 'JobStatusID',
             'foreign' => 'JobStatusID'));

        $this->hasOne('Models_Solaria_Cases as Cases', array(
             'local' => 'CaseID',
             'foreign' => 'CaseID'));

        $this->hasOne('Models_Solaria_JobType as JobType', array(
             'local' => 'JobTypeID',
             'foreign' => 'JobTypeID'));

        $this->hasOne('Models_Solaria_Contact as Contact', array(
             'local' => 'ContactID',
             'foreign' => 'ContactID'));

        $this->hasOne('Models_Solaria_JobLocation as JobLocation', array(
             'local' => 'JobLocationID',
             'foreign' => 'JobLocationID'));

        $this->hasOne('Models_Solaria_ConferenceRoom as ConferenceRoom', array(
             'local' => 'ConferenceRoomID',
             'foreign' => 'ConferenceRoomID'));

        $this->hasOne('Models_Solaria_SystemUser as SystemUser', array(
             'local' => 'UserID',
             'foreign' => 'UserID'));

        $this->hasOne('Models_Solaria_JobColorCode as JobColorCode', array(
             'local' => 'JobColorCodeID',
             'foreign' => 'JobColorCodeID'));

        $this->hasOne('Models_Solaria_TimeZone as TimeZone', array(
             'local' => 'TimeZoneCode',
             'foreign' => 'TimeZoneCode'));

        $this->hasOne('Models_Solaria_Address as Address', array(
             'local' => 'ClientAddressID',
             'foreign' => 'AddressID'));

        $this->hasOne('Models_Solaria_JobConfirmStatus as JobConfirmStatus', array(
             'local' => 'JobConfirmStatusID',
             'foreign' => 'JobConfirmStatusID'));

        $this->hasOne('Models_Solaria_JobUserCode as JobUserCode', array(
             'local' => 'JobUserCodeID',
             'foreign' => 'JobUserCodeID'));

        $this->hasOne('Models_Solaria_DeliveryType as DeliveryType', array(
             'local' => 'DeliveryTypeID',
             'foreign' => 'DeliveryTypeID'));

        $this->hasOne('Models_Solaria_JobTrackingType as JobTrackingType', array(
             'local' => 'JobTrackingTypeID',
             'foreign' => 'JobTrackingTypeID'));

        $this->hasOne('Models_Solaria_JobPriorityType as JobPriorityType', array(
             'local' => 'JobPriorityTypeID',
             'foreign' => 'JobPriorityTypeID'));

        $this->hasOne('Models_Solaria_CSDType as CSDType', array(
             'local' => 'CSDTypeID',
             'foreign' => 'CSDTypeID'));

        $this->hasOne('Models_Solaria_ClientMatter as ClientMatter', array(
             'local' => 'ClientMatterID',
             'foreign' => 'ClientMatterID'));

        $this->hasOne('Models_Solaria_BypassProductionReason as BypassProductionReason', array(
             'local' => 'BypassProductionReasonID',
             'foreign' => 'BypassProductionReasonID'));

        $this->hasOne('Models_Solaria_ReporterWorksheetStatus as ReporterWorksheetStatus', array(
             'local' => 'ReporterWorksheetStatusID',
             'foreign' => 'ReporterWorksheetStatusID'));

        $this->hasMany('Models_Solaria_Invoice as Invoice', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_JobAppearanceType as JobAppearanceType', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_JobAttorneyDeponent as JobAttorneyDeponent', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_JobAttorneyPresent as JobAttorneyPresent', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_JobCheckIn as JobCheckIn', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_JobDeponent as JobDeponent', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_JobFile as JobFile', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_JobInsurance as JobInsurance', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_JobProductTask as JobProductTask', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_JobReporterCost as JobReporterCost', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_JobReporterTimeAndDistance as JobReporterTimeAndDistance', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_JobService as JobService', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_JobTask as JobTask', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_Orders as Orders', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));

        $this->hasMany('Models_Solaria_StaffInvoice as StaffInvoice', array(
             'local' => 'JobID',
             'foreign' => 'JobID'));
    }
}
