
-- These changes will modify the schema for a Solaria database.
-- This should ONLY be used in development/qa.

CREATE TABLE dbo.ReporterWorksheetStatus( --DONE
    ReporterWorksheetStatusID INT IDENTITY,
    Description VARCHAR(100) NOT NULL,
    Name VARCHAR(30) NOT NULL,
    SortOrder INT NOT NULL,
    IsActive BIT DEFAULT (1) NOT NULL,
    CentralID INT NULL,
	CONSTRAINT PK_ReporterWorksheetStatus, PRIMARY KEY (ReporterWorksheetStatusID)
);

CREATE TABLE dbo.BypassProductionReason( --DONE
    BypassProductionReasonID INT IDENTITY,
    Description VARCHAR(100) NOT NULL,
    Name VARCHAR(30) NOT NULL,
    SortOrder INT NOT NULL,
    IsActive BIT DEFAULT (1) NOT NULL,
    CentralID INT NULL,
	CONSTRAINT PK_BypassProductionReason PRIMARY KEY (BypassProductionReasonID)
);

CREATE TABLE dbo.AppearanceType( --DONE
    AppearanceTypeID INT IDENTITY,
    Description VARCHAR(100) NOT NULL,
    Name VARCHAR(30) NOT NULL,
    SortOrder INT NOT NULL,
    IsActive BIT DEFAULT (1) NOT NULL,
    CentralID INT NULL,
	CONSTRAINT PK_AppearanceType PRIMARY KEY (AppearanceTypeID)
);

CREATE TABLE dbo.JobAppearanceType( --DONE
    JobAppearanceTypeID INT IDENTITY,
    AppearanceTypeID INT NOT NULL,
    JobID INT NOT NULL,
    Value BIT DEFAULT (0) NOT NULL,
	CONSTRAINT PK_JobAppearanceType PRIMARY KEY (JobAppearanceTypeID),
	CONSTRAINT PKC_JobAppearanceTypeCompound UNIQUE (AppearanceTypeID, JobID)
);

CREATE TABLE dbo.Jurisdiction( --DONE
    JurisdictionID INT IDENTITY,
    StateCode VARCHAR(5) NULL,
    Description VARCHAR(100) NOT NULL,
    Name VARCHAR(30) NOT NULL,
    SortOrder INT NOT NULL,
    IsActive BIT DEFAULT (1) NOT NULL,
	SignatureProtocolID INT NULL,
	CentralID INT NULL,
    CONSTRAINT PK_Jurisdiction PRIMARY KEY (JurisdictionID);
);

CREATE TABLE dbo.SignatureProtocol( --DONE
    SignatureProtocolID INT IDENTITY,
    ShortTitle VARCHAR(50) NOT NULL,
    LongTitle VARCHAR(200) NOT NULL,
    Description TEXT NOT NULL,
    SortOrder INT NOT NULL,
    CentralID INT NULL,
    IsActive BIT DEFAULT (1) NOT NULL,
	CONSTRAINT PK_SignatureProtocol PRIMARY KEY (SignatureProtocol);
);

CREATE TABLE dbo.JobReporterCost( --DONE
	JobReporterCostID INT IDENTITY,
    ReporterCostID INT NOT NULL,
    JobID INT NOT NULL,
    Value INT NULL,
    ApprovingManager VARCHAR(100) NULL,
	CONSTRAINT PK_JobReporterCostID PRIMARY KEY (JobReporterCostID),
	CONSTRAINT PKC_JobReporterCost UNIQUE (ReporterCostID, JobID)
);

CREATE TABLE dbo.ReporterCost( --DONE
    ReporterCostID INT IDENTITY,
    Description VARCHAR(30) NOT NULL,
    Name VARCHAR(30) NOT NULL,
    SortOrder INT NOT NULL,
    IsActive BIT DEFAULT (1) NOT NULL,
    CentralID INT NULL,
	CONSTRAINT PK_ReporterCost PRIMARY KEY (ReporterCostID)
);

CREATE TABLE dbo.JobReporterTimeAndDistance( --DONE
    JobReporterTimeAndDistanceID INT IDENTITY,
    ReporterTimeAndDistanceID INT NOT NULL,
    JobID INT NOT NULL,
    Value INT NULL,
    ApprovingManager VARCHAR(100) NULL,
	CONSTRAINT PK_JobReporterTimeAndDistance PRIMARY KEY (JobReporterTimeAndDistanceID),
	CONSTRAINT PKC_JobReporterTimeAndDistance UNIQUE (ReporterTimeAndDistanceID, JobID)
);

CREATE TABLE dbo.ReporterTimeAndDistance( --DONE
    ReporterTimeAndDistanceID INT IDENTITY,
    Description VARCHAR(100) NOT NULL,
    Name VARCHAR(30) NOT NULL,
    SortOrder INT NOT NULL,
    CentralID INT NULL,
    IsActive BIT DEFAULT (1) NOT NULL,
    CONSTRAINT PK_ReporterTimeAndDistance PRIMARY KEY (ReporterTimeAndDistanceID)
);

CREATE TABLE dbo.OnBehalfOfType( 
    OnBehalfOfTypeID INT IDENTITY,
    Description VARCHAR(100) NOT NULL,
    IsActive BIT DEFAULT (1) NOT NULL,
    IsSystemDefined BIT DEFAULT (1) NOT NULL,
	CONSTRAINT PK_OnBehalfOfType PRIMARY KEY (OnBehalfOfTypeID)
);

CREATE TABLE dbo.ProofOfOrdering( --DONE  - needs Doctrine
    ProofOfOrderingID INT IDENTITY,
    Description VARCHAR(100) NOT NULL,
    Name VARCHAR(30) NOT NULL,
    SortOrder INT NOT NULL,
    IsActive BIT DEFAULT (1) NOT NULL,
    CentralID INT NULL,
	CONSTRAINT PK_ProofOfOrdering PRIMARY KEY (ProofOfOrderingID)
);
      
CREATE TABLE dbo.OrderProofOfOrdering( --DONE - needs Doctrine
    OrderProofOfOrderingID INT IDENTITY,
    OrderID INT NOT NULL,
    ProofOfOrderingID INT NOT NULL,
    Value BIT DEFAULT (0) NOT NULL,
	CONSTRAINT PK_OrderProofOfOrdering PRIMARY KEY (OrderProofOfOrderingID),
	CONSTRAINT PKC_OrderProofOfOrdering UNIQUE (OrderID, ProofOfOrderingID)
);

CREATE TABLE dbo.OrderDeponentDeliverable ( --DONE
	OrderDeponentDeliverableID INT IDENTITY,
	OrderID INT NOT NULL,
	DeponentID INT NOT NULL,
	DeliverableID INT NOT NULL,
	IsOriginal BIT DEFAULT (0),
	DeliveryMediumID INT,
	CONSTRAINT PK_OrderDeponentDeliverable PRIMARY KEY (OrderDeponentDeliverableID)
);

CREATE TABLE dbo.DeliveryMedium ( --DONE
	DeliveryMediumID INT IDENTITY,
	Description VARCHAR(100),
	Name VARCHAR(30) NOT NULL,
	SortOrder INT NOT NULL,
	IsActive INT DEFAULT (1),
	CentralID INT,
	CONSTRAINT PK_DeliveryMedium PRIMARY KEY (DeliveryMediumID)
);

CREATE TABLE dbo.OrderDeponentDeliverableOption ( --DONE
	OrderDeponentDeliverableOptionID INT IDENTITY,
	OrderDeponentDeliverableID INT,
	DeliverableOptionID INT,
	CONSTRAINT PK_OrderDeponentDeliverableOption PRIMARY KEY (OrderDeponentDeliverableID),
	CONSTRAINT PKC_OrderDeponentDeliverableOption UNIQUE (OrderDeponentDeliverableID, DeliverableOptionID)
);

CREATE TABLE dbo.Exhibit ( --DONE
	ExhibitID INT IDENTITY,
	ExhibitSequence VARCHAR(200) NULL,
	ExhibitNotSentToProduction VARCHAR(200) NULL,
	ExhibitInstructionID INT NULL,
	ExhibitTurnInID INT NULL,
	TurnInDate DATETIME NULL,
	TrackingNumbers VARCHAR(100) NULL,
    CONSTRAINT PK_Exhibit PRIMARY KEY (ExhibitID)
);

CREATE TABLE dbo.TranscriptType( --DONE
    TranscriptTypeID INT IDENTITY,
    Description VARCHAR(100) NOT NULL,
    Name VARCHAR(30) NOT NULL,
    SortOrder INT NOT NULL,
    CentralID INT NULL,
    IsActive BIT DEFAULT (1) NOT NULL,
    CONSTRAINT PK_TranscriptType PRIMARY KEY (TranscriptTypeID)
);

CREATE TABLE dbo.Confidentiality( --DONE
    ConfidentialityID INT IDENTITY,
    Description VARCHAR(100) NOT NULL,
    Name VARCHAR(30) NOT NULL,
    SortOrder INT NOT NULL,
    CentralID INT NULL,
    IsActive BIT DEFAULT (1) NOT NULL,
    CONSTRAINT PK_Confidentiality PRIMARY KEY (ConfidentialityID)
);

CREATE TABLE dbo.ExhibitInstruction ( --DONE
	ExhibitInstructionID INT IDENTITY,
	Name VARCHAR(30) NOT NULL,
	Description VARCHAR(100) NOT NULL,
	SortOrder INT NOT NULL,
    CentralID INT NULL,
	IsActive BIT DEFAULT (1) NOT NULL,
    CONSTRAINT PK_ExhibitInstruction PRIMARY KEY (ExhibitInstructionID)
);

CREATE TABLE dbo.ExhibitTurnIn ( --DONE
	ExhibitTurnInID INT IDENTITY,
	Name VARCHAR(30) NOT NULL,
	Description VARCHAR(100) NOT NULL,
	SortOrder INT NOT NULL,
	IsActive INT DEFAULT (1) NOT NULL,
    CentralID INT NULL,
    CONSTRAINT PK_ExhibitTurnIn PRIMARY KEY (ExhibitTurnInID)
);

CREATE TABLE dbo.JobDeponentReadAndSign ( --DONE
	JobDeponentReadAndSignID INT IDENTITY,
	WitnessAttorneyName VARCHAR(100) NULL,
	DaysTimeLimit INT NULL,
	SignatureProtocolID INT NULL,
	WitnessSignature VARCHAR(30) NULL,
    CONSTRAINT PK_JobDeponentReadAndSign PRIMARY KEY (JobDeponentReadAndSignID)
);




--------- FOREIGN KEYS -------------------------
ALTER TABLE dbo.Exhibit ADD 
	CONSTRAINT FK_Exhibit_ExhibitInstruction FOREIGN KEY (ExhibitInstructionID) 
	REFERENCES dbo.ExhibitInstruction (ExhibitInstructionID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_Exhibit_ExhibitTurnIn FOREIGN KEY (ExhibitTurnInID) 
	REFERENCES dbo.ExhibitTurnIn (ExhibitTurnInID) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE dbo.JobDeponentReadAndSign ADD 
	CONSTRAINT FK_JobDeponentReadAndSign_SignatureProtocol FOREIGN KEY (SignatureProtocolID)
	REFERENCES dbo.SignatureProtocolID (SignatureProtocolID) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE dbo.Job ADD 
	EmailDueDate DATETIME NULL,
	HardCopyDueDate DATETIME NULL,
	HasOvertimeRates BIT DEFAULT (0) NOT NULL,
	HasSpecialRates BIT DEFAULT (0) NOT NULL,
	BypassProduction BIT DEFAULT (0) NOT NULL,
	HasDigitalSignature BIT DEFAULT (0) NOT NULL,
	BypassProductionReasonID INT NULL,
	ReporterWorksheetStatusID INT NULL,
	CONSTRAINT FK_Job_BypassProductionReason FOREIGN KEY (BypassProductionReasonID)
	REFERENCES dbo.BypassProductionReason (BypassProductionReasonID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_Job_ReporterWorksheetStatus FOREIGN KEY (ReporterWorksheetStatusID)
	REFERENCES dbo.ReporterWorksheetStatus (ReporterWorksheetStatusID) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE dbo.Cases ADD 
	JurisdictionID INT NULL,
	CONSTRAINT FK_Cases_Jurisdiction FOREIGN KEY (JurisdictionID)
	REFERENCES dbo.Jurisdiction (JurisdictionID) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE dbo.Jurisdiction ADD 
	CONSTRAINT FK_Jurisdiction_State FOREIGN KEY (StateCode)
	REFERENCES dbo.State (StateCode) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_Jurisdiction_SignatureProtocol FOREIGN KEY (SignatureProtocolID)
	REFERENCES dbo.SignatureProtocol (SignatureProtocolID) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE dbo.JobPerformedService ADD 
	CONSTRAINT FK_JobPerformedService_Job FOREIGN KEY (JobID)
	REFERENCES dbo.Job (JobID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_JobPerformedService_PerformedService FOREIGN KEY (PerformedServiceID)
	REFERENCES dbo.PerformedService (PerformedServiceID) ON DELETE NO ACTION ON UPDATE NO ACTION;
      
ALTER TABLE dbo.OrderProofOfOrdering ADD 
	CONSTRAINT FK_OrderProofOfOrdering_ProofOfOrdering FOREIGN KEY (ProofOfOrderingID)
	REFERENCES dbo.ProofOfOrdering (ProofOfOrderingID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_OrderProofOfOrdering_Orders FOREIGN KEY (OrderID)
	REFERENCES dbo.Orders (OrderID) ON DELETE NO ACTION ON UPDATE NO ACTION;
      
ALTER TABLE dbo.JobReporterCost ADD 
	CONSTRAINT FK_JobReporterCost_Job FOREIGN KEY (JobID)
	REFERENCES dbo.Job (JobID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_JobReporterCost_ReporterCost FOREIGN KEY (ReporterCostID)
	REFERENCES dbo.ReporterCost (ReporterCostID) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE dbo.JobAppearanceType ADD 
	CONSTRAINT FK_JobAppearanceType_Job FOREIGN KEY (JobID)
	REFERENCES dbo.Job (JobID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_JobAppearanceType_AppearanceType FOREIGN KEY (AppearanceTypeID)
	REFERENCES dbo.AppearanceType (AppearanceTypeID) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE dbo.JobReporterTimeAndDistance ADD 
	CONSTRAINT FK_JobReporterTimeAndDistance_Job FOREIGN KEY (JobID)
	REFERENCES dbo.Job (JobID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_JobReporterTimeAndDistance_ReporterTimeAndDistance FOREIGN KEY (ReporterTimeAndDistanceID)
	REFERENCES dbo.ReporterTimeAndDistance (ReporterTimeAndDistanceID) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE dbo.OrderDeponentDeliverable ADD 
	CONSTRAINT FK_OrderDeponentDeliverable_Orders
	FOREIGN KEY (OrderID) REFERENCES dbo.Orders (OrderID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_OrderDeponentDeliverable_Deponent
	FOREIGN KEY (DeponentID) REFERENCES dbo.Deponent (DeponentID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_OrderDeponentDeliverable_Deliverable
	FOREIGN KEY (DeliverableID) REFERENCES dbo.Deliverable (DeliverableID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_OrderDeponentDeliverable_DeliveryMedium
	FOREIGN KEY (DeliveryMediumID) REFERENCES dbo.DeliveryMedium (DeliveryMediumID) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE dbo.OrderDeponentDeliverableOption ADD
	CONSTRAINT FK_OrderDeponentDeliverableOption_OrderDeponenetDeliverable FOREIGN KEY (OrderDeponentDeliverableID) 
	REFERENCES dbo.OrderDeponentDeliverable (OrderDeponentDeliverableID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_OrderDeponentDeliverableOption_DeliverableOption FOREIGN KEY (DeliverableOptionID) 
	REFERENCES dbo.DeliverableOption (DeliverableOptionID) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE dbo.JobDeponent ADD 
	TranscriptTypeID INT NULL,
	ConfidentialityID INT NULL,
	RoughDraftPageCount INT NULL,
	JobDeponentReadAndSignID INT NULL,
	JobDeponentExhibitID INT NULL;

ALTER TABLE dbo.JobDeponent ADD 
	CONSTRAINT FK_JobDeponent_JobDeponentReadAndSign FOREIGN KEY (JobDeponentReadAndSign)
	REFERENCES dbo.JobDeponentReadAndSign (JobDeponentReadAndSignID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_JobDeponent_JobDeponentExhibitID FOREIGN KEY (JobDeponentExhibitID)
	REFERENCES dbo.JobDeponentExhibit (JobDeponentExhibitID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_JobDeponent_TranscriptType FOREIGN KEY (TranscriptTypeID)
	REFERENCES dbo.TranscriptType (TranscriptTypeID) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT FK_JobDeponent_Confidentiality FOREIGN KEY (ConfidentialityID)
	REFERENCES dbo.Confidentiality (ConfidentialityID) ON DELETE NO ACTION ON UPDATE NO ACTION;

-------------- DEFAULT VALUES ------------------

INSERT INTO dbo.ProofOfOrdering (Description, Name, SortOrder, IsActive, CentralID)
	VALUES('Signed Order Form', 'SIGNED ORDER', 1, 1, null)
INSERT INTO dbo.ProofOfOrdering (Description, Name, SortOrder, IsActive, CentralID)
	VALUES('Ordered on the Record', 'ORDERED ON RECORD', 2, 1, null)
INSERT INTO dbo.ProofOfOrdering (Description, Name, SortOrder, IsActive, CentralID)
	VALUES('Order caught on audio recording', 'ORDERED ON AUDIO', 3, 1, null)
INSERT INTO dbo.ProofOfOrdering (Description, Name, SortOrder, IsActive, CentralID)
	VALUES('Standing Order', 'STANDING ORDER', 4, 1, null)
INSERT INTO dbo.ProofOfOrdering (Description, Name, SortOrder, IsActive, CentralID)
	VALUES('Other Proof', 'OTHER PROOF', 5, 1, null)
INSERT INTO dbo.ProofOfOrdering (Description, Name, SortOrder, IsActive, CentralID)
	VALUES('None', 'NONE', 6, 1, null)

INSERT INTO dbo.OnBehalfOfType (Description, IsActive, IsSystemDefined)
	VALUES('DEFENDANT', 1, 1)
INSERT INTO dbo.OnBehalfOfType (Description, IsActive, IsSystemDefined)
	VALUES('PLAINTIFF', 1, 1)
INSERT INTO dbo.OnBehalfOfType (Description, IsActive, IsSystemDefined)
	VALUES('THIRD PARTY', 1, 1)
INSERT INTO dbo.OnBehalfOfType (Description, IsActive, IsSystemDefined)
	VALUES('OTHER', 1, 1)

INSERT INTO dbo.Confidentiality (Description, Name, SortOrder, IsActive)
	VALUES('Normal (Non-Confidential)', 'NORMAL', 1, 1)
INSERT INTO dbo.Confidentiality (Description, Name, SortOrder, IsActive)
	VALUES('Confidential', 'CONFIDENTIAL', 2, 1)
INSERT INTO dbo.Confidentiality (Description, Name, SortOrder, IsActive)
	VALUES('Highly Confidential', 'HIGH', 3, 1)
INSERT INTO dbo.Confidentiality (Description, Name, SortOrder, IsActive)
	VALUES('Highly Confidential - Attorney Eyes Only', 'ATTORNEY EYES', 4, 1)
INSERT INTO dbo.Confidentiality (Description, Name, SortOrder, IsActive)
	VALUES('Highly Confidential - Outside Counsel Eyes Only', 'COUNSEL EYES', 5, 1)
INSERT INTO dbo.Confidentiality (Description, Name, SortOrder, IsActive)
	VALUES('Other', 'OTHER', 6, 1)

INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Appeal', 'APPEAL', 1, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Audio Transcription', 'AUDIO', 2, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Deposition-Normal', 'NORMAL', 3, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Deposition - Complex Litigation', 'COMPLEX', 4, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Deposition - Construction Defect', 'DEFECT', 5, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Deposition - Construction Defect - PMK', 'DEFECT PMK', 6, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Deposition - Medical Expert', 'MEDICAL', 7, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Deposition - Technical Expert', 'TECHNICAL', 8, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Examination Under Oath', 'OATH', 9, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Forfeiture', 'FORFEITURE', 10, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Hearing - Normal', 'HEARING', 11, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Investigation', 'INVESTIGATION', 12, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Meeting', 'MEETING', 13, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Certificate of Non-appearance (No Show)', 'NOW SHOW CNA', 14, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Records Pickup', 'PICKUP', 15, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Statement on Record (No Show)', 'NO SHOW STATEMENT', 16, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Sworn Statement', 'SWORN', 17, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Trial', 'TRIAL', 18, 1)
INSERT INTO dbo.TranscriptType (Description, Name, SortOrder, IsActive)
	VALUES('Trial - Grand Jury', 'GRAND', 19, 1)

INSERT INTO dbo.AppearanceType (Description, Name, SortOrder, IsActive)
	VALUES('Regular Appearance Fee', 'REGULAR', 1, 1)
INSERT INTO dbo.AppearanceType (Description, Name, SortOrder, IsActive)
	VALUES('After Hours Appearance Fee', 'AFTERHOURS', 2, 1)
INSERT INTO dbo.AppearanceType (Description, Name, SortOrder, IsActive)
	VALUES('Weekend Appearance Fee', 'WEEKEND', 3, 1)
INSERT INTO dbo.AppearanceType (Description, Name, SortOrder, IsActive)
	VALUES('No Appearance Fee', 'NONE', 4, 1)

INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Federal', 'FEDERAL', 1, 1, NULL)
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('None', 'NONE', 2, 1, NULL)
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Alabama', 'AL', 3, 1, 'AL')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Alaska', 'AK', 3, 1, 'AK')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Arizona', 'AZ', 3, 1, 'AZ')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('California', 'CA', 3, 1, 'CA')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Colorado', 'CO', 3, 1, 'CO')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Connecticut', 'CT', 3, 1, 'CT')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Delaware', 'DE', 3, 1, 'DE')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Florida', 'FL', 3, 1, 'FL')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Georgia', 'GA', 4, 1, 'GA')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Hawaii', 'HI', 3, 1, 'HI')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Idaho', 'ID', 3, 1, 'ID')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Illinois', 'IL', 5, 1, 'IL')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Indiana', 'IN', 3, 1, 'IN')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Iowa', 'IA', 3, 1, 'IA')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Kansas', 'KS', 3, 1, 'KS')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Kentucky', 'KY', 3, 1, 'KY')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Louisiana', 'LA', 3, 1, 'LA')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Maine', 'ME', 3, 1, 'ME')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Maryland', 'MD', 3, 1, 'MD')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Massachusetts', 'MA', 3, 1, 'MA')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Michigan', 'MI', 6, 1, 'MI')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Minnesota', 'MN', 3, 1, 'MN')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Mississippi', 'MS', 3, 1, 'MS')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Missouri', 'MO', 3, 1, 'MO')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Montana', 'MT', 3, 1, 'MT')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Nebraska', 'NE', 3, 1, 'NE')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Nevada', 'NV', 3, 1, 'NV')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('New Hampshire', 'NH', 3, 1, 'NH')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('New Jersey', 'NJ', 3, 1, 'NJ')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('New Mexico', 'NM', 3, 1, 'NM')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('New York', 'NY', 3, 1, 'NY')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('North Carolina', 'NC', 3, 1, 'NC')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('North Dakota', 'ND', 3, 1, 'ND')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Ohio', 'OH', 3, 1, 'OH')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Oklahoma', 'OK', 3, 1, 'OK')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Oregon', 'OR', 3, 1, 'OR')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Pennsylvania', 'PA', 3, 1, 'PA')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Rhode Island', 'RI', 3, 1, 'RI')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('South Carolina', 'SC', 3, 1, 'SC')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('South Dakota', 'SD', 3, 1, 'SD')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Tennessee', 'TN', 3, 1, 'TN')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Texas', 'TX', 3, 1, 'TX')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Utah', 'UT', 3, 1, 'UT')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Vermont', 'VT', 3, 1, 'VT')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Virginia', 'VA', 3, 1, 'VA')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Washington', 'WA', 3, 1, 'WA')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('West Virginia', 'WV', 3, 1, 'WV')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Wisconsin', 'WI', 3, 1, 'WI')
INSERT INTO dbo.Jurisdiction (Description, Name, SortOrder, IsActive, StateCode)
	VALUES('Wyoming', 'WY', 3, 1, 'WY')

INSERT INTO dbo.ReporterCost (Description, Name, SortOrder, IsActive)
	VALUES('Parking', 'PARKING', 1, 1)
INSERT INTO dbo.ReporterCost (Description, Name, SortOrder, IsActive)
	VALUES('Food Costs', 'FOOD', 2, 1)
INSERT INTO dbo.ReporterCost (Description, Name, SortOrder, IsActive)
	VALUES('Taxi', 'TAXI', 3, 1)
INSERT INTO dbo.ReporterCost (Description, Name, SortOrder, IsActive)
	VALUES('Airfare', 'AIRFARE', 4, 1)
INSERT INTO dbo.ReporterCost (Description, Name, SortOrder, IsActive)
	VALUES('Hotel', 'HOTEL', 5, 1)

INSERT INTO dbo.ReporterTimeAndDistance (Description, Name, SortOrder, IsActive)
	VALUES('Wait Time', 'WAIT TIME', 1, 1)
INSERT INTO dbo.ReporterTimeAndDistance (Description, Name, SortOrder, IsActive)
	VALUES('Exhibit Marking / Copying Time', 'MARKING TIME', 2, 1)
INSERT INTO dbo.ReporterTimeAndDistance (Description, Name, SortOrder, IsActive)
	VALUES('Break / Lunch times', 'BREAK TIME', 3, 1)
INSERT INTO dbo.ReporterTimeAndDistance (Description, Name, SortOrder, IsActive)
	VALUES('Round Trip Travel Time', 'TRAVEL TIME', 4, 1)
INSERT INTO dbo.ReporterTimeAndDistance (Description, Name, SortOrder, IsActive)
	VALUES('Round Trip Mileage', 'TRAVEL MILEAGE', 5, 1)

INSERT INTO dbo.BypassProductionReason (Description, Name, SortOrder, IsActive)
	VALUES('Appearance Fee Only', 'APPEARANCE FEE ONLY', 1, 1)
INSERT INTO dbo.BypassProductionReason (Description, Name, SortOrder, IsActive)
	VALUES('Bill for Takedown/Hold Notes', 'BILL TAKEDOWN/HOLD NOTES', 2, 1)
INSERT INTO dbo.BypassProductionReason (Description, Name, SortOrder, IsActive)
	VALUES('Late Cancellation/No Show', 'LATE CANCELLATION/NO SHOW', 3, 1)
INSERT INTO dbo.BypassProductionReason (Description, Name, SortOrder, IsActive)
	VALUES('CART (Closed Captioning)', 'CART CLOSED CAPTIONING', 4, 1)
INSERT INTO dbo.BypassProductionReason (Description, Name, SortOrder, IsActive)
	VALUES('Production Already Completed', 'PRODUCTION ALREADY COMPLETED', 5, 1)

INSERT INTO dbo.SignatureProtocol (ShortTitle, LongTitle, Description, SortOrder, IsActive)
	VALUES('Standard Read & Sign Procedure', 'Standard Read & Sign procedure per Federal Rules of Civil Procedure and analogous state rules Hold Original Send Mini to Witness', 'Hold Original transcript in our main Atlanta office. Send Mini, Errata, and Instruction letter to either the witness, or the attorney representing the witness. The witness has a certain number of days', 1, 1)
INSERT INTO dbo.SignatureProtocol (ShortTitle, LongTitle, Description, SortOrder, IsActive)
	VALUES('No Copy / Come-In', 'No Copy / Come-In - Read & Sign procedure per Federal Rules of Civil Procedure<br />Hold Original, Send Come-In Letter to Witness', 'Hold Original in the staffed Esquire location located closest to the witness. Since counsel for witness did not order a copy, send Come-In instruction letter to either the witness, or the attorney rep', 2, 1)
INSERT INTO dbo.SignatureProtocol (ShortTitle, LongTitle, Description, SortOrder, IsActive)
	VALUES('Release Original for Signature', 'Release Original for Signature - No Return Requested', 'Send unsealed Original directly to attorney representing the witness along with instruction letter. The attorney will allow the witness to read & sign on the Original transcript within a certain numbe', 3, 1)
INSERT INTO dbo.SignatureProtocol (ShortTitle, LongTitle, Description, SortOrder, IsActive)
	VALUES('Release Original to Custodial Attorney (unsealed)', 'Release Original to Custodial Attorney (Send Mini to Witness)', 'Send unsealed Original and instruction letter to either the witness, or the attorney representing the witness. The witness will make changes if necessary. Recipient is responsible for distributing cop', 4, 1)
INSERT INTO dbo.SignatureProtocol (ShortTitle, LongTitle, Description, SortOrder, IsActive)
	VALUES('Release Original to Custodial Attorney', 'Release Original to Custodial Attorney (Send Mini to Witness)', 'Send Original transcript to custodial/taking attorney right away. Send Mini, Errata, and Instruction letter to either the witness, or the attorney representing the witness. Within a certain number of', 5, 1)
INSERT INTO dbo.SignatureProtocol (ShortTitle, LongTitle, Description, SortOrder, IsActive)
	VALUES('Original Transcript Immediately Sent', 'Original Transcript Immediately Sent to taking / custodial attorney', 'It may or may not be sealed, depending on the requirements of the court.',6, 1)
INSERT INTO dbo.SignatureProtocol (ShortTitle, LongTitle, Description, SortOrder, IsActive)
	VALUES('Custom Read & Sign Procedure', 'Custom Read & Sign Procedure', 'Please describe in detail the procedure the Production team should follow regarding witness signature in the Notes sections on the Finalize Tab.', 7, 1)
INSERT INTO dbo.SignatureProtocol (ShortTitle, LongTitle, Description, SortOrder, IsActive)
	VALUES('Waived / Not Discussed / N/A', 'Waived / Not Discussed / N/A', 'Read and sign waived by client, not discussed or not applicable to this case/order.', 8, 1)

INSERT INTO dbo.ExhibitInstruction (Description, Name, SortOrder, IsActive)
	VALUES('Attached to Original', 'ORIGINAL TRANSCRIPT', 1, 1)
INSERT INTO dbo.ExhibitInstruction (Description, Name, SortOrder, IsActive)
	VALUES('Bind Separately', 'BIND SEPARATELY', 2, 1)
INSERT INTO dbo.ExhibitInstruction (Description, Name, SortOrder, IsActive)
	VALUES('Must Return to Witness (Address in Notes Tab)', 'RETURN TO WITNESS', 3, 1)
INSERT INTO dbo.ExhibitInstruction (Description, Name, SortOrder, IsActive)
	VALUES('Retained by Counsel', 'RETAINED BY COUNSEL', 4, 1)
INSERT INTO dbo.ExhibitInstruction (Description, Name, SortOrder, IsActive)
	VALUES('Retained by Witness', 'RETAINED BY WITNESS', 5, 1)
INSERT INTO dbo.ExhibitInstruction (Description, Name, SortOrder, IsActive)
	VALUES('Not Applicable', 'NOT APPLICABLE', 6, 1)
INSERT INTO dbo.ExhibitInstruction (Description, Name, SortOrder, IsActive)
	VALUES('Other (Describe in Notes)', 'OTHER', 7, 1)

INSERT INTO dbo.ExhibitTurnIn (Description, Name, SortOrder, IsActive)
	VALUES('Shipped to Atlanta Production, FedEx', 'FEDEX', 1, 1)

INSERT INTO dbo.Deliverable (Description, Name, SortOrder, IsActive)
	VALUES('Full Size Transcript', 'FULL', 1, 1)
INSERT INTO dbo.Deliverable (Description, Name, SortOrder, IsActive)
	VALUES('Condensed Transcript', 'CONDENSED', 2, 1)
INSERT INTO dbo.Deliverable (Description, Name, SortOrder, IsActive)
	VALUES('Word Index', 'INDEX', 3, 1)
INSERT INTO dbo.Deliverable (Description, Name, SortOrder, IsActive)
	VALUES('Exhibit Copies', 'EXHIBITS', 4, 1)
INSERT INTO dbo.Deliverable (Description, Name, SortOrder, IsActive)
	VALUES('Linked Transcript', 'LINKED', 5, 1)
INSERT INTO dbo.Deliverable (Description, Name, SortOrder, IsActive)
	VALUES('LEF', 'LEF', 6, 1)
INSERT INTO dbo.Deliverable (Description, Name, SortOrder, IsActive)
	VALUES('SBF', 'SBF', 7, 1)
INSERT INTO dbo.Deliverable (Description, Name, SortOrder, IsActive)
	VALUES('XMEF', 'XMEF', 8, 1)
INSERT INTO dbo.Deliverable (Description, Name, SortOrder, IsActive)
	VALUES('PTX', 'PTX', 9, 1)
INSERT INTO dbo.Deliverable (Description, Name, SortOrder, IsActive)
	VALUES('ASCII', 'ASCII', 10, 1)
INSERT INTO dbo.Deliverable (Description, Name, SortOrder, IsActive)
	VALUES('Deposition Summary', 'SUMMARY', 11, 1)

INSERT INTO dbo.DeliveryMedium (Description, Name, SortOrder, IsActive)
	VALUES('Disk', 'DISK', 1, 1)
INSERT INTO dbo.DeliveryMedium (Description, Name, SortOrder, IsActive)
	VALUES('Email', 'EMAIL', 2, 1)
INSERT INTO dbo.DeliveryMedium (Description, Name, SortOrder, IsActive)
	VALUES('Online Repository', 'REPOSITORY', 3, 1)
INSERT INTO dbo.DeliveryMedium (Description, Name, SortOrder, IsActive)
	VALUES('Hard Copy', 'HARD COPY', 4, 1)

INSERT INTO dbo.DeliverableOption (Description, Name, SortOrder, IsActive)
	VALUES('Double Sided', 'DOUBLE', 1, 1)
INSERT INTO dbo.DeliverableOption (Description, Name, SortOrder, IsActive)
	VALUES('Single Sided', 'SINGLE', 2, 1)
INSERT INTO dbo.DeliverableOption (Description, Name, SortOrder, IsActive)
	VALUES('Color', 'COLOR', 3, 1)
INSERT INTO dbo.DeliverableOption (Description, Name, SortOrder, IsActive)
	VALUES('TIFF', 'TIFF', 4, 1)
INSERT INTO dbo.DeliverableOption (Description, Name, SortOrder, IsActive)
	VALUES('PDF', 'PDF', 5, 1)
