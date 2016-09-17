<?php

       require_once("../pearllogin_templatexml.php");
       include '../classes/class.list_doc_villagewise.php';

	$option = $_GET['option'];
	$list_tobj= new list_document();
	$databaseObj = OpenPearlDataBase::getInstance();
	$phpVal = new PhpValidation();

	switch($option) {


		case 0:
                         try
                         {

				$fromdate = $_GET['fromdate'];
				$todate = $_GET['todate'];
				$trans_code= $_GET['transcode'];
                                $village_code= $_GET['vilg'];

                                // Validations//
				 $assoArray1 = array("From date"=>trim($fromdate),"To date"=>trim($todate));
                                 $assoArray2 = array("Transaction Code"=>trim($trans_code),"Village Code"=>trim($village_code));

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
                                   if ($phpVal->_isInteger(trim($trans_code),"Transaction Code",4)!==true)
                                   {
                                       exit(0);
                                   }
                                    if ($phpVal->_isInteger(trim($village_code),"Village Code",2)!==true)
                                   {
                                       exit(0);
                                   }
				// end of Validations//

				$list_tobj->displaydocumentDetails($databaseObj,$fromdate,$todate,$trans_code,$village_code);

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




