<?php
/*
 * Service to manage Jobs.
 * Really? Ya reckon a file named "Job" in a folder named "Services" would be a service to manage jobs? Shocking.
 * @author jason.vanhoy @ Jul 25, 2012 12:21:10 PM
 *
 */
class Services_Job extends Services_Base
{
	/**
	 * Get a list of jobs, alternatively from between a pair of dates, alternatively up to a certain number.
	 * 
	 * @param unknown_type $token Security token provided in first Service interaction. Required for all subsequent interactions.
	 * @param Date $fromDate [optional] the beginning date for the range. Will be used to filter by the JobDate parameter. 
	 * @param Date $toDate [optional] the ending date for the range. Will be used to filter by the JobDate parameter.
	 * @param integer $maxResults [optional] If provided, only this many results will be returned. 
	 * @return Esquire_Service_Result
	 */
	public function getJobList($token, $fromDate = NULL, $toDate = NULL, $maxResults = 1000000) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			if(empty($fromDate)) {
				$fromDate = JASON_EPOCH;
			}

			if(empty($toDate)) {
				$toDate = date('Y-m-d');
			}

			$conn = $this->getCompanyDataConnection($this->companyId);

			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->select('j.*');
				$query->from('Models_Solaria_Job j');
				$query->where('JobDate BETWEEN \'' . $fromDate . '\' AND \'' . $toDate . '\'');
				$query->limit($maxResults);
				$resultSet = $query->execute();

				$this->_appendId($resultSet);

				if(sizeof($resultSet) == 0) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No results found';
					$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
				} else {
					$this->serviceResult = new Esquire_Service_Result(Esquire_Service_Result::SUCCESS);
					$this->serviceResult->data = $resultSet;
				}
			}

		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}
	
	/**
	 * Retrieve Job data based on a provided id.
	 * 
	 * @param string $token Security token provided in first Service interaction. Required for all subsequent interactions.
	 * @param integer $jobId The job ID (primary key) of the job you wish to retrieve.
	 * @param array $desiredColumns [optional] To retrieve only some columns, provide the column names as an array.
	 * @param boolean $expand [optional] To retrieve all relations for a Job, set to true.
	 * @return Esquire_Service_Result
	 */
	public function getJobById($token, $jobId, $expand = FALSE) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			if(empty($this->companyId)) { $this->companyId = 401; }
			$this->serviceResult = new Esquire_Service_Result(Esquire_Service_Result::SUCCESS);
			$conn = $this->getCompanyDataConnection($this->companyId);
			$transcripts = NULL;

			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->from('Models_Solaria_Job j');
				$query->where('JobID = ?', $jobId);

				if($expand) {
					$this->_expandQuery($query);
					$transcriptService = new Services_Transcript();
					$newToken = $this->security->getSecurityToken($transcriptService->getName(), 'indexAction');
					$transcriptService->companyId = $this->companyId;
					$result = $transcriptService->getTranscriptList($newToken, $jobId);
					$transcripts = $result->data;
				}

				$jobList = $query->execute();

				$this->_appendId($jobList);

				if($jobList->count() == 0) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No results found';
					$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
				} else {
					$job = $jobList->getFirst();
					
					if(!empty($transcripts)) {
						$job->JobDeponent = $transcripts;
					}
					
					$this->serviceResult->data = $job;
				}

			}

		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}

	/**
	 * Retrieve job data based on provided Job Number. 
	 * 
	 * @param string $token Security token provided in first Service interaction. Required for all subsequent interactions.
	 * @param integer $jobNumber The Job Number parameter of the job to retrieve.
	 * @param array $desiredColumns [optional] To retrieve only some columns, provide the column names as an array.
	 * @param boolean $expand [optional] To retrieve all relations for a Job, set to true.
	 * @return Esquire_Service_Result
	 */
	public function getJobByJobNumber($token, $jobNumber, $expand = FALSE) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$this->serviceResult = new Esquire_Service_Result(Esquire_Service_Result::SUCCESS);
			$transcripts = NULL;

			$conn = $this->getCompanyDataConnection($this->companyId);

			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->select('j.*');
				$query->from('Models_Solaria_Job j');
				$query->where('JobNumber = ?', array($jobNumber));
				$query->andWhere('CompanyId = ?', $this->companyId);
				
				if($expand) {
					$this->_expandQuery($query);
					$transcriptService = new Services_Transcript();
					$newToken = $this->security->getSecurityToken($transcriptService->getName(), 'indexAction');
					$transcriptService->companyId = $this->companyId;
					$result = $transcriptService->getTranscriptList($newToken, $jobId);
					$transcripts = $result->data;
				}
				
				
				$jobList = $query->execute();

				$this->_appendId($jobList);

				if($jobList->count() == 0) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No results found';
					$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
				} elseif($jobList->count() > 1) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'More than 1 result found for expected single-row query??';
					$this->serviceResult->returnCode = Esquire_Service_Result::DATABASE_ERROR;
				} else {
					$job = $jobList->getFirst();
					
					if(!empty($transcripts)) {
						$job->JobDeponent = $transcripts;
					}

					$this->serviceResult->data = $job;
				}

			}

		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}

    /**
     * Retrieve a single job, and, optionally, related entities, given a "super id".  The super id is the "id" value returned by most service calls and represents a unique value for the record across all Solaria databases. The super id is (currently) a concatenation of two database columns.
     *
     * @param string $token Security token provided in first Service interaction. Required for all subsequent interactions.
     * @param string $id The "super Id" for the job requested.
     * @param array $desiredColumns [optional] An array of column names to include in the result. If this array is non-empty, only the requested columns will be provided. Otherwise, all scalar values will be filled.
     * @param boolean $expand [optional] Whether or not to load references for the Job object.
     * @return Esquire_Service_Result
     */
    public function getJobBySuperId($token, $id, $expand = FALSE) {
    	if($this->security->hasActiveSession($token, $this->serviceName)) {
    		$jobListRequest = new Esquire_Service_JobListRequest();
			$this->companyId = $jobListRequest->getSolariaCompanyIdFromSuperId($id);
			$jobId = $jobListRequest->getSolariaJobIdFromSuperId($id);
			$this->serviceResult = $this->getJobById($token, $jobId, $expand);
		
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}

	/**
	 * Given a Models_Solaria_Job, persist that job and return it (with any updated fields).
	 * 
	 * @param string $token Security token provided in first Service interaction. Required for all subsequent interactions.
	 * @param Models_Solaria_Job $job
	 * @return Esquire_Service_Result
	 */
	public function storeJob($token, Models_Solaria_Job $job) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$this->serviceResult = new Esquire_Service_Result(Esquire_Service_Result::GENERAL_ERROR);
	
			$connection = $this->getCompanyDataConnection($job->CompanyID);
			try {
				if(!empty($job->JobDeponent) && $job->JobDeponent->count() > 0) {
					foreach ($job->JobDeponent as $currentDeponentTranscriptPersonThingy) {
						$currentDeponentTranscriptPersonThingy instanceof Models_Solaria_JobDeponent;
						
						if(!empty($currentDeponentTranscriptPersonThingy->DeponentID) && $currentDeponentTranscriptPersonThingy->Deponent->isModified()) {
							$query = Doctrine_Query::create($connection);
							$query->from('Models_Solaria_JobDeponent jd');
							$query->leftJoin('jd.Deponent d');
							$query->leftJoin('d.Person p');
							$query->where('DeponentID = ' . $currentDeponentTranscriptPersonThingy->DeponentID);
							$query->andWhere('JobID <> ' . $job->JobID);
							
							$results = $query->execute();
							
							if($results->count() > 0) {
								$newPerson = $currentDeponentTranscriptPersonThingy->Deponent->Person->copy();
								$newDeponent = $currentDeponentTranscriptPersonThingy->Deponent->copy();
								$newDeponent->Person = $newPerson;
								$currentDeponentTranscriptPersonThingy->Deponent = $newDeponent;
							}
						}
					}
				}
	
				$job->save($connection);
				// MAYBE: ask Andrew why in the hell this is like this?
				// UPDATE: I think I know now...
				$manager = Doctrine_Manager::getInstance();
				$manager->setCurrentConnection($manager->getConnectionName($connection));
				Doctrine_Core::getTable('Models_Solaria_Job')->setConnection($connection);
				$job->refresh(true);
				
				$this->serviceResult->returnCode = Esquire_Service_Result::SUCCESS;
				$this->serviceResult->data = $job;
			} catch(Exception $e) {
				$this->serviceResult->returnCode = Esquire_Service_Result::DATABASE_ERROR;
				$this->serviceResult->faultString = $e->getMessage();
				$this->serviceResult->data = NULL;
			}
			
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}
	
	/**
	 * Generate a Models_Solaria_Job object from a provided array.
	 *
	 * @param string $token Security token provided in first Service interaction. Required for all subsequent interactions.
	 * @param array $jobData - array of name => value pairs containing at least 'id', 'JobID', and 'CompanyID'
	 * @return Models_Solaria_Job
	 * @todo - This whole thing is only necessary to get around connection problems with Doctrine (and our environment)
	 * @throws Exception
	 */
	public function fromArray($token, array $jobData) {
		if(!array_key_exists('id', $jobData)) {
			throw new Exception(__METHOD__ . ': Key "id" required but not found in input.');
		}
		
		$result = $this->getJobBySuperId($token, $jobData['id'], true);
		$job = $result->data;

		if (!$job instanceof Models_Solaria_Job) {
			$job = new Models_Solaria_Job();
			$job->CompanyID = $jobData['CompanyID'];
		}

		$connection = $this->getCompanyDataConnection($job->CompanyID);

		$manager = Doctrine_Manager::getInstance();
		$manager->setCurrentConnection($manager->getConnectionName($connection));
		Doctrine_Core::getTable('Models_Solaria_Job')->setConnection($connection);

		$job->fromArray($jobData, true);
		return $job;
	}

	/**
	 * Add id value to each given job.
	 *
	 * @param Doctrine_Collection - collection of Models_Solaria_Job
	 * @return void
	 */
	private function _appendId($jobs) {
		$jobListRequest = new Esquire_Service_JobListRequest();

		foreach ($jobs as $job) {
			$params = array();
			$job->id = $jobListRequest->getSuperIdForJob(NULL, NULL, $job);
		}
	}

    /**
     * Update given query with joins necessary to provide a "deeper" set of job data.
     *
     * @param Doctrine_Query $query
     * @return void
     */
	private function _expandQuery(Doctrine_Query $query) {
		/*
		 * The code below tries to do this generically but there are a 
		 * couple issues to address:
		 * 1)  Doctrine has circular reference issues with the Company object. 
		 *     Attempts (admittedly rushed) to remove relationships had no effect.
		 *     "Company" could be skipped, but that's pretty stupid, as is the 
		 *     issue itself.
		 * 2)  Some information is a few levels down because of linking tables.  
		 *     The new JobReporterCost => ReporterCost tables are an example.
		 *
		 * So for now this method will simply update the query by manually 
		 * specifying joins.
		 */

		/*
		$jobTableRelations = Doctrine_Core::getTable('Models_Solaria_Job')->getRelations();
		$joinList = array_keys($jobTableRelations);

		foreach($joinList as $join) {
			$query->leftJoin('j.' . $join);
		}
		 */

		/*
		 * FIXME - this should probably be considered temporary
		 */
		$query->leftJoin('j.JobReporterCost jrc');
		$query->leftJoin('jrc.ReporterCost rc');
		$query->leftJoin('j.JobReporterTimeAndDistance jrtd');
		$query->leftJoin('jrtd.ReporterTimeAndDistance rtd');
		$query->leftJoin('j.ReporterWorksheetStatus rws');
		$query->leftJoin('j.BypassProductionReason bpr');
		$query->leftJoin('j.JobAppearanceType jat');
		$query->leftJoin('jat.AppearanceType at');
		$query->leftJoin('j.Cases c');
		$query->leftJoin('c.Jurisdiction ju');
		$query->leftJoin('j.JobPriorityType jpt');
		$query->leftJoin('j.JobLocation jl');
		$query->leftJoin('jl.Address a');
		$query->leftJoin('j.Client cl');
	}
}
