<?php

      require_once("../pearllogin_templatexml.php");
       include '../classes/class.list_doc_desamwise.php';

	$option = $_GET['option'];
	$list_tobj= new list_documentdesam();
	$databaseObj = OpenPearlDataBase::getInstance();
	$phpVal = new PhpValidation();

	switch($option) {


		case 0:
                         try
                         {

				$fromdate = $_GET['fromdate'];
				$todate = $_GET['todate'];
				//$trans_code= $_GET['transcode'];
                                $village_code= $_GET['vilg'];
                                $desam= $_GET['Desam'];

                                // Validations//
				 $assoArray1 = array("From date"=>trim($fromdate),"To date"=>trim($todate));
                                 $assoArray2 = array("Village Code"=>trim($village_code),"Desam"=>trim($desam));

                                   if ($phpVal->_isEmpty($assoArray1)!== true)
                                   {
                                       exit(0);
                                   }
                                   if ($phpVal->_isDate(trim($fromdate),"From Date")!==true)
                                   {

                                   exit(0);
                                   }

                                   if ($phpVal->_isDate(trim($todate),"To Date")!==true)
                                   {

                                   exit(0);
                                   }
                                   if (!$phpVal->_isDateBeforeToday(trim($fromdate),"From Date"))
                                   {

                                   exit(0);
                                   }
                                   if (!$phpVal->_isDateBeforeToday(trim($todate),"To Date"))
                                   {

                                   exit(0);
                                   }

                                   if($phpVal->_isSelect($assoArray2)!==true)
                                   {
                                       exit(0);
                                   }
                                    if ($phpVal->_isInteger(trim($village_code),"Village Code",2)!==true)
                                   {
                                       exit(0);
                                   }
                                   if($desam != -2){
                                       if ($phpVal->_isInteger(trim($desam),"Desam",8)!==true)
                                       {
                                           exit(0);
                                       }
                                   }
				// end of Validations//

				$list_tobj->displaydocumentDetails($databaseObj,$fromdate,$todate,$village_code,$desam);

                         }
                         catch(Exception $e)
                         {
                            echo "Mesg: Error Occured Retry After Some Time"; exit(0);
                         }
                         break;
                case 1:
                        try
                         {
                            $vil = $_GET['vilg'];
                            $list_tobj->getDesaminVillage($vil);
                         }
                         catch(Exception $e)
                         {
                            echo "Mesg: Error Occured Retry After Some Time"; exit(0);
                         }
                        break;
                default:
                         break;
	}
?>




