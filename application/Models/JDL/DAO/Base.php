<?php
/**
 *
 * @author jason.vanhoy @ Apr 2, 2013 11:35:25 AM
 */
abstract class Models_JDL_DAO_Base {
	
	
	
	protected $table;
	protected $uniqueIdentifier;
	protected $relationships;
	
	
	public function getTable() {
		return $this->table;
	}
	
	public function getRelationships() {
		return $this->relationships;
	}
	
	public function getUniqueIdentifier() {
		return $this->uniqueIdentifier;
	}
	
	
	/**
	 * Fills THIS typed object from an array of data based on matching params/array keys.
	 * @param array $data
	 */
	public function fillFromArray(array $data) {
		$peepingTom = new ReflectionClass(new $this);
		$paramList = $peepingTom->getProperties();
		

		foreach($data as $param => $value) {
			if($peepingTom->hasProperty($param)) {
				$this->$param = $value;
			}
		}
		
		
		if(!empty($this->relationships)) {
			foreach($this->relationships as $relationship) {
				$relationship instanceof Esquire_JDL_Relationship;
				$relatedObject = new $relationship->object;
				$relatedObject instanceof Models_JDL_DAO_Base;
				$relatedObject->fillFromArray($data);
				$parentParam = $relationship->parameter;
				$this->$parentParam = $relatedObject;
			}
		}
		
	}
	
	
	
	/**
	 * Returns the list of database columns associated with this class as a comma-delimited string. 
	 * @return string
	 */
	public function getColumnList() {
		$columnArray = array();
		$columnList = NULL;
		
		$reflectionClass = new ReflectionClass($this);
		$propertyArray = $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC);
		
		foreach($propertyArray as $property) {
			$columnArray[] = $property->getName();
		}
		
		
		foreach($this->relationships as $relationship) {
			$relationship instanceof Esquire_JDL_Relationship;
			
			$targetSpot = array_search($relationship->parameter, $columnArray);
			if($targetSpot !== FALSE) {
				array_splice($columnArray, $targetSpot, 1);
			}
		}
		
		
		
		$columnList = implode(',', $columnArray);	
	
		return $columnList;
	}
	
}