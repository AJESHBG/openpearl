<?php 
	require_once("../pearllogin_templatexml.php");
	require_once '../classes/class.enclosure.php';
	require_once('../entryvalidate.php');
	
	$option = $_GET['opt'];
	$enclosureObj = new Enclosure();
	$validationObj = new  PhpValidation();

	switch($option) {
		case 1 :
			//$slno=trim($_POST['pno']);
			$tokenNo=trim($_SESSION['tokenNo']);
			//$enclosure=trim($_POST['enclosure']);
			$bookNo=trim($_SESSION['bookNo']);
			$user_login=$_SESSION['userName'];
                        $nos=$_GET['nos'];
                        $numar=$_GET['numar'];
                        $arvalues[]=$_GET['arval'];
                        $str="";

			$enclosureObj->setTokenNo($tokenNo);
			$enclosureObj->setBookNo($bookNo);
			$enclosureObj->setUserlogin($user_login);

                        $enclosureObj->setNoofArray($numar);
                        $enclosureObj->setArray($arvalues[0]);
			
			$enclosureObj->setUserName($_SESSION['userName']);
			$ip = $enclosureObj->getRealIpAddr();
			$enclosureObj->setClientIp($ip);
			$enclosureObj->setPageAccessed('enclosure.php');
			$enclosureObj->setPageAccessTime(date('Y-m-d h:i:s'));
			$enclosureObj->setTask(1);
			
			if($enclosureObj->validateEnclosure($validationObj)) {
				$res = $enclosureObj->insertData();
				if($res==true)
					echo "1"; 
				else
					echo "2";
				
			}
			break;
		case 2 :
			
			$slno=trim($_POST['hid_slno']);
			$tokenNo=trim($_SESSION['tokenNo']);
			$enclosure=trim($_POST['enclosure']);
			$bookNo=trim($_SESSION['bookNo']);
			$user_login=$_SESSION['userName'];

			$enclosureObj->setSlno($slno);
			$enclosureObj->setTokenNo($tokenNo);
			$enclosureObj->setEnclosure($enclosure);
			$enclosureObj->setBookNo($bookNo);
			$enclosureObj->setUserlogin($user_login);
			
			
			$enclosureObj->setUserName($_SESSION['userName']);
			$ip = $enclosureObj->getRealIpAddr();
				$enclosureObj->setClientIp($ip);
			$enclosureObj->setPageAccessed('enclosure.php');
			$enclosureObj->setPageAccessTime(date('Y-m-d h:i:s'));
			$enclosureObj->setTask(3);

			if($enclosureObj->validateEnclosure($validationObj)) {
				$res = $enclosureObj->updateData();
				if($res==true)
					echo "1"; 
				else
					echo "2";
			}
			
			break;
		case 3: 
				$tokNo = $_POST['hid_tokNo'];
				$delReason = $_POST['deleteReason'];
				$slNo = $_POST['slno'];
				$formDetails = "Enclosure with serial No".$slNo; 
				
				/*Auidit Trial */
				$enclosureObj->setUserName($_SESSION['userName']);
				$ip = $enclosureObj->getRealIpAddr();
					$enclosureObj->setClientIp($ip);
				$enclosureObj->setPageAccessed('enclosure.php');
				$enclosureObj->setPageAccessTime(date('Y-m-d h:i:s'));
				$enclosureObj->setTask(2);
				$res = $enclosureObj->deletionDetailsSave($delReason,$formDetails,'enclosure',$slNo,'slno','docno','rowid');
				if($res==true)
					echo 1;
				else if($res==false)
					echo 2;
				else
					echo $res;
			
				break;
	}

?>