<?php 
	require_once("../pearllogin_templatexml.php");
	require_once '../classes/class.accounts.php';
	require_once('../entryvalidate.php');
	
	//$poa=0;
	$option = $_GET['opt'];
	$accountsObj = new Accounts();

	$validationObj = new  PhpValidation();
	$ddVal = new dropDownValidation();

	switch($option) {
		case 1 :
			$accountsObj->setSlno(trim($_POST['slNo']));
			$accountsObj->setTtype(trim($_POST['tType']));
			
			$accountsObj->setVat(trim($_POST['vat']));
			$accountsObj->setTokenNo($_SESSION['tokenNo']);
			$accountsObj->setBookNo($_SESSION['bookNo']);
			$accountsObj->setUserlogin($_SESSION['userName']);
			$accountsObj->setStamp_duty(trim($_POST['sd']));
			$accountsObj->setSurcharge(trim($_POST['sc']));
			$accountsObj->setFees(trim($_POST['fee']));
			$accountsObj->setRemarks(trim($_POST['remarks']));

			$accountsObj->setDate(trim($_POST['date']));
			$accountsObj->setAmount(trim($_POST['amount']));
			$accountsObj->setAccountCode(trim($_POST['accountCode']));
			//$accountsObj->setReciptNo(trim($_POST['rno']));
				 

			$accountsObj->setUserName(trim($_SESSION['userName']));
			$ip = $accountsObj->getRealIpAddr();
				$accountsObj->setClientIp($ip);
			$accountsObj->setPageAccessed('accounts.php');
			$tst=date('Y-m-d h:i:s');
			$accountsObj->setPageAccessTime($tst);
			$accountsObj->setTask(1);
			//if(validateAcountForm($validationObj,$ddVal)) {
				$res = $accountsObj->insertData();
				if($res==true)
					echo 1;
				else 
					echo 2;
			//}
			break;
		case 2 :
			$accountsObj->setSlno(trim($_POST['slNo']));
			$accountsObj->setTtype(trim($_POST['tType']));
			$accountsObj->setVat(trim($_POST['vat']));
			$accountsObj->setTokenNo($_SESSION['tokenNo']);
			$accountsObj->setBookNo($_SESSION['bookNo']);
			$accountsObj->setUserlogin($_SESSION['userName']);
			$accountsObj->setStamp_duty(trim($_POST['sd']));
			$accountsObj->setSurcharge(trim($_POST['sc']));
			$accountsObj->setFees(trim($_POST['fee']));
			$accountsObj->setRemarks(trim($_POST['remarks']));

			$accountsObj->setDate(trim($_POST['date']));
			$accountsObj->setAmount(trim($_POST['amount']));
			$accountsObj->setAccountCode(trim($_POST['accountCode']));
			$accountsObj->setReciptNo(trim($_POST['rno']));
				 

			$accountsObj->setUserName(trim($_SESSION['userName']));
			$ip = $accountsObj->getRealIpAddr();
				$accountsObj->setClientIp($ip);
			$accountsObj->setPageAccessed('accounts.php');
			$tst=date('Y-m-d h:i:s');
			$accountsObj->setPageAccessTime($tst);
			$accountsObj->setTask(3);
			//if(validateAcountForm($validationObj,$ddVal)) {
				$res = $accountsObj->updateData();
				if($res==true)
					echo 'jes1';
				else 
					echo 'jes2';
			//}
			break;
		case 3:	
			$accountsObj->fillClaimantDropdown($_SESSION['tokenNo'],trim($_POST['clslno']));
			break;
		case 4:	
			$tCode=$_GET['tcod'];
			$accountsObj->fillAccountType(1,0,0,'accountCode',$tCode);
			break;
		case 5: 
			$tCode=$_GET['tcod'];
			$amount=$_GET['amoun'];
			$tVat=$_GET['vat'];
			$accountsObj->fillStampDuty(1,0,'sd',$tCode,$amount,$tVat); //$operation,$presentValue,$controlName,$trnsCode,$amount,$vatAmount
			break;
		case 6: 
			$tCode=$_GET['tcod'];
			$amount=$_GET['amoun'];
			$accountsObj->fillRegFee(1,0,'fee',$tCode,$amount); //$operation,$presentValue,$controlName,$trnsCode,$amount
			break;
		
		case 7 :
			
			$stampBorne = trim($_POST['stamp_borne']);
			
			$accountsObj->setUserName(trim($_SESSION['userName']));
			$ip = $accountsObj->getRealIpAddr();
				$accountsObj->setClientIp($ip);
			$accountsObj->setPageAccessed('accounts.php');
			$tst=date('Y-m-d h:i:s');
			$accountsObj->setPageAccessTime($tst);
			$accountsObj->setTask(1);
			//if(validateAcountForm($validationObj,$ddVal)) {
				$res = $accountsObj->acceptRegn($stampBorne);
				if($res==true)
					echo 1;
				else 
					echo 2;
			//}
			break;
		
		case 8: 
			$tCode=$_GET['tcod'];
			$amount=$_GET['amoun'];
			$sd=$_GET['stampduty'];
			$vat=$_GET['vat'];
			//$accountsObj->fillVat(1,$vat,'vat',$tCode,$amount,$sd,'fillStampDutyafterVat(this.form)'); //$operation,$presentValue,$controlName,$trnsCode,$amount,$stamp,$postBack
			$accountsObj->fillVat(1,$vat,'vat',$tCode,$amount,$sd,'fillStampDutyafterVat(this.form)'); //$operation,$presentValue,$controlName,$trnsCode,$amount,$stamp,$postBack
			break;
		
		case 11: 
				$tokNo = $_POST['hid_tokNo'];
				$delReason = $_POST['deleteReason'];
				$slNo = $_POST['slno'];
				$formDetails = "Account with serial No".$slNo; 
				
				/*Auidit Trial */
				$accountsObj->setUserName(trim($_SESSION['userName']));
				$ip = $accountsObj->getRealIpAddr();
					$accountsObj->setClientIp($ip);
				$accountsObj->setPageAccessed('accounts.php');
				$accountsObj->setPageAccessTime(date('Y-m-d h:i:s'));
				$accountsObj->setTask(2);
				$res = $accountsObj->deletionDetailsSave($delReason,$formDetails,'account',$slNo,'slno','docno','rowid');
				
				if($res==true)
					echo 1;
				else if($res==false)
					echo 2;
				else
					echo $res;
			
				break;
	}

?>