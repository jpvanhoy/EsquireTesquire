<?php
/**
 *
 * @author jason.vanhoy @ Apr 12, 2013 2:15:32 PM
 */
abstract class Models_JDL_VO_Base {
	
		
	
	public function toArray() {
		$outputArray = array();
		foreach($this as $key => $value) {
			$outputArray[$key] = $value;
		}
		
		return $outputArray;
	}
	
}