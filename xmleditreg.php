<?php
include '../classes/class.audittrail.php';
include '../classes/class.presentation.php';
include '../classes/class.claimant.php';
require_once("../DBAL/dbclassopenperal.php");
	//session_start();
	$option = $_GET['opt'];
	//$task_option = $_GET['task_opt'];
	$presentationObj = new Presentation();
	$claimantObj = new Claimant();
	$databaseObj = Database::getInstance();
	$audittrialObj = new AuditTrail();
	switch($option) {
		case 1: 
			break;
		
		case 2: 
			break;
			
		case 3: 
			break;
			
			case 6: 
				$presentationObj->fillDisplay();
			break;
			
			case 7: 
				$claimantObj->fillDisplay();
			break;
			
			case 8: 
				
			break;
			
	}
	


?>
