<?php
/**
 *
 * @author jason.vanhoy @ Feb 25, 2013 8:44:41 AM
 */
class Services_Deliverable extends Services_Base {
	
	
	public function getListOfBaseDeliveryMethods($token) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
				
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->from('Models_Solaria_DeliveryMedium dm');
				$query->orderBy('SortOrder');
				
				$resultSet = $query->execute();
				
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
	
	
	
	
	public function getListOfBaseDeliverables($token) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				
				$query = Doctrine_Query::create($conn);
				$query->from('Models_Solaria_Deliverable d');
				$query->orderBy('SortOrder');
				
				$resultSet = $query->execute();
				
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
	
	
	
	
	
	public function getListOfBaseDeliverableOptions($token) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
				
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->from('Models_Solaria_DeliverableOption do');
				$query->orderBy('SortOrder');
			
				$resultSet = $query->execute();
			
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
	
	
	
	
	
	public function getDeliverableOptionsForOrderDeponentDeliverable($token, $orderDeponenetDeliverableId) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);

			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
			} else {
				$query = Doctrine_Query::create($conn);
				$query->from('Models_Solaria_DeliverableOption do');
				$query->leftJoin('do.OrderDeponentDeliverableOption bridge');
				$query->where('bridge.OrderDeponentDeliverableID = ' . $orderDeponenetDeliverableId);
				$query->orderBy('SortOrder');
					
				$resultSet = $query->execute();
					
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
	
	
	
	
	public function getDeliveryMethodsForOrderDeponentDeliverable($token, $orderDeponentDeliverableId) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
				
		
				if(empty($conn)) {
					$this->serviceResult->data = null;
					$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
					$this->serviceResult->returnCode = Esquire_Service_Result::RECORD_NOT_FOUND;
				} else {
					$query = Doctrine_Query::create($conn);
					$query->from('Models_Solaria_DeliveryMedium dm');
					$query->leftJoin('dm.OrderDeponentDeliverable bridge');
					$query->where('bridge.OrderDeponentDeliverableID = ' . $orderDeponenetDeliverableId);
					$query->orderBy('SortOrder');
			
					$resultSet = $query->execute();
			
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
	
	
	
	
	
	
	public function getOrderDeponentDeliverable($token, $orderId, $deponentId = NULL) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
				
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::GENERAL_ERROR;
			} else {
			
				if(!empty($deponentId) && $deponentId > 0) {
					$dql = 'SELECT odd.*,  FROM Models_Solaria_OrderDeponentDeliverable odd 
								INNER JOIN odd.DeliveryMedium dm 
								INNER JOIN odd.Deliverable d 
								LEFT JOIN odd.OrderDeponentDeliverableOption bridge
								LEFT JOIN bridge.DeliverableOption
							WHERE OrderID = ' . $orderId . ' AND DeponentID = ' . $deponentId;
				} else {
					$dql = 'SELECT odd.*,  FROM Models_Solaria_OrderDeponentDeliverable odd 
								INNER JOIN odd.DeliveryMedium dm 
								INNER JOIN odd.Deliverable d 
								LEFT JOIN odd.OrderDeponentDeliverableOption bridge
								LEFT JOIN bridge.DeliverableOption
							WHERE OrderID = ' . $orderId;
				}
			
				$resultSet = $conn->query($dql);
			
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
	
	
	
	
	
	
	public function saveOrderDeponentDeliverable($token, Models_Solaria_OrderDeponentDeliverable $orderDeponentDeliverable) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
				
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::GENERAL_ERROR;
			} else {
				$orderDeponentDeliverable->save($conn);

				// Refresh the record to stick it into the service result object.  I'm not 
				// positive the connection stuff is necessary.  It was pulled from the Job 
				// service and seems to work fine.
				$manager = Doctrine_Manager::getInstance();
				$manager->setCurrentConnection($manager->getConnectionName($conn));
				Doctrine_Core::getTable('Models_Solaria_OrderDeponentDeliverable')->setConnection($conn);
				$orderDeponentDeliverable->refresh(true);
				
				$this->serviceResult->returnCode = Esquire_Service_Result::SUCCESS;
				$this->serviceResult->faultString = NULL;
				$this->serviceResult->data = $orderDeponentDeliverable;
			}	
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}
	
	
	
	
	public function deleteOrderDeponentDeliverable($token, $orderDeponentDeliverableId) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
		
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::GENERAL_ERROR;
			} else {
				/*
				 * So yeah, so, this code here doesn't work. The code below it does. 
				 * Makes a shitload of sense, huh?
				 */
// 				$success = FALSE;
// 				$orderDeponentDeliverable = new Models_Solaria_OrderDeponentDeliverable();
// 				$orderDeponentDeliverable->OrderDeponentDeliverableID = $orderDeponentDeliverableId;
// 				$orderDeponentDeliverable->refresh();
// 				$success = $orderDeponentDeliverable->delete($conn);
				
				
				$query = Doctrine_Query::create()->delete('Models_Solaria_OrderDeponentDeliverable odd');
				$query->where('odd.OrderDeponentDeliverableID = ' . $orderDeponentDeliverableId);
				$query->execute();
				
				$this->serviceResult->returnCode = Esquire_Service_Result::SUCCESS;
				$this->serviceResult->faultString = NULL;
				$this->serviceResult->data = NULL;
			}
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}
	
	
	public function deleteOrderDeponentDeliverableOption($token, $orderDeponentDeliverableOptionId) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);
			
			if(empty($conn)) {
				$this->serviceResult->data = null;
				$this->serviceResult->faultString = 'No company found for id ' . $this->companyId;
				$this->serviceResult->returnCode = Esquire_Service_Result::GENERAL_ERROR;
			} else {
				$query = Doctrine_Query::create()->delete('Models_Solaria_OrderDeponentDeliverableOption oddo');
				$query->where('oddo.OrderDeponentDeliverableOptionID = ' . $orderDeponentDeliverableOptionId);
				$query->execute();
				
				$this->serviceResult->returnCode = Esquire_Service_Result::SUCCESS;
				$this->serviceResult->faultString = NULL;
				$this->serviceResult->data = NULL;
			}
		} else {
			$this->serviceResult = $this->sayBadSecurity();
		}
		
		return $this->serviceResult;
	}
	
	
	
	
	
	
	public function fromArray($token, array $orderDeponentDeliverableData) {
		if($this->security->hasActiveSession($token, $this->serviceName)) {
			$conn = $this->getCompanyDataConnection($this->companyId);

			$connection = $this->getCompanyDataConnection($this->companyId);
			$manager = Doctrine_Manager::getInstance();
			$manager->setCurrentConnection($manager->getConnectionName($connection));
			Doctrine_Core::getTable('Models_Solaria_OrderDeponentDeliverable')->setConnection($connection);
			$orderDeponentDeliverable = new Models_Solaria_OrderDeponentDeliverable();
			$orderDeponentDeliverable->fromArray($orderDeponentDeliverableData, true);
			return $orderDeponentDeliverable;
				
		} else {
			$this->logger->log('Deliverable service has registered a call to ' . __METHOD__ . ' with improper security.', Zend_log::ERR);
			return NULL;
		}
	}
	
	
}
