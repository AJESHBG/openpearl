<?php

require_once("../pearllogin_templatexml.php");
require_once("../classes/class.encumbcertificate.php");
require_once("../common/CommonECReportFunctions.php");
require_once("../common/PhpCommonFunctions.php");
require_once("../DBAL/PublicDataBaseClass.php");

$option="";
$objencumbcertificate= new encumbcertificate();
$objclsPhpValidation= new PhpValidation();

$databaseObj = OpenPearlDataBase::getInstance();
$objPublic=PublicDataBase::getInstance();
//echo "opt=".$_GET['option'];
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
else
{
    echo "Invalid Option";
    exit(0);
}
 

if(isset($_GET['txtGsno']))
{

    if(!$objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtGsno'])), "Gsno", 5))
    {
        exit(0);
    }
}

        
if(isset($_POST['txtGsno']))
{
    if(!$objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtGsno'])), "Gsno", 5))
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
try
{
	
	 $objencumbcertificate->Loadapplnform("N");
 } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	
	
	 break;
//========//SubmitDocumentdet===================================================CASE 1============validated==================================
case 1 :
    try
{
     
   //                   echo "Mesg:Invalid Input1  txtGsno ".isset($_POST['txtGsno']) ." SROvalue ".
   // isset($_POST['ddlSro']) ." Datevalue ". isset($_POST['txtDate']) ." Namevalue ". isset($_POST['txtName'])
   // ." HouseNovalue ". isset($_POST['txtHouseno']) ." Cityvalue ". isset($_POST['txtCity']) ." Pinvalue ". isset($_POST['txtPin'])
   // ." Emailvalue ". isset($_POST['txtEmail']) ." Phonevalue ". isset($_POST['txtPhone'])." Mobilevalue ". isset($_POST['txtmobile'])
   // ." Collectvalue ". isset($_POST['ddlCollectec']) ." SROvalue ". trim(strip_tags($_POST['ddlSro']))
   // ." Collectvalue ". trim(strip_tags($_POST['ddlCollectec'])) ."hidden".isset($_GET['tok']);
     
  
        //=================================================Validation Started=====================================================
   
    if (isset($_POST['txtGsno']) and isset($_GET['stat']) and isset($_POST['ddlDist']) and isset($_POST['ddlSro']) and isset($_POST['txtDate']) and isset($_POST['txtName']) and isset($_POST['txtHouseno']) and isset($_POST['txtCity']) and  isset($_POST['txtPin']) and isset($_POST['txtEmail']) and isset($_POST['txtPhone']) and isset($_POST['txtmobile']) and isset($_POST['ddlCollectec']) and isset($_GET['tok']) )
    { 
        
       
        //,"Email"=>trim(strip_tags($_POST['txtEmail'])),"PhoneNo"=>trim(strip_tags($_POST['txtPhone'])),"Mobile"=>trim(strip_tags($_POST['txtmobile']))
        $assoArray1 = array("Gsno"=>trim(strip_tags($_POST['txtGsno'])), "Date"=>trim(strip_tags($_POST['txtDate'])),"Name"=>trim(strip_tags($_POST['txtName'])), "House No/Name"=>trim(strip_tags($_POST['txtHouseno'])), "City/District"=>trim(strip_tags($_POST['txtCity'])));
        $assoArray2 = array("District"=>trim(strip_tags($_POST['ddlDist'])),"Sub-Registrar Office"=>trim(strip_tags($_POST['ddlSro'])),"Collect the EC (BY)"=>trim(strip_tags($_POST['ddlCollectec'])));
      
       //, "Pincode"=>trim(strip_tags($_POST['txtPin']))
       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {
   
           exit(0);
           
       }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {
            
            exit(0);
         
       }
        
             $assoArray1 = array("Gsno"=>$_POST['txtGsno'],"stat"=>$_GET['stat']);
             $assoArray2 = array("Name"=>$_POST['txtName']);
             $assoArray3 = array("House No/Name"=>trim(strip_tags($_POST['txtHouseno'])));
             $assoArray4 = array( "City/District"=>trim(strip_tags($_POST['txtCity'])));
         iF ($objclsPhpValidation->_isSpclChar($assoArray1)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtGsno'])),"Gsno",5)!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtDate'])),"Date")!==true)
           {
           
           exit(0);
           }
            if ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlDist'])), "District",2)!==true)
            {
                 exit(0);
            }
            if ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlSro'])),"Sro",4)!==true)
            {
                 exit(0);
            }

        iF ($objclsPhpValidation->_isSpclChar($assoArray2,array('.'))!==true)
           {
               exit(0);
           }

        iF ($objclsPhpValidation->_isSpclChar($assoArray3,array('.','-',',','/'))!==true)
           {
              exit(0);
           }
         iF ($objclsPhpValidation->_isSpclChar($assoArray4,array('.','-',','))!==true)
           {
              exit(0);
           }
     
        iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtPin'])),"Pincode")!==true)
           {
              exit(0);
           }
       iF ($objclsPhpValidation->_isEmail(trim(strip_tags($_POST['txtEmail'])),"EmailID")!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isPhoneNo(trim(strip_tags($_POST['txtPhone'])),"PhoneNumber")!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isPhoneNo(trim(strip_tags($_POST['txtmobile'])),"Mobile")!==true)
           {
              exit(0);
           }
           if(trim(strip_tags($_POST['ddlCollectec']))!=1 and trim(strip_tags($_POST['ddlCollectec']))!=2)
           {
               echo "Mesg: Invalid Collect the EC (BY)";
               exit(0);
           }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtGsno'])), 6, "Gsno")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtDate'])), 10, "Date")!==true)
        {
       exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlDist'])), 2, "District")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlSro'])), 4, "Sub-Registrar Office")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtName'])),30, "Name")!==true)
        {
      exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtHouseno'])), 50,"House No/Name")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtCity'])), 50,"City/District")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtEmail'])),50, "EmailID")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlCollectec'])),1,"Collect the EC (BY)")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['stat'])),3,"stat")!==true)
        {
            exit(0);
        }
    

    
 
  if(isset($_POST['txtBookno']) and isset($_POST['txtDocno']) and isset($_POST['txtYear']) and isset($_GET['slno']))
    {
      
       $assoArray = array("Year"=>trim(strip_tags($_POST['txtYear'])),"BookNo"=>trim(strip_tags($_POST['txtBookno'])),"DocNo"=>trim(strip_tags($_POST['txtDocno'])));
      
        if ($objclsPhpValidation->_isEmpty($assoArray)!== true)
           {
              exit(0);

           }
           $assoArray1 = array("Docno"=>$_POST['txtDocno'],"BookNo"=>$_POST['txtBookno']);


         iF ($objclsPhpValidation->_isSpclChar($assoArray1)!==true)
           {
              exit(0);
           }

        iF ($objclsPhpValidation->_isYear(trim(strip_tags($_POST['txtYear'])))!==true)
           {
             exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['slno'])),"Slno",2)!==true)
           {
             exit(0);
           }
            if (trim(strip_tags($_POST['txtBookno']))!="1" and trim(strip_tags($_POST['txtBookno']))!="3" and trim(strip_tags($_POST['txtBookno']))!="")
            {
                echo "Mesg: Invalid Book No";
                exit(0);
            }
         if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtBookno'])), 1, "BookNo")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtDocno'])), 6, "DocNo")!==true)
        {
            exit(0);
        }
         
       
         
    
    
     
       
  
     //=================================================Validation Over=====================================================

  
                 $arr=split('[.-/]',trim(strip_tags($_POST['txtDate'])));
                 if (sizeof($arr)>0)
                 {
                         $ecyear=$arr[2];

                 }

                
                    $stat=$_GET['stat'];
                  
                 $gsno= trim(strip_tags($_POST['txtGsno']));
                  $slnodoc=$objencumbcertificate->NextSlnodocRno($ecyear,$gsno,$stat);
                 $sro= trim(strip_tags($_POST['ddlSro']));
                 $bookno=trim(strip_tags($_POST['txtBookno']));
                 $docno=trim(strip_tags($_POST['txtDocno']));
                 $year=trim(strip_tags($_POST['txtYear']));
                 $dcode=trim(strip_tags($_POST['ddlDist']));

                 $objencumbcertificate->setslnodoc($slnodoc);
                 $objencumbcertificate->setbookno($bookno);
                 $objencumbcertificate->setdocno($docno);
                 $objencumbcertificate->setyear($year);
             /*Storing to data base *///$stat="",$ecyear="",$gsno="",$sro="",$slnodoc="",$bookno="",$docno="",$year=""
                // echo'in xml'.$stat;
                 $objencumbcertificate->insertecdonos($stat,$ecyear,$gsno,$sro,$slnodoc,$bookno,$docno,$year,$dcode,$databaseObj);
                 $objencumbcertificate->GridDocument_display($ecyear,$gsno,$stat);

        
         
    }
    }
    } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
       //echo "Mesg:Invalid Input1".($_POST['txtDate']) ."value". ($_POST['txtGsno'])."value". ($_POST['ddlSro']) ."value". ($_POST['txtBookno']) ."value". ($_POST['txtDocno']) ."value". ($_POST['txtYear']);
    
	 break; 
 //============//FillDocumentdet================================================CASE 2========validated======================================
 case 2 :
     try
 {
     if(isset($_GET['txtGsno']) and isset($_GET['txtDate']) and isset($_GET['tok']) and isset($_GET['off']) )
     {
         $offset=$_GET['off'];
         if(trim(strip_tags($_GET['off']))<0)
         {
         $offset=0;
         }
     
       
        $assoArray1 = array("Gsno"=>$_GET['txtGsno']);

        iF ($objclsPhpValidation->_isDate(trim(strip_tags($_GET['txtDate'])),"Date")!==true)
           {

           exit(0);
           }
         iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtGsno'])),"Gsno",5)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($offset)),"Offset",2)!==true)
           {
               exit(0);
           }
	 $gsno= $_GET['txtGsno'];

        $arr=split('[.-/]',trim(strip_tags($_GET['txtDate'])));
	 if (sizeof($arr)>0)
	 {
		 $ecyear=$arr[2];
	 } 
	 $objencumbcertificate->setgsno($gsno);
	 $objencumbcertificate->setecyear($ecyear);
	 $off= trim(strip_tags($offset));
	// commented  $objencumbcertificate->showdocdet($off,"E",$ecyear);
	$objencumbcertificate->GridDocument_display($ecyear,$gsno,'E');
     }
     else
     {
         echo "Mesg: Gsno & Date Required";
        exit(0);
     }
     } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
 //=================//filltaluk=================================================CASE 3============validated==================================
 case 3 :
     try
 {
     if(isset($_GET['ddlDist']) and (trim(strip_tags($_GET['ddlDist']))!=-1 and $_GET['ddlDist']!=0) and isset($_GET['ddlSro']) and (trim(strip_tags($_GET['ddlSro']))!=-1 and trim(strip_tags($_GET['ddlSro']))!=0) and isset($_GET['tok']) )
     {
         $objDDVal = new dropDownValidation();
           if(!$objDDVal->checkDistrict(trim(strip_tags($_GET['ddlDist'])))) exit(0);
            if(!$objDDVal->checkSRO(trim(strip_tags($_GET['ddlDist'])),trim(strip_tags($_GET['ddlSro'])))) exit(0);
         




       
        if ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlDist'])), "District",2)!==true)
            {
                 exit(0);
            }
 if ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlSro'])), "Sro",4)!==true)
            {
                 exit(0);
            }
	 $dcode= trim(strip_tags($_GET['ddlDist']));
         $srocode=trim(strip_tags($_GET['ddlSro']));
   	 $objencumbcertificate->filltaluk($dcode,$srocode);
     }
     else
     {
         echo "Mesg: Taluk Does not Exits/District & Sub-Registrar Office Required";
         exit(0);
     }
unset($objDDVal);
} //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
 //================//fillvillage================================================CASE 4=======validated=======================================
 case 4 : 
     try
 {
        if(isset($_GET['ddlDist']) and (trim(strip_tags($_GET['ddlDist']))!=-1 and trim(strip_tags($_GET['ddlDist']))!=0) and isset($_GET['ddlTaluk']) and isset($_GET['ddlSro']) and (trim(strip_tags($_GET['ddlSro']))!=-1 and trim(strip_tags($_GET['ddlSro']))!=0) and (trim(strip_tags($_GET['ddlTaluk']))!=-1 and trim(strip_tags($_GET['ddlTaluk']))!=0) and isset($_GET['tok']) )
       {

$objDDVal = new dropDownValidation();
            if(!$objDDVal->checkDistrict(trim(strip_tags($_GET['ddlDist'])))) exit(0);
            if(!$objDDVal->checkSRO(trim(strip_tags($_GET['ddlDist'])),trim(strip_tags($_GET['ddlSro'])))) exit(0);
            if(!$objDDVal->checkTalukFromSRO(trim(strip_tags($_GET['ddlDist'])),trim(strip_tags($_GET['ddlSro'])),trim(strip_tags($_GET['ddlTaluk'])))) exit(0);
           
     
       
           if ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlDist'])), "District",2)!==true)
            {
                 exit(0);
            }
             iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlTaluk'])),"Taluk",2)!==true)
           {
               exit(0);
           }
        if ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlSro'])), "Sro",4)!==true)
            {
                 exit(0);
            }
           
	 $dcode= trim(strip_tags($_GET['ddlDist']));
	 $tcode= trim(strip_tags($_GET['ddlTaluk']));
         $srocode= trim(strip_tags($_GET['ddlSro']));
	 $objencumbcertificate->fillvillage($dcode,$tcode,$srocode);
     }
     else
     {
         echo "Mesg: Village Does not Exits/District,Taluk & Sub-Registrar Office Required";
        exit(0);
     }
     unset($objDDVal);
     } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
 //=============//fillDesam=====================================================CASE 5=======validated=======================================
 case 5 :
     try
 {
       if(isset($_GET['ddlDist']) and isset($_GET['ddlSro']) and (trim(strip_tags($_GET['ddlSro']))!=-1 and trim(strip_tags($_GET['ddlSro']))!=0) and (trim(strip_tags($_GET['ddlDist']))!=-1 and trim(strip_tags($_GET['ddlDist']))!=0) and isset($_GET['ddlTaluk']) and (trim(strip_tags($_GET['ddlTaluk']))!=-1 and trim(strip_tags($_GET['ddlTaluk']))!=0) and isset($_GET['ddlVillage']) and (trim(strip_tags($_GET['ddlVillage']))!=-1 and trim(strip_tags($_GET['ddlVillage']))!=0) and isset($_GET['tok']) )
     {
           $objDDVal = new dropDownValidation();
           if(!$objDDVal->checkDistrict(trim(strip_tags($_GET['ddlDist'])))) exit(0);
            if(!$objDDVal->checkSRO(trim(strip_tags($_GET['ddlDist'])),trim(strip_tags($_GET['ddlSro'])))) exit(0);
            if(!$objDDVal->checkTalukFromSRO(trim(strip_tags($_GET['ddlDist'])),trim(strip_tags($_GET['ddlSro'])),trim(strip_tags($_GET['ddlTaluk'])))) exit(0);
            if(!$objDDVal->checkVillageFromSRO(trim(strip_tags($_GET['ddlDist'])),trim(strip_tags($_GET['ddlVillage'])),trim(strip_tags($_GET['ddlTaluk'])),trim(strip_tags($_GET['ddlSro'])))) exit(0);



       
      
          iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlDist'])),"District",2)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlTaluk'])),"Taluk",2)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlVillage'])),"Village",2)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlSro'])),"Sro",4)!==true)
           {
               exit(0);
           }
	 $dcode= trim(strip_tags($_GET['ddlDist']));
	 $tcode= trim(strip_tags($_GET['ddlTaluk']));
	 $vcode= trim(strip_tags($_GET['ddlVillage']));
         $sro=trim(strip_tags($_GET['ddlSro']));
	 $objencumbcertificate->fillDesam($dcode,$tcode,$vcode,$sro);
     }
     else
     {
         echo "Mesg: Desam Does not Exits/District & Taluk & Village Required";
        exit(0);
     }
 unset($objDDVal);
 } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
 //=========//fillBlock=========================================================CASE 6========validated======================================
 case 6 :
     try
 {
    
     //and isset($_GET['ddlDesam']) and (trim(strip_tags($_GET['ddlDesam']))!=-1 and trim(strip_tags($_GET['ddlDesam']))!=0)
      if(isset($_GET['ddlDist'])  and isset($_GET['ddlSro']) and (trim(strip_tags($_GET['ddlSro']))!=-1 and trim(strip_tags($_GET['ddlSro']))!=0) and (trim(strip_tags($_GET['ddlDist']))!=-1 and trim(strip_tags($_GET['ddlDist']))!=0) and isset($_GET['ddlTaluk']) and (trim(strip_tags($_GET['ddlTaluk']))!=-1 and trim(strip_tags($_GET['ddlTaluk']))!=0) and isset($_GET['ddlVillage']) and (trim(strip_tags($_GET['ddlVillage']))!=-1 and trim(strip_tags($_GET['ddlVillage']))!=0) and isset($_GET['tok']) )
     { //Desam is validated b'z on its change block is filled
          $objDDVal = new dropDownValidation();
          if(!$objDDVal->checkDistrict(trim(strip_tags($_GET['ddlDist'])))) exit(0);
            if(!$objDDVal->checkSRO(trim(strip_tags($_GET['ddlDist'])),trim(strip_tags($_GET['ddlSro'])))) exit(0);
            if(!$objDDVal->checkTalukFromSRO(trim(strip_tags($_GET['ddlDist'])),trim(strip_tags($_GET['ddlSro'])),trim(strip_tags($_GET['ddlTaluk'])))) exit(0);
            if(!$objDDVal->checkVillageFromSRO(trim(strip_tags($_GET['ddlDist'])),trim(strip_tags($_GET['ddlVillage'])),trim(strip_tags($_GET['ddlTaluk'])),trim(strip_tags($_GET['ddlSro'])))) exit(0);


       
         

       
          iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlDist'])),"District",2)!==true)
           {
               exit(0);
           }
             iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlSro'])),"Sro",4)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlTaluk'])),"Taluk",2)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlVillage'])),"Village",2)!==true)
           {
               exit(0);
           }
          /* iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlDesam'])),"Desam",2)!==true)
           {
               exit(0);
           }*/
            unset($objDDVal);
	 $dcode= trim(strip_tags($_GET['ddlDist']));
	 $tcode= trim(strip_tags($_GET['ddlTaluk']));
	 $vcode= trim(strip_tags($_GET['ddlVillage']));
         $desam=trim(strip_tags($_GET['ddlDesam']));
        $sro=trim(strip_tags($_GET['ddlSro']));
	 $objencumbcertificate->fillBlock($dcode,$tcode,$vcode,$sro);/*  */
         
	
     }
      else
     {
         echo "Mesg: Block Does not Exits/District & Taluk & Village & Desam Required";
        exit(0);
     }
     } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
     break;
 //====================fillSro==================================================CASE 7=====validated=========================================
 case 7 :
     try
 {
     if(isset($_GET['ddlDist']) and isset($_GET['stat']) and (trim(strip_tags(($_GET['ddlDist']))!=-1  and trim(strip_tags(($_GET['ddlDist']))!=0))) and isset($_GET['tok']) )
     {
         $objDDVal = new dropDownValidation();


        if(!$objDDVal->checkDistrict(trim(strip_tags($_GET['ddlDist'])))) exit(0);
       
        
       
         iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlDist'])),"District",2)!==true)
           {
               exit(0);
           }
          
	 $dcode= trim(strip_tags($_GET['ddlDist']));
	 $stat=trim(strip_tags($_GET['stat']));
         $objencumbcertificate->fillSro($dcode,$stat);
     }
     else
     {
         echo "Mesg:Sub-Registrar Office Does not Exits/District Required";
         exit(0);
     }
	 unset($objDDVal);
         } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;

//=============================InsertECSurnos===================================CASE 9=======validated=======================================
case 9 : 
 try
{
        //=================================================Validation Started=====================================================

    if (isset($_POST['txtGsno']) and isset($_GET['stat']) and isset($_POST['ddlDist']) and isset($_POST['ddlSro']) and isset($_POST['txtDate']) and isset($_POST['txtName']) and isset($_POST['txtHouseno']) and isset($_POST['txtCity']) and  isset($_POST['txtPin']) and isset($_POST['txtEmail']) and isset($_POST['txtPhone']) and isset($_POST['txtmobile']) and isset($_POST['ddlCollectec']) and isset($_GET['tok']) )
    {

       
//,"Email"=>trim(strip_tags($_POST['txtEmail'])),"PhoneNo"=>trim(strip_tags($_POST['txtPhone'])),"Mobile"=>trim(strip_tags($_POST['txtmobile']))
        $assoArray1 = array("Gsno"=>trim(strip_tags($_POST['txtGsno'])), "Date"=>trim(strip_tags($_POST['txtDate'])),"Name"=>trim(strip_tags($_POST['txtName'])), "House No/Name"=>trim(strip_tags($_POST['txtHouseno'])), "City/District"=>trim(strip_tags($_POST['txtCity']))); //, "Pincode"=>trim(strip_tags($_POST['txtPin']))
        $assoArray2 = array("District"=>trim(strip_tags($_POST['ddlDist'])),"Sub-Registrar Office"=>trim(strip_tags($_POST['ddlSro'])),"Collect the EC (BY)"=>trim(strip_tags($_POST['ddlCollectec'])));


       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }

             $assoArray1 = array("Gsno"=>$_POST['txtGsno'],"stat"=>$_GET['stat']);
             $assoArray2 = array("Name"=>$_POST['txtName']);
             $assoArray3 = array("House No/Name"=>trim(strip_tags($_POST['txtHouseno'])));
             $assoArray4 = array( "City/District"=>trim(strip_tags($_POST['txtCity'])));
         iF ($objclsPhpValidation->_isSpclChar($assoArray1)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtGsno'])),"Gsno",5)!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtDate'])),"Date")!==true)
           {

           exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlDist'])),"District",2)!==true)
           {
               exit(0);
           }
    iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlSro'])),"Sro",4)!==true)
           {
               exit(0);
           }

        iF ($objclsPhpValidation->_isSpclChar($assoArray2,array('.'))!==true)
           {
               exit(0);
           }

        iF ($objclsPhpValidation->_isSpclChar($assoArray3,array('.','-',',','/'))!==true)
           {
              exit(0);
           }
         iF ($objclsPhpValidation->_isSpclChar($assoArray4,array('.','-',','))!==true)
           {
              exit(0);
           }

		iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtPin'])),"Pincode")!==true)
           {
              exit(0);
           }
       iF ($objclsPhpValidation->_isEmail(trim(strip_tags($_POST['txtEmail'])),"EmailID")!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isPhoneNo(trim(strip_tags($_POST['txtPhone'])),"PhoneNumber")!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isPhoneNo(trim(strip_tags($_POST['txtmobile'])),"Mobile")!==true)
           {
              exit(0);
           }
           if(trim(strip_tags($_POST['ddlCollectec']))!=1 and trim(strip_tags($_POST['ddlCollectec']))!=2)
           {
               echo "Mesg: Invalid Collect the EC (BY)";
               exit(0);
           }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtGsno'])), 6, "Gsno")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtDate'])), 10, "Date")!==true)
        {
             exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlDist'])), 2, "District")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlSro'])), 4, "Sub-Registrar Office")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtName'])),30, "Name")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtHouseno'])), 50,"House No/Name")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtCity'])), 50,"City/District")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtEmail'])),50, "EmailID")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlCollectec'])),1,"Collect the EC (BY)")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['stat'])),3,"stat")!==true)
        {
            exit(0);
        }

        
 if (isset($_GET['stat']) and isset($_POST['ddlDist']) and
         isset($_POST['ddlTaluk']) and isset($_POST['ddlVillage']) and isset($_POST['ddlDesam']) and
         isset($_POST['txtblock']) and isset($_POST['txtResurno']) and isset($_POST['txtResurSubdiv']) and
         isset($_POST['txtOldsurno']) and isset( $_POST['txtOldsubdivno']) and isset($_POST['ddlUnit']) and
         isset($_POST['txtHect']) and isset($_POST['txtAre']) and isset($_POST['txtSqlnk']) and
         isset($_POST['txtRemark'])  and isset($_POST['txtEast']) and isset($_POST['txtWest']) and
         isset($_POST['txtNorth']) and isset($_POST['txtSouth']))
    {
     //"Resurvey No"=>trim(strip_tags($_POST['txtResurno'])),"Resurvey Subdiv No"=>trim(strip_tags($_POST['txtResurSubdiv'])),
     //     "Old Survey No"=>trim(strip_tags($_POST['txtOldsurno'])), "Old Survey Subdiv No"=>trim(strip_tags($_POST['txtOldsubdivno'])),
     //,"Remark"=>trim(strip_tags($_POST['txtRemark'])),"East"=>trim(strip_tags($_POST['txtEast'])),
      //    "West"=>trim(strip_tags($_POST['txtWest'])),"North"=>trim(strip_tags($_POST['txtNorth'])),"South"=>trim(strip_tags($_POST['txtSouth']))
     //,"Desam"=>trim(strip_tags($_POST['ddlDesam'])),"Block"=>trim(strip_tags($_POST['txtblock'])),"Unit"=>trim(strip_tags($_POST['ddlUnit']))
      $assoArray1 = array("Hectare/Acre"=>trim(strip_tags($_POST['txtHect'])),"Are/Cent"=>trim(strip_tags($_POST['txtAre'])), "Square Meter/Link"=>trim(strip_tags($_POST['txtSqlnk'])));
      
      $assoArray2 = array("District"=>trim(strip_tags($_POST['ddlDist'])),"Taluk"=>trim(strip_tags($_POST['ddlTaluk'])),"Village"=>trim(strip_tags($_POST['ddlVillage'])),"Unit"=>trim(strip_tags($_POST['ddlUnit'])));

      $assoArray3 = array("Resurvey No"=>trim(strip_tags($_POST['txtResurno'])),"Resurvey Subdiv No"=>trim(strip_tags($_POST['txtResurSubdiv'])),
          "Old Survey No"=>trim(strip_tags($_POST['txtOldsurno'])), "Old Survey Subdiv No"=>trim(strip_tags($_POST['txtOldsubdivno'])),
          "Remark"=>trim(strip_tags($_POST['txtRemark'])),"East"=>trim(strip_tags($_POST['txtEast'])),
          "West"=>trim(strip_tags($_POST['txtWest'])),"North"=>trim(strip_tags($_POST['txtNorth'])),"South"=>trim(strip_tags($_POST['txtSouth'])));

       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }
   iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlTaluk'])),"Taluk",2)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlVillage'])),"Village",2)!==true)
           {
               exit(0);
           }
              iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlDesam'])),"Desam",2)!==true)
           {
               exit(0);
           }
          // echo "Mesg23:".$_POST['txtblock'];
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtblock'])),"Block",3)!==true)
           {
               exit(0);
           }
           if(strlen(trim(strip_tags($_POST['txtblock'])))!=3 and trim(strip_tags($_POST['txtblock']))!="")
           {
               echo "Mesg:Invalid Block";
               exit(0);
           }
        if(($_POST['txtHect']=="") and ($_POST['txtAre']=="") and ($_POST['txtSqlnk']==""))
		    {
			echo "Mesg:Property Area Required";
			exit(0);
		    }

		    if(($_POST['txtHect']+$_POST['txtAre']+$_POST['txtSqlnk'])==0)
		    {
			echo "Mesg:Property Area Cannot be Zero";
			exit(0);
		    }
    
       
       
       iF ($objclsPhpValidation->_isSpclChar($assoArray3)!==true)
           {
                exit(0);
           }
        iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtHect'])), "Hectare/Acre", 5)!==true)
           {
                exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtAre'])), "Are/Cent", 5)!==true)
           {
                exit(0);
           }
            iF ($objclsPhpValidation->_isDecimal(trim(strip_tags($_POST['txtSqlnk'])),6,2, "Square Meter/Link")!==true)
           {
               exit(0);
           }
           //======================================length validation=======================================================
            if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlDist'])), 2,"District")!==true)
            {
                 exit(0);
            }
            if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlSro'])), 4,"Sro")!==true)
            {
                 exit(0);
            }
             if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlTaluk'])), 2,"Taluk")!==true)
            {
                 exit(0);
            }
             if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlVillage'])), 2,"Village")!==true)
            {
                 exit(0);
            }
             if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlDesam'])), 2,"Desam")!==true)
            {
                 exit(0);
            }
             if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtblock'])), 3,"Block")!==true)
            {
                exit(0);
            }
            if (trim(strip_tags($_POST['ddlUnit']))!=1 and trim(strip_tags($_POST['ddlUnit']))!=2)
            {
                echo  "Mesg: Invalid Unit";
                         exit(0);
            }
             if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtResurno'])), 6,"Resurvey No")!==true)
            {
                 exit(0);
            }
             if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtResurSubdiv'])), 15,"Resurvey Subdiv No")!==true)
            {
                exit(0);
            }
            
            if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtOldsurno'])), 6,"Old Survey No")!==true)
            {
                 exit(0);
            }
            if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtOldsubdivno'])), 15,"Old Survey Subdiv No")!==true)
            {
                 exit(0);
            }
           
             if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtRemark'])), 150,"Remark")!==true)
            {
                 exit(0);
            }
             if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtEast'])), 50,"East")!==true)
            {
                 exit(0);
            }
             if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtWest'])), 50,"West")!==true)
            {
                 exit(0);
            }
              if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtNorth'])), 50,"North")!==true)
            {
                 exit(0);
            }
              if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtSouth'])), 50,"South")!==true)
            {
                 exit(0);
            }

        //=======================================================================================================================
$objDDVal = new dropDownValidation();
if(!$objDDVal->checkDistrict(trim(strip_tags($_POST['ddlDist'])))) exit(0);

if(!$objDDVal->checkSRO(trim(strip_tags($_POST['ddlDist'])),trim(strip_tags($_POST['ddlSro'])))) exit(0);

if(!$objDDVal->checkTalukFromSRO(trim(strip_tags($_POST['ddlDist'])),trim(strip_tags($_POST['ddlSro'])),trim(strip_tags($_POST['ddlTaluk'])))) exit(0);

if(!$objDDVal->checkVillageFromSRO(trim(strip_tags($_POST['ddlDist'])),trim(strip_tags($_POST['ddlVillage'])),trim(strip_tags($_POST['ddlTaluk'])),trim(strip_tags($_POST['ddlSro'])))) exit(0);

if(!$objDDVal->checkDesamFromSRO(trim(strip_tags($_POST['ddlDist'])),trim(strip_tags($_POST['ddlVillage'])),trim(strip_tags($_POST['ddlTaluk'])),trim(strip_tags($_POST['ddlSro'])),trim(strip_tags($_POST['ddlDesam'])))) exit(0);

//if(!$objDDVal->checkBlockFromSRO(trim(strip_tags($_POST['ddlDist'])),trim(strip_tags($_POST['ddlVillage'])),trim(strip_tags($_POST['ddlTaluk'])),trim(strip_tags($_POST['ddlSro'])),trim(strip_tags($_POST['ddlDesam'])),trim(strip_tags($_POST['txtblock'])))) exit(0);


unset($objDDVal);

	//echo $stat;
        
	// $slno= trim(strip_tags($_POST['txtSlno']));
	 $arr=split('[.-/]',trim(strip_tags($_POST['txtDate'])));
	if (sizeof($arr)>0)
	{
		 $ecyear=$arr[2];
	}
	 $gsno= trim(strip_tags($_POST['txtGsno']));
	 $sro= trim(strip_tags($_POST['ddlSro']));
	 $dcode= trim(strip_tags($_POST['ddlDist']));
	 $tcode=trim(strip_tags( $_POST['ddlTaluk']));
	 $vcode= trim(strip_tags($_POST['ddlVillage']));
          if(isset($_POST['ddlDesam']))
          {
               $desam= trim(strip_tags($_POST['ddlDesam']));
          }
          else
         $desam=0;
         $stat=trim(strip_tags($_GET['stat']));
	 $block= trim(strip_tags($_POST['txtblock']));
	 $rsurno= trim(strip_tags($_POST['txtResurno']));
	 $rsbdvnno= trim(strip_tags($_POST['txtResurSubdiv']));
	 $surno= trim(strip_tags($_POST['txtOldsurno']));
         $sbdvnno= trim(strip_tags($_POST['txtOldsubdivno']));
	 $unit_mf= trim(strip_tags($_POST['ddlUnit']));
	 $hr_acre= trim(strip_tags($_POST['txtHect']));
	 $ar_cent=trim(strip_tags( $_POST['txtAre']));
	 $sqm_sqlink= trim(strip_tags($_POST['txtSqlnk']));
         $remarks= trim(strip_tags($_POST['txtRemark']));
	 $east=trim(strip_tags($_POST['txtEast']));
	 $west=trim(strip_tags($_POST['txtWest']));
	 $north=trim(strip_tags($_POST['txtNorth']));
	 $south=trim(strip_tags($_POST['txtSouth']));
			
         if ( $stat=='N' || $stat=='EAN')
         {
              $slno= $objencumbcertificate->NextSlnosurno($ecyear,$gsno,$stat);
         }
         else
         {
         $slno= trim(strip_tags($_GET['slno']));
         }
	
	 if($hr_acre=="")
             $hr_acre=0;
         if($ar_cent=="")
             $ar_cent=0;
         if($sqm_sqlink=="")
             $sqm_sqlink=0;
	 $objencumbcertificate->setslno($slno);
	 $objencumbcertificate->setecyear($ecyear);
 	 $objencumbcertificate->setgsno($gsno);
	 $objencumbcertificate->setsro($sro);
	 $objencumbcertificate->setdcode($dcode);
	 $objencumbcertificate->settcode($tcode);
	 $objencumbcertificate->setvcode($vcode);
	 $objencumbcertificate->setdesam($desam);
	 $objencumbcertificate->setblock($block);
	 $objencumbcertificate->setrsurno($rsurno);
	 $objencumbcertificate->setrsbdvnno($rsbdvnno);
	 $objencumbcertificate->setsurno($surno);
	 $objencumbcertificate->setsbdvnno($sbdvnno);
	 $objencumbcertificate->setunit_mf($unit_mf);
	 $objencumbcertificate->sethr_acre($hr_acre);
	 $objencumbcertificate->setar_cent($ar_cent);
	 $objencumbcertificate->setsqm_sqlink($sqm_sqlink);
	 $objencumbcertificate->setremarks($remarks);
	 $objencumbcertificate->seteast($east);
	 $objencumbcertificate->setwest($west);
	 $objencumbcertificate->setnorth($north);
	 $objencumbcertificate->setsouth($south);

        // $databaseObj->startTransaction();
      
	$objencumbcertificate->InsertOrUpdateEcsurnos($stat,$databaseObj);
        $objencumbcertificate->GridProperty_display($ecyear,$gsno,$stat,0);

        
    }
    }
    } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
         //=====================save============================================CASE 10======validated========================================
case 10 :
   try
{
     
        //=================================================Validation Started=====================================================

    if (isset($_POST['txtGsno']) and isset($_POST['txtowner']) and isset($_GET['stat']) and isset($_POST['ddlDist']) and isset($_POST['ddlSro']) and isset($_POST['txtDate']) and isset($_POST['txtName']) and isset($_POST['txtHouseno']) and isset($_POST['txtCity']) and  isset($_POST['txtPin']) and isset($_POST['txtEmail']) and isset($_POST['txtPhone']) and isset($_POST['txtmobile']) and isset($_POST['ddlCollectec']) and isset($_GET['tok']) )
    {

        
//,"Email"=>trim(strip_tags($_POST['txtEmail'])),"PhoneNo"=>trim(strip_tags($_POST['txtPhone'])),"Mobile"=>trim(strip_tags($_POST['txtmobile']))
        $assoArray1 = array("Owner Of The Property"=>trim(strip_tags($_POST['txtowner'])),"Gsno"=>trim(strip_tags($_POST['txtGsno'])), "Date"=>trim(strip_tags($_POST['txtDate'])),"Name"=>trim(strip_tags($_POST['txtName'])), "House No/Name"=>trim(strip_tags($_POST['txtHouseno'])), "City/District"=>trim(strip_tags($_POST['txtCity'])));
        //, "Pincode"=>trim(strip_tags($_POST['txtPin']))
        $assoArray2 = array("District"=>trim(strip_tags($_POST['ddlDist'])),"Sub-Registrar Office"=>trim(strip_tags($_POST['ddlSro'])),"Collect the EC (BY)"=>trim(strip_tags($_POST['ddlCollectec'])));


       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }
        
             $assoArray1 = array("Gsno"=>$_POST['txtGsno'],"stat"=>$_GET['stat']);
             $assoArray2 = array("Name"=>$_POST['txtName'],"Owner Of The Property"=>trim(strip_tags($_POST['txtowner'])));
             $assoArray3 = array("House No/Name"=>trim(strip_tags($_POST['txtHouseno'])));
             $assoArray4 = array( "City/District"=>trim(strip_tags($_POST['txtCity'])));
         iF ($objclsPhpValidation->_isSpclChar($assoArray1)!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtDate'])),"Date")!==true)
           {

           exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtGsno'])),"Gsno",5)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlDist'])),"District",2)!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlSro'])),"Sro",4)!==true)
           {
               exit(0);
           }

        iF ($objclsPhpValidation->_isSpclChar($assoArray2,array('.'))!==true)
           {
               exit(0);
           }

        iF ($objclsPhpValidation->_isSpclChar($assoArray3,array('.','-',',','/'))!==true)
           {
              exit(0);
           }
         iF ($objclsPhpValidation->_isSpclChar($assoArray4,array('.','-',','))!==true)
           {
              exit(0);
           }

		iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtPin'])),"Pincode")!==true)
           {
              exit(0);
           }
       iF ($objclsPhpValidation->_isEmail(trim(strip_tags($_POST['txtEmail'])),"EmailID")!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isPhoneNo(trim(strip_tags($_POST['txtPhone'])),"PhoneNumber")!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isPhoneNo(trim(strip_tags($_POST['txtmobile'])),"Mobile")!==true)
           {
              exit(0);
           }
           if(trim(strip_tags($_POST['ddlCollectec']))!=1 and trim(strip_tags($_POST['ddlCollectec']))!=2)
           {
               echo "Mesg: Invalid Collect the EC (BY)";
               exit(0);
           }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtGsno'])), 6, "Gsno")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtDate'])), 10, "Date")!==true)
        {
       exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlDist'])), 2, "District")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlSro'])), 4, "Sub-Registrar Office")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtName'])),30, "Name")!==true)
        {
      exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtHouseno'])), 50,"House No/Name")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtCity'])), 50,"City/District")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtEmail'])),50, "EmailID")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlCollectec'])),1,"Collect the EC (BY)")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['stat'])),3,"stat")!==true)
        {
            exit(0);
        }


    if(isset($_POST['txtFrom']) and isset($_POST['txtTo']) and isset($_POST['txtExtraclaimant']) and isset($_POST['txtExtravillages']) and isset($_POST['ddlTypeofec']) and  isset($_POST['ddlPriority'])) //isset($_POST['ddlModeofPay']))// and isset($_POST['ddlPriority']))
     {

         $assoArray1 = array("From Date"=>trim(strip_tags($_POST['txtFrom'])), "To Date"=>trim(strip_tags($_POST['txtTo'])),"Extra Claimant Nos."=>trim(strip_tags($_POST['txtExtraclaimant'])), "Extra Villages"=>trim(strip_tags($_POST['txtExtravillages'])));

         $assoArray2 = array("Type of EC"=>trim(strip_tags($_POST['ddlTypeofec'])),"Wish to get Priority?"=>trim(strip_tags($_POST['ddlPriority']))); //,"Mode of Payment"=>trim(strip_tags($_POST['ddlModeofPay']))


       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

            exit(0);

       }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }
      
          iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtFrom'])),"From Date"))
           {

           exit(0);
           }
            iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtTo'])),"To Date"))
           {

           exit(0);
           }
             iF (!$objclsPhpValidation->_isDateBeforeToday(trim(strip_tags($_POST['txtFrom'])),"From Date"))
           {

           exit(0);
           }
            iF (!$objclsPhpValidation->_isDateBeforeToday(trim(strip_tags($_POST['txtTo'])),"To Date"))
           {

          exit(0);
           }
            iF (!$objclsPhpValidation->_isDateDiffer(trim(strip_tags($_POST['txtFrom'])),trim(strip_tags($_POST['txtTo'])),"FromDate,ToDate"))
           {

                 exit(0);
           }
        iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtExtraclaimant'])), "Extra Claimant Nos", 5)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtExtravillages'])), "Extra Villages", 5)!==true)
           {
                exit(0);
           }
            iF ((trim(strip_tags($_POST['txtExtraclaimant'])))<=0 || (trim(strip_tags($_POST['txtExtravillages'])))<=0)
           {
                echo  "Mesg: Number of Owners/Number of Villages Should Be Greater Than Zero";
               exit(0);
           }
           
        


    if(isset($_POST['txtpriorityfee']) and isset($_POST['txtownershipfee']) and isset($_POST['txtsearchfee']) and isset($_POST['txtFee']) and isset($_POST['txthCaptcha']))
     {

         $assoArray1 = array("Click Calculate Fee -->Priority Fee"=>trim(strip_tags($_POST['txtpriorityfee'])), "Click Calculate Fee -->Ownership Fee"=>trim(strip_tags($_POST['txtownershipfee'])),"Click Calculate Fee -->Search Fee"=>trim(strip_tags($_POST['txtsearchfee'])), "Click Calculate Fee -->Total Fee Collected"=>trim(strip_tags($_POST['txtFee'])));

         $assoArray2=array("Enter the characters as shown"=>trim(strip_tags($_POST['txthCaptcha'])));

       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

            exit(0);

       }
      
       if ($objclsPhpValidation->_isEmpty($assoArray2)!== true)
       {

           exit(0);

       }
      
       
         
        iF ($objclsPhpValidation->_isDecimal(trim(strip_tags($_POST['txtpriorityfee'])),18,2, "Priority Fee")!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isDecimal(trim(strip_tags($_POST['txtownershipfee'])),18,2, "Ownership Fee")!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isDecimal(trim(strip_tags($_POST['txtsearchfee'])),18,2, "Search Fee")!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isDecimal(trim(strip_tags($_POST['txtFee'])),18,2, "Total Fee Collected")!==true)
           {
               exit(0);
           }
          
        
        iF ($objclsPhpValidation->_isSpclChar($assoArray2)!==true)
           {
               exit(0);
           }
          
           if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtowner'])),30, "Owner Of The Property")!==true)
                {
              exit(0);
                }
$objDDVal = new dropDownValidation();
if(!$objDDVal->checkDistrict(trim(strip_tags($_POST['ddlDist'])))) exit(0);
if(!$objDDVal->checkSRO(trim(strip_tags($_POST['ddlDist'])),trim(strip_tags($_POST['ddlSro'])))) exit(0);
if(!$objDDVal->checkSelectOption("eccode", "code", trim(strip_tags($_POST['ddlTypeofec'])),"Type Of EC")) exit(0);

unset($objDDVal);
               
     $stat=$_GET['stat'];
    
	 $arr=split('[.-/]',trim(strip_tags($_POST['txtDate'])));
       
	if (sizeof($arr)>0)
	{
		 $ecyear=$arr[2];
	}
	 $gsno= trim(strip_tags($_POST['txtGsno']));
	 $sro= trim(strip_tags($_POST['ddlSro']));
	 $appname=trim(strip_tags( $_POST['txtName']));
     $search_from= trim(strip_tags($_POST['txtFrom']));
	 $search_to= trim(strip_tags($_POST['txtTo']));
	 $pin= trim(strip_tags($_POST['txtPin']));
	 $houseno= trim(strip_tags($_POST['txtHouseno']));
	 $city= trim(strip_tags($_POST['txtCity']));
	 $email= trim(strip_tags($_POST['txtEmail']));
     $extravillages= trim(strip_tags($_POST['txtExtravillages']));
	 $extraclaimant= trim(strip_tags($_POST['txtExtraclaimant']));
	 $typeofec= trim(strip_tags($_POST['ddlTypeofec']));
     $collectec= trim(strip_tags($_POST['ddlCollectec']));
     $appdate=trim(strip_tags($_POST['txtDate']));
	 $modeofpayment=trim(strip_tags($_POST['ddlModeofPay']));
	 $phone=trim(strip_tags($_POST['txtPhone']));
	 $mobile=trim(strip_tags($_POST['txtmobile']));
	 $appfee=1;
	 $priorityfee=trim(strip_tags($_POST['txtpriorityfee']));
	 $ownershipfee=trim(strip_tags($_POST['txtownershipfee'])); 
	 $searchfee=trim(strip_tags($_POST['txtsearchfee']));
	 $totfee=trim(strip_tags($_POST['txtFee']));
          $dcode=trim(strip_tags($_POST['ddlDist']));
         
          $owner=trim(strip_tags($_POST['txtowner']));
          

         $objencumbcertificate->setowner($owner);
	 $objencumbcertificate->setecyear($ecyear);
 	 $objencumbcertificate->setgsno($gsno);
	 $objencumbcertificate->setsro($sro);
	 $objencumbcertificate->setappname($appname);
	 $objencumbcertificate->setsearch_from($search_from);
	 $objencumbcertificate->setsearch_to($search_to);
	 $objencumbcertificate->setappdate($appdate);
	 $objencumbcertificate->setpin($pin);
	 $objencumbcertificate->setemail($email);
	 $objencumbcertificate->sethouseno($houseno);
	 $objencumbcertificate->setcity($city);
	 $objencumbcertificate->setextravillages($extravillages);
	 $objencumbcertificate->setextraclaimant($extraclaimant);
	 $objencumbcertificate->settypeofec($typeofec);
	 $objencumbcertificate->setcollectec($collectec);
	 $objencumbcertificate->setmodeofpayment($modeofpayment);
	 $objencumbcertificate->setmobile($mobile);
	 $objencumbcertificate->setphone($phone);
	 $objencumbcertificate->setappfee($appfee);
	 $objencumbcertificate->setpriorityfee($priorityfee);
	 $objencumbcertificate->setownershipfee($ownershipfee);
	 $objencumbcertificate->setsearchfee($searchfee);
	 $objencumbcertificate->settotfee($totfee);
         $objencumbcertificate->setdcode($dcode);
         
	// $databaseObj->startTransaction();
            
	 $objencumbcertificate->save(trim(strip_tags($_POST['txthCaptcha'])),$stat,$databaseObj);
         
	 //$databaseObj->commit();
	 //$_SESSION['year']=$ecyear;
     }
     }
    }
	 } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
 
         //====================loadpropertydiv==================================CASE 13========validated======================================
case 13:

  try
{
    if(isset($_GET['txtGsno']) and isset($_GET['txtDate']) and isset($_GET['ddlSro']) and isset($_GET['pk']) and isset($_GET['stat']) and isset($_GET['ddlDist']) and isset($_GET['tok']) )
     {
       
        $assoArray1 = array("Gsno"=>trim(strip_tags($_GET['txtGsno'])), "Date"=>trim(strip_tags($_GET['txtDate'])));
        $assoArray2 = array("Sub-Registrar Office"=>trim(strip_tags($_GET['ddlSro'])),"District"=>trim(strip_tags($_GET['ddlDist'])));

        $assoArray3 = array("pk"=>trim(strip_tags($_GET['pk'])));
        $assoArray4 = array("Gsno"=>trim(strip_tags($_GET['txtGsno'])),"stat"=>trim(strip_tags($_GET['stat'])));


       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

          exit(0);

       }
        iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_GET['txtDate'])),"Date"))
           {

          exit(0);
           }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }
       if (!$objclsPhpValidation->_isSpclChar($assoArray3,array("/")))
       {

           exit(0);

       }
         if (!$objclsPhpValidation->_isSpclChar($assoArray4))
       {

           exit(0);

       }

 iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtGsno'])),"Gsno",5)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlDist'])),"District",2)!==true)
           {
               exit(0);
           }
    iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlSro'])),"Sro",4)!==true)
           {
               exit(0);
           }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['txtGsno'])), 6, "Gsno")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['txtDate'])), 10, "Date")!==true)
        {
      exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['ddlDist'])), 2, "District")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['ddlSro'])), 4, "Sub-Registrar Office")!==true)
        {
            exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['pk'])), 20, "pk")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['stat'])), 3, "stat")!==true)
        {
           exit(0);
        }

      
    
          $gsno= trim(strip_tags($_GET['txtGsno']));
	 $sro= trim(strip_tags($_GET['ddlSro']));
	//$gsno=$_SESSION['rno'];
        $stat= trim(strip_tags($_GET['stat']));
       
     $arr=split('[.-/]',trim(strip_tags($_GET['txtDate'])));
	 if (sizeof($arr)>0)
	 {
		 $ecyear=$arr[2];
	 } 
	 
	 $text=explode("/",trim(strip_tags($_GET['pk'])));
	 if (sizeof($text)>0)
	 {   $slno=$text[1];
		 $ecyear=$text[2];
		 $gsno=$text[3];
	 }
         if ($stat=="EA")
             $query="select * from ecsurnos where slno=$slno and ecyear='$ecyear' and (gsno=$gsno or gsno=".$_SESSION['rno'].")";
             else
	 $query="select * from ecsurnos where slno=$slno and ecyear='$ecyear' and  gsno=".$_SESSION['rno'];
	//echo $query;
	 $result=OpenPearlDataBase::getInstance()->executeQuery($query);
   	 $rows=$result->fetchRow();
	 
	 $objencumbcertificate->Loadproperty($stat,$rows['slno'],$rows['dcode'],$rows['tcode'],$rows['vcode'],
							$rows['desam'],$rows['surno'],$rows['sbdvnno'],$rows['rsurno'],$rows['rsbdvnno'],$rows['block']
							,$rows['unit_mf'],$rows['hr_acre'],$rows['ar_cent'],$rows['sqm_sqlink'],$rows['remarks'],
		 					$rows['east'],$rows['west'],$rows['south'],$rows['north'],$ecyear,$gsno,$sro);
		 
          //$objencumbcertificate->GridProperty_display($ecyear,$gsno,"E");
		
}
} //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
//========================GetDeletetableRowDoc===================CASE 14========validated======================================
case 14:
try
{
    
    if(isset($_GET['txtGsno']) and isset($_GET['txtDate']) and isset($_GET['ddlSro']) and isset($_GET['pk']) and isset($_GET['stat']) and isset($_GET['ddlDist']) and isset($_GET['tok']) )
     {
         
        $assoArray1 = array("Gsno"=>trim(strip_tags($_GET['txtGsno'])), "Date"=>trim(strip_tags($_GET['txtDate'])));
        $assoArray2 = array("Sub-Registrar Office"=>trim(strip_tags($_GET['ddlSro'])),"District"=>trim(strip_tags($_GET['ddlDist'])));

        $assoArray3 = array("pk"=>trim(strip_tags($_GET['pk'])));
        $assoArray4 = array("Gsno"=>trim(strip_tags($_GET['txtGsno'])),"stat"=>trim(strip_tags($_GET['stat'])));


       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

          exit(0);

       }

        iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_GET['txtDate'])),"Date"))
           {

           exit(0);
           }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }
       if (!$objclsPhpValidation->_isSpclChar($assoArray3,array("/")))
       {

           exit(0);

       }
         if (!$objclsPhpValidation->_isSpclChar($assoArray4))
       {

           exit(0);

       }
       iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlDist'])),"District",2)!==true)
           {
               exit(0);
           }
    iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlSro'])),"Sro",4)!==true)
           {
               exit(0);
           }
iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtGsno'])),"Gsno",5)!==true)
           {
               exit(0);
           }
//================================================length check===================================================
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['txtGsno'])), 5, "Gsno")!==true)
        {
           exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['txtDate'])), 10, "Date")!==true)
        {
            exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['ddlDist'])), 2, "District")!==true)
        {
           exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['ddlSro'])), 4, "Sub-Registrar Office")!==true)
        {
           exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['pk'])),20, "pk")!==true)
        {
           exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['stat'])), 3, "stat")!==true)
        {
           exit(0);
        }
         $sro= trim(strip_tags($_GET['ddlSro']));
	 $gsno= trim(strip_tags($_GET['txtGsno']));
         $stat=$_GET['stat'];
	// if($stat!='EA')
	// $gsno=$_SESSION['rno'];

         $arr=split('[.-/]',trim(strip_tags($_GET['txtDate'])));
	 if (sizeof($arr)>0)
	 {
		 $ecyear=$arr[2];
	 }

	 $text=explode('/',trim(strip_tags($_GET['pk'])));
	 if (sizeof($text)>0)
	 {   $year=$text[1];
		 $bookno=$text[2];
		 $docno=$text[3];
	 }

          $_query="";


                                $objAuditTrail = new AuditTrail();

                                $clientIp=$objAuditTrail->getRealIpAddr();
				$objAuditTrail->setUserName($_SESSION['userName']);
				$objAuditTrail->setClientIp($clientIp);
				$objAuditTrail->setPageAccessed('encumbcertificate.php');
				$objAuditTrail->setPageAccessTime(date('Y-m-d h:i:s'));
				$objAuditTrail->setTask(2);
                                $databaseObj->startTransaction();

                 $query="delete from ecdocnos where docyear='$year' and bookno='$bookno' and docno='$docno' and ecyear='$ecyear' and (gsno=$gsno or gsno=".$_SESSION['rno'].") and sro_code='$sro'";
                  $result=$databaseObj->executeTransactionQueryNew($query);

                       if($result==true)
				 {
					 $_query=$query;
                                         $q= addslashes($_query);
					 $objAuditTrail->setQuery($q);
					 $aResult = $objAuditTrail->setAuditAccess($databaseObj);

					 if($aResult==true)
					 {
						$databaseObj->commit();


					 }
					 else
					 {       $objAuditTrail->writetoText($query);
						 $databaseObj->abort();
                                                 $databaseObj->commit();
						 echo "Mesg: Unable To Delete Document Details. Retry After Some Time";
                                                 exit(0);
					 }
				}
				else
				{
					$databaseObj->abort();
                                        $databaseObj->commit();
					 echo "Mesg: Unable To Delete Document Details. Retry After Some Time";
                                         exit(0);
				}


		 $objencumbcertificate->GridDocument_display($ecyear,$gsno,$stat);

    

     }
     } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;

//=======GetDeletetableRowProp==================================================CASE 15=======validated=======================================

         case 15:

             try
         {
    if(isset($_GET['txtGsno']) and isset($_GET['txtDate']) and isset($_GET['ddlSro']) and isset($_GET['pk']) and isset($_GET['stat']) and isset($_GET['ddlDist']) and isset($_GET['tok']))
     {
        
        $assoArray1 = array("Gsno"=>trim(strip_tags($_GET['txtGsno'])), "Date"=>trim(strip_tags($_GET['txtDate'])));
        $assoArray2 = array("Sub-Registrar Office"=>trim(strip_tags($_GET['ddlSro'])),"District"=>trim(strip_tags($_GET['ddlDist'])));

        $assoArray3 = array("pk"=>trim(strip_tags($_GET['pk'])));
        $assoArray4 = array("Gsno"=>trim(strip_tags($_GET['txtGsno'])),"stat"=>trim(strip_tags($_GET['stat'])));


       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }

        iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_GET['txtDate'])),"Date"))
           {

          exit(0);
           }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

           exit(0);

       }
       if (!$objclsPhpValidation->_isSpclChar($assoArray3,array("/")))
       {

           exit(0);

       }
         if (!$objclsPhpValidation->_isSpclChar($assoArray4))
       {

           exit(0);

       }
iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtGsno'])),"Gsno",5)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlDist'])),"District",2)!==true)
           {
               exit(0);
           }
    iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlSro'])),"Sro",4)!==true)
           {
               exit(0);
           }
//================================================length check===================================================
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['txtGsno'])), 6, "Gsno")!==true)
        {
           exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['txtDate'])), 10, "Date")!==true)
        {
           exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['ddlDist'])), 2, "District")!==true)
        {
           exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['ddlSro'])), 4, "Sub-Registrar Office")!==true)
        {
            exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['pk'])), 20, "pk")!==true)
        {
           exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['stat'])), 3, "stat")!==true)
        {
           exit(0);
        }




    
	 $sro= trim(strip_tags($_GET['ddlSro']));
	 $gsno= trim(strip_tags($_GET['txtGsno']));
         $stat=$_GET['stat'];
	 if($stat!='EA')
	$gsno=$_SESSION['rno'];

     $arr=split('[.-/]',trim(strip_tags($_GET['txtDate'])));
	 if (sizeof($arr)>0)
	 {
		 $ecyear=$arr[2];
	 }

	 $text=explode("/",trim(strip_tags($_GET['pk'])));
	 if (sizeof($text)>0)
	 {


             $slno=$text[1];

	 }
          $_query="";


                                $objAuditTrail = new AuditTrail();

                                $clientIp=$objAuditTrail->getRealIpAddr();
				$objAuditTrail->setUserName($_SESSION['userName']);
				$objAuditTrail->setClientIp($clientIp);
				$objAuditTrail->setPageAccessed('ecfirstsearch.php');
				$objAuditTrail->setPageAccessTime(date('Y-m-d h:i:s'));
				$objAuditTrail->setTask(2);
                                $databaseObj->startTransaction();

	 $query="delete from ecsurnos where   ecyear='$ecyear' and (gsno=$gsno or gsno=".$_SESSION['rno'].") and sro='$sro' and stat='P' and slno='$slno'";

		  $result=$databaseObj->executeTransactionQueryNew($query);

                       if($result==true)
				 {
					 $_query.=$query;
                                          $q= addslashes($_query);
					 $objAuditTrail->setQuery($q);
					 $aResult = $objAuditTrail->setAuditAccess($databaseObj);

					 if($aResult==true)
					 {
						$databaseObj->commit();


					 }
					 else
					 {       $objAuditTrail->writetoText($query);
						 $databaseObj->abort();
                                                 $databaseObj->commit();
						 echo "Mesg: Unable To Delete Property Details. Retry After Some Time";
                                                 exit(0);
					 }
				}
				else
				{
					$databaseObj->abort();
                                        $databaseObj->commit();
					 echo "Mesg: Unable To Delete Property Details. Retry After Some Time";
                                         exit(0);
				}

		 $objencumbcertificate->GridProperty_display($ecyear,$gsno,$stat);
    


     }
     } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }

	 break;
//========================Paging==doc===========================================CASE 16=======validated=======================================
case 16:
    try
{
      if(isset($_GET['offset']) and isset($_GET['stat']) and isset($_GET['txtDate']) and isset($_GET['txtGsno']))
    {
           $offset=trim(strip_tags($_GET['offset']));
         if(trim(strip_tags($_GET['offset']))<0 or trim(strip_tags($_GET['offset']))=="")
         {
         $offset=0;
         }
      
 $assoArray1 = array("Gsno"=>trim(strip_tags($_GET['txtGsno'])), "Date"=>trim(strip_tags($_GET['txtDate'])));
     if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           $mesg.=$objclsPhpValidation->_isEmpty($assoArray1);

       }
       iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtGsno'])),"Gsno",5)!==true)
           {
               exit(0);
           }
 iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_GET['txtDate'])),"Date"))
           {

          exit(0);
           }
  $assoArray4 = array("Gsno"=>trim(strip_tags($_GET['txtGsno'])),"stat"=>trim(strip_tags($_GET['stat'])));
   if (!$objclsPhpValidation->_isSpclChar($assoArray4))
       {

           exit(0);

       }
    

$stat=$_GET['stat'];

$arr=split('[.-/]',trim(strip_tags($_GET['txtDate'])));
	 if (sizeof($arr)>0)
	 {
		 $ecyear=$arr[2];
	 }
	//$gsno=$_SESSION['rno'];
		 $gsno= trim(strip_tags($_GET['txtGsno']));

$objencumbcertificate->GridDocument_display($ecyear,$gsno,$stat,$offset);
    }
    } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }

 break;
 //=========================Paging==prop========================================CASE 17========validated======================================
case 17:
    try
{
    if(isset($_GET['offset']) and isset($_GET['stat']) and isset($_GET['txtDate']) and isset($_GET['txtGsno']) and isset($_GET['tok']))
    {
         $offset=trim(strip_tags($_GET['offset']));
         if(trim(strip_tags($_GET['offset']))<0 or trim(strip_tags($_GET['offset']))=="")
         {
         $offset=0;
         }
        
    $assoArray1 = array("Gsno"=>trim(strip_tags($_GET['txtGsno'])), "Date"=>trim(strip_tags($_GET['txtDate'])));
     if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           $mesg.=$objclsPhpValidation->_isEmpty($assoArray1);

       }
       iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtGsno'])),"Gsno",5)!==true)
           {
               exit(0);
           }
 iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_GET['txtDate'])),"Date"))
           {

          exit(0);
           }
  $assoArray4 = array("Gsno"=>trim(strip_tags($_GET['txtGsno'])),"stat"=>trim(strip_tags($_GET['stat'])));
   if (!$objclsPhpValidation->_isSpclChar($assoArray4))
       {

           exit(0);

       }

$stat=$_GET['stat'];

$arr=split('[.-/]',trim(strip_tags($_GET['txtDate'])));
	 if (sizeof($arr)>0)
	 {
		 $ecyear=$arr[2];
	 }
	 $gsno=trim(strip_tags($_GET['txtGsno']));
	// echo 'gsno='.$gsno;
	// echo 'stat='.$stat;

	 if($stat!='EA')
	$gsno=$_SESSION['rno'];
$objencumbcertificate->GridProperty_display($ecyear,$gsno,$stat,$offset);
    }
    } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
  break;
 
 //=============LoadDocument====================================================CASE 18===========validated===================================
 case 18:

try
 {
    
    if(isset($_GET['txtGsno']) and isset($_GET['txtDate']) and isset($_GET['ddlSro']) and isset($_GET['pk']) and isset($_GET['stat']) and isset($_GET['ddlDist']) and isset($_GET['tok']) )
     {
        
        $assoArray1 = array("Gsno"=>trim(strip_tags($_GET['txtGsno'])), "Date"=>trim(strip_tags($_GET['txtDate'])));
        $assoArray2 = array("Sub-Registrar Office"=>trim(strip_tags($_GET['ddlSro'])),"District"=>trim(strip_tags($_GET['ddlDist'])));

        $assoArray3 = array("pk"=>trim(strip_tags($_GET['pk'])));
        $assoArray4 = array("Gsno"=>trim(strip_tags($_GET['txtGsno'])),"stat"=>trim(strip_tags($_GET['stat'])));


       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           $mesg.=$objclsPhpValidation->_isEmpty($assoArray1);

       }
       iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtGsno'])),"Gsno",5)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlDist'])),"District",2)!==true)
           {
               exit(0);
           }
    iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlSro'])),"Sro",4)!==true)
           {
               exit(0);
           }
        iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_GET['txtDate'])),"Date"))
           {

          exit(0);
           }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

           exit(0);

       }
       if (!$objclsPhpValidation->_isSpclChar($assoArray3,array("/")))
       {

           exit(0);

       }
         if (!$objclsPhpValidation->_isSpclChar($assoArray4))
       {

           exit(0);

       }


        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['txtGsno'])), 6, "Gsno")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['txtDate'])), 10, "Date")!==true)
        {
       exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['ddlDist'])), 2, "District")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['ddlSro'])), 4, "Sub-Registrar Office")!==true)
        {
            exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['pk'])), 20, "pk")!==true)
        {
             exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['stat'])), 3, "stat")!==true)
        {
           exit(0);
        }


    
         $stat=trim(strip_tags($_GET['stat']));
	 $sro= trim(strip_tags($_GET['ddlSro']));
	 $gsno= trim(strip_tags($_GET['txtGsno']));
	// if($stat!='EA')
	//$gsno=$_SESSION['rno'];

     $arr=split('[.-/]',trim(strip_tags($_GET['txtDate'])));
	 if (sizeof($arr)>0)
	 {
		 $ecyear=$arr[2];
	 }

	 $text=explode("/",trim(strip_tags($_GET['pk'])));
	 if (sizeof($text)>0)
	 {   $year=$text[1];
		 $bookno=$text[2];
		 $docno=$text[3];
	 }
	

         if($stat=="EA")
             $query="select slno,docno,bookno,docyear  from ecdocnos where docyear='$year' and bookno='$bookno' and docno='$docno' and ecyear='$ecyear' and (gsno=$gsno or gsno=".$_SESSION['rno'].") and sro_code='$sro'";
         
            
         else
              $query="select slno,docno,bookno,docyear  from ecdocnos where docyear='$year' and bookno='$bookno' and docno='$docno' and ecyear='$ecyear' and gsno=".$_SESSION['rno']." and sro_code='$sro'";
			//echo  $query;
		 $result=OpenPearlDataBase::getInstance()->executeQuery($query);
		 $rows=$result->fetchRow();//$stat="",$gsno="",$dcode="",$sro="",$name="",$houseno="",$city="",$pin="",$email="",$=collectec""
		 $objencumbcertificate->LoadDocument($stat,$rows['slno'],$rows['docno'],$rows['docyear'],$rows['bookno']);


		
                }
 } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
 //=================SubmitDocumentdet===========================================CASE 19=========validated============================================================================================
case 19: 
    try
{
 
        //=================================================Validation Started=====================================================

    if (isset($_POST['txtGsno']) and isset($_GET['stat']) and isset($_POST['ddlDist']) and isset($_POST['ddlSro']) and isset($_POST['txtDate']) and isset($_POST['txtName']) and isset($_POST['txtHouseno']) and isset($_POST['txtCity']) and  isset($_POST['txtPin']) and isset($_POST['txtEmail']) and isset($_POST['txtPhone']) and isset($_POST['txtmobile']) and isset($_POST['ddlCollectec']) and isset($_GET['tok']) )
    {

        
//,"Email"=>trim(strip_tags($_POST['txtEmail'])),"PhoneNo"=>trim(strip_tags($_POST['txtPhone'])),"Mobile"=>trim(strip_tags($_POST['txtmobile']))
        $assoArray1 = array("Gsno"=>trim(strip_tags($_POST['txtGsno'])), "Date"=>trim(strip_tags($_POST['txtDate'])),"Name"=>trim(strip_tags($_POST['txtName'])), "House No/Name"=>trim(strip_tags($_POST['txtHouseno'])), "City/District"=>trim(strip_tags($_POST['txtCity'])));//, "Pincode"=>trim(strip_tags($_POST['txtPin']))
        $assoArray2 = array("District"=>trim(strip_tags($_POST['ddlDist'])),"Sub-Registrar Office"=>trim(strip_tags($_POST['ddlSro'])),"Collect the EC (BY)"=>trim(strip_tags($_POST['ddlCollectec'])));


       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }

             $assoArray1 = array("Gsno"=>$_POST['txtGsno'],"stat"=>$_GET['stat']);
             $assoArray2 = array("Name"=>$_POST['txtName']);
             $assoArray3 = array("House No/Name"=>trim(strip_tags($_POST['txtHouseno'])));
             $assoArray4 = array( "City/District"=>trim(strip_tags($_POST['txtCity'])));
         iF ($objclsPhpValidation->_isSpclChar($assoArray1)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtGsno'])),"Gsno",5)!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtDate'])),"Date")!==true)
           {

           exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlDist'])),"District",2)!==true)
           {
               exit(0);
           }
    iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlSro'])),"Sro",4)!==true)
           {
               exit(0);
           }
            $objDDVal=new dropDownValidation();
            if(!$objDDVal->checkDistrict(trim(strip_tags($_POST['ddlDist'])))) exit(0);
            if(!$objDDVal->checkSRO(trim(strip_tags($_POST['ddlDist'])),trim(strip_tags($_POST['ddlSro'])))) exit(0);



        iF ($objclsPhpValidation->_isSpclChar($assoArray2,array('.'))!==true)
           {
               exit(0);
           }

        iF ($objclsPhpValidation->_isSpclChar($assoArray3,array('.','-',',','/'))!==true)
           {
              exit(0);
           }
         iF ($objclsPhpValidation->_isSpclChar($assoArray4,array('.','-',','))!==true)
           {
              exit(0);
           }

		iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtPin'])),"Pincode")!==true)
           {
              exit(0);
           }
       iF ($objclsPhpValidation->_isEmail(trim(strip_tags($_POST['txtEmail'])),"EmailID")!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isPhoneNo(trim(strip_tags($_POST['txtPhone'])),"PhoneNumber")!==true)
           {
               exit(0);
           }
        iF ($objclsPhpValidation->_isPhoneNo(trim(strip_tags($_POST['txtmobile'])),"Mobile")!==true)
           {
              exit(0);
           }
           if(trim(strip_tags($_POST['ddlCollectec']))!=1 and trim(strip_tags($_POST['ddlCollectec']))!=2)
           {
               echo "Mesg: Invalid Collect the EC (BY)";
               exit(0);
           }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtGsno'])), 6, "Gsno")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtDate'])), 10, "Date")!==true)
        {
       exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlDist'])), 2, "District")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlSro'])), 4, "Sub-Registrar Office")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtName'])),30, "Name")!==true)
        {
      exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtHouseno'])), 50,"House No/Name")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtCity'])), 50,"City/District")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtEmail'])),50, "EmailID")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['ddlCollectec'])),1,"Collect the EC (BY)")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['stat'])),3,"stat")!==true)
        {
            exit(0);
        }

        unset($objDDVal);


  if(isset($_POST['txtBookno']) and isset($_POST['txtDocno']) and isset($_POST['txtYear']) and isset($_GET['slno']))
    {

       $assoArray = array("Year"=>trim(strip_tags($_POST['txtYear'])),"BookNo"=>trim(strip_tags($_POST['txtBookno'])),"DocNo"=>trim(strip_tags($_POST['txtDocno'])));

        if ($objclsPhpValidation->_isEmpty($assoArray)!== true)
           {
              exit(0);

           }
           $assoArray1 = array("Docno"=>$_POST['txtDocno'],"BookNo"=>$_POST['txtBookno']);


         iF ($objclsPhpValidation->_isSpclChar($assoArray1)!==true)
           {
              exit(0);
           }

        iF ($objclsPhpValidation->_isYear(trim(strip_tags($_POST['txtYear'])))!==true)
           {
             exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['slno'])),"Slno",2)!==true)
           {
             exit(0);
           }
            if (trim(strip_tags($_POST['txtBookno']))!="1" and trim(strip_tags($_POST['txtBookno']))!="3" and trim(strip_tags($_POST['txtBookno']))!="")
            {
                echo "Mesg: Invalid Book No";
                exit(0);
            }
         if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtBookno'])), 1, "BookNo")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtDocno'])), 6, "DocNo")!==true)
        {
            exit(0);
        }








     //=================================================Validation Over=====================================================

     
	$arr=split('[.-/]',trim(strip_tags($_POST['txtDate'])));
		
	 if (sizeof($arr)>0)
	 {
		 $ecyear=$arr[2];
	 } 
	
	 $gsno= trim(strip_tags($_POST['txtGsno']));
	 $sro= trim(strip_tags($_POST['ddlSro']));
	 $bookno=trim(strip_tags($_POST['txtBookno']));
	 $docno=trim(strip_tags($_POST['txtDocno']));
         $year=trim(strip_tags($_POST['txtYear']));

	 $slnodoc=trim(strip_tags($_GET['slno']));
          

         $dcode=trim(strip_tags($_POST['ddlDist']));
           
	 $objencumbcertificate->setbookno($bookno);
 	 $objencumbcertificate->setdocno($docno);
	 $objencumbcertificate->setyear($year);
			
	 $stat=trim(strip_tags($_GET['stat']));
         //$slnodoc=$objencumbcertificate->NextSlnodocRno($ecyear,$gsno,$stat);
        // $databaseObj->startTransaction();
	 $objencumbcertificate->insertecdonos($stat,$ecyear,$gsno,$sro,$slnodoc,$bookno,$docno,$year,$dcode,$databaseObj);
         
	 // commented $objencumbcertificate-> showdocdet(0,$stat,$gsno,$sro,$ecyear);
	 	$objencumbcertificate->GridDocument_display($ecyear,$gsno,$stat);
         

 //$
    }
    }
    } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
   
	 break;

 //=====================LoadDeclaration=================================CASE 21==============================================
case 21:
    try
{
   if (isset($_GET['tok']))
   {

    
        /* @var $_SESSION <type> */
        $transid=trim(strip_tags($_SESSION['trans_id']));
        
        
	$objencumbcertificate->LoadDeclaration($transid);
       
   }
   } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
         //=================LoadSuccessmsg======================================CASE 22=========validated=====================================
case 22:
    try
{
    if( isset($_GET['tok']))
    {
        /*$assoArray1 = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));

        if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
        $assoArray = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));
        if (!$objclsPhpValidation->_isSpclChar($assoArray))
       {

           exit(0);

       }


    if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['transid'])), 8,"Transaction ID")!==true)
            {
                 exit(0);
            }
            if(strlen(trim(strip_tags($_GET['transid'])))!=8)
            {
                echo "Mesg: Invalid Transaction ID";
                exit(0);
            }*/

     
	$objencumbcertificate->SuccessMsg(trim(strip_tags($_SESSION['trans_id'])));
    }
    } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
         //=======================LoadAcknowledgement===========================CASE 23======validated========================================
case 23:
    try
{
    unset($_SESSION['trans_id']);
	if (isset($_GET['transid']) and isset($_GET['tok']))
	{
             $assoArray1 = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));

        if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
        
       $assoArray = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));
        if (!$objclsPhpValidation->_isSpclChar($assoArray))
       {

           exit(0);

       }
        

    if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['transid'])), 8,"Transaction ID")!==true)
            {
                 exit(0);
            }
            if(strlen(trim(strip_tags($_GET['transid'])))!=8)
            {
                echo "Mesg: Invalid Transaction ID";
                exit(0);
            }
		 
		$objencumbcertificate->Acknowledgement(trim(strip_tags($_GET['transid'])));
	}
        } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
         //==============CalculateFee===========================================CASE 24===========validated===================================
case 24:
   try
{
    if(isset($_GET['txtFrom']) and isset($_GET['txtTo']) and isset($_GET['txtExtraclaimant']) and isset($_GET['txtExtravillages']) and isset($_GET['ddlTypeofec']) and  isset($_GET['ddlPriority']) and isset($_GET['tok']) ) //isset($_GET['ddlModeofPay']))// and isset($_GET['ddlPriority']))
     {
       
        
         $assoArray1 = array("From Date"=>trim(strip_tags($_GET['txtFrom'])), "To Date"=>trim(strip_tags($_GET['txtTo'])),"Extra Claimant Nos."=>trim(strip_tags($_GET['txtExtraclaimant'])), "Extra Villages"=>trim(strip_tags($_GET['txtExtravillages'])));

         $assoArray2 = array("Type of EC"=>trim(strip_tags($_GET['ddlTypeofec'])),"Wish to get Priority?"=>trim(strip_tags($_GET['ddlPriority']))); //,"Mode of Payment"=>trim(strip_tags($_GET['ddlModeofPay']))



       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }
      
          iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_GET['txtFrom'])),"From Date"))
           {

          exit(0);
           }
            iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_GET['txtTo'])),"To Date"))
           {

          exit(0);
           }
           iF (!$objclsPhpValidation->_isDateBeforeToday(trim(strip_tags($_GET['txtFrom'])),"From Date"))
           {

         exit(0);
           }
            iF (!$objclsPhpValidation->_isDateBeforeToday(trim(strip_tags($_GET['txtTo'])),"To Date"))
           {

         exit(0);
           }
            iF (!$objclsPhpValidation->_isDateDiffer(trim(strip_tags($_GET['txtFrom'])),trim(strip_tags($_GET['txtTo'])),"FromDate,ToDate"))
           {

                exit(0);
           }
        iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtExtraclaimant'])), "Extra Claimant Nos", 3)!==true)
           {
              exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtExtravillages'])), "Extra Villages", 3)!==true)
           {
               exit(0);
           }
            if(!$objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlTypeofec'])),"Type of EC",2))
            {
                exit(0);
            }
            $objDDVal = new dropDownValidation();
            if(!$objDDVal->checkSelectOption("eccode", "code", trim(strip_tags($_GET['ddlTypeofec'])),"Type Of EC")) exit(0);
            unset($objDDVal);
            if(trim(strip_tags($_GET['ddlPriority']))!=1 and trim(strip_tags($_GET['ddlPriority']))!=2)
            {
                echo "Mesg: Invalid Priority";
                exit(0);
            }


         
       
	 $eccode = trim(strip_tags($_GET['ddlTypeofec']));
	 $claimno=trim(strip_tags($_GET['txtExtraclaimant']));
	 $villno = trim(strip_tags($_GET['txtExtravillages']));
	 $prior=trim(strip_tags($_GET['ddlPriority']));
	
         
      
           
            
        
        
                 
	 $arrfrom=split('[/.-]',trim(strip_tags($_GET['txtFrom'])));
        
	 if (sizeof($arrfrom)>0)
	 {
		 $yearfrom=$arrfrom[2];
	 } 
	 $arrto=split('[/.-]',trim(strip_tags($_GET['txtTo'])));
	 if (sizeof($arrto)>0)
	 {
		 $yearto=$arrto[2];
	 } 


	$objencumbcertificate->CalculateFee($eccode,$yearfrom,$yearto,$claimno,$villno,$prior);
     }
     } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
  
   
case 27:
try
{
   if (isset($_GET['lang']) and isset($_GET['tok']))
	{
		
		$_SESSION['lang']=(trim(strip_tags($_GET['lang'])));
                //echo $_SESSION['lang'];
                $objencumbcertificate->Loadapplnform("N");

	}
        } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	  break;

 //===================cancelApplication=========================================CASE 28=============validated=================================
case 28:
    try
{
    if(isset($_GET['transid']))
    {
         $assoArray1 = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));

        if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
        $assoArray = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));
        if (!$objclsPhpValidation->_isSpclChar($assoArray))
       {

           exit(0);

       }

    if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['transid'])), 8,"Transaction ID")!==true)
            {
                 exit(0);
            }
             if(strlen(trim(strip_tags($_GET['transid'])))!=8)
            {
                echo "Mesg: Invalid Transaction ID";
                exit(0);
            }

    
 	 $transid = trim(strip_tags($_GET['transid']));

          $query="select * from ecregister where trans_id='$transid' and trim(applicationstatus) in('E','N')";

		 $result=OpenPearlDataBase::getInstance()->executeQuery($query);
		 $rows=$result->fetchRow();
		 if($rows==0)
		 {
		 echo "Mesg: No Such Application Exists";
		 exit(0);
		 }

                 
	 $databaseObj->startTransaction();
	 $objencumbcertificate->CancelApplication($transid,$databaseObj);
	 //$databaseObj->commit();
    }
    } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
//-------------Edit Appln-toggle language------------------------start---------------------------
         
   case 29:
      try
		{

        if ( isset($_GET['tok']) and isset($_GET['gsno']))
	{
		 
		
                $gsno=trim(strip_tags($_GET['gsno']));

	 $query="select sro,appname,addr1,addr2,pin,email,collectec,appdate,search_from,search_to,remarks,extravillages,
	 		extraclaimants,typeofec,modeofpayment,phone,mobile,appfee,priorityfee,ownershipfee,searchfee,
			totfee,ecyear,gsno,stat from ecregister where gsno=".$gsno." and applicationstatus in('E','N') and stat='S'";
			//echo $query;
		 $result=OpenPearlDataBase::getInstance()->executeQuery($query);
		 $rows=$result->fetchRow();//$stat="",$gsno="",$dcode="",$sro="",$name="",$houseno="",$city="",$pin="",$email="",$=collectec""
		 if($rows==0)
		 {
		 echo "Mesg: No Such Application Exists";
		 exit(0);
		 }
	     $dcode=substr($rows['sro'],0,2);


		 $objencumbcertificate->Loadapplnform("EA",$rows['gsno'],$dcode,$rows['sro'],$rows['appname'],$rows['addr1'],$rows['addr2'],
		 $rows['pin'],$rows['email'],$rows['collectec'],$rows['appdate'],$rows['search_from'],$rows['search_to'],$rows['remarks'],
		 $rows['extravillages'],$rows['extraclaimants'],$rows['typeofec'],$rows['mobile'],$rows['phone'],$rows['modeofpayment'],$rows['totfee'],         $rows['priorityfee'],$rows['ownershipfee'],
		 $rows['searchfee'],$rows['ecyear'],$rows['owner'],$rows['stat']);
	        }
               } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }

	 break;
   
         
//================EditAppln()========editecapln.php=============================CASE 30============validated==================================
case 30:
		try
		{
   
    if (isset($_GET['transid']))
    { 
         $assoArray1 = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));

        if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
         $assoArray = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));
        if (!$objclsPhpValidation->_isSpclChar($assoArray))
       {

           exit(0);

       }

    if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['transid'])), 8,"Transaction ID")!==true)
            {
                 exit(0);
            }
    if(strlen(trim(strip_tags($_GET['transid'])))!=8)
            {
                echo "Mesg: Invalid Transaction ID";
                exit(0);
            }
    
         $assoArray1 = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));

        if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
         $assoArray = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));
        if (!$objclsPhpValidation->_isSpclChar($assoArray))
       {

           exit(0);

       }

    if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['transid'])), 8,"Transaction ID")!==true)
            {
                 exit(0);
            }
             if(strlen(trim(strip_tags($_GET['transid'])))!=8)
            {
                echo "Mesg: Invalid Transaction ID";
                exit(0);
            }
         $transid=trim(strip_tags($_GET['transid']));
        $_SESSION['trans_id']= $transid;

        $objencumbcertificate->settransid($_SESSION['trans_id']);

 

	 $query="select sro,appname,addr1,addr2,pin,email,collectec,appdate,search_from,search_to,remarks,extravillages,
	 		extraclaimants,typeofec,modeofpayment,phone,mobile,appfee,priorityfee,ownershipfee,searchfee,
			totfee,ecyear,gsno,owner,stat from ecregister where trans_id='$transid' and applicationstatus not in ('D') and stat='S'";
		
		 $result=OpenPearlDataBase::getInstance()->executeQuery($query);
		 $rows=$result->fetchRow();
		 if($rows==0)
		 {
		 echo "Mesg: No Such Application Exists";
		 exit(0);
		 }
	     $dcode=substr($rows['sro'],0,2);


		 $objencumbcertificate->Loadapplnform("EA",$rows['gsno'],$dcode,$rows['sro'],$rows['appname'],$rows['addr1'],$rows['addr2'],
		 $rows['pin'],$rows['email'],$rows['collectec'],$rows['appdate'],$rows['search_from'],$rows['search_to'],$rows['remarks'],
                 $rows['extravillages'],$rows['extraclaimants'],$rows['typeofec'],$rows['mobile'],$rows['phone'],$rows['modeofpayment'],
                 $rows['totfee'],$rows['priorityfee'],$rows['ownershipfee'],$rows['searchfee'],$rows['ecyear'],$rows['owner'],$rows['stat']);
	   

		 }
               } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }

	 break;
         
 //=========fillHectre()=========ecfirstsearch.php==&==editecapln.php==================CASE 31======validated========================================
         case 31:
            try
         {
            if( isset($_GET['ddlUnit'] ) and isset($_GET['tok']))
            {
                if (trim(strip_tags($_GET['ddlUnit']))!=1 and trim(strip_tags($_GET['ddlUnit']))!=2)
                {
                    echo  "Mesg: Invalid Unit";
                     exit(0);
                }
                
                $objencumbcertificate->filldivHectre(trim(strip_tags($_GET['ddlUnit'])));
               
                
            }
            } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
             break;
//================Search by survey no=================================================case 32 ===================
       case 32:
                try
                   {//fn_ecsurvey('0105','000','2011',3,'P')SearchBySurveyNo($sro,$user,$ecyear,$gsno,$status,$dbInstance="")
           if(isset($_GET['tok']))
           {
//                if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtstatus'])),1,"statusPS")!==true)
//                {
//                 exit(0);
//                 }
            $dat=$_POST['txtDate'];
            $ecyear=(substr($dat,strlen($dat)-4,strlen($dat)));
            $gsno=$_POST['txtGsno'];
            $user=$_SESSION['userName'];
            $sro=$_POST['ddlSro'];
            $status=$_POST['txtstatus'];

            $objencumbcertificate->SearchBySurveyNo($sro,$user,$ecyear,$gsno,$status,$databaseObj);
           }
            break;
                   }
                catch(Exception $e)
		 {
                 echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
               break;
 //================Load application for first search========ecfirstsearch.php=============================CASE 33============validated==================================
case 33:

		try
		{

    if (isset($_GET['transid']))
    {
         $assoArray1 = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));

        if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
         $assoArray = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));
        if (!$objclsPhpValidation->_isSpclChar($assoArray))
       {

           exit(0);

       }

    if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['transid'])), 8,"Transaction ID")!==true)
            {
                 exit(0);
            }
    if(strlen(trim(strip_tags($_GET['transid'])))!=8)
            {
                echo "Mesg: Invalid Transaction ID";
                exit(0);
            }

         $assoArray1 = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));

        if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
         $assoArray = array("Transaction ID"=>trim(strip_tags($_GET['transid'])));
        if (!$objclsPhpValidation->_isSpclChar($assoArray))
       {

           exit(0);

       }

    if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['transid'])), 8,"Transaction ID")!==true)
            {
                 exit(0);
            }

             if(strlen(trim(strip_tags($_GET['transid'])))!=8)
            {
                echo "Mesg: Invalid Transaction ID";
                exit(0);
            }

         $transid=trim(strip_tags($_GET['transid']));
        $_SESSION['trans_id']= $transid;

        $objencumbcertificate->settransid($_SESSION['trans_id']);
        

	 $query="select sro_code,appname,addr1,addr2,pin,email,collectec,date(acceptdate) as appdate,date(search_from) as search_from,date(search_to) as search_to,remarks,extravillages,
	 		extraclaimants,typeofec,modeofpayment,phone,mobile,appfee,priorityfee,ownershipfee,searchfee,
			coalesce(fees,totfee) as fees,ecyear,gsno,owner,stat,receiptno,stat,languageid from ecregister where trans_id='$transid' and applicationstatus not in ('D') --and stat='S'";
        // echo "Mesg:".$query;
		 $result=OpenPearlDataBase::getInstance()->executeQuery($query);
		 $rows=$result->fetchRow();
		 if($rows==0)
		 {
		 echo "Mesg: No Such Application Exists";
		 exit(0);
		 }
	     $dcode=substr($rows['sro_code'],0,2);
		 $objencumbcertificate->Loadapplnform("EA",$rows['gsno'],$dcode,$rows['sro_code'],$rows['appname'],$rows['addr1'],$rows['addr2'],
		 $rows['pin'],$rows['email'],$rows['collectec'],$rows['appdate'],$rows['search_from'],$rows['search_to'],$rows['remarks'],
		 $rows['extravillages'],$rows['extraclaimants'],$rows['typeofec'],$rows['mobile'],$rows['phone'],$rows['modeofpayment'],$rows['fees'], $rows['priorityfee'],$rows['ownershipfee'],
		 $rows['searchfee'],$rows['ecyear'],$rows['owner'],$rows['stat'],$rows['receiptno'],$rows['stat'],$rows['languageid'],$transid);
		 }
               } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
//================Search by Old survey no=================================================case 33 ===================
       case 34:
                try
                   {//fn_ecsurvey('0105','000','2011',3,'P')SearchBySurveyNo($sro,$user,$ecyear,$gsno,$status,$dbInstance="")
           if(isset($_GET['tok']))
           {

            $dat=$_POST['txtDate'];
            $ecyear=(substr($dat,strlen($dat)-4,strlen($dat)));
            $gsno=$_POST['txtGsno'];
            $user=$_SESSION['userName'];
            $sro=$_POST['ddlSro'];
            $status=$_POST['txtstatus'];

            $objencumbcertificate->SearchByOldSurveyNo($sro,$user,$ecyear,$gsno,$status,$databaseObj);
           }
            
                   }
                catch(Exception $e)
		 {
                 echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
               break;
//================Search by Re survey no=================================================case 34 ===================
       case 35:
                try
                   {//fn_ecsurvey('0105','000','2011',3,'P')SearchBySurveyNo($sro,$user,$ecyear,$gsno,$status,$dbInstance="")
           if(isset($_GET['tok']))
           {
//                if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtstatus'])),1,"statusPS")!==true)
//                {
//                 exit(0);
//                 }
            $dat=$_POST['txtDate'];
            $ecyear=(substr($dat,strlen($dat)-4,strlen($dat)));
            $gsno=$_POST['txtGsno'];
            $user=$_SESSION['userName'];
            $sro=$_POST['ddlSro'];
            $status=$_POST['txtstatus'];

            $objencumbcertificate->SearchByReSurveyNo($sro,$user,$ecyear,$gsno,$status,$databaseObj);
           }
            
                   }
                catch(Exception $e)
		 {
                 echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
               break;
//******************************************************************************************************************************
case 36:
                try
                   {//fn_ecsurvey('0105','000','2011',3,'P')SearchBySurveyNo($sro,$user,$ecyear,$gsno,$status,$dbInstance="")
           if(isset($_GET['tok']))
           {
//                if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtstatus'])),1,"statusPS")!==true)
//                {
//                 exit(0);
//                 }
            $dat=$_POST['txtDate'];
            $ecyear=(substr($dat,strlen($dat)-4,strlen($dat)));
            $gsno=$_POST['txtGsno'];
            $user=$_SESSION['userName'];
            $sro=$_POST['ddlSro'];
            $status=$_POST['txtstatus'];

            $objencumbcertificate->SearchByDocNoIncludingSurveyNo($sro,$user,$ecyear,$gsno,$status,$databaseObj);
           }

                   }
                catch(Exception $e)
		 {
                 echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
               break;
//******************************Search By Document No Excluding Survey No************************************************************************************************
case 37:
                try
                   {//fn_ecsurvey('0105','000','2011',3,'P')SearchBySurveyNo($sro,$user,$ecyear,$gsno,$status,$dbInstance="")
           if(isset($_GET['tok']))
           {
//                if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtstatus'])),1,"statusPS")!==true)
//                {
//                 exit(0);
//                 }
            $dat=$_POST['txtDate'];
            $ecyear=(substr($dat,strlen($dat)-4,strlen($dat)));
            $gsno=$_POST['txtGsno'];
            $user=$_SESSION['userName'];
            $sro=$_POST['ddlSro'];
            $status=$_POST['txtstatus'];

            $objencumbcertificate->SearchByDocNoExcludingSurveyNo($sro,$user,$ecyear,$gsno,$status,$databaseObj);
           }
            
                   }
                catch(Exception $e)
		 {
                 echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
               break;
//******************************Search By Document No Including  Survey No************************************************************************************************
case 38:
                try
                   {//fn_ecsurvey('0105','000','2011',3,'P')SearchBySurveyNo($sro,$user,$ecyear,$gsno,$status,$dbInstance="")
           if(isset($_GET['tok']))
           {
//                if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtstatus'])),1,"statusPS")!==true)
//                {
//                 exit(0);
//                 }
            $dat=$_POST['txtDate'];
            $ecyear=(substr($dat,strlen($dat)-4,strlen($dat)));
            $gsno=$_POST['txtGsno'];
            $user=$_SESSION['userName'];
            $sro=$_POST['ddlSro'];
            $status=$_POST['txtstatus'];

            $objencumbcertificate->option_Documentsearch();
           }

                   }
                catch(Exception $e)
		 {
                 echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
               break;
//*************************************************************************************************************************
               //$objfirstsearch->option_Documentsearch();
	       
	       
	       
# @ 31-05-2011 (EC Reports) ------------------------------------------------

   case 39:
             # ?? validations
             
            
	    if(isset($_GET['gsno']) and isset($_GET['sro']) and isset($_GET['date']) and isset($_GET['appln_status']))
	    {
		//echo "SSSSS+".$_GET['appln_status'];
		trimAndStripTags($_GET);
		if($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['gsno'])),"Gsno",5)!==true) exit(0);
		if(!$objclsPhpValidation->_isDate($_GET['date'],"Current Date")) exit(0);
		if($objclsPhpValidation->_isLen(trim(strip_tags($_GET['date'])), 10, "Date")!==true) exit(0);
		if(!$objclsPhpValidation->_isInteger($_GET['sro'],"SRO",4)) exit(0);
		if($objclsPhpValidation->_isLen(trim(strip_tags($_GET['appln_status'])), 1, "Status")!==true) exit(0);
		
		$aryDateParts = explode("/", $_GET['date']);
		// $aryDateParts[2] => EcYear
		
		$funRes = $objencumbcertificate->checkForPropertyDetails($_GET['sro'],$aryDateParts[2],$_GET['gsno'],$rowCount);
		if($funRes === false)
		{
		    echo "Mesg:Failed while Fetching Property Details";
		    exit(0);
		}
		
		if($rowCount==0)
		{
		    echo "Mesg:No Property Details are given.Cannot print EC.";
		    exit(0);
		}
                
                $res = $objencumbcertificate->checkInMecregister($_GET['sro'],$aryDateParts[2],$_GET['gsno']);
                if($res == true)
                {
                    echo "Mesg:Certificate Generation Already Done";
                    //$objencumbcertificate->loadPrintButtons($_GET['sro'],$_GET['gsno'],$aryDateParts[2]);
                    exit();
                }
		
		$boolRes = $objencumbcertificate->printEC($_GET['sro'],$aryDateParts[2],$_GET['gsno'],$_GET['appln_status'],$databaseObj,$objPublic);
		if($boolRes === true)
		{
		   // $objencumbcertificate->loadPrintButtons();
			$objencumbcertificate->loadPrintButtons($_GET['sro'],$_GET['gsno'],$aryDateParts[2]);
		}
		else if($boolRes === false)
		{
		    echo "Mesg:Failed in Print EC Processing..Try Again";
		    exit(0);
		}
	    }
	    
	    //$objencumbcertificate->loadPrintButtons();

            break;

    case 40:
	
            $objencumbcertificate->loadPrintButtons();
        
        break;
    
    case 41: # A4 Plain (Data Page) Report
    
            /*trimAndStripTags($_GET);
	    
	    if($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['gsno'])),"Gsno",5)!==true)
	    {
               exit(0);
	    }
	   
	    if($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlSro'])),"Sro",4)!==true)
	    {
               exit(0);
            }
	    if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['txtGsno'])), 6, "Gsno")!==true)
	    {
		exit(0);
	    }
	    if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['txtDate'])), 10, "Date")!==true)
	    {
		exit(0);
	    }
	    */
	    
	    trimAndStripTags($_GET);
	    if($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['gsno'])),"Gsno",5)!==true) exit(0);
	    if(!$objclsPhpValidation->_isDate($_GET['date'],"Current Date")) exit(0);
	    if($objclsPhpValidation->_isLen(trim(strip_tags($_GET['date'])), 10, "Date")!==true) exit(0);
	    if(!$objclsPhpValidation->_isInteger($_GET['sro'],"SRO",4)) exit(0);
	    if($objclsPhpValidation->_isLen(trim(strip_tags($_GET['appln_status'])), 1, "Status")!==true) exit(0);
	    
	    $aryDateParts = explode("/", $_GET['date']);
	   
	   $boolRes = $objencumbcertificate->preserveOfficeCopy($_GET['sro'],$aryDateParts[2],$_GET['gsno'],$_GET['appln_status'],$databaseObj);
           //$boolRes = true;
          
           if($boolRes == false)
	    {
		echo "Mesg:Failed While Preserving Office Copy";
		exit(0);
	    }
            else
                echo "Success";
	

	break;
    
    
    case 42: # Schedule of Property
    
		//Validations Needs to be Done
		trimAndStripTags($_GET);
		if($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['gsno'])),"Gsno",5)!==true) exit(0);
		if(!$objclsPhpValidation->_isDate($_GET['date'],"Current Date")) exit(0);
		if($objclsPhpValidation->_isLen(trim(strip_tags($_GET['date'])), 10, "Date")!==true) exit(0);
		if(!$objclsPhpValidation->_isInteger($_GET['sro'],"SRO",4)) exit(0);
		
		$objLang = new Language();
		$aryRptLabels = array();
		$aryRptLabels = $objLang->getSchOfPropertyLabels();
		
		//print_r($aryRptLabels);
		
		
		$aryDateParts = explode("/", $_GET['date']);
		$aryHeaderVals = array();
		
		$boolRes = $objencumbcertificate->getScheduleOfProperty($_GET['sro'],$aryDateParts[2],$_GET['gsno'],$resSchProp);
		if($boolRes == true)
		{
		    
		    if($resSchProp->numRows()==0)
		    {
			echo "Mesg:No Records found for the Selected Period"; // to indicate as no records found for selected period
			exit(0);
		    }
		    
		    $ctr = $pgBreakCounter = 0;
		    define('ROWCOUNT',8); 
		    while($rows=$resSchProp->fetchRow())
		    {
			trimAndStripTags($rows);
			$ctr++;
			if($ctr == 1)
			{
			    
			    $aryHeaderVals['gsno'] = $_GET['gsno']."/".substr($aryDateParts[2], -2);   // $aryDateParts[2] => EcYear
			    schOfProperty_RptHeader($aryRptLabels,$aryHeaderVals);
			    schOfProperty_TableHeader($aryRptLabels);
			}
			
			#page Break Check for Normal Data
			if($pgBreakCounter == ROWCOUNT)
			{
			    $pgBreakCounter = 0;
 
			    showTableFooter();
			    schOfProperty_RptFooter($aryRptLabels['reg_off_sign']);
			    addPageBreak();
			    schOfProperty_RptHeader($aryRptLabels,$aryHeaderVals);
			    schOfProperty_TableHeader($aryRptLabels);
			    
			}
			$pgBreakCounter++;
			
			#Report Data Row
			
?>

		    <tr>
			<td class="alignCenter" width="5%"><?php echo $ctr; ?></td>
			<td class="alignCenter" width="14%"><?php echo $rows['village_name']; ?></td>
			<td class="alignCenter" width="14%"><?php echo $rows['desam_name']; ?></td>
			<td class="alignCenter" width="9%"><?php echo $rows['survey_no']; ?></td>
			<td class="alignCenter" width="7%"><?php echo $rows['block']; ?></td>
			<td class="alignCenter" width="9%"><?php echo $rows['resurvey']; ?></td>
			<td class="alignCenter" width="5%"><?php echo $rows['unit']; ?></td>
			<td class="alignCenter" width="7%"><?php echo $rows['hr_acre']; ?></td>
			<td class="alignCenter" width="7%"><?php echo $rows['ar_cent']; ?></td>
			<td class="alignCenter" width="9%"><?php echo $rows['sqm_sqlink']; ?></td>
			<td class="alignCenter" width="14%"><?php echo $rows['remarks']; ?></td>
		    </tr>


<?php
		    }
		    showTableFooter();
		    schOfProperty_RptFooter($aryRptLabels['reg_off_sign']);
		    
		}
		else if($boolRes == false)
		{
		    echo "Mesg:Failed While Fetching Property Details";
		    exit(0);
		}
		
	break;
    
        case 43: # A4 Pre Printed Report
    
	    trimAndStripTags($_GET);
	    if($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['gsno'])),"Gsno",5)!==true) exit(0);
	    if(!$objclsPhpValidation->_isDate($_GET['date'],"Current Date")) exit(0);
	    if($objclsPhpValidation->_isLen(trim(strip_tags($_GET['date'])), 10, "Date")!==true) exit(0);
	    if(!$objclsPhpValidation->_isInteger($_GET['sro'],"SRO",4)) exit(0);
	    if($objclsPhpValidation->_isLen(trim(strip_tags($_GET['appln_status'])), 1, "Status")!==true) exit(0);
	    
	    $aryDateParts = explode("/", $_GET['date']);
	     //echo $_GET['appln_status'];exit();
	    //$boolRes = $objencumbcertificate->preserveOfficeCopy($_GET['sro'],$aryDateParts[2],$_GET['gsno'],$_GET['appln_status'],$databaseObj);
            $boolRes = true;
	    if($boolRes == false)
	    {
		echo "Mesg:Failed While Preserving Office Copy";
		exit(0);
	    }
            else
                echo "Success";
	break;
    
    case 44:
	
	    $objLang = new Language();
	    $aryRptLabels = array();
	    $aryRptLabels = $objLang->getECFrontPageLabels();
	    
	    //printr($aryRptLabels);
	    
	    showA4Plain_FrontPage($aryRptLabels);
	
	break;
    case 45:
	 if(isset($_GET['tok']) && isset($_GET['langid']))
           {
            if(($_GET['langid'])==1 or $_GET['langid']==2)
            {
	    $objencumbcertificate=new encumbcertificate;
	    $objencumbcertificate->fillApplnCertificateGeneration($_GET['langid']);
            }
	   }
	
	break;

# ---------------------------------------------------------------------------------
               
        default:
             break;

}//end of switch

function trimAndStripTags(&$array)
{
    foreach($array as $key => $value)
	$array[$key]=trim(strip_tags($value));

}


?>