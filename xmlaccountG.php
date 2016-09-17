<?php
require_once("../pearllogin_templatexml.php");
require_once("../common/PhpCommonFunctions.php");
require_once("../classes/class.accountG.php");
require_once("../common/CommonReportFns.php");
require_once("birt_config.php");

stripTags($_GET);
if(isset($_GET['option']))
{
    $objPhpVal1 = new PhpValidation();
    if(!$objPhpVal1->_isInteger($_GET['option'],"Option Value",2)) return false;
    unset($objPhpVal1);
}

$year = date('Y'); //Current Year
//$sro = $_POST['sro_code'];
$sro = trim($_SESSION['loggedinOffice']);

//creating Common Objects
$objcom = new Common();
$objPhpVal = new PhpValidation();


switch(trim($_GET['option']))
{
    
    case 1: # Part 1 Account G Report
    
            stripTags($_POST);
            if(!$objPhpVal->_isSelect(array('Month'=>$_POST['month'])))  exit(0);
            if(!$objPhpVal->_isEmpty(array('Year'=>$_POST['year']))) exit(0);
            if(!$objPhpVal->_isInteger($_POST['month'],"Month",2)) exit(0);
            if(!$objPhpVal->_isYear($_POST['year'],"Year")) exit(0);
            
            if(intval($_POST['month'])<1 || intval($_POST['month'])>12)
            {
                echo "Invalid Month"; 
                exit(0);
            }
            
            $ymdFirstDayOfMonth = $_POST['year']."-".$_POST['month']."-"."01";
            $ymdFirstDayOfYear = $_POST['year']."-01-01";
            
            $objDB = OpenPearlDataBase::getInstance();
            $sql = "select cast(date_trunc('month'::text, '".$ymdFirstDayOfMonth."'::timestamp) + interval '1 month'- interval '1 day' as date)";
            $ymdLastDayOfMonth = $objDB->getOne($sql);
            
            $objcom->getRealIpAddr();
            $fd_split= explode('-', $ymdFirstDayOfMonth); # spliting ymd from date
            $td_split= explode('-', $ymdLastDayOfMonth); # spliting ymd to date
            
            #Creating a token => concatenate day & month of from date and to date
            $token = md5($objcom->getRealIpAddr() . (($fd_split[2].$fd_split[1]) + ($td_split[2].$td_split[1]))); 
            $opt = 26;
            
            $inputMonth = $_SESSION['input_month'] = $_POST['month'];
            $inputYear = $_SESSION['input_year'] = $_POST['year'];
            
            break;
    
    case 2: # Part 2 Account G Report
    
            stripTags($_POST);
            if(!$objPhpVal->_isSelect(array('Month'=>$_POST['month'])))  exit(0);
            if(!$objPhpVal->_isEmpty(array('Year'=>$_POST['year']))) exit(0);
            if(!$objPhpVal->_isInteger($_POST['month'],"Month",2)) exit(0);
            if(!$objPhpVal->_isYear($_POST['year'],"Year")) exit(0);
            
            if(intval($_POST['month'])<1 || intval($_POST['month'])>12)
            {
                echo "Invalid Month"; 
                exit(0);
            }
            
            $ymdFirstDayOfMonth = $_POST['year']."-".$_POST['month']."-"."01";
            $ymdFirstDayOfYear = $_POST['year']."-01-01";
            
            $objDB = OpenPearlDataBase::getInstance();
            $sql = "select cast(date_trunc('month'::text, '".$ymdFirstDayOfMonth."'::timestamp) + interval '1 month'- interval '1 day' as date)";
            $ymdLastDayOfMonth = $objDB->getOne($sql);
            
            $objcom->getRealIpAddr();
            $fd_split= explode('-', $ymdFirstDayOfMonth); # spliting ymd from date
            $td_split= explode('-', $ymdLastDayOfMonth); # spliting ymd to date
            
            #Creating a token => concatenate day & month of from date and to date
            $token = md5($objcom->getRealIpAddr() . (($fd_split[2].$fd_split[1]) + ($td_split[2].$td_split[1]))); 
            $opt = 25;
            
            $inputMonth = $_SESSION['input_month'] = $_POST['month'];
            $inputYear = $_SESSION['input_year'] = $_POST['year'];
            
            break;
        
    case 3:  # Part 1 Account G Report (generated by clicking View Part 1 Rpt)
        
            $ymdFirstDayOfMonth = $_SESSION['input_year']."-".$_SESSION['input_month']."-"."01";
            $ymdFirstDayOfYear = $_SESSION['input_year']."-01-01";
            
            $objDB = OpenPearlDataBase::getInstance();
            $sql = "select cast(date_trunc('month'::text, '".$ymdFirstDayOfMonth."'::timestamp) + interval '1 month'- interval '1 day' as date)";
            $ymdLastDayOfMonth = $objDB->getOne($sql);
            
            $objcom->getRealIpAddr();
            $fd_split= explode('-', $ymdFirstDayOfMonth); # spliting ymd from date
            $td_split= explode('-', $ymdLastDayOfMonth); # spliting ymd to date
            
            #Creating a token => concatenate day & month of from date and to date
            $token = md5($objcom->getRealIpAddr() . (($fd_split[2].$fd_split[1]) + ($td_split[2].$td_split[1]))); 
            $opt = 26;
            
            $inputMonth = $_SESSION['input_month'];
            $inputYear = $_SESSION['input_year'];
            
            //unset($_SESSION['input_month'],$_SESSION['input_year']);
        
            break;
        
    case 4: # Part 2 Account G Report (generated by clicking View Part 2 Rpt)
        
            $ymdFirstDayOfMonth = $_SESSION['input_year']."-".$_SESSION['input_month']."-"."01";
            $ymdFirstDayOfYear = $_SESSION['input_year']."-01-01";
            
            $objDB = OpenPearlDataBase::getInstance();
            $sql = "select cast(date_trunc('month'::text, '".$ymdFirstDayOfMonth."'::timestamp) + interval '1 month'- interval '1 day' as date)";
            $ymdLastDayOfMonth = $objDB->getOne($sql);
            
            $objcom->getRealIpAddr();
            $fd_split= explode('-', $ymdFirstDayOfMonth); # spliting ymd from date
            $td_split= explode('-', $ymdLastDayOfMonth); # spliting ymd to date
            
            #Creating a token => concatenate day & month of from date and to date
            $token = md5($objcom->getRealIpAddr() . (($fd_split[2].$fd_split[1]) + ($td_split[2].$td_split[1]))); 
            $opt = 25;
            
            $inputMonth = $_SESSION['input_month'];
            $inputYear = $_SESSION['input_year'];
            
            //unset($_SESSION['input_month'],$_SESSION['input_year']);
            
          break;
    
    default:
        echo "Mesg:Invalid Choice";
        break;
    
}


$src = "http://".SERVER_URL.":8080/birt-viewer/validate_access.jsp?tok=".$token."&str=".str_replace('-','', $ymdFirstDayOfMonth).$sro.str_replace('-','', $ymdLastDayOfMonth)."&opt=".$opt;
$src.="&year=".$inputYear."&month=".getMonthDescription($inputMonth)."&firstDay=".$ymdFirstDayOfYear;
$src.="&__showtitle=false";
    
?>

<iframe src="<?php echo $src; ?>" style="height:720px;width:1000px" frameborder="0">
   Report Generation Failed
</iframe>