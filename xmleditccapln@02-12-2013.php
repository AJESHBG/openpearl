<?php
require_once("../pearllogin_templatexml.php");
require_once("../classes/class.editccapln.php");
require_once("../classes/class.gridView.php");
//require_once("../DBAL/PublicDataBaseClass.php");
$option="";
$objclsecapln= new ccapln();
$objclsPhpValidation= new PhpValidation();
//$objPublic=PublicDataBase::getInstance();
$objcomn=new Common();


$databaseObj = OpenPearlDataBase::getInstance();
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
     if($stat!="EA" and $stat!="E" and $stat!="EAN" and $stat!="N" and $stat!="P" and $stat!="S" and $stat!="T")
           {
               echo  "Mesg: Invalid Stat1".$_GET['stat'];
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
	 $objclsecapln->randomNumber();
	 $objclsecapln->Loadapplnform("N");
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

        iF ($objclsPhpValidation->_isSpclChar($assoArray2,array('.','/'))!==true)
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
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtName'])),75, "Name")!==true)
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
                  $slnodoc=$objclsecapln->NextSlnodocRno($ecyear,$gsno,$stat);
                 $sro= trim(strip_tags($_POST['ddlSro']));
                 $bookno=trim(strip_tags($_POST['txtBookno']));
                 $docno=trim(strip_tags($_POST['txtDocno']));
                 $year=trim(strip_tags($_POST['txtYear']));
                 $dcode=trim(strip_tags($_POST['ddlDist']));

                 $objclsecapln->setslnodoc($slnodoc);
                 $objclsecapln->setbookno($bookno);
                 $objclsecapln->setdocno($docno);
                 $objclsecapln->setyear($year);
             /*Storing to data base *///$stat="",$ecyear="",$gsno="",$sro="",$slnodoc="",$bookno="",$docno="",$year=""
                // echo'in xml'.$stat;
                 $objclsecapln->insertecdonos($stat,$ecyear,$gsno,$sro,$slnodoc,$bookno,$docno,$year,$dcode,$databaseObj);
                 $objclsecapln->GridDocument_display($ecyear,$gsno,$stat);



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
	 $objclsecapln->setgsno($gsno);
	 $objclsecapln->setecyear($ecyear);
	 $off= trim(strip_tags($offset));
	// commented  $objclsecapln->showdocdet($off,"E",$ecyear);
	$objclsecapln->GridDocument_display($ecyear,$gsno,'E');
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
   	 $objclsecapln->filltaluk($dcode,$srocode);
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
	 $objclsecapln->fillvillage($dcode,$tcode,$srocode);
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
	 $objclsecapln->fillDesam($dcode,$tcode,$vcode,$sro);
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
	 $objclsecapln->fillBlock($dcode,$tcode,$vcode,$sro);/*  */


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
         $objclsecapln->fillSro($dcode,$stat);
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

        iF ($objclsPhpValidation->_isSpclChar($assoArray2,array('.','/'))!==true)
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
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtName'])),75, "Name")!==true)
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

      $assoArray3 = array("Remark"=>trim(strip_tags($_POST['txtRemark'])),"East"=>trim(strip_tags($_POST['txtEast'])),
          "West"=>trim(strip_tags($_POST['txtWest'])),"North"=>trim(strip_tags($_POST['txtNorth'])),"South"=>trim(strip_tags($_POST['txtSouth'])));
     $assoArray4 = array("Resurvey No"=>trim(strip_tags($_POST['txtResurno'])),"Resurvey Subdiv No"=>trim(strip_tags($_POST['txtResurSubdiv'])),
          "Old Survey No"=>trim(strip_tags($_POST['txtOldsurno'])), "Old Survey Subdiv No"=>trim(strip_tags($_POST['txtOldsubdivno'])));
        iF ($objclsPhpValidation->_isSpclChar($assoArray4,array('.','-',',','/'))!==true)
           {
              exit(0);
           }
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
              $slno= $objclsecapln->NextSlnosurno($ecyear,$gsno,$stat);
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
	 $objclsecapln->setslno($slno);
	 $objclsecapln->setecyear($ecyear);
 	 $objclsecapln->setgsno($gsno);
	 $objclsecapln->setsro($sro);
	 $objclsecapln->setdcode($dcode);
	 $objclsecapln->settcode($tcode);
	 $objclsecapln->setvcode($vcode);
	 $objclsecapln->setdesam($desam);
	 $objclsecapln->setblock($block);
	 $objclsecapln->setrsurno($rsurno);
	 $objclsecapln->setrsbdvnno($rsbdvnno);
	 $objclsecapln->setsurno($surno);
	 $objclsecapln->setsbdvnno($sbdvnno);
	 $objclsecapln->setunit_mf($unit_mf);
	 $objclsecapln->sethr_acre($hr_acre);
	 $objclsecapln->setar_cent($ar_cent);
	 $objclsecapln->setsqm_sqlink($sqm_sqlink);
	 $objclsecapln->setremarks($remarks);
	 $objclsecapln->seteast($east);
	 $objclsecapln->setwest($west);
	 $objclsecapln->setnorth($north);
	 $objclsecapln->setsouth($south);

        // $databaseObj->startTransaction();

	$objclsecapln->InsertOrUpdateEcsurnos($stat,$databaseObj);
        $objclsecapln->GridProperty_display($ecyear,$gsno,$stat,0);


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
    //echo "Mesg : xml"; exit();
    try
{
//echo "Mesg: save;go"; exit();
        //=================================================Validation Started=====================================================


    if (isset($_POST['txtSsno']) and isset($_GET['stat']) and isset($_POST['ddlDist'])
        and isset($_POST['ddlSro']) and isset($_POST['txtDate']) and isset($_POST['txtName'])
        and isset($_POST['txtHouseno']) and isset($_POST['txtCity']) and  isset($_POST['txtPin'])
        and isset($_POST['txtEmail']) and isset($_POST['txtPhone']) and isset($_POST['txtmobile'])
        and isset($_POST['ddlAppId']) and isset($_POST['txtappidnumber']) and isset($_POST['txtappidissuedate'])
        and isset($_POST['txtappidexpdate']) and isset($_POST['txtClname']) and isset($_POST['txtClsurname']) 
		and isset($_POST['txtClhname'])
        and isset($_POST['txtClcity']) and isset($_POST['txtClpin']) and isset($_POST['txtExname'])
        and isset($_POST['txtExsurname']) and isset($_POST['txtExhname']) and isset($_POST['txtExcity'])
        and isset($_POST['txtExpin']) and isset($_POST['txtDocno']) and isset($_POST['txtYear'])
        and isset($_POST['txtBookno'])  /* and isset($_POST['txtFrom']) and isset($_POST['txtTo'])*/
        and isset($_POST['txtstamp']) and isset($_POST['ddlModeofPay']) and isset($_POST['txtFee']) 
        and isset($_POST['txtNoofcopy']) and isset($_POST['txtNoofword']) and isset($_POST['ddlPlan'])
		and isset($_POST['txtplanfee']) and isset($_POST['txtoriginalstamp']) and isset($_POST['txtnoplan']) and isset($_GET['tok']))

	
	
    {//and isset($_POST['txtpriorityfee'])



          $assoArray1 = array("Ssno"=>trim(strip_tags($_POST['txtSsno'])),
            "Date"=>trim(strip_tags($_POST['txtDate'])),
            "Name"=>trim(strip_tags($_POST['txtName'])),
            "House No/Name"=>trim(strip_tags($_POST['txtHouseno'])),
              "Number of Plan"=>trim(strip_tags($_POST['txtnoplan'])),
           /*  "City/District"=>trim(strip_tags($_POST['txtCity'])),            
           "Claimant Name"=>trim(strip_tags($_POST['txtClname'])),
           "HouseNo/Name Of Claimant"=>trim(strip_tags($_POST['txtClhname'])),
            "City/District, PostOffice Of Claimant"=>trim(strip_tags($_POST['txtClcity'])),
            "Executant Name"=>trim(strip_tags($_POST['txtExname'])),
            "HouseNo/Name Of Executant"=>trim(strip_tags($_POST['txtExhname'])),
            "City/District, PostOffice Of Executant"=>trim(strip_tags($_POST['txtExcity'])),  */
           /* "From Date"=>trim(strip_tags($_POST['txtFrom'])),
            "To Date"=>trim(strip_tags($_POST['txtTo'])),*/
            //"Value of Stamp Paper Submitted"=>trim(strip_tags($_POST['txtstamp'])),
            //"Click Calculate Fee --> Application Fee"=>trim(strip_tags($_POST['txtappfees'])),
            "Click Calculate Fee --> Search Fee"=>trim(strip_tags($_POST['txtsearchfees'])),
            "Click Calculate Fee --> Total Fee Collected"=>trim(strip_tags($_POST['txtFee'])),
            "Number of Copy"=>trim(strip_tags($_POST['txtNoofcopy'])),
            "Number of Words"=>trim(strip_tags($_POST['txtNoofword']))
            );
        
          //,"ID No"=>trim(strip_tags($_POST['txtappidnumber'])),
          //  "Issued Date"=>trim(strip_tags($_POST['txtappidissuedate'])),"Expiry Date"=>trim(strip_tags($_POST['txtappidexpdate']))
          //
        //Claimant SurName"=>trim(strip_tags($_POST['txtClsurname'])),"Executant SurName"=>trim(strip_tags($_POST['txtExsurname'])), "Pincode"=>trim(strip_tags($_POST['txtPin'])),"Email"=>trim(strip_tags($_POST['txtEmail'])),"PhoneNo"=>trim(strip_tags($_POST['txtPhone'])),"Mobile"=>trim(strip_tags($_POST['txtmobile']))
             //"Pincode Of Claimant"=>trim(strip_tags($_POST['txtClpin'])),"Pincode Of Executant"=>trim(strip_tags($_POST['txtExpin']))
        //"DocNo"=>trim(strip_tags($_POST['txtDocno'])),"Year"=>trim(strip_tags($_POST['txtYear'])),"BookNo"=>trim(strip_tags($_POST['txtBookno'])),

        $assoArray2 = array("District"=>trim(strip_tags($_POST['ddlDist'])),"Sub-Registrar Office"=>trim(strip_tags($_POST['ddlSro'])),
            "Mode of Payment"=>trim(strip_tags($_POST['ddlModeofPay'])),
            "Wish To Get Priority"=>trim(strip_tags($_POST['ddlPriority'])),"Plan"=>trim(strip_tags($_POST['ddlPlan'])));
        //,"ID Type"=>trim(strip_tags($_POST['ddlAppId']))

       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }

        iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtSsno'])),"Ssno",5)!==true)
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
        /*iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlTranstype'])),"Transaction Type",4)!==true)
           {
               exit(0);
           }*/

        iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlSro'])),"Sro",4)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtNoofcopy'])),"Number of Copy",3)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtnoplan'])),"Number of Plan",3)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtNoofword'])),"Number of Words",5)!==true)
           {
               exit(0);
           }
  
    //**********************************************************************************************************************************
            //Allowed dot
             $assoArray2 = array("Name"=>$_POST['txtName'],"Claimant Name"=>trim(strip_tags($_POST['txtClname'])),
                                 "Claimant SurName"=>trim(strip_tags($_POST['txtClsurname'])),"Executant Name"=>trim(strip_tags($_POST['txtExname'])),
                                 "Executant SurName"=>trim(strip_tags($_POST['txtExsurname'])));

              iF ($objclsPhpValidation->_isSpclChar($assoArray2,array('.','/'))!==true)
           {
               exit(0);
           }
           
   //**********************************************************************************************************************************
            //Allow some specilal Characters
             $assoArray3 = array("House No/Name"=>trim(strip_tags($_POST['txtHouseno'])), "HouseNo/Name Of Claimant"=>trim(strip_tags($_POST['txtClhname'])),"HouseNo/Name Of Executant"=>trim(strip_tags($_POST['txtExhname'])));
             iF ($objclsPhpValidation->_isSpclChar($assoArray3,array('.','-',',','/'))!==true)
               {
                  exit(0);
               }
  //**********************************************************************************************************************************

                 //Allow some specilal Characters
             $assoArray4 = array( "City/District"=>trim(strip_tags($_POST['txtCity'])),"City/District, PostOffice Of Claimant"=>trim(strip_tags($_POST['txtClcity'])),"City/District, PostOffice Of Executant"=>trim(strip_tags($_POST['txtExcity'])));
              iF ($objclsPhpValidation->_isSpclChar($assoArray4,array('.','-',','))!==true)
           {
              exit(0);
           }  
 //**********************************************************************************************************************************

        iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtPin'])),"Applicant Pincode")!==true)
           {
              exit(0);
           }
            iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtClpin'])),"Pincode Of Claimant")!==true)
           {
              exit(0);
           }
             iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtExpin'])),"Pincode Of Executant")!==true)
           {
              exit(0);
           }
 //**********************************************************************************************************************************
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
 //**********************************************************************************************************************************
 // // No special character
             $assoArray1 = array("stat"=>$_GET['stat'],"Docno"=>$_POST['txtDocno'],"BookNo"=>$_POST['txtBookno']);

// allow "/"  special character
             $assoArray2= array("ID No"=>trim(strip_tags($_POST['txtappidnumber'])));

             /* commented on 02-02-2013  
             if(trim(strip_tags($_POST['ddlAppId']))!=0 and trim(strip_tags($_POST['ddlAppId']))!=-1)
             {
                 if(trim(strip_tags($_POST['txtappidnumber']))=="")
                 {
                     echo "Mesg: ID No Required";
                     exit(0);
                 }
             }
  commented on 02-02-2013  */
           iF ($objclsPhpValidation->_isSpclChar($assoArray1)!==true)
           {
               exit(0);
           }
           
           iF ($objclsPhpValidation->_isSpclChar($assoArray2,array("/"))!==true)
           {
               exit(0);
           }
           
         
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtBookno'])),"BookNo",1)!==true)
           {
               exit(0);
           }
          
            iF ($objclsPhpValidation->_isYear(trim(strip_tags($_POST['txtYear'])),"Year")!==true)
           {
               exit(0);
           }

 //**********************************************************************************************************************************
 //ID SHOULD BE VALIDATED BASED ON OpenPearlDataBase
 //**********************************************************************************************************************************
           iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtappidissuedate'])),"Issued Date"))
           {

           exit(0);
           }
           iF (!$objclsPhpValidation->_isDateBeforeToday(trim(strip_tags($_POST['txtappidissuedate'])),"Issued Date"))
           {

           exit(0);
           }
 //**********************************************************************************************************************************
  iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtappidexpdate'])),"Expiry Date"))
           {

           exit(0);
           }
           iF (!$objclsPhpValidation->_isDateAfterToday(trim(strip_tags($_POST['txtappidexpdate'])),"Expiry Date"))
           {

           exit(0);
           }
 //**********************************************************************************************************************************
           /* iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtFrom'])),"From Date"))
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
           }*/

 //**********************************************************************************************************************************
 iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtBookno'])),"BookNo",1)!==true)
           {
               exit(0);
           }
            if ((trim(strip_tags($_POST['txtBookno']))!="1" and trim(strip_tags($_POST['txtBookno']))!="3" and trim(strip_tags($_POST['txtBookno']))!="4") and trim(strip_tags($_POST['txtBookno']))!="")
            {
                echo "Mesg: Invalid Book No";
                exit(0);
            }
         
 //**********************************************************************************************************************************
 iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtstamp'])),"Value of Stamp Paper Submitted",5)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlModeofPay'])),"Mode of Payment",1)!==true)
           {
               exit(0);
           }
            if(trim(strip_tags($_POST['ddlPriority']))!=1 and trim(strip_tags($_POST['ddlPriority']))!=2)
            {
                echo "Mesg: Invalid Priority";
                exit(0);
            }

            if(trim(strip_tags($_POST['ddlPlan']))!=1 and trim(strip_tags($_POST['ddlPlan']))!=2)
            {
                echo "Mesg: Invalid Plan";
                exit(0);
            }

 //**********************************************************************************************************************************
/*  iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtappfees'])),"Application Fee",6)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtsearchfees'])),"Search Fee",6)!==true)
           {
               exit(0);
           }*/
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtCopyFee'])),"Copy Fee",6)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtFee'])),"Total Fee",6)!==true)
           {
               exit(0);
           }
            
  /*iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtpriorityfee'])), "Priority Fee",5)!==true)
           {
               exit(0);
           }*/
           

 //*****************************************************************Length Validation*****************************************************************
          

     if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtName'])),75, "Name")!==true)
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

 //**********************************************************************************************************************************
         

       if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClname'])),90, "Claimant Name")!==true)
        {
            exit(0);
        }
       if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClsurname'])),75, "Claimant SurName")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClhname'])), 50,"HouseNo/Name Of Claimant")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClcity'])), 50,"City/District, PostOffice Of Claimant")!==true)
        {
            exit(0);
        }
       

 //**********************************************************************************************************************************
         
           

         if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExname'])),90, "Executant Name")!==true)
        {
            exit(0);
        }
          if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExsurname'])),75, "Executant SurName")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExhname'])), 50,"HouseNo/Name Of Executant")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExcity'])), 50,"City/District, PostOffice Of Executant")!==true)
        {
            exit(0);
        }
       
        
 //**********************************************************************************************************************************
       if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtappidnumber'])), 20,"ID No")!==true)
        {
            exit(0);
        }
            
//**********************************************************************************************************************************
         if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtDocno'])), 6, "DocNo")!==true)
        {
            exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtNoofcopy'])), 3, "Number of Copy")!==true)
        {
            exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtNoofword'])), 5, "Number of Words")!==true)
        {
            exit(0);
        }
        
       
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['stat'])),3,"stat")!==true)
        {
            exit(0);
        } 
//**********************************************************************************************************************************
  // modeofpayment from OpenPearlDataBase  ID SHOULD BE VALIDATED BASED ON OpenPearlDataBase
$objDDVal = new dropDownValidation();

if(!$objDDVal->checkDistrict(trim(strip_tags($_POST['ddlDist'])))) exit(0);

if(!$objDDVal->checkSRO(trim(strip_tags($_POST['ddlDist'])),trim(strip_tags($_POST['ddlSro'])))) exit(0);

if(!$objDDVal->checkSelectOption('idcard','id_type',trim(strip_tags($_POST['ddlAppId'])),'ID Type')) exit(0);

if(!$objDDVal->checkSelectOption('modeofpayment','id',trim(strip_tags($_POST['ddlModeofPay'])),'Mode of Payment')) exit(0);

//echo "11";exit();
unset($objDDVal);

////**********************************************************************************************************************************
   

           
      $stat=trim(strip_tags($_GET['stat']));
     
	$arr=split('[.-/]',trim(strip_tags($_POST['txtDate'])));
       $ccyear="";
	if (sizeof($arr)>0)
	{
		 $ccyear=$arr[2];
	}




         $objclsecapln->setstat(trim(strip_tags($_GET['stat'])));

         $objclsecapln->setssno(trim(strip_tags($_POST['txtSsno'])));
         $objclsecapln->setappdate(trim(strip_tags($_POST['txtDate'])));
         $objclsecapln->setccyear($ccyear);

 	 $objclsecapln->setdcode(trim(strip_tags($_POST['ddlDist'])));
	 $objclsecapln->setsro(trim(strip_tags($_POST['ddlSro'])));

         $objclsecapln->setapp_name(trim(strip_tags( $_POST['txtName'])));
         $objclsecapln->setapp_city(trim(strip_tags($_POST['txtCity'])));
         $objclsecapln->setapp_houseno(trim(strip_tags($_POST['txtHouseno'])));
         $objclsecapln->setapp_pin(trim(strip_tags($_POST['txtPin'])));
         $objclsecapln->setapp_email(trim(strip_tags($_POST['txtEmail'])));
         $objclsecapln->setapp_phone(trim(strip_tags($_POST['txtPhone'])));
         $objclsecapln->setapp_mobile(trim(strip_tags($_POST['txtmobile'])));

         $objclsecapln->setapp_idexpdate(trim(strip_tags($_POST['txtappidexpdate'])));

         $objclsecapln->setapp_idtype(trim(strip_tags($_POST['ddlAppId'])));
         $objclsecapln->setapp_idissuedate(trim(strip_tags($_POST['txtappidissuedate'])));
         $objclsecapln->setapp_idnumber(trim(strip_tags($_POST['txtappidnumber'])));


         $objclsecapln->setcl_name(trim(strip_tags( $_POST['txtClname'])));

         $objclsecapln->setclsur_name(trim(strip_tags( $_POST['txtClsurname'])));

         $objclsecapln->setcl_city(trim(strip_tags($_POST['txtClcity'])));
         $objclsecapln->setcl_houseno(trim(strip_tags($_POST['txtClhname'])));
         $objclsecapln->setcl_pin(trim(strip_tags($_POST['txtClpin'])));

         $objclsecapln->setex_name(trim(strip_tags( $_POST['txtExname'])));
         $objclsecapln->setexsur_name(trim(strip_tags( $_POST['txtExsurname'])));

         $objclsecapln->setex_city(trim(strip_tags($_POST['txtExcity'])));
         $objclsecapln->setex_houseno(trim(strip_tags($_POST['txtExhname'])));
         $objclsecapln->setex_pin(trim(strip_tags($_POST['txtExpin'])));

         $objclsecapln->setdocno(trim(strip_tags($_POST['txtDocno'])));
         $objclsecapln->setbookno(trim(strip_tags($_POST['txtBookno'])));
         $objclsecapln->setdocyear(trim(strip_tags($_POST['txtYear'])));
		 	

 			$objclsecapln->setplanfee(trim(strip_tags($_POST['txtplanfee'])));
			$objclsecapln->setpfee(trim(strip_tags($_POST['txtpriorityfee'])));
        
 /*
         $objclsecapln->setsearch_from(trim(strip_tags($_POST['txtFrom'])));
	 $objclsecapln->setsearch_to(trim(strip_tags($_POST['txtTo']))); */

         $objclsecapln->setnocopy(trim(strip_tags($_POST['txtNoofcopy'])));
         $objclsecapln->setnoword(trim(strip_tags($_POST['txtNoofword'])));

         $objclsecapln->setnoplan(trim(strip_tags($_POST['txtnoplan'])));

         $objclsecapln->setplan(trim(strip_tags($_POST['ddlPlan'])));
		 $objclsecapln->setoriginalstamp(trim(strip_tags($_POST['txtoriginalstamp'])));



         $objclsecapln->setstampduty(trim(strip_tags($_POST['txtstamp'])));
         
	 $objclsecapln->setmodeofpay(trim(strip_tags($_POST['ddlModeofPay'])));
	 $objclsecapln->setcccode();

         $objclsecapln->setapp_fees(1);

         $objclsecapln->sets_fees(10);

        $objclsecapln->setcopyfees(trim(strip_tags($_POST['txtCopyFee'])));

	 $objclsecapln->setmodeofpay(trim(strip_tags($_POST['ddlModeofPay'])));
         $objclsecapln->setnowhitepaper(trim(strip_tags($_POST['txtnowhitepaper'])));
	 $objclsecapln->setcccode();



	// $databaseObj->startTransaction();
	
//echo "Mesg: okdydhdhd"; exit();
$stat='EA';
	 $objclsecapln->save($stat);

	 //$databaseObj->commit();

     }



	 } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Timewer"; exit(0);
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

	 $objclsecapln->Loadproperty($stat,$rows['slno'],$rows['dcode'],$rows['tcode'],$rows['vcode'],
							$rows['desam'],$rows['surno'],$rows['sbdvnno'],$rows['rsurno'],$rows['rsbdvnno'],$rows['block']
							,$rows['unit_mf'],$rows['hr_acre'],$rows['ar_cent'],$rows['sqm_sqlink'],$rows['remarks'],
		 					$rows['east'],$rows['west'],$rows['south'],$rows['north'],$ecyear,$gsno,$sro);

          //$objclsecapln->GridProperty_display($ecyear,$gsno,"E");

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
				$objAuditTrail->setPageAccessed('editccapln.php');
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


		 $objclsecapln->GridDocument_display($ecyear,$gsno,$stat);



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
				$objAuditTrail->setPageAccessed('ecapln.php');
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

		 $objclsecapln->GridProperty_display($ecyear,$gsno,$stat);



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

$objclsecapln->GridDocument_display($ecyear,$gsno,$stat,$offset);
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
$objclsecapln->GridProperty_display($ecyear,$gsno,$stat,$offset);
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
		 $objclsecapln->LoadDocument($stat,$rows['slno'],$rows['docno'],$rows['docyear'],$rows['bookno']);



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



        iF ($objclsPhpValidation->_isSpclChar($assoArray2,array('.','/'))!==true)
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
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtName'])),75, "Name")!==true)
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

	 $objclsecapln->setbookno($bookno);
 	 $objclsecapln->setdocno($docno);
	 $objclsecapln->setyear($year);

	 $stat=trim(strip_tags($_GET['stat']));
         //$slnodoc=$objclsecapln->NextSlnodocRno($ecyear,$gsno,$stat);
        // $databaseObj->startTransaction();
	 $objclsecapln->insertecdonos($stat,$ecyear,$gsno,$sro,$slnodoc,$bookno,$docno,$year,$dcode,$databaseObj);

	 // commented $objclsecapln-> showdocdet(0,$stat,$gsno,$sro,$ecyear);
	 	$objclsecapln->GridDocument_display($ecyear,$gsno,$stat);


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


	$objclsecapln->LoadDeclaration($transid);

   }
   } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
         //=================LoadSuccessmsg======================================CASE 22=========validated=====================================
case 22:
    //echo "Mesg : "."xml";
     try
{
    if(isset($_GET['tok']))
    {



	$objclsecapln->SuccessMsg(trim(strip_tags($_SESSION['trans_id'])));
    }
    } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;

         //=======================LoadAcknowledgement===========================CASE 23======validated========================================
case 23:
   // echo "Mesg : "."xml"; exit();
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
				$moneyno=trim($_GET['moneyno']); 
				$moneydate=trim($_GET['moneydate']);
				$modeofpay=trim($_GET['modeofpay']);  
 
				
				


		$objclsecapln->Acknowledgement(trim(strip_tags($_GET['transid'])),$moneyno,$moneydate,$modeofpay);
	}
        } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
         //==============CalculateFee===========================================CASE 24===========validated===================================
case 24:
    
      //echo"Mesg:"."xml";exit();
  try
{

    // if(isset($_GET['txtFrom']) and isset($_GET['txtTo']) and isset($_GET['tok']) and isset($_GET['txtstamp']) and isset($_GET['ddlModeofPay']) and isset($_GET['ddlPriority']) )
     if(isset($_GET['tok']) and isset($_GET['txtstamp']) and isset($_GET['ddlModeofPay']) and isset($_GET['ddlPriority']) and isset($_GET['txtNoofcopy'])and isset($_GET['txtNoofword'])and isset($_GET['ddlPlan']) and isset($_GET['ddlPlanno']))
     {//
       //echo "Mesg:hai";
        
         //$assoArray1 = array("From Date"=>trim(strip_tags($_GET['txtFrom'])), "To Date"=>trim(strip_tags($_GET['txtTo'])),"Value of Stamp Paper Submitted "=>trim(strip_tags($_GET['txtstamp'])));
         $assoArray1 = array("Value of Stamp Paper Submitted "=>trim(strip_tags($_GET['txtstamp'])),"Number of Copies "=>trim(strip_tags($_GET['txtNoofcopy'])),"Number of Words "=>trim(strip_tags($_GET['txtNoofword'])),"Number of Plan "=>trim(strip_tags($_GET['ddlPlanno'])));

         $assoArray2 = array("Mode of Payment"=>trim(strip_tags($_GET['ddlModeofPay'])),"Wish To Get Priority?"=>trim(strip_tags($_GET['ddlPriority'])),"Wish To Get Plan?"=>trim(strip_tags($_GET['ddlPlan'])));



       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
      if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }
      
        /*  iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_GET['txtFrom'])),"From Date"))
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
           }*/
        iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtstamp'])), "Value of Stamp Paper Submitted", 5)!==true)
           {
              exit(0);
           }

            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtNoofcopy'])), "Number of Copy", 3)!==true)
           {
              exit(0);
           }

            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['txtNoofword'])), "Number of Words", 5)!==true)
           {
              exit(0);
           }
       
            if(trim(strip_tags($_GET['ddlPriority']))!=1 and trim(strip_tags($_GET['ddlPriority']))!=2)
            {
                echo "Mesg: Invalid Priority";
                exit(0);
            }

             if(trim(strip_tags($_GET['ddlPlan']))!=1 and trim(strip_tags($_GET['ddlPlan']))!=2)
            {
                echo "Mesg: Invalid Plan";
                exit(0);
            }
			
			 iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_GET['ddlPlanno'])), "Number of Plan", 3)!==true)
           {
              exit(0);
           }


        $priority=trim(strip_tags($_GET['ddlPriority']));

       /* $arrfrom=split('[/.-]',trim(strip_tags($_GET['txtFrom'])));
        
	 if (sizeof($arrfrom)>0)
	 {
		 $yearfrom=$arrfrom[2];
	 } 
	 $arrto=split('[/.-]',trim(strip_tags($_GET['txtTo'])));
	 if (sizeof($arrto)>0)
	 {
		 $yearto=$arrto[2];
	 } 

*/

	$objclsecapln->CalculateFee(trim(strip_tags($_GET['txtstamp'])),$priority,trim(strip_tags($_GET['txtNoofcopy'])),trim(strip_tags($_GET['txtNoofword'])),trim(strip_tags($_GET['ddlPlan'])),trim(strip_tags($_GET['txtstamp'])),trim(strip_tags($_GET['roundednum'])),trim(strip_tags($_GET['ddlPlanno'])));
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
                $objclsecapln->Loadapplnform("N");

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

                 $query="select * from ccregister where trans_id='$transid' and trim(applicationstatus) in('E','N')";

		 $result=OpenPearlDataBase::getInstance()->executeQuery($query);
		 $rows=$result->fetchRow();
		 if($rows==0)
		 {
		 echo "Mesg: No Such Application Exists";
		 exit(0);
		 }


	 $databaseObj->startTransaction();
	 $objclsecapln->CancelApplication($transid,$databaseObj);
	 //$databaseObj->commit();
    }
    } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;

 //=========fillHectre()=========ecapln.php==&==editecapln.php==================CASE 31======validated========================================
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

                $objclsecapln->filldivHectre(trim(strip_tags($_GET['ddlUnit'])));


            }
            } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
             break;
         default:

             break;

//==========================fILL gRID for listing Applications Pending=============================================
      case 32: //echo "Mesg: case 32 :";

	$objgridView= new gridView();
	$objcommon = new Common();
        $ofcode=$_SESSION['loggedinOffice'];
//	$arr=explode("/",trim(strip_tags($_POST['txtDate'])));
//	 if (sizeof($arr)>0)
//	 {
//		 $ecyear=$arr[2];
//	 }
        $ccyear=date("Y",time());
	$fieldNames=array('Ssno','TransId','Applicant Name','House Name','City','Phone','Mobile','Select');

	$query="select ssno,trans_id,appname,addr1,addr2,appphone,appmob from ccregister
                where ((cccertno is null  or cccertno=0) and applicationstatus not in  ('R', 'C', 'I', 'F', 'D')
        and sro_code='$ofcode'  and trans_id like 'P%')  order by ssno";
	$result=OpenPearlDataBase::getInstance()->executeQueryOrdered($query);
	$i=0;
	$noofrows=$result->numRows();
	$noofcols=$result->numCols();
        
	$totrows=$objcommon->GetTotalRows("ccregister","(cccertno is null  or cccertno=0) and receiptno=0");
        
	$aryResult=array();

	while($rows=$result->fetchRow())
	{
	  for($j=0;$j<$result->numCols();$j++)	
	  {
		$aryResult[$i][$j]=$rows[$j];
	  }
	  $i++;
	 }
	$pkcolnumbers='1'; 
        //gridDisplay_Select($fieldNames,$aryResult,$noofrows,$noofcols,$pkcolnumbers,$totrows,$offset="",$frmname="",$limit="",$EditfnName="",$stat="")
        ?>
		<table align="center" width="100%">
			<tr>
				<td width="100%" class="mainHeading" style="height:25px ">
					 <font color="#CC3300" ><b><i>List of Applications for CC from public</i></b></font>
				</td>
			</tr>
		</table>
		<!-- <div align="center" style="width:100%" class="mainHeading" style="margin:0px; vertical-align:middle; height:30px; padding:5px; "><font color="#CC3300" ><b><i>List of Applications for CC from public</i></b></font></div> -->
        <div align="center" style="height: 250px; overflow: auto;">
        <?php
	$objgridView->gridDisplay_Select($fieldNames,$aryResult,$noofrows,$noofcols,$pkcolnumbers,$totrows,0,'frmEC',20,'GetCCApplnEdit');
        ?>
        </div>
		
        <?php
		
		$fieldNames=array('Ssno','TransId','Applicant Name','House Name','City','Phone','Mobile','Select');

	 $query="select ssno,trans_id,appname,addr1,addr2,appphone,appmob from ccregister where (((cccertno is null or cccertno=0)  and  ccyear='$ccyear'
and applicationstatus not in  ('D', 'R', 'C') and sro_code='$ofcode' and trans_id like 'S%')) or 
                (applicationstatus in ('D', 'I','F') and trans_id like 'P%') order by ssno ";

	$result=OpenPearlDataBase::getInstance()->executeQueryOrdered($query);
	$i=0;
	$noofrows=$result->numRows();
	$noofcols=$result->numCols();
        
	$totrows=$objcommon->GetTotalRows("ccregister","(cccertno is null  or cccertno=0) and receiptno=0");
        
	$aryResult=array();

	while($rows=$result->fetchRow())
	{
	  for($j=0;$j<$result->numCols();$j++)
	  {
		$aryResult[$i][$j]=$rows[$j];
	  }
	  $i++;
	 }
	$pkcolnumbers='1'; 
	//echo $totrows;
        //gridDisplay_Select($fieldNames,$aryResult,$noofrows,$noofcols,$pkcolnumbers,$totrows,$offset="",$frmname="",$limit="",$EditfnName="",$stat="")
        ?>
		<br/>
		<table align="center" width="100%">
			<tr>
				<td width="100%" class="mainHeading" style="height:25px ">
					 <font color="#CC3300" ><b><i>List of Fee Remitted Applications</i></b></font>
				</td>
			</tr>
		</table>
		<!-- <div align="center" style="width:100%"><font color="#3333CC"><b><i>List of Fee Remitted Applications</i></b></font></div> -->
        <div align="center" style="height: 250px; overflow: auto;">
        <?php
	$objgridView->gridDisplay_Select($fieldNames,$aryResult,$noofrows,$noofcols,$pkcolnumbers,$totrows,0,'frmEC',20,'GetCCApplnEdit');
        ?>
        </div>
        <?php
 break;

 //================EditAppln for Appln pending========editecapln.php=============================CASE 33============validated==================================
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


        $objclsecapln->settransid(trim(strip_tags($_GET['transid'])));



	         $query="select sro_code,receiptno,user_login,time_stamp,ccyear,ssno,
				appname,addr1,addr2,appphone,appmob,appemail,
				apppincode,appidtype,appidnumber,appidexpdate,
				appidissuedate,dcode,search_from,search_to,docno,docyear,bookno,money_number,to_char(money_date,'dd/mm/YYYY')as money_date ,
				exe_name,exe_surname,exe_housename,exe_city,cl_name,cl_surname,
				cl_housename,cl_city,cc_stamp,app_fees,s_fees,priorityfee,copyfees,plan_charges,number_copy,
				cl_pincode,exe_pincode,no_words,plan,stat,volume,
				mode_payment,appdate,applicationstatus,trans_id,trans_code,original_stamp,no_white_papers,no_plan from ccregister 
				where trans_id='$transid' and trim(applicationstatus) in('I','N','E','D','F')";

		 $result=OpenPearlDataBase::getInstance()->executeQuery($query);
		 $rows=$result->fetchRow();
		 if($rows==0)
		 {
		 echo "Mesg: No Such Application Exists";
		 exit(0);
		 }
                 //echo "Mesg:".$objcomn->sqlDateformat(substr($rows['appdate'],0,10));
                // echo "Mesg:".$objcomn->ourDateformatfromSql(substr($rows['appidissuedate'],0,10));
                // exit();

		$_SESSION['transid_editcc']=$rows['trans_code'];
		$_SESSION['receiptno_editcc']=$rows['receiptno'];
		$_SESSION['first_letter']= substr($transid,0,1);
                $stat_tab=trim($rows['stat']);

                if($stat_tab=='T' && $rows['applicationstatus'] !='F'){
                        //echo "SSDG";
                        $objclsecapln->AcceptSSDG_form($stat_tab,$rows['ssno'],$objcomn->ourDateformatfromSql(substr($rows['appdate'],0,10)),$rows['dcode'],$rows['sro_code'],
                          $rows['appname'],$rows['addr1'],$rows['addr2'],$rows['apppincode'],
                          $rows['appemail'],$rows['appphone'],$rows['appmob'],$rows['appidtype'],
                          $rows['appidnumber'],substr($rows['appidissuedate'],0,10),substr($rows['appidexpdate'],0,10),
                          $rows['cl_name'],$rows['cl_surname'],$rows['cl_housename'],$rows['cl_city'],$rows['cl_pincode'],
                          $rows['exe_name'],$rows['exe_surname'],$rows['exe_housename'],$rows['exe_city'],$rows['exe_pincode'],
                          $rows['docno'],$rows['docyear'],$rows['bookno'],
                          $rows['search_from'],$rows['search_to'],$rows['cc_stamp'],$rows['mode_payment'],$rows['app_fees'],$rows['s_fees'],$rows['priorityfee'],$rows['trans_id'],
                          $rows['copyfees'],$rows['plan_charges'],$rows['number_copy'],$rows['ccyear'],$rows['no_words'],$rows['original_stamp'],$rows['no_white_papers'], $rows['applicationstatus'],
                          $rows['plan'],substr($transid,0,1),$rows['no_plan'],trim($rows['money_number']),trim($rows['money_date']),trim($rows['volume']));
                }
                else{ 
                        //echo "PEARL";
                        if((substr($transid,0,1)) == 'S' or (($rows['applicationstatus'] =='I' or $rows['applicationstatus'] =='F') and substr($transid,0,1) == 'P' ) )
                        {
                                //echo "Mesg: going to SRO area"; exit();
                         $objclsecapln->Loadapplnform("EA",$rows['ssno'],$objcomn->ourDateformatfromSql(substr($rows['appdate'],0,10)),$rows['dcode'],$rows['sro_code'],
                          $rows['appname'],$rows['addr1'],$rows['addr2'],$rows['apppincode'],
                          $rows['appemail'],$rows['appphone'],$rows['appmob'],$rows['appidtype'],
                          $rows['appidnumber'],substr($rows['appidissuedate'],0,10),substr($rows['appidexpdate'],0,10),
                          $rows['cl_name'],$rows['cl_surname'],$rows['cl_housename'],$rows['cl_city'],$rows['cl_pincode'],
                          $rows['exe_name'],$rows['exe_surname'],$rows['exe_housename'],$rows['exe_city'],$rows['exe_pincode'],
                          $rows['docno'],$rows['docyear'],$rows['bookno'],
                          $rows['search_from'],$rows['search_to'],$rows['cc_stamp'],$rows['mode_payment'],$rows['app_fees'],
                          $rows['s_fees'],$rows['priorityfee'],$rows['trans_id'],$rows['copyfees'],$rows['plan_charges'],$rows['number_copy'],$rows['ccyear'],$rows['no_words'],$rows['original_stamp'],$rows['no_white_papers'], $rows['applicationstatus'],substr($transid,0,1),$rows['no_plan'],trim($rows['stat']),trim($rows['volume']));

                        }
                        if(substr($transid,0,1) == 'P' and ($rows['applicationstatus'] !='I' and $rows['applicationstatus'] !='F'))
                        {
                                //echo "Mesg: going to public area"; exit();
                         $objclsecapln->Loadapplnform_public("EA",$rows['ssno'],$objcomn->ourDateformatfromSql(substr($rows['appdate'],0,10)),$rows['dcode'],$rows['sro_code'],
                          $rows['appname'],$rows['addr1'],$rows['addr2'],$rows['apppincode'],
                          $rows['appemail'],$rows['appphone'],$rows['appmob'],$rows['appidtype'],
                          $rows['appidnumber'],$objcomn->ourDateformatfromSql(substr($rows['appidissuedate'],0,10)),$objcomn->ourDateformatfromSql(substr($rows['appidexpdate'],0,10)),
                          $rows['cl_name'],$rows['cl_surname'],$rows['cl_housename'],$rows['cl_city'],$rows['cl_pincode'],
                          $rows['exe_name'],$rows['exe_surname'],$rows['exe_housename'],$rows['exe_city'],$rows['exe_pincode'],
                          $rows['docno'],$rows['docyear'],$rows['bookno'],
                          $rows['search_from'],$rows['search_to'],$rows['cc_stamp'],$rows['mode_payment'],$rows['app_fees'],$rows['s_fees'],$rows['priorityfee'],$rows['trans_id'],
                          $rows['copyfees'],$rows['plan_charges'],$rows['number_copy'],$rows['ccyear'],$rows['no_words'],$rows['original_stamp'],$rows['no_white_papers'], $rows['applicationstatus'],
                          $rows['plan'],substr($transid,0,1),$rows['no_plan'],trim($rows['money_number']),trim($rows['money_date']),trim($rows['volume']));

                        }
                }
                
                exit();


		



		 }
               } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time3"; exit(0);
		 }

	break;
   case 34:
	 try
{
//echo "Mesg: new save";exit();
        //=================================================Validation Started=====================================================


    if (isset($_POST['txtSsno']) and isset($_GET['stat']) and isset($_POST['ddlDist'])
        and isset($_POST['ddlSro']) and isset($_POST['txtDate']) and isset($_POST['txtName'])
        and isset($_POST['txtHouseno']) and isset($_POST['txtCity']) and  isset($_POST['txtPin'])
        and isset($_POST['txtEmail']) and isset($_POST['txtPhone']) and isset($_POST['txtmobile'])
        and isset($_POST['ddlAppId']) and isset($_POST['txtappidnumber']) and isset($_POST['txtappidissuedate'])
        and isset($_POST['txtappidexpdate']) and isset($_POST['txtClname']) and isset($_POST['txtClsurname']) 
		and isset($_POST['txtClhname'])
        and isset($_POST['txtClcity']) and isset($_POST['txtClpin']) and isset($_POST['txtExname'])
        and isset($_POST['txtExsurname']) and isset($_POST['txtExhname']) and isset($_POST['txtExcity'])
        and isset($_POST['txtExpin']) and isset($_POST['txtDocno']) and isset($_POST['txtYear'])
        and isset($_POST['txtBookno'])  /* and isset($_POST['txtFrom']) and isset($_POST['txtTo'])*/
        and isset($_POST['txtstamp']) and isset($_POST['ddlModeofPay']) and isset($_POST['txtFee']) 
        and isset($_POST['txtNoofcopy']) and isset($_POST['txtNoofword']) and isset($_POST['ddlPlan'])
		and isset($_POST['txtplanfee']) and isset($_POST['txtoriginalstamp']) and isset($_POST['txtnowhitepaper']) 
		and isset($_GET['tok']))

	
	
    {//and isset($_POST['txtpriorityfee'])



          $assoArray1 = array("Ssno"=>trim(strip_tags($_POST['txtSsno'])),
            "Date"=>trim(strip_tags($_POST['txtDate'])),
            "Name"=>trim(strip_tags($_POST['txtName'])),
            "House No/Name"=>trim(strip_tags($_POST['txtHouseno'])),
            /* "City/District"=>trim(strip_tags($_POST['txtCity'])),            
           "Claimant Name"=>trim(strip_tags($_POST['txtClname'])),
           "HouseNo/Name Of Claimant"=>trim(strip_tags($_POST['txtClhname'])),
            "City/District, PostOffice Of Claimant"=>trim(strip_tags($_POST['txtClcity'])),
            "Executant Name"=>trim(strip_tags($_POST['txtExname'])),
            "HouseNo/Name Of Executant"=>trim(strip_tags($_POST['txtExhname'])),
            "City/District, PostOffice Of Executant"=>trim(strip_tags($_POST['txtExcity'])),  */
           /* "From Date"=>trim(strip_tags($_POST['txtFrom'])),
            "To Date"=>trim(strip_tags($_POST['txtTo'])),*/
            "Value of Stamp Paper Submitted"=>trim(strip_tags($_POST['txtstamp'])),
            //"Click Calculate Fee --> Application Fee"=>trim(strip_tags($_POST['txtappfees'])),
            //"Click Calculate Fee --> Search Fee"=>trim(strip_tags($_POST['txtsearchfees'])),
            "Click Calculate Fee --> Total Fee Collected"=>trim(strip_tags($_POST['txtFee'])),
            "Number of Copy"=>trim(strip_tags($_POST['txtNoofcopy'])),
            "Number of Words"=>trim(strip_tags($_POST['txtNoofword'])),
			"Number of White Papers"=>trim(strip_tags($_POST['txtnowhitepaper']))
            );
        
          //,"ID No"=>trim(strip_tags($_POST['txtappidnumber'])),
          //  "Issued Date"=>trim(strip_tags($_POST['txtappidissuedate'])),"Expiry Date"=>trim(strip_tags($_POST['txtappidexpdate']))
          //
        //Claimant SurName"=>trim(strip_tags($_POST['txtClsurname'])),"Executant SurName"=>trim(strip_tags($_POST['txtExsurname'])), "Pincode"=>trim(strip_tags($_POST['txtPin'])),"Email"=>trim(strip_tags($_POST['txtEmail'])),"PhoneNo"=>trim(strip_tags($_POST['txtPhone'])),"Mobile"=>trim(strip_tags($_POST['txtmobile']))
             //"Pincode Of Claimant"=>trim(strip_tags($_POST['txtClpin'])),"Pincode Of Executant"=>trim(strip_tags($_POST['txtExpin']))
        //"DocNo"=>trim(strip_tags($_POST['txtDocno'])),"Year"=>trim(strip_tags($_POST['txtYear'])),"BookNo"=>trim(strip_tags($_POST['txtBookno'])),

        $assoArray2 = array("District"=>trim(strip_tags($_POST['ddlDist'])),"Sub-Registrar Office"=>trim(strip_tags($_POST['ddlSro'])),
            "Mode of Payment"=>trim(strip_tags($_POST['ddlModeofPay'])),
            "Wish To Get Priority"=>trim(strip_tags($_POST['ddlPriority'])),"Plan"=>trim(strip_tags($_POST['ddlPlan'])));
        //,"ID Type"=>trim(strip_tags($_POST['ddlAppId']))

       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }

        iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtSsno'])),"Ssno",5)!==true)
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
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtNoofcopy'])),"Number of Copy",3)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtNoofword'])),"Number of Words",5)!==true)
           {
               exit(0);
           }
		   iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtnowhitepaper'])),"Number of White Papers",5)!==true)
           {
               exit(0);
           }
  
    //**********************************************************************************************************************************
            //Allowed dot
             $assoArray2 = array("Name"=>$_POST['txtName'],"Claimant Name"=>trim(strip_tags($_POST['txtClname'])),
                                 "Claimant SurName"=>trim(strip_tags($_POST['txtClsurname'])),"Executant Name"=>trim(strip_tags($_POST['txtExname'])),
                                 "Executant SurName"=>trim(strip_tags($_POST['txtExsurname'])));

              iF ($objclsPhpValidation->_isSpclChar($assoArray2,array('.','/'))!==true)
           {
               exit(0);
           }
           
   //**********************************************************************************************************************************
            //Allow some specilal Characters
             $assoArray3 = array("House No/Name"=>trim(strip_tags($_POST['txtHouseno'])), "HouseNo/Name Of Claimant"=>trim(strip_tags($_POST['txtClhname'])),"HouseNo/Name Of Executant"=>trim(strip_tags($_POST['txtExhname'])));
             iF ($objclsPhpValidation->_isSpclChar($assoArray3,array('.','-',',','/'))!==true)
               {
                  exit(0);
               }
  //**********************************************************************************************************************************

                 //Allow some specilal Characters
             $assoArray4 = array( "City/District"=>trim(strip_tags($_POST['txtCity'])),"City/District, PostOffice Of Claimant"=>trim(strip_tags($_POST['txtClcity'])),"City/District, PostOffice Of Executant"=>trim(strip_tags($_POST['txtExcity'])));
              iF ($objclsPhpValidation->_isSpclChar($assoArray4,array('.','-',','))!==true)
           {
              exit(0);
           }  
 //**********************************************************************************************************************************

        iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtPin'])),"Applicant Pincode")!==true)
           {
              exit(0);
           }
            iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtClpin'])),"Pincode Of Claimant")!==true)
           {
              exit(0);
           }
             iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtExpin'])),"Pincode Of Executant")!==true)
           {
              exit(0);
           }
 //**********************************************************************************************************************************
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
 //**********************************************************************************************************************************
 // // No special character
             $assoArray1 = array("stat"=>$_GET['stat'],"Docno"=>$_POST['txtDocno'],"BookNo"=>$_POST['txtBookno']);

// allow "/"  special character

             $assoArray2= array("ID No"=>trim(strip_tags($_POST['txtappidnumber'])));

            /* commented on 02-02-2013  
             if(trim(strip_tags($_POST['ddlAppId']))!=0 and trim(strip_tags($_POST['ddlAppId']))!=-1)
             {
                 if(trim(strip_tags($_POST['txtappidnumber']))=="")
                 {
                     echo "Mesg: ID No Required";
                     exit(0);
                 }
             }   commented on 02-02-2013  */
 
           iF ($objclsPhpValidation->_isSpclChar($assoArray1)!==true)
           {
               exit(0);
           }
           
           iF ($objclsPhpValidation->_isSpclChar($assoArray2,array("/","-",".",","))!==true)
           {
               exit(0);
           }
           
         
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtBookno'])),"BookNo",1)!==true)
           {
               exit(0);
           }
          
            iF ($objclsPhpValidation->_isYear(trim(strip_tags($_POST['txtYear'])),"Year")!==true)
           {
               exit(0);
           }

 //**********************************************************************************************************************************
 //ID SHOULD BE VALIDATED BASED ON OpenPearlDataBase
 //**********************************************************************************************************************************
           iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtappidissuedate'])),"Issued Date"))
           {

           exit(0);
           }
           iF (!$objclsPhpValidation->_isDateBeforeToday(trim(strip_tags($_POST['txtappidissuedate'])),"Issued Date"))
           {

           exit(0);
           }
 //**********************************************************************************************************************************
  iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtappidexpdate'])),"Expiry Date"))
           {

           exit(0);
           }
           iF (!$objclsPhpValidation->_isDateAfterToday(trim(strip_tags($_POST['txtappidexpdate'])),"Expiry Date"))
           {

           exit(0);
           }
 //**********************************************************************************************************************************
           /* iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtFrom'])),"From Date"))
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
           }*/

 //**********************************************************************************************************************************
 iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtBookno'])),"BookNo",1)!==true)
           {
               exit(0);
           }
            if ((trim(strip_tags($_POST['txtBookno']))!="1" and trim(strip_tags($_POST['txtBookno']))!="3" and trim(strip_tags($_POST['txtBookno']))!="4") and trim(strip_tags($_POST['txtBookno']))!="")
            {
                echo "Mesg: Invalid Book No";
                exit(0);
            }
         
 //**********************************************************************************************************************************
 iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtstamp'])),"Value of Stamp Paper Submitted",5)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlModeofPay'])),"Mode of Payment",1)!==true)
           {
               exit(0);
           }
            if(trim(strip_tags($_POST['ddlPriority']))!=1 and trim(strip_tags($_POST['ddlPriority']))!=2)
            {
                echo "Mesg: Invalid Priority";
                exit(0);
            }

            if(trim(strip_tags($_POST['ddlPlan']))!=1 and trim(strip_tags($_POST['ddlPlan']))!=2)
            {
                echo "Mesg: Invalid Plan";
                exit(0);
            }

 //**********************************************************************************************************************************
 /* iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtappfees'])),"Application Fee",6)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtsearchfees'])),"Search Fee",6)!==true)
           {
               exit(0);
           }*/
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtCopyFee'])),"Copy Fee",6)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtFee'])),"Total Fee",6)!==true)
           {
               exit(0);
           }
            
  /*iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtpriorityfee'])), "Priority Fee",5)!==true)
           {
               exit(0);
           }*/
           

 //*****************************************************************Length Validation*****************************************************************
          

     if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtName'])),75, "Name")!==true)
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
		 if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtnowhitepaper'])), 5, "Number of White Papers")!==true)
        {
            exit(0);
        }

 //**********************************************************************************************************************************
         

       if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClname'])),90, "Claimant Name")!==true)
        {
            exit(0);
        }
       if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClsurname'])),75, "Claimant SurName")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClhname'])), 50,"HouseNo/Name Of Claimant")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClcity'])), 50,"City/District, PostOffice Of Claimant")!==true)
        {
            exit(0);
        }
       

 //**********************************************************************************************************************************
         
           

         if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExname'])),90, "Executant Name")!==true)
        {
            exit(0);
        }
          if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExsurname'])),75, "Executant SurName")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExhname'])), 50,"HouseNo/Name Of Executant")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExcity'])), 50,"City/District, PostOffice Of Executant")!==true)
        {
            exit(0);
        }
       
        
 //**********************************************************************************************************************************
       if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtappidnumber'])), 20,"ID No")!==true)
        {
            exit(0);
        }
            
//**********************************************************************************************************************************
         if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtDocno'])), 6, "DocNo")!==true)
        {
            exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtNoofcopy'])), 3, "Number of Copy")!==true)
        {
            exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtNoofword'])), 5, "Number of Words")!==true)
        {
            exit(0);
        }
        
       
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['stat'])),3,"stat")!==true)
        {
            exit(0);
        } 
//**********************************************************************************************************************************
  // modeofpayment from OpenPearlDataBase  ID SHOULD BE VALIDATED BASED ON OpenPearlDataBase
$objDDVal = new dropDownValidation();

if(!$objDDVal->checkDistrict(trim(strip_tags($_POST['ddlDist'])))) exit(0);

if(!$objDDVal->checkSRO(trim(strip_tags($_POST['ddlDist'])),trim(strip_tags($_POST['ddlSro'])))) exit(0);

if(!$objDDVal->checkSelectOption('idcard','id_type',trim(strip_tags($_POST['ddlAppId'])),'ID Type')) exit(0);

if(!$objDDVal->checkSelectOption('modeofpayment','id',trim(strip_tags($_POST['ddlModeofPay'])),'Mode of Payment')) exit(0);

//echo "11";exit();
unset($objDDVal);

////**********************************************************************************************************************************
   


           
      $stat=trim(strip_tags($_GET['stat']));
     
	$arr=split('[.-/]',trim(strip_tags($_POST['txtDate'])));
       $ccyear="";
	if (sizeof($arr)>0)
	{
		 $ccyear=$arr[2];
	}




         $objclsecapln->setstat(trim(strip_tags($_GET['stat'])));

         $objclsecapln->setssno(trim(strip_tags($_POST['txtSsno'])));
         $objclsecapln->setappdate(trim(strip_tags($_POST['txtDate'])));
         $objclsecapln->setccyear($ccyear);

 	 $objclsecapln->setdcode(trim(strip_tags($_POST['ddlDist'])));
	 $objclsecapln->setsro(trim(strip_tags($_POST['ddlSro'])));

         $objclsecapln->setapp_name(trim(strip_tags( $_POST['txtName'])));
         $objclsecapln->setapp_city(trim(strip_tags($_POST['txtCity'])));
         $objclsecapln->setapp_houseno(trim(strip_tags($_POST['txtHouseno'])));
         $objclsecapln->setapp_pin(trim(strip_tags($_POST['txtPin'])));
         $objclsecapln->setapp_email(trim(strip_tags($_POST['txtEmail'])));
         $objclsecapln->setapp_phone(trim(strip_tags($_POST['txtPhone'])));
         $objclsecapln->setapp_mobile(trim(strip_tags($_POST['txtmobile'])));

         $objclsecapln->setapp_idexpdate(trim(strip_tags($_POST['txtappidexpdate'])));

         $objclsecapln->setapp_idtype(trim(strip_tags($_POST['ddlAppId'])));
         $objclsecapln->setapp_idissuedate(trim(strip_tags($_POST['txtappidissuedate'])));
         $objclsecapln->setapp_idnumber(trim(strip_tags($_POST['txtappidnumber'])));


         $objclsecapln->setcl_name(trim(strip_tags( $_POST['txtClname'])));

         $objclsecapln->setclsur_name(trim(strip_tags( $_POST['txtClsurname'])));

         $objclsecapln->setcl_city(trim(strip_tags($_POST['txtClcity'])));
         $objclsecapln->setcl_houseno(trim(strip_tags($_POST['txtClhname'])));
         $objclsecapln->setcl_pin(trim(strip_tags($_POST['txtClpin'])));

         $objclsecapln->setex_name(trim(strip_tags( $_POST['txtExname'])));
         $objclsecapln->setexsur_name(trim(strip_tags( $_POST['txtExsurname'])));

         $objclsecapln->setex_city(trim(strip_tags($_POST['txtExcity'])));
         $objclsecapln->setex_houseno(trim(strip_tags($_POST['txtExhname'])));
         $objclsecapln->setex_pin(trim(strip_tags($_POST['txtExpin'])));

         $objclsecapln->setdocno(trim(strip_tags($_POST['txtDocno'])));
		 
         $objclsecapln->setbookno(trim(strip_tags($_POST['txtBookno'])));
         $objclsecapln->setdocyear(trim(strip_tags($_POST['txtYear'])));
		 	

 			
        
 /*
         $objclsecapln->setsearch_from(trim(strip_tags($_POST['txtFrom'])));
	 $objclsecapln->setsearch_to(trim(strip_tags($_POST['txtTo']))); */

         $objclsecapln->setnocopy(trim(strip_tags($_POST['txtNoofcopy'])));
         $objclsecapln->setnoword(trim(strip_tags($_POST['txtNoofword'])));
         $objclsecapln->setplan(trim(strip_tags($_POST['ddlPlan'])));
		 $objclsecapln->setoriginalstamp(trim(strip_tags($_POST['txtoriginalstamp'])));



         $objclsecapln->setstampduty(trim(strip_tags($_POST['txtstamp'])));
         
	 	$objclsecapln->setmodeofpay(trim(strip_tags($_POST['ddlModeofPay'])));
		


        $objclsecapln->setcopyfees(trim(strip_tags($_POST['txtCopyFee'])));
		$objclsecapln->setplanfee(trim(strip_tags($_POST['txtplanfee'])));
		$objclsecapln->setpfee(trim(strip_tags($_POST['txtpriorityfee'])));
		
		$objclsecapln->setnowhitepaper(trim(strip_tags($_POST['txtnowhitepaper'])));

	 $objclsecapln->setmodeofpay(trim(strip_tags($_POST['ddlModeofPay'])));

	 $objclsecapln->save_public($stat,'',trim($_GET['cnr']));

     }



	 } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Timewer"; exit(0);
		 }
	 break;
	 
	 case 35:
	 	try{
	 			//echo "Mesg: xml case 35"; //exit();
				 if( isset($_GET['ccyear'] ) and isset($_GET['sro'] )  and isset($_GET['ssno'] ) and isset($_GET['app_name'] ) and isset($_GET['appdate'] ) and isset($_GET['tok']))
            {
				$ccyear=trim($_GET['ccyear']); 
				$ccyear_new=date('Y'); 
				$sro= trim($_GET['sro']);
				$ssno= trim($_GET['ssno']);
				$app_name= trim($_GET['app_name']);
				$appdate=trim($_GET['appdate']); 
				$moneyno=trim($_GET['moneyno']); 
				$moneydate=trim($_GET['moneydate']);
				$modeofpay=trim($_GET['modeofpay']);  
				//echo "Mesg: ok"; //exit();
				$objclsecapln->print_first_receipt($ccyear,$sro,$ssno,$app_name,$appdate,$moneyno,$moneydate,$modeofpay,$ccyear_new);
			}
			else
			{
				echo "Mesg: error";
				exit();
			}
			} //end of Try
 		catch(Exception $e)
		 {
     		echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
	 
	 //*****************************case 36********************************************************************************************************
	 case 36:
	 try
	 {
	 //echo "Mesg: xml"; //exit();
	 
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

        $objclsecapln->settransid($_SESSION['trans_id']);
      
       
	

		 $objclsecapln->PrintApplication($_GET['transid']);


		 }
	 }
	 //end of Try
	 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Time"; exit(0);
		 }
	 break;
	 
//*********************************************

case 37 :
    
    try
{  // echo "Mesg: xml"; exit();
//echo "Mesg: save;go";
        //=================================================Validation Started=====================================================


    if (isset($_POST['txtSsno']) and isset($_GET['stat']) and isset($_POST['ddlDist'])
        and isset($_POST['ddlSro']) and isset($_POST['txtDate']) and isset($_POST['txtName'])
        and isset($_POST['txtHouseno']) and isset($_POST['txtCity']) and  isset($_POST['txtPin'])
        and isset($_POST['txtEmail']) and isset($_POST['txtPhone']) and isset($_POST['txtmobile'])
        and isset($_POST['ddlAppId']) and isset($_POST['txtappidnumber']) and isset($_POST['txtappidissuedate'])
        and isset($_POST['txtappidexpdate']) and isset($_POST['txtClname']) and isset($_POST['txtClsurname']) 
		and isset($_POST['txtClhname'])
        and isset($_POST['txtClcity']) and isset($_POST['txtClpin']) and isset($_POST['txtExname'])
        and isset($_POST['txtExsurname']) and isset($_POST['txtExhname']) and isset($_POST['txtExcity'])
        and isset($_POST['txtExpin']) and isset($_POST['txtDocno']) and isset($_POST['txtYear'])
        and isset($_POST['txtBookno'])  /* and isset($_POST['txtFrom']) and isset($_POST['txtTo'])*/
        and isset($_POST['txtstamp']) and isset($_POST['ddlModeofPay']) and isset($_POST['txtFee']) 
        and isset($_POST['txtNoofcopy']) and isset($_POST['txtNoofword']) and isset($_POST['ddlPlan'])
		and isset($_POST['txtnoplan']) and isset($_POST['txtplanfee']) and isset($_POST['txtoriginalstamp']) and isset($_GET['tok']))

	
	
    {//and isset($_POST['txtpriorityfee'])



          $assoArray1 = array("Ssno"=>trim(strip_tags($_POST['txtSsno'])),
            "Date"=>trim(strip_tags($_POST['txtDate'])),
            "Name"=>trim(strip_tags($_POST['txtName'])),
            "House No/Name"=>trim(strip_tags($_POST['txtHouseno'])),
           /* "City/District"=>trim(strip_tags($_POST['txtCity'])),            
            "Claimant Name"=>trim(strip_tags($_POST['txtClname'])),
           "HouseNo/Name Of Claimant"=>trim(strip_tags($_POST['txtClhname'])),
            "City/District, PostOffice Of Claimant"=>trim(strip_tags($_POST['txtClcity'])),
            "Executant Name"=>trim(strip_tags($_POST['txtExname'])),
            "HouseNo/Name Of Executant"=>trim(strip_tags($_POST['txtExhname'])),
            "City/District, PostOffice Of Executant"=>trim(strip_tags($_POST['txtExcity'])),  */
           /* "From Date"=>trim(strip_tags($_POST['txtFrom'])),
            "To Date"=>trim(strip_tags($_POST['txtTo'])),*/
            "Value of Stamp Paper Submitted"=>trim(strip_tags($_POST['txtstamp'])),
            //"Click Calculate Fee --> Application Fee"=>trim(strip_tags($_POST['txtappfees'])),
            //"Click Calculate Fee --> Search Fee"=>trim(strip_tags($_POST['txtsearchfees'])),
            "Click Calculate Fee --> Total Fee Collected"=>trim(strip_tags($_POST['txtFee'])),
            "Number of Copy"=>trim(strip_tags($_POST['txtNoofcopy'])),
            "Number of Words"=>trim(strip_tags($_POST['txtNoofword']))
            );
        
          //,"ID No"=>trim(strip_tags($_POST['txtappidnumber'])),
          //  "Issued Date"=>trim(strip_tags($_POST['txtappidissuedate'])),"Expiry Date"=>trim(strip_tags($_POST['txtappidexpdate']))
          //
        //Claimant SurName"=>trim(strip_tags($_POST['txtClsurname'])),"Executant SurName"=>trim(strip_tags($_POST['txtExsurname'])), "Pincode"=>trim(strip_tags($_POST['txtPin'])),"Email"=>trim(strip_tags($_POST['txtEmail'])),"PhoneNo"=>trim(strip_tags($_POST['txtPhone'])),"Mobile"=>trim(strip_tags($_POST['txtmobile']))
             //"Pincode Of Claimant"=>trim(strip_tags($_POST['txtClpin'])),"Pincode Of Executant"=>trim(strip_tags($_POST['txtExpin']))
        //"DocNo"=>trim(strip_tags($_POST['txtDocno'])),"Year"=>trim(strip_tags($_POST['txtYear'])),"BookNo"=>trim(strip_tags($_POST['txtBookno'])),

        $assoArray2 = array("District"=>trim(strip_tags($_POST['ddlDist'])),"Sub-Registrar Office"=>trim(strip_tags($_POST['ddlSro'])),
           "Mode of Payment"=>trim(strip_tags($_POST['ddlModeofPay'])),
            "Wish To Get Priority"=>trim(strip_tags($_POST['ddlPriority'])),"Plan"=>trim(strip_tags($_POST['ddlPlan'])));
        //,"ID Type"=>trim(strip_tags($_POST['ddlAppId']))

       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }

        iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtSsno'])),"Ssno",5)!==true)
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
       /* iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlTranstype'])),"Transaction Type",4)!==true)
           {
               exit(0);
           }*/

        iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlSro'])),"Sro",4)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtNoofcopy'])),"Number of Copy",3)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtnoplan'])),"Number of Plan",3)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtNoofword'])),"Number of Words",5)!==true)
           {
               exit(0);
           }

    //**********************************************************************************************************************************
            //Allowed dot
             $assoArray2 = array("Name"=>$_POST['txtName'],"Claimant Name"=>trim(strip_tags($_POST['txtClname'])),
                                 "Claimant SurName"=>trim(strip_tags($_POST['txtClsurname'])),"Executant Name"=>trim(strip_tags($_POST['txtExname'])),
                                 "Executant SurName"=>trim(strip_tags($_POST['txtExsurname'])));

              iF ($objclsPhpValidation->_isSpclChar($assoArray2,array('.','/'))!==true)
           {
               exit(0);
           }
           
   //**********************************************************************************************************************************
            //Allow some specilal Characters
             $assoArray3 = array("House No/Name"=>trim(strip_tags($_POST['txtHouseno'])), "HouseNo/Name Of Claimant"=>trim(strip_tags($_POST['txtClhname'])),"HouseNo/Name Of Executant"=>trim(strip_tags($_POST['txtExhname'])));
             iF ($objclsPhpValidation->_isSpclChar($assoArray3,array('.','-',',','/'))!==true)
               {
                  exit(0);
               }
  //**********************************************************************************************************************************

                 //Allow some specilal Characters
             $assoArray4 = array( "City/District"=>trim(strip_tags($_POST['txtCity'])),"City/District, PostOffice Of Claimant"=>trim(strip_tags($_POST['txtClcity'])),"City/District, PostOffice Of Executant"=>trim(strip_tags($_POST['txtExcity'])));
              iF ($objclsPhpValidation->_isSpclChar($assoArray4,array('.','-',','))!==true)
           {
              exit(0);
           }  
 //**********************************************************************************************************************************

        iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtPin'])),"Applicant Pincode")!==true)
           {
              exit(0);
           }
            iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtClpin'])),"Pincode Of Claimant")!==true)
           {
              exit(0);
           }
             iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtExpin'])),"Pincode Of Executant")!==true)
           {
              exit(0);
           }
 //**********************************************************************************************************************************
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
 //**********************************************************************************************************************************
 // // No special character
             $assoArray1 = array("stat"=>$_GET['stat'],"Docno"=>$_POST['txtDocno'],"BookNo"=>$_POST['txtBookno']);

// allow "/"  special character
             $assoArray2= array("ID No"=>trim(strip_tags($_POST['txtappidnumber'])));

              /* commented on 02-02-2013  
             if(trim(strip_tags($_POST['ddlAppId']))!=0 and trim(strip_tags($_POST['ddlAppId']))!=-1)
             {
                 if(trim(strip_tags($_POST['txtappidnumber']))=="")
                 {
                     echo "Mesg: ID No Required";
                     exit(0);
                 }
            }
             commented on 02-02-2013 */
             
           iF ($objclsPhpValidation->_isSpclChar($assoArray1)!==true)
           {
               exit(0);
           }
           
           iF ($objclsPhpValidation->_isSpclChar($assoArray2,array("/"))!==true)
           {
               exit(0);
           }
           
         
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtBookno'])),"BookNo",1)!==true)
           {
               exit(0);
           }
          
            iF ($objclsPhpValidation->_isYear(trim(strip_tags($_POST['txtYear'])),"Year")!==true)
           {
               exit(0);
           }

 //**********************************************************************************************************************************
 //ID SHOULD BE VALIDATED BASED ON OpenPearlDataBase
 //**********************************************************************************************************************************
           iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtappidissuedate'])),"Issued Date"))
           {

           exit(0);
           }
           iF (!$objclsPhpValidation->_isDateBeforeToday(trim(strip_tags($_POST['txtappidissuedate'])),"Issued Date"))
           {

           exit(0);
           }
 //**********************************************************************************************************************************
  iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtappidexpdate'])),"Expiry Date"))
           {

           exit(0);
           }
           iF (!$objclsPhpValidation->_isDateAfterToday(trim(strip_tags($_POST['txtappidexpdate'])),"Expiry Date"))
           {

           exit(0);
           }
 //**********************************************************************************************************************************
           /* iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtFrom'])),"From Date"))
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
           }*/

 //**********************************************************************************************************************************
 iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtBookno'])),"BookNo",1)!==true)
           {
               exit(0);
           }
            if ((trim(strip_tags($_POST['txtBookno']))!="1" and trim(strip_tags($_POST['txtBookno']))!="3" and trim(strip_tags($_POST['txtBookno']))!="4") and trim(strip_tags($_POST['txtBookno']))!="")
            {
                echo "Mesg: Invalid Book No";
                exit(0);
            }
         
 //**********************************************************************************************************************************
 iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtstamp'])),"Value of Stamp Paper Submitted",5)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlModeofPay'])),"Mode of Payment",1)!==true)
           {
               exit(0);
           }
            if(trim(strip_tags($_POST['ddlPriority']))!=1 and trim(strip_tags($_POST['ddlPriority']))!=2)
            {
                echo "Mesg: Invalid Priority";
                exit(0);
            }

            if(trim(strip_tags($_POST['ddlPlan']))!=1 and trim(strip_tags($_POST['ddlPlan']))!=2)
            {
                echo "Mesg: Invalid Plan";
                exit(0);
            }

 //**********************************************************************************************************************************
 /* iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtappfees'])),"Application Fee",6)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtsearchfees'])),"Search Fee",6)!==true)
           {
               exit(0);
           }*/
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtCopyFee'])),"Copy Fee",6)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtFee'])),"Total Fee",6)!==true)
           {
               exit(0);
           }
            
  /*iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtpriorityfee'])), "Priority Fee",5)!==true)
           {
               exit(0);
           }*/
           

 //*****************************************************************Length Validation*****************************************************************
          

     if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtName'])),75, "Name")!==true)
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

 //**********************************************************************************************************************************
         

       if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClname'])),90, "Claimant Name")!==true)
        {
            exit(0);
        }
       if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClsurname'])),75, "Claimant SurName")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClhname'])), 50,"HouseNo/Name Of Claimant")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClcity'])), 50,"City/District, PostOffice Of Claimant")!==true)
        {
            exit(0);
        }
       

 //**********************************************************************************************************************************
         
           

         if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExname'])),90, "Executant Name")!==true)
        {
            exit(0);
        }
          if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExsurname'])),75, "Executant SurName")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExhname'])), 50,"HouseNo/Name Of Executant")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExcity'])), 50,"City/District, PostOffice Of Executant")!==true)
        {
            exit(0);
        }
       
        
 //**********************************************************************************************************************************
       if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtappidnumber'])), 20,"ID No")!==true)
        {
            exit(0);
        }
            
//**********************************************************************************************************************************
         if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtDocno'])), 6, "DocNo")!==true)
        {
            exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtNoofcopy'])), 3, "Number of Copy")!==true)
        {
            exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtNoofword'])), 5, "Number of Words")!==true)
        {
            exit(0);
        }
        
       
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_GET['stat'])),3,"stat")!==true)
        {
            exit(0);
        } 
//**********************************************************************************************************************************
  // modeofpayment from OpenPearlDataBase  ID SHOULD BE VALIDATED BASED ON OpenPearlDataBase
$objDDVal = new dropDownValidation();

if(!$objDDVal->checkDistrict(trim(strip_tags($_POST['ddlDist'])))) exit(0);

if(!$objDDVal->checkSRO(trim(strip_tags($_POST['ddlDist'])),trim(strip_tags($_POST['ddlSro'])))) exit(0);

if(!$objDDVal->checkSelectOption('idcard','id_type',trim(strip_tags($_POST['ddlAppId'])),'ID Type')) exit(0);

if(!$objDDVal->checkSelectOption('modeofpayment','id',trim(strip_tags($_POST['ddlModeofPay'])),'Mode of Payment')) exit(0);

//echo "11";exit();
unset($objDDVal);

////**********************************************************************************************************************************
   


           
      $stat=trim(strip_tags($_GET['stat']));
     
	$arr=split('[.-/]',trim(strip_tags($_POST['txtDate'])));
       $ccyear="";
	if (sizeof($arr)>0)
	{
		 $ccyear=$arr[2];
	}




         $objclsecapln->setstat(trim(strip_tags($_GET['stat'])));

         $objclsecapln->setssno(trim(strip_tags($_POST['txtSsno'])));
         $objclsecapln->setappdate(trim(strip_tags($_POST['txtDate'])));
         $objclsecapln->setccyear($ccyear);

 	 $objclsecapln->setdcode(trim(strip_tags($_POST['ddlDist'])));
	 $objclsecapln->setsro(trim(strip_tags($_POST['ddlSro'])));

         $objclsecapln->setapp_name(trim(strip_tags( $_POST['txtName'])));
         $objclsecapln->setapp_city(trim(strip_tags($_POST['txtCity'])));
         $objclsecapln->setapp_houseno(trim(strip_tags($_POST['txtHouseno'])));
         $objclsecapln->setapp_pin(trim(strip_tags($_POST['txtPin'])));
         $objclsecapln->setapp_email(trim(strip_tags($_POST['txtEmail'])));
         $objclsecapln->setapp_phone(trim(strip_tags($_POST['txtPhone'])));
         $objclsecapln->setapp_mobile(trim(strip_tags($_POST['txtmobile'])));

         $objclsecapln->setapp_idexpdate(trim(strip_tags($_POST['txtappidexpdate'])));

         $objclsecapln->setapp_idtype(trim(strip_tags($_POST['ddlAppId'])));
         $objclsecapln->setapp_idissuedate(trim(strip_tags($_POST['txtappidissuedate'])));
         $objclsecapln->setapp_idnumber(trim(strip_tags($_POST['txtappidnumber'])));


         $objclsecapln->setcl_name(trim(strip_tags( $_POST['txtClname'])));

         $objclsecapln->setclsur_name(trim(strip_tags( $_POST['txtClsurname'])));

         $objclsecapln->setcl_city(trim(strip_tags($_POST['txtClcity'])));
         $objclsecapln->setcl_houseno(trim(strip_tags($_POST['txtClhname'])));
         $objclsecapln->setcl_pin(trim(strip_tags($_POST['txtClpin'])));

         $objclsecapln->setex_name(trim(strip_tags( $_POST['txtExname'])));
         $objclsecapln->setexsur_name(trim(strip_tags( $_POST['txtExsurname'])));

         $objclsecapln->setex_city(trim(strip_tags($_POST['txtExcity'])));
         $objclsecapln->setex_houseno(trim(strip_tags($_POST['txtExhname'])));
         $objclsecapln->setex_pin(trim(strip_tags($_POST['txtExpin'])));

         $objclsecapln->setdocno(trim(strip_tags($_POST['txtDocno'])));
         $objclsecapln->setbookno(trim(strip_tags($_POST['txtBookno'])));
         $objclsecapln->setdocyear(trim(strip_tags($_POST['txtYear'])));
		 	

 			$objclsecapln->setplanfee(trim(strip_tags($_POST['txtplanfee'])));
			$objclsecapln->setpfee(trim(strip_tags($_POST['txtpriorityfee'])));
        
 /*
         $objclsecapln->setsearch_from(trim(strip_tags($_POST['txtFrom'])));
	 $objclsecapln->setsearch_to(trim(strip_tags($_POST['txtTo']))); */

         $objclsecapln->setnocopy(trim(strip_tags($_POST['txtNoofcopy'])));
         $objclsecapln->setnoword(trim(strip_tags($_POST['txtNoofword'])));
         $objclsecapln->setplan(trim(strip_tags($_POST['ddlPlan']))); 
         $objclsecapln->setnoplan(trim(strip_tags($_POST['txtnoplan'])));
		 $objclsecapln->setoriginalstamp(trim(strip_tags($_POST['txtoriginalstamp'])));



         $objclsecapln->setstampduty(trim(strip_tags($_POST['txtstamp'])));
         
	 $objclsecapln->setmodeofpay(trim(strip_tags($_POST['ddlModeofPay'])));
	 $objclsecapln->setcccode();

         $objclsecapln->setapp_fees(1);

         $objclsecapln->sets_fees(10);

        $objclsecapln->setcopyfees(trim(strip_tags($_POST['txtCopyFee'])));
        $objclsecapln->setnowhitepaper(trim(strip_tags($_POST['txtnowhitepaper'])));

	 $objclsecapln->setmodeofpay(trim(strip_tags($_POST['ddlModeofPay'])));
	 $objclsecapln->setcccode();



	// $databaseObj->startTransaction();
	
//echo "Mesg: xml"; exit();
         $stat='EA';
	 $objclsecapln->save($stat);

	 //$databaseObj->commit();

     }



	 } //end of Try
 catch(Exception $e)
		 {
     echo "Mesg: Error Occured Retry After Some Timewer"; exit(0);
		 }
	 break;
 //=================================================================Issue All CC=============================CASE 38==============================================
case 38:
 $ofcode=$_SESSION['loggedinOffice'];
    $ccyear=date("Y",time());
	$query="SELECT  sro_code, ccyear, ssno, coalesce(receiptno,0) as receiptno, cccode, coalesce(cccertno,0) as cccertno, to_char(acceptdate,'dd/mm/yyyy') as acceptdate, 
       to_char(preparedate,'dd/mm/yyyy') as preparedate, appname, addr1, addr2, dcode, tcode, vcode, desam, 
       surno, sbdvnno, block, osurno, osbdvnno, to_char(search_from,'dd/mm/yyyy') as search_from, to_char(search_to,'dd/mm/yyyy') as search_to, 
       docno, docyear, bookno, exe_name, exe_surname, exe_housename, 
       cl_name, cl_surname, cl_housename, coalesce(cc_stamp,0) as cc_stamp, coalesce(app_fees,0) as app_fees, coalesce(s_fees,0) as s_fees, 
       coalesce(copyfees,0) as copyfees, opcode, appphone, appmob, appemail, apppincode, appidtype, 
       appidnumber, to_char(appidexpdate,'dd/mm/yyyy') as appidexpdate, to_char(appidissuedate,'dd/mm/yyyy') as appidissuedate, exe_city, exe_pincode, 
       cl_city, cl_pincode, coalesce(priorityfee,0) as priorityfee, mode_payment, to_char(appdate,'dd/mm/yyyy') as appdate, applicationstatus, 
       stat, trans_id, remarks, coalesce(original_stamp,0) as original_stamp, volume, coalesce(plan_charges,0) as plan_charges, 
       trans_code,to_char(money_date,'dd/mm/yyyy') as money_date, money_number, to_char(money_date_search,'dd/mm/yyyy') as money_date_search, money_number_search, 
       money_number_search_mode, coalesce(no_words,0) as no_words, coalesce(stamp_value,0) as stamp_value, coalesce(no_white_papers,0) as no_white_papers, 
       coalesce(number_copy,0) as number_copy, coalesce(copying_fee,0) as copying_fee, plan,coalesce(no_plan,0) as no_plan 
 	   from ccregister where (((cccertno is null or cccertno=0)  and  ccyear='$ccyear'
		and applicationstatus not in  ('D', 'R', 'C') and sro_code='$ofcode' and trans_id like 'S%')) or 
        (applicationstatus in ('D', 'I','F') and trans_id like 'P%') order by ssno ";

		$result=OpenPearlDataBase::getInstance()->executeQueryStmt($query);
		
		//exit();
		
		if($result!="error")
		{
		
		$i=0;
			while($rows=$result->fetchRow())
			{
				$i++;
					$id="chkSelApp".$i;
					if(isset($_POST[$id]))
					{
						$assoArray1 = array(
						
						"Ssno"=>trim($rows['ssno']),
						"Date"=>trim($rows['acceptdate']),
						"Name"=>trim($rows['appname']),
						"House No/Name"=>trim($rows['addr1']),
						"Value of Stamp Paper Submitted"=>trim($rows['stamp_value']),
						"Number of Copy"=>trim($rows['number_copy']),
						"Number of Words"=>trim($rows['no_words']),
						"District"=>trim($rows['dcode']),
						"Sub-Registrar Office"=>trim($rows['sro_code']),
						"Mode of Payment"=>trim($rows['mode_payment']),
						"Plan"=>trim($rows['plan'])
						);
						/*$assoArray2 = array("District"=>trim($rows['dcode']),"Sub-Registrar Office"=>trim($rows['sro_code']),
						"Mode of Payment"=>trim($rows['mode_payment']),"Plan"=>trim($rows['plan']);*/
						
				
					   if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
					   {
						  continue;
					   }
					   
					  /* if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
					   {
							exit(0);
					   }*/
						
					   if ($objclsPhpValidation->_isInteger(trim($rows['ssno']),"Ssno",5)!==true)
					   {
						   //exit(0);
						   continue;
					   }
					   if ($objclsPhpValidation->_isDate(trim($rows['acceptdate']),"Date")!==true)
					   {
						  continue;
					   }
					   
					   if ($objclsPhpValidation->_isInteger(trim($rows['dcode']),"District",2)!==true)
					   {
							  continue;
					   }
					   if ($objclsPhpValidation->_isInteger(trim($rows['sro_code']),"Sro",4)!==true)
					   {
							   continue;
					   }
					   if ($objclsPhpValidation->_isInteger(trim($rows['number_copy']),"Number of Copy",3)!==true)
					   {
						   continue;
					   }
					   if ($objclsPhpValidation->_isInteger(trim($rows['no_plan']),"Number of Plan",3)!==true)
					   {
						   continue;
					   }
					   if ($objclsPhpValidation->_isInteger(trim($rows['no_words']),"Number of Words",4)!==true)
					   {
						   continue;
					   }
				
					//**********************************************************************************************************************************
						//Allowed dot
					   /*$assoArray2 = array
					   (
					   "Name"=>trim($rows['appname']),
					   "Claimant Name"=>trim($rows['cl_name']),
						"Claimant SurName"=>trim($rows['cl_surname']),
						"Executant Name"=>trim($rows['exe_name']),
						"Executant SurName"=>trim($rows['exe_surname'])
						);
				
					   if ($objclsPhpValidation->_isSpclChar($assoArray2,array('.'))!==true)
					   {
						   exit(0);
					   }*/
						   
				   //**********************************************************************************************************************************
					//Allow some specilal Characters
					 $assoArray3 = array("House No/Name"=>trim($rows['addr1']), "HouseNo/Name Of Claimant"=>trim($rows['cl_housename']),
					 "HouseNo/Name Of Executant"=>trim($rows['exe_housename']));
					 if ($objclsPhpValidation->_isSpclChar($assoArray3,array('.','-',',','/'))!==true)
					 {
						 continue;
					 }
  //**********************************************************************************************************************************

					 //Allow some specilal Characters
					$assoArray4 = array( "City/District"=>trim($rows['addr2']),"City/District, PostOffice Of Claimant"=>trim($rows['cl_city']),
					"City/District, PostOffice Of Executant"=>trim($rows['exe_city']));
					iF ($objclsPhpValidation->_isSpclChar($assoArray4,array('.','-',','))!==true)
					{
						continue;
					}  
	 //**********************************************************************************************************************************
					
					if ($objclsPhpValidation->_isPincode(trim($rows['apppincode']),"Applicant Pincode")!==true)
					{
					   continue;
					}
					if ($objclsPhpValidation->_isPincode(trim($rows['cl_pincode']),"Pincode Of Claimant")!==true)
					{
					  continue;
					}
					if ($objclsPhpValidation->_isPincode(trim($rows['exe_pincode']),"Pincode Of Executant")!==true)
					{
					  continue;
					}
 //**********************************************************************************************************************************
				   if ($objclsPhpValidation->_isEmail(trim($rows['appemail']),"EmailID")!==true)
				   {
					   continue;
				   }
				   if ($objclsPhpValidation->_isPhoneNo(trim($rows['appphone']),"PhoneNumber")!==true)
				   {
					  continue;
				   }
				   if ($objclsPhpValidation->_isPhoneNo(trim($rows['appmob']),"Mobile")!==true)
				   {
					  continue;
				   }  
				   
			  
 //**********************************************************************************************************************************
				//  No special character
				 $assoArray1 = array("Docno"=>$rows['docno'],"BookNo"=>$rows['bookno']);
	
				// allow "/"  special character
				 $assoArray2= array("ID No"=>trim($rows['appidnumber']));
	
                             /* commented on 02-02-2013  
				 if(trim($rows['appidtype'])!='' and trim($rows['appidtype'])!=null and trim($rows['appidtype'])!=0)
				 {
					 if(trim($rows['appidnumber'])=="")
					 {
						 echo "Mesg: ID No Required";
						 continue;
					 }
				 }
				 commented on 02-02-2013 */ 
	 
				if ($objclsPhpValidation->_isSpclChar($assoArray1)!==true)
				{
				  continue;
				}
				if ($objclsPhpValidation->_isSpclChar($assoArray2,array("/"))!==true)
				{
				   continue;
				}
				if ($objclsPhpValidation->_isInteger($rows['bookno'],"BookNo",1)!==true)
				{
				   continue;
				}
				if ($objclsPhpValidation->_isYear(trim($rows['ccyear']),"Year")!==true)
				{
				   continue;
				}
				if (!$objclsPhpValidation->_isDate(trim($rows['appidissuedate']),"Issued Date"))
				{
					continue;
				}
				if (!$objclsPhpValidation->_isDateBeforeToday(trim($rows['appidissuedate']),"Issued Date"))
				{
					continue;
				}
				
	 //**********************************************************************************************************************************
				if (!$objclsPhpValidation->_isDate(trim($rows['appidexpdate']),"Expiry Date"))
				{
					continue;
				}
				if(trim($rows['appidexpdate'])!='01/01/1900' && trim($rows['appidexpdate'])!='' )
				{
					if (!$objclsPhpValidation->_isDateAfterToday(trim($rows['appidexpdate']),"Expiry Date"))
					{
						continue;
					}
				}
			
 //**********************************************************************************************************************************
				if (($rows['bookno']!="1" and $rows['bookno']!="3" and $rows['bookno']!="4") and $rows['bookno']!="")
				{
					echo "Mesg: Invalid Book No";
					continue;
				}
			 
	 //**********************************************************************************************************************************
			   if ($objclsPhpValidation->_isInteger(trim($rows['stamp_value']),"Value of Stamp Paper Submitted",5)!==true)
			   {
				   continue;
			   }
			   if ($objclsPhpValidation->_isInteger(trim($rows['mode_payment']),"Mode of Payment",1)!==true)
			   {
				  continue;
			   }
			   
				
 //**********************************************************************************************************************************
			   if ($objclsPhpValidation->_isInteger(trim($rows['copyfees']),"Copy Fee",6)!==true)
			   {
				   continue;
			   }
	//*****************************************************************Length Validation*****************************************************************
			  if ($objclsPhpValidation->_isLen(trim($rows['appname']),30, "Name")!==true)
			  {
				continue;
			  }
			  if ($objclsPhpValidation->_isLen(trim($rows['addr1']), 50,"House No/Name")!==true)
			  {
			  continue;
			  }
			  if ($objclsPhpValidation->_isLen(trim($rows['addr2']), 50,"City/District")!==true)
			  {
				continue;
			  }
			  
			  
			  if ($objclsPhpValidation->_isLen(trim($rows['appemail']),50, "EmailID")!==true)
			  {
			   continue;
			  }
 //**********************************************************************************************************************************
			 if ($objclsPhpValidation->_isLen(trim($rows['cl_name']),40, "Claimant Name")!==true)
			 {
				continue;
			 }
			if ($objclsPhpValidation->_isLen(trim($rows['cl_surname']),30, "Claimant SurName")!==true)
			{
				continue;
			}
			if ($objclsPhpValidation->_isLen(trim($rows['cl_housename']), 50,"HouseNo/Name Of Claimant")!==true)
			{
			  continue;
			}
			if ($objclsPhpValidation->_isLen(trim($rows['cl_city']), 50,"City/District, PostOffice Of Claimant")!==true)
			{
				continue;
			}
 //**********************************************************************************************************************************
			if ($objclsPhpValidation->_isLen(trim($rows['exe_name']),40, "Executant Name")!==true)
			{
				continue;
			}
			  if ($objclsPhpValidation->_isLen(trim($rows['exe_surname']),30, "Executant SurName")!==true)
			{
				continue;
			}
			if ($objclsPhpValidation->_isLen(trim($rows['exe_housename']), 50,"HouseNo/Name Of Executant")!==true)
			{
			  continue;
			}
			if ($objclsPhpValidation->_isLen(trim($rows['exe_city']), 50,"City/District, PostOffice Of Executant")!==true)
			{
				continue;
			}
		
 //**********************************************************************************************************************************
		   if ($objclsPhpValidation->_isLen(trim($rows['appidnumber']), 20,"ID No")!==true)
		   {
				continue;
		   }
	//**********************************************************************************************************************************
			 if ($objclsPhpValidation->_isLen(trim($rows['docno']), 6, "DocNo")!==true)
			{
				continue;
			}
	
			if ($objclsPhpValidation->_isLen(trim($rows['number_copy']), 3, "Number of Copy")!==true)
			{
				continue;
			}
	
			if ($objclsPhpValidation->_isLen(trim($rows['no_words']), 4, "Number of Words")!==true)
			{
				continue;
			}
			
//**********************************************************************************************************************************
		  // modeofpayment from OpenPearlDataBase  ID SHOULD BE VALIDATED BASED ON OpenPearlDataBase
			$objDDVal = new dropDownValidation();
			
			if(!$objDDVal->checkDistrict(trim($rows['dcode'])  )  ) continue;
			
			if(!$objDDVal->checkSRO(trim(strip_tags($rows['dcode'])),trim(strip_tags($rows['sro_code'])))) continue;
			
			if(!$objDDVal->checkSelectOption('idcard','id_type',trim($rows['appidtype']),'ID Type')) continue;
			
			if(!$objDDVal->checkSelectOption('modeofpayment','id',trim($rows['mode_payment']),'Mode of Payment')) continue;
			
			//echo "11";exit();
			unset($objDDVal);
////**********************************************************************************************************************************
			 
			 $ccyear=trim($rows['ccyear']);
			 $objclsecapln->setstat("EA");
		
			 $objclsecapln->setssno(trim($rows['ssno']));
			 $objclsecapln->setappdate(trim($rows['acceptdate']));
			 $objclsecapln->setccyear($ccyear);
		
			 $objclsecapln->setdcode(trim($rows['dcode']));
			 $objclsecapln->setsro(trim($rows['sro_code']));
		
			 $objclsecapln->setapp_name(trim( $rows['appname']));
			 $objclsecapln->setapp_city(trim($rows['addr2']));
			 $objclsecapln->setapp_houseno(trim($rows['addr1'])); 
			 $objclsecapln->setapp_pin(trim($rows['apppincode']));
			 $objclsecapln->setapp_email(trim($rows['appemail']));
			 $objclsecapln->setapp_phone(trim($rows['appphone']));
			 $objclsecapln->setapp_mobile(trim($rows['appmob']));
			 $objclsecapln->setapp_idexpdate(trim($rows['appidexpdate']));
			 $objclsecapln->setapp_idtype(trim($rows['appidtype']));
			 $objclsecapln->setapp_idissuedate(trim($rows['appidissuedate']));
			 $objclsecapln->setapp_idnumber(trim($rows['appidnumber']));
			 $objclsecapln->setcl_name(trim( $rows['cl_name']));
			 $objclsecapln->setclsur_name(trim( $rows['cl_surname']));
			 $objclsecapln->setcl_city(trim($rows['cl_city']));
			 $objclsecapln->setcl_houseno(trim($rows['cl_housename']));
			 $objclsecapln->setcl_pin(trim($rows['cl_pincode']));
		
			 $objclsecapln->setex_name(trim( $rows['exe_name']));
			 $objclsecapln->setexsur_name(trim( $rows['exe_surname']));
			 $objclsecapln->setex_city(trim($rows['exe_city']));
			 $objclsecapln->setex_houseno(trim($rows['exe_housename']));
			 $objclsecapln->setex_pin(trim($rows['exe_pincode']));
			 $objclsecapln->setdocno(trim($rows['docno']));
			 $objclsecapln->setbookno(trim($rows['bookno']));
			 $objclsecapln->setdocyear(trim($rows['docyear']));
			$objclsecapln->setplanfee(trim($rows['plan_charges']));
			$objclsecapln->setpfee(trim($rows['priorityfee']));
			$objclsecapln->setnocopy(trim($rows['number_copy']));
			$objclsecapln->setnoword(trim($rows['no_words']));
			$objclsecapln->setplan(trim($rows['plan'])); 
			$objclsecapln->setnoplan(trim($rows['no_plan']));
			$objclsecapln->setoriginalstamp(trim($rows['original_stamp']));
			$objclsecapln->setstampduty(trim($rows['stamp_value']));
			$objclsecapln->setmodeofpay(trim($rows['mode_payment']));
			$objclsecapln->setcccode();
			$objclsecapln->setapp_fees(1);
			$objclsecapln->sets_fees(10);
			$objclsecapln->setcopyfees(trim($rows['copyfees']));
			$objclsecapln->setnowhitepaper(trim($rows['no_white_papers']));
			$_SESSION['trans_id']=trim($rows['trans_id']);
			$_SESSION['transid_editcc']=$rows['trans_id'];
			$_SESSION['receiptno_editcc']=$rows['receiptno'];
			$_SESSION['first_letter']= substr(trim($rows['trans_id']),0,1);

	
			$objclsecapln->save('EA');
			}//is set checkbox
		}//while
	}//if result not error
	else
		echo "Mesg:Unable to Issue All Copies Together. Try One by One";
break;
case 39:	
	$objgridView= new gridView();
	$objcommon = new Common();
    $ofcode=$_SESSION['loggedinOffice'];
    $ccyear=date("Y",time());
	$fieldNames=array('Sl No','Application Date','TransId','Applicant Name','House Name','City','Select');

	$query="select ssno,to_char(appdate,'dd/mm/YYYY') as appdate,trans_id,appname,addr1,addr2,stat from ccregister
                where ((cccertno is null  or cccertno=0) and applicationstatus not in  ('R', 'C', 'I', 'F', 'D')
        and sro_code='$ofcode'  and trans_id like 'P%')  order by ssno";
	$result=OpenPearlDataBase::getInstance()->executeQueryOrdered($query);
	$i=0;
	$totrows=$noofrows=$result->numRows();
	$noofcols=$result->numCols();
        $noofcols=$noofcols-1;
	//$totrows=$objcommon->GetTotalRows("ccregister","(cccertno is null  or cccertno=0) and receiptno=0");
        
	$aryResult=array();

	while($rows=$result->fetchRow())
	{
	  for($j=0;$j<$result->numCols();$j++)	
	  {
		$aryResult[$i][$j]=$rows[$j];
	  }
	  $i++;
	 }
	$pkcolnumbers='2'; 
       //$objgridView->gridDisplay_Select($fieldNames,$aryResult,$noofrows,$noofcols,$pkcolnumbers,$totrows,$offset="",$frmname="",$limit="",$EditfnName="",$stat="")
        ?>
		<table align="center" width="100%">
			<tr>
				<td width="100%" class="mainHeading" style="height:25px ">
					 <font color="#CC3300" ><b><i>List of Applications for CC from public</i></b></font>
				</td>
			</tr>
		</table>
		<!-- <div align="center" style="width:100%" class="mainHeading" style="margin:0px; vertical-align:middle; height:30px; padding:5px; "><font color="#CC3300" ><b><i>List of Applications for CC from public</i></b></font></div> -->
        <div align="center" style="height: 250px; overflow: auto;">
        <?php
	$objgridView->gridDisplay_Select($fieldNames,$aryResult,$noofrows,$noofcols,$pkcolnumbers,$totrows,0,'frmCC',20,'GetCCApplnEdit');
        ?>
        </div>
        <?php
		
		$fieldNames=array('Ssno','TransId','Applicant Name','House Name','City','Phone','Mobile','Select');

	 $query="select ssno,trans_id,appname,addr1,addr2,appphone,appmob,applicationstatus,stat from ccregister where
	  (((cccertno is null or cccertno=0)  and  ccyear='$ccyear'
		and applicationstatus not in  ('D', 'R', 'C') and sro_code='$ofcode' and trans_id like 'S%')) or 
                (applicationstatus in ('D', 'I','F') and trans_id like 'P%') order by ssno ";
	$result=OpenPearlDataBase::getInstance()->executeQueryOrdered($query);
	$i=0;
	$totrows=$noofrows=$result->numRows();
	$noofcols=$result->numCols();
        
	//$totrows=$objcommon->GetTotalRows("ccregister","(cccertno is null  or cccertno=0) and receiptno=0");
        
	$aryResult=array();

	/*while($rows=$result->fetchRow())
	{
	  for($j=0;$j<$result->numCols();$j++)
	  {
		$aryResult[$i][$j]=$rows[$j];
	  }
	  $i++;
	 }*/
	$pkcolnumbers='1'; 
	//echo $totrows;
    //$objgridView->gridDisplay_Select($fieldNames,$aryResult,$noofrows,$noofcols,$pkcolnumbers,$totrows,$offset="",$frmname="",$limit="",$EditfnName="",$stat="")
        ?>
		<br/>
		<table align="center" width="100%">
			<tr>
				<td width="100%" class="mainHeading" style="height:25px ">
					 <font color="#CC3300" ><b><i>List of Fee Remitted Applications</i></b></font>
				</td>
			</tr>
		</table>
		<!-- <div align="center" style="width:100%"><font color="#3333CC"><b><i>List of Fee Remitted Applications</i></b></font></div> -->
        <div align="center" style="height: 250px; overflow: auto;">
		<table  border="0" align="center" cellpadding="1" cellspacing="0" width="100%" ><!-- for border -->
		<tr class="row">
		<td>
			<table  border="1" cellpadding="2" cellspacing="2" width="100%" class="subTable">
			<tr class="titleRow">
				<!--<th class="titleRow"  align="center">Select All
				<input type=checkbox style="height: 20px;" align="middle" title="Check All"  id="checkAll" name="checkAll" onClick="CheckAll('<?php echo $noofrows;?>');">
				</th> -->
                                <th class="titleRow"  align="center">Ssno</th>
				<th class="titleRow"  align="center">TransId</th>
				<th class="titleRow"  align="center">Applicant Name</th> 
				<th class="titleRow"  align="center">House Name</th>
				<th class="titleRow"  align="center">City</th>
				<th class="titleRow"  align="center">Phone </th>
				<th class="titleRow"  align="center"> Mobile </th>
				<th class="titleRow"  align="center"> Select</th>
				<th class="titleRow"  align="center"></th>
		   </tr>
		   <?php
		   $i=0;
		   while($rows=$result->fetchRow())
		   {
		  $i++;
		   ?>
                        <tr class="row" style="<?php if(trim($rows[8])=='T') echo 'color: #623554; height: 25px; cursor: pointer; background-color: #ede4e4;'; ?> ">
			  <!--<td   align="center"  >
			  <?php   ?>
				<input type=checkbox style="height: 20px;" align="middle" title="Click to Select"  id="<?php echo 'chkSelApp'.$i; ?>" name="<?php echo 'chkSelApp'.$i; ?>">
              </td> -->
			 <td align="center"><?php echo $rows[0]; ?></td>
			 <td align="center"><?php echo $rows[1];?></td>
			 <td align="center"><?php echo $rows[2]; ?></td> 
			 <td align="center"><?php echo $rows[3]; ?></td>
			 <td align="center"><?php echo $rows[4]; ?></td>
			 <td align="center"><?php echo $rows[5];  ?></td>
			 <td align="center"><?php echo $rows[6]; ?></td>
			 <td align="center">
					<img src="images/edit-icon.gif"  height="20px"  alt="Click to Edit"  align="middle" id="<?php echo "Edit_".$i; ?>" onClick="EditCCAppln('<?php echo $rows[1]; ?>');" name="<?php echo "Edit_".$i; ?>" title="Click to Edit"  style="cursor: pointer;">
			 </td>
			 </tr>
		   <?php
		    
		   }
		   ?>
		</table>
		</td>
		</tr>
	</table>
</div>
<!-- 		<table width="100%">
				<tr>
						 <td  align="center" colspan="6">
						 <?php
						 if(isset($_SESSION['userRole']))
						 {
									//if($this->isAuthorizedforTask("Issue CC",$_SESSION['userRole']))
									//{
							?>
									   <input  type="button" name="btnIssCopy"  value="Issue All"  onClick="IssueAll();" class="btnStyle" >
							<?php
									//}
						   
					    }
						 ?>
				</tr>
  		</table> -->
        <?php
break;



case 40:

    try
{

        //=================================================Validation Started=====================================================


    if (isset($_POST['txtSsno']) and isset($_POST['ddlDist'])
        and isset($_POST['ddlSro']) and isset($_POST['txtDate']) and isset($_POST['txtName'])
        and isset($_POST['txtHouseno']) and isset($_POST['txtCity']) and  isset($_POST['txtPin'])
        and isset($_POST['txtEmail']) and isset($_POST['txtPhone']) and isset($_POST['txtmobile'])
        and isset($_POST['ddlAppId']) and isset($_POST['txtappidnumber']) and isset($_POST['txtappidissuedate'])
        and isset($_POST['txtappidexpdate']) and isset($_POST['txtClname']) and isset($_POST['txtClsurname'])
		and isset($_POST['txtClhname'])
        and isset($_POST['txtClcity']) and isset($_POST['txtClpin']) and isset($_POST['txtExname'])
        and isset($_POST['txtExsurname']) and isset($_POST['txtExhname']) and isset($_POST['txtExcity'])
        and isset($_POST['txtExpin']) and isset($_POST['txtDocno']) and isset($_POST['txtYear'])
        and isset($_POST['txtBookno'])  /* and isset($_POST['txtFrom']) and isset($_POST['txtTo'])*/
        and isset($_POST['txtstamp']) and isset($_POST['ddlModeofPay']) and isset($_POST['txtFee'])
        and isset($_POST['txtNoofcopy']) and isset($_POST['txtNoofword']) and isset($_POST['ddlPlan'])
		and isset($_POST['txtplanfee']) and isset($_POST['txtoriginalstamp']) and isset($_POST['txtnowhitepaper'])
		and isset($_GET['tok']))



    { 



            $assoArray1 = array("Ssno"=>trim(strip_tags($_POST['txtSsno'])),
            "Date"=>trim(strip_tags($_POST['txtDate'])),
            "Name"=>trim(strip_tags($_POST['txtName'])),
            "House No/Name"=>trim(strip_tags($_POST['txtHouseno'])),
            "Value of Stamp Paper Submitted"=>trim(strip_tags($_POST['txtstamp'])),
            "Click Calculate Fee --> Total Fee Collected"=>trim(strip_tags($_POST['txtFee'])),
            "Number of Copy"=>trim(strip_tags($_POST['txtNoofcopy'])),
            "Number of Words"=>trim(strip_tags($_POST['txtNoofword'])),
            "Number of White Papers"=>trim(strip_tags($_POST['txtnowhitepaper']))
            );

        $assoArray2 = array("District"=>trim(strip_tags($_POST['ddlDist'])),"Sub-Registrar Office"=>trim(strip_tags($_POST['ddlSro'])),
            "Mode of Payment"=>trim(strip_tags($_POST['ddlModeofPay'])),
            "Wish To Get Priority"=>trim(strip_tags($_POST['ddlPriority'])),"Plan"=>trim(strip_tags($_POST['ddlPlan'])));

       if ($objclsPhpValidation->_isEmpty($assoArray1)!== true)
       {

           exit(0);

       }
       if ($objclsPhpValidation->_isSelect($assoArray2)!==true)
       {

            exit(0);

       }

        iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtSsno'])),"Ssno",5)!==true)
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
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtNoofcopy'])),"Number of Copy",3)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtNoofword'])),"Number of Words",5)!==true)
           {
               exit(0);
           }
		   iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtnowhitepaper'])),"Number of White Papers",5)!==true)
           {
               exit(0);
           }

    //**********************************************************************************************************************************
            //Allowed dot
             $assoArray2 = array("Name"=>$_POST['txtName'],"Claimant Name"=>trim(strip_tags($_POST['txtClname'])),
                                 "Claimant SurName"=>trim(strip_tags($_POST['txtClsurname'])),"Executant Name"=>trim(strip_tags($_POST['txtExname'])),
                                 "Executant SurName"=>trim(strip_tags($_POST['txtExsurname'])));

              iF ($objclsPhpValidation->_isSpclChar($assoArray2,array('.','/'))!==true)
           {
               exit(0);
           }

   //**********************************************************************************************************************************
            //Allow some specilal Characters
             $assoArray3 = array("House No/Name"=>trim(strip_tags($_POST['txtHouseno'])), "HouseNo/Name Of Claimant"=>trim(strip_tags($_POST['txtClhname'])),"HouseNo/Name Of Executant"=>trim(strip_tags($_POST['txtExhname'])));
             iF ($objclsPhpValidation->_isSpclChar($assoArray3,array('.','-',',','/'))!==true)
               {
                  exit(0);
               }
  //**********************************************************************************************************************************

                 //Allow some specilal Characters
             $assoArray4 = array( "City/District"=>trim(strip_tags($_POST['txtCity'])),"City/District, PostOffice Of Claimant"=>trim(strip_tags($_POST['txtClcity'])),"City/District, PostOffice Of Executant"=>trim(strip_tags($_POST['txtExcity'])));
              iF ($objclsPhpValidation->_isSpclChar($assoArray4,array('.','-',','))!==true)
           {
              exit(0);
           }
 //**********************************************************************************************************************************

        iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtPin'])),"Applicant Pincode")!==true)
           {
              exit(0);
           }
            iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtClpin'])),"Pincode Of Claimant")!==true)
           {
              exit(0);
           }
             iF ($objclsPhpValidation->_isPincode(trim(strip_tags($_POST['txtExpin'])),"Pincode Of Executant")!==true)
           {
              exit(0);
           }
 //**********************************************************************************************************************************
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
 //**********************************************************************************************************************************

             $assoArray1 = array("Docno"=>$_POST['txtDocno'],"BookNo"=>$_POST['txtBookno']);

             $assoArray2= array("ID No"=>trim(strip_tags($_POST['txtappidnumber'])));


           iF ($objclsPhpValidation->_isSpclChar($assoArray1)!==true)
           {
               exit(0);
           }

           iF ($objclsPhpValidation->_isSpclChar($assoArray2,array("/","-",".",","))!==true)
           {
               exit(0);
           }


           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtBookno'])),"BookNo",1)!==true)
           {
               exit(0);
           }

            iF ($objclsPhpValidation->_isYear(trim(strip_tags($_POST['txtYear'])),"Year")!==true)
           {
               exit(0);
           }

 //**********************************************************************************************************************************
 //ID SHOULD BE VALIDATED BASED ON OpenPearlDataBase
 //**********************************************************************************************************************************
           iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtappidissuedate'])),"Issued Date"))
           {

           exit(0);
           }
           iF (!$objclsPhpValidation->_isDateBeforeToday(trim(strip_tags($_POST['txtappidissuedate'])),"Issued Date"))
           {

           exit(0);
           }
 //**********************************************************************************************************************************
  iF (!$objclsPhpValidation->_isDate(trim(strip_tags($_POST['txtappidexpdate'])),"Expiry Date"))
           {

           exit(0);
           }
           iF (!$objclsPhpValidation->_isDateAfterToday(trim(strip_tags($_POST['txtappidexpdate'])),"Expiry Date"))
           {

           exit(0);
           }

 //**********************************************************************************************************************************
 iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtBookno'])),"BookNo",1)!==true)
           {
               exit(0);
           }
            if ((trim(strip_tags($_POST['txtBookno']))!="1" and trim(strip_tags($_POST['txtBookno']))!="3" and trim(strip_tags($_POST['txtBookno']))!="4") and trim(strip_tags($_POST['txtBookno']))!="")
            {
                echo "Mesg: Invalid Book No";
                exit(0);
            }

 //**********************************************************************************************************************************
 iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtstamp'])),"Value of Stamp Paper Submitted",5)!==true)
           {
               exit(0);
           }
           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['ddlModeofPay'])),"Mode of Payment",1)!==true)
           {
               exit(0);
           }
            if(trim(strip_tags($_POST['ddlPriority']))!=1 and trim(strip_tags($_POST['ddlPriority']))!=2)
            {
                echo "Mesg: Invalid Priority";
                exit(0);
            }

            if(trim(strip_tags($_POST['ddlPlan']))!=1 and trim(strip_tags($_POST['ddlPlan']))!=2)
            {
                echo "Mesg: Invalid Plan";
                exit(0);
            }

 //**********************************************************************************************************************************

           iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtCopyFee'])),"Copy Fee",6)!==true)
           {
               exit(0);
           }
            iF ($objclsPhpValidation->_isInteger(trim(strip_tags($_POST['txtFee'])),"Total Fee",6)!==true)
           {
               exit(0);
           }


 //*****************************************************************Length Validation*****************************************************************


     if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtName'])),75, "Name")!==true)
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
		 if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtnowhitepaper'])), 5, "Number of White Papers")!==true)
        {
            exit(0);
        }

 //**********************************************************************************************************************************


       if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClname'])),90, "Claimant Name")!==true)
        {
            exit(0);
        }
       if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClsurname'])),75, "Claimant SurName")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClhname'])), 50,"HouseNo/Name Of Claimant")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtClcity'])), 50,"City/District, PostOffice Of Claimant")!==true)
        {
            exit(0);
        }


 //**********************************************************************************************************************************



         if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExname'])),90, "Executant Name")!==true)
        {
            exit(0);
        }
          if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExsurname'])),75, "Executant SurName")!==true)
        {
            exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExhname'])), 50,"HouseNo/Name Of Executant")!==true)
        {
           exit(0);
        }
        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtExcity'])), 50,"City/District, PostOffice Of Executant")!==true)
        {
            exit(0);
        }


 //**********************************************************************************************************************************
       if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtappidnumber'])), 20,"ID No")!==true)
        {
            exit(0);
        }

//**********************************************************************************************************************************
         if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtDocno'])), 6, "DocNo")!==true)
        {
            exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtNoofcopy'])), 3, "Number of Copy")!==true)
        {
            exit(0);
        }

        if ($objclsPhpValidation->_isLen(trim(strip_tags($_POST['txtNoofword'])), 5, "Number of Words")!==true)
        {
            exit(0);
        }


//**********************************************************************************************************************************
  // modeofpayment from OpenPearlDataBase  ID SHOULD BE VALIDATED BASED ON OpenPearlDataBase
$objDDVal = new dropDownValidation();

if(!$objDDVal->checkDistrict(trim(strip_tags($_POST['ddlDist'])))) exit(0);

if(!$objDDVal->checkSRO(trim(strip_tags($_POST['ddlDist'])),trim(strip_tags($_POST['ddlSro'])))) exit(0);

if(!$objDDVal->checkSelectOption('idcard','id_type',trim(strip_tags($_POST['ddlAppId'])),'ID Type')) exit(0);

if(!$objDDVal->checkSelectOption('modeofpayment','id',trim(strip_tags($_POST['ddlModeofPay'])),'Mode of Payment')) exit(0);

//echo "11";exit();
unset($objDDVal);

////**********************************************************************************************************************************


	$arr=split('[.-/]',trim(strip_tags($_POST['txtDate'])));
       $ccyear="";
	if (sizeof($arr)>0)
	{
		 $ccyear=$arr[2];
	}

         $objclsecapln->setssno(trim(strip_tags($_POST['txtSsno'])));
         $objclsecapln->setappdate(trim(strip_tags($_POST['txtDate'])));
         $objclsecapln->setccyear($ccyear);

 	 $objclsecapln->setdcode(trim(strip_tags($_POST['ddlDist'])));
	 $objclsecapln->setsro(trim(strip_tags($_POST['ddlSro'])));

         $objclsecapln->setapp_name(trim(strip_tags( $_POST['txtName'])));
         $objclsecapln->setapp_city(trim(strip_tags($_POST['txtCity'])));
         $objclsecapln->setapp_houseno(trim(strip_tags($_POST['txtHouseno'])));
         $objclsecapln->setapp_pin(trim(strip_tags($_POST['txtPin'])));
         $objclsecapln->setapp_email(trim(strip_tags($_POST['txtEmail'])));
         $objclsecapln->setapp_phone(trim(strip_tags($_POST['txtPhone'])));
         $objclsecapln->setapp_mobile(trim(strip_tags($_POST['txtmobile'])));

         $objclsecapln->setapp_idexpdate(trim(strip_tags($_POST['txtappidexpdate'])));

         $objclsecapln->setapp_idtype(trim(strip_tags($_POST['ddlAppId'])));
         $objclsecapln->setapp_idissuedate(trim(strip_tags($_POST['txtappidissuedate'])));
         $objclsecapln->setapp_idnumber(trim(strip_tags($_POST['txtappidnumber'])));


         $objclsecapln->setcl_name(trim(strip_tags( $_POST['txtClname'])));

         $objclsecapln->setclsur_name(trim(strip_tags( $_POST['txtClsurname'])));

         $objclsecapln->setcl_city(trim(strip_tags($_POST['txtClcity'])));
         $objclsecapln->setcl_houseno(trim(strip_tags($_POST['txtClhname'])));
         $objclsecapln->setcl_pin(trim(strip_tags($_POST['txtClpin'])));

         $objclsecapln->setex_name(trim(strip_tags( $_POST['txtExname'])));
         $objclsecapln->setexsur_name(trim(strip_tags( $_POST['txtExsurname'])));

         $objclsecapln->setex_city(trim(strip_tags($_POST['txtExcity'])));
         $objclsecapln->setex_houseno(trim(strip_tags($_POST['txtExhname'])));
         $objclsecapln->setex_pin(trim(strip_tags($_POST['txtExpin'])));

         $objclsecapln->setdocno(trim(strip_tags($_POST['txtDocno'])));

         $objclsecapln->setbookno(trim(strip_tags($_POST['txtBookno'])));
         $objclsecapln->setdocyear(trim(strip_tags($_POST['txtYear'])));


         $objclsecapln->setnocopy(trim(strip_tags($_POST['txtNoofcopy'])));
         $objclsecapln->setnoword(trim(strip_tags($_POST['txtNoofword'])));
         $objclsecapln->setplan(trim(strip_tags($_POST['ddlPlan'])));
		 $objclsecapln->setoriginalstamp(trim(strip_tags($_POST['txtoriginalstamp'])));



         $objclsecapln->setstampduty(trim(strip_tags($_POST['txtstamp'])));

	$objclsecapln->setmodeofpay(trim(strip_tags($_POST['ddlModeofPay'])));



        $objclsecapln->setcopyfees(trim(strip_tags($_POST['txtCopyFee'])));
        $objclsecapln->setplanfee(trim(strip_tags($_POST['txtplanfee'])));
        $objclsecapln->setpfee(trim(strip_tags($_POST['txtpriorityfee'])));

        $objclsecapln->setnowhitepaper(trim(strip_tags($_POST['txtnowhitepaper'])));

	 $objclsecapln->setmodeofpay(trim(strip_tags($_POST['ddlModeofPay'])));





	 $objclsecapln->save_ssdg_aplcn();

        }
    } //end of Try
    catch(Exception $e)
    {
        echo "Mesg: Error Occured Retry After Some Timewer"; exit(0);
    }
    break;
    case 41:
                    $objclsecapln->DisplaySuccessMsg();
                    break;

}//end of switch

?>