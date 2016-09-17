<?php

	require_once("../pearllogin_templatexml.php");
	require_once("../classes/class.token_sendrequest.php");
	$sendRequestObj = new token_sendRequest();
	switch(trim($_REQUEST['opt']))
{
    
        case 1:
	
	   $sendRequestObj->newRequestForm1();
		 break;
		 
	case 2:	
            $sendRequestObj->setFormDetails();
            $objPhpVal = new PhpValidation();
            $sendRequestObj->validateFormDetails($objPhpVal);
            $sendRequestObj->newsendrequest_igr();

        case 3:
       
	$request_id=trim($_REQUEST['req_id']);
        $sendRequestObj->rejectRequestForm($request_id);
         break;
		
        
            
		
    default :echo"invalid option";
        break;
}
?>
	