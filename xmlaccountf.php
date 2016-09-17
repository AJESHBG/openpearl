<?php
require_once("../pearllogin_templatexml.php");
require_once("../common/PhpCommonFunctions.php");
require_once("../classes/class.accountfrpt.php");
require_once("../common/CommonReportFns.php");
require_once("birt_config.php");

stripTags($_GET);
if(isset($_GET['option']))
{
    $objPhpVal1 = new PhpValidation();
    if(!$objPhpVal1->_isInteger($_GET['option'],"Option Value",2)) return false;
    unset($objPhpVal1);
}

$sro = trim($_SESSION['loggedinOffice']);

//creating Common Objects
$objcom = new Common();
$objPhpVal = new PhpValidation();

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

$objDB = OpenPearlDataBase::getInstance();
$sql = "select cast(date_trunc('month'::text, '".$ymdFirstDayOfMonth."'::timestamp) + interval '1 month'- interval '1 day' as date)";
$ymdLastDayOfMonth = $objDB->getOne($sql);

$objcom->getRealIpAddr();
$fd_split= explode('-', $ymdFirstDayOfMonth); # spliting ymd from date
$td_split= explode('-', $ymdLastDayOfMonth); # spliting ymd to date

#Creating a token => concatenate day & month of from date and to date
$token = md5($objcom->getRealIpAddr() . (($fd_split[2].$fd_split[1]) + ($td_split[2].$td_split[1]))); 
$opt = 0;

switch(trim($_GET['option']))
{
    
    case 1: #account F : Part 1 report
            $opt = 3;
        break;
    
    case 2: #account F : Part 2 report
            $opt = 4;
        break;
    
    case 3: #account F : Part 3 report
            $opt = 5;
    break;

    case 4: #account F : Part 4 report
            $opt = 6;
    break;
    
    default:
        echo "Mesg:Invalid Choice";
        break;
    
}

$src = "http://".SERVER_URL.":8080/birt-viewer/validate_access.jsp?tok=".$token."&str=".str_replace('-','', $ymdFirstDayOfMonth).$sro.str_replace('-','', $ymdLastDayOfMonth)."&opt=".$opt;
$src.="&year=".$_POST['year']."&month=".getMonthDescription($_POST['month']);
$src.="&__showtitle=false";
    
?>

<iframe src="<?php echo $src; ?>" style="height:720px;width:1000px" frameborder="0">
   Report Generation Failed
</iframe>
    