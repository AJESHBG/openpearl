<?php
require_once("../pearllogin_templatexml.php");
require_once("../common/PhpCommonFunctions.php");
require_once("../classes/class.acceptmemo.php");
require_once("../common/CommonReportFns.php");
require_once("../DBAL/dbconnect.php");
//require_once("../classes/class.memoprinting.php");
require_once("birt_config.php");

stripTags($_GET);
$objPhpVal = new PhpValidation();
$objAM = new acceptMemo();

//echo "OPTION :".$_GET['option']; 

switch(trim($_GET['option']))
{
    
    case 1:
        
            $aryEmptyValues = array();
            $aryEmptyValues['Sro'] = $_GET['sro'];
            $aryEmptyValues['Year'] = $_GET['year'];
            $aryEmptyValues['Book No'] = $_GET['bookno'];
            $aryEmptyValues['Doc No'] = $_GET['docno'];
            $aryEmptyValues['Send SRO'] = $_GET['send_sro'];
            
            if(!$objPhpVal->_isEmpty($aryEmptyValues)) exit(0);
            
            if(!$objPhpVal->_isYear($_GET['year'],"Year")) exit(0);
            if(!$objPhpVal->_isBookNumber($_GET['bookno'],"Book No")) exit(0);
            if(!$objPhpVal->_isAlphaNumeric($_GET['docno'],"Doc No")) exit(0);
            if(!$objPhpVal->_isInteger($_GET['sro'],"SRO Code",4)) exit(0);
            if(!$objPhpVal->_isInteger($_GET['send_sro'],"Send SRO",4)) exit(0);
            
            $objAM->showReceivedDocDetails($_GET['sro'],$_GET['year'],$_GET['bookno'],$_GET['docno'],$_GET['period'],$_GET['send_sro']);
            
        break;
    
    case 2:
        
            //print_r($_POST);
            stripTags($_POST);
            
            $objAM->setYear($_POST['hid_year']);
            $objAM->setBookNo($_POST['hid_bookno']);
            $objAM->setSendDocNo($_POST['hid_send_docno']);
            $objAM->setSendSro($_POST['hid_send_sro']);
            
            #New Document Details
            $objAM->setNewDocNo($_POST['docno']);
            $objAM->setVolume($_POST['volume']);
            $objAM->setPageFrom($_POST['page_from']);
            $objAM->setPageTo($_POST['page_to']);
            $objAM->setNoOfPages($_POST['no_pages']);
            $objAM->setRemarks($_POST['remarks']);
            
            $aryEmptyValues = array();
            $aryEmptyValues['New Doc No'] = $_POST['docno'];
            $aryEmptyValues['Volume'] = $_POST['volume'];
            $aryEmptyValues['Page From'] = $_POST['page_from'];
            $aryEmptyValues['Page To'] = $_POST['page_to'];
            $aryEmptyValues['No. of Pages'] = $_POST['no_pages'];
            
            if(!$objPhpVal->_isEmpty($aryEmptyValues)) exit(0);
            if(!$objPhpVal->_isLen($_POST['docno'],6,"New Doc No")) exit(0);
            
            if(strlen($_POST['docno']) < 2)
            {
                echo "Mesg:New Doc No Required";
                exit();
            }
            
            if(substr($_POST['docno'],0,1) !="F")
            {
                echo "Mesg:Invalid New Doc No.";
                exit();
            }
            
            $doc_substr = substr($_POST['docno'],1,strlen($_POST['docno']));
            if(!$objPhpVal->_isInteger($doc_substr,"New Doc No",5)) exit(0);
            
            if(!$objPhpVal->_isInteger($_POST['page_from'],"Page From",4)) exit(0);
            if(!$objPhpVal->_isInteger($_POST['page_to'],"Page To",4)) exit(0);
            if(!$objPhpVal->_isInteger($_POST['no_pages'],"No. of Pages",3)) exit(0);
            
            if($_POST['page_from'] > $_POST['page_to'])
            {
                echo "Mesg:Invalid Page From/Page To Value.";
                exit();
            }
            
            if($_POST['remarks'])
            {
                if(!$objPhpVal->_isSpclChar(array('Remarks'=>$_POST['remarks']))) exit(0);
                if(!$objPhpVal->_isLen($_POST['remarks'],100,"Remarks")) exit(0);
            }
            
            $sroCode = trim($_SESSION['loggedinOffice']);
            $docExists = $objAM->checkIfDocumentExists($sroCode,$_POST['hid_year'],$_POST['hid_bookno'],$_POST['docno']);
            if($docExists == true)
            {
                echo "Mesg:Document No. already Exists.";
                exit();
            }
            
            $funRes = $objAM->acceptSelectedMemo();
            //var_dump($funRes);
            
            //$funRes = true;
            if($funRes === true)
                echo "Memo Accepted Successfully";
            else
                echo "Mesg:Failed While Accepting Memo";
                
           
        break;
    
    case 3:
        
            stripTags($_GET);
            //print_r($_GET);
            $currentYear = date("Y");
            //$objAM->showAcceptedMemo($_GET['year'],$_GET['bookno'],$_GET['docno'],$_GET['period']);
            
            $objAM->showAcceptedMemo($currentYear,$_GET['bookno'],$_GET['docno'],$_GET['period']);
        
        break;
    
    
    case 4:

            $aryEmptyValues = array();
            $year = $aryEmptyValues['Year'] = $_GET['year'];
            $bookno = $aryEmptyValues['Book No'] = $_GET['bookno'];
            $docno = $aryEmptyValues['Doc No'] = trim($_GET['docno']);  //echo "NIC123"; exit();
            $sendSro = $aryEmptyValues['Send Sro'] = trim($_GET['send_sro']);
            
            if(!$objPhpVal->_isEmpty($aryEmptyValues)) exit(0);
            if(!$objPhpVal->_isYear($_GET['year'],"Year")) exit(0);
            if(!$objPhpVal->_isBookNumber($_GET['bookno'],"Book No")) exit(0);
            if(!$objPhpVal->_isAlphaNumeric($_GET['docno'],"Doc No")) exit(0);
            if(!$objPhpVal->_isInteger($_GET['send_sro'],"Send SRO Code",4)) exit(0);
            
	    $objcom = new Common();
            
            #To get Count of of Previous Documents
            $mlinkCount = $objAM->getPrevDocCount($year,$bookno,$docno,$sendSro);
            $transCount = $objAM->getTransactionCount($year,$bookno,$docno,$sendSro);
            
	    $token = md5($objcom->getRealIpAddr() . ($year + $bookno));  //Token formed by year & bookno
	    $str = trim($_SESSION['loggedinOffice']).$year.$bookno.$docno;  //sro_code,year,bookno,docno
	    $opt = 3;
	    
	    $src = "http://".SERVER_URL.":8080/birt-viewer/valid_memo.jsp?tok=".$token."&str=".$str."&linkct=".$mlinkCount."&opt=".$opt;
            $src.="&send_sro=".$sendSro;
	    $src.="&transCt=".$transCount."&__showtitle=false";
            
            $aryTemp = split('=',$_GET['period']);

?>
<iframe src="<?php echo $src; ?>" style="height:720px;width:1000px" frameborder="0">
   Report Generation Failed
</iframe>

    <input type="hidden" name="fmdt" id="fmdt" value="<?php echo $aryTemp[0]; ?>">
    <input type="hidden" name="todt" id="todt" value="<?php echo $aryTemp[1]; ?>">
    
<?php
        
        break;
    
    case 5:
        stripTags($_POST);
        
        $objAM->setYear($_POST['hid_year']);
        $objAM->setBookNo($_POST['hid_bookno']);
        $objAM->setSendDocNo($_POST['hid_send_docno']);
        $objAM->setSendSro($_POST['hid_send_sro']);
    
        $objAM->showRejectionForm();
        
        break;
    
    case 6:
    
        stripTags($_POST);
        
        $objAM->setYear($_POST['hid_year']);
        $objAM->setBookNo($_POST['hid_bookno']);
        $objAM->setSendDocNo($_POST['hid_send_docno']);
        $objAM->setSendSro($_POST['hid_send_sro']);
        $objAM->showAcceptanceForm();
    
    break;

    case 7: //Reject Memo
        
        stripTags($_POST);
        //echo "<pre>";
        //print_r($_POST);
        
        $objAM->setYear($_POST['hid_year']);
        $objAM->setBookNo($_POST['hid_bookno']);
        $objAM->setSendDocNo($_POST['hid_send_docno']);
        $objAM->setSendSro($_POST['hid_send_sro']);
        
        if(!$objPhpVal->_isEmpty(array('Reason for Rejection '=>$_POST['reject_reason']))) exit(0);
        if(!$objPhpVal->_isSpclChar(array('Reason for Rejection '=>$_POST['reject_reason']),array('-'))) exit(0);
        if(!$objPhpVal->_isLen($_POST['reject_reason'],75,"Reason for Rejection")) exit(0);
        
        $objAM->setRejectReason($_POST['reject_reason']);
        
        $funRes = $objAM->rejectMemo();
        //var_dump($funRes);
        if($funRes === true)
            echo "Memo Rejected Successfully";
        else
            echo "Mesg:Failed While Rejecting Memo";
     
        break;
    
    default:
            echo "Mesg:Invalid Choice";
        break;

}

?>