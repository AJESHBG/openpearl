<?php 
require_once("../pearllogin_templatexml.php");
require_once("../classes/class.lcinmalayalam.php");
require_once("../classes/class.gridView.php");
require_once("../classes/class.encumbcertificate.php");
require_once("../common/CommonECReportFunctions.php");

$option="";
$objlcineng= new lc_english();
$objclsPhpValidation= new PhpValidation();

$databaseObj = OpenPearlDataBase::getInstance();

//echo "List Cert -- Option :: ".$_GET['option'];
try
{
if(isset($_GET['option']))
{ 
    $option= trim(strip_tags($_GET['option']));
    if(!$objclsPhpValidation->_isInteger($option, "Option", 2))
    {
        
        exit(0);
    }
}
if(isset($_GET['txtGsno']))
{

    if(!$objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtGsno'])), "Gsno", 10))
    {
        exit(0);
    }
}
if(isset($_POST['txtGsno']))
{
    if(!$objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtGsno'])), "Gsno", 10))
    {
        exit(0);
    }
}
if(isset($_GET['stat']))
{
    $stat=trim(strip_tags($_GET['stat']));
     if($stat!="EA" and $stat!="E" and $stat!="EAN" and $stat!="N")
           {
               echo  "Mesg: Invalid Stat2".$_GET['stat'];
               exit(0);
           }
}
if(isset($_GET['pk']))
{
     $assoArray = array("pk"=>trim(strip_tags($_GET['pk'])));
        if (!$objclsPhpValidation->_isSpclChar($assoArray,array("/")))
       {

           exit(0);

       }
       if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['pk'])),20, "pk")!==true)
        {
           exit(0);
        }
}
if(isset($_GET['offset']))
{
    $offset=trim(strip_tags($_GET['offset']));
    if(trim($_GET['offset'])<0 or trim($_GET['offset'])=="")
    {
        $offset=0;
    }
    if(!$objclsPhpValidation->_isInteger($offset, "Offset", 2))
    {
        exit(0);
    }
}
if(isset($_POST['txtDate']))
{
    iF ($objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtDate'])),"Date")!==true)
           {

           exit(0);
           }

}
if(isset($_GET['txtDate']))
{
    iF ($objclsPhpValidation->_isDate(trim(strip_tags($_GET['txtDate'])),"Date")!==true)
           {

           exit(0);
           }

}
} //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
switch($option)//start of switch
{
    case 0:
	    if( isset($_GET['tok']) )
	    {
		$objlcineng->fillApplnforLCinMal();
	    }
	    break;
    case 1:
	    $pkey	=  strip_tags(trim($_GET['pkey']));
	    
	    $aryPkey	=  split('/',$pkey);
	    $gsno	=  $aryPkey[0];
	    $ecyear	=  $aryPkey[1];
	    $transId	=  $aryPkey[2];

	    $objlcineng->fillApplLcinMalayalam($gsno,$ecyear,$transId);
	    
	    break;
    case 2:
	    if(isset($_GET['tok']) and isset($_GET['ecyear']) and  isset($_GET['gsno']))
	    {
	       $objlcineng->LCPrintPreview($_GET['gsno'],$_GET['ecyear']);
	    }
	    break;
        
    default:
    break;
    case 3:
	    if(isset($_GET['tok']))
	    {
		$boolRes = $objlcineng-> printLC($_SESSION['loggedinOffice'],trim($_GET['ecyear']),$_GET['gsno'],'S',$databaseObj); 
		if($boolRes == false)
		{
		echo "Mesg:Failed While Printing List Certificate.";
		exit(0);
		}
		else
		echo "Success";
	    }
	    break;
    default:
    break;
            

}//end of switch

?>