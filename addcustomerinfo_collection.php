<?php
session_start();
include_once 'core/database/connect.php';
$customer_no = mysql_escape_string(trim($_POST['cus_no']));
$customer_name = mysql_escape_string(trim($_POST['cus_name']));
$or_number = mysql_escape_string(trim($_POST['ornum']));
$totalamt = mysql_escape_string(trim($_POST['totalamt']));
$paymethod = mysql_escape_string(trim($_POST['paymethod']));
$checkNum = mysql_escape_string(trim($_POST['chckno']));
$rmrks = mysql_escape_string(trim($_POST['remarks']));
$paymethod = mysql_escape_string(trim($_POST['paymethod']));
$rcpcode=mysql_escape_string(trim($_SESSION['rpcode']));
$date=mysql_escape_string(trim($_POST['ordate']));
$user_id = mysql_escape_string(trim($_SESSION['id']));

if(isset($_POST['submit'])){$sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id' ");
												while($row=$sql->fetch_assoc()){
													$access = $row['access'];
										  			 $u_outlet=$row['outlet'];	
														$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
														while ($row1 = $outlet->fetch_assoc()) {
													 $locCode=$row1['locationCode'];
													 $outDocCode=$row1['outletDocCode'];	
														
														}
												}



	$result = $db->query("SELECT * FROM cocode WHERE id='$u_outlet'");
	while($row = $result->fetch_array())
	  {
	        $fefe=$row['code']; 
	  }
	$sasa=$fefe+1;
	$db->query("UPDATE cocode SET code = '$sasa'");
	$docNo=$outDocCode."-CR-".$sasa;												

	$insColc = $db->query("INSERT INTO collection_journ(locationID,receipt_code,documentNo,doctype,customerID,customer_name,postingDate,externalDocNo,appAmnt,amount,OriginalAmt,ramt,payment_method,check_no,remarks) 
			VALUES('$locCode','$docNo','','2','$customer_no','$customer_name','$date','$or_number','0','$totalamt','$totalamt','$totalamt','$paymethod','$checkNum','$rmrks')");				
	mysqli_query($db, $insColc);		

													 
	$_SESSION['rp']=$docNo;	
	$_SESSION['cus_no']=$customer_no;
	$_SESSION['cus_name']=$customer_name;
	$_SESSION['ornum']=$or_number;
	$_SESSION['totalamt']=$totalamt;
	$_SESSION['pmethod']=$paymethod;
	$_SESSION['chkno']=$checkNum;
	$_SESSION['remrks']=$rmrks;
	$_SESSION['rp']=$docNo;
	$_SESSION['docdate']=$date;

	header("location:new_collection.php");
	}

 /*$customer_no = $_POST['cus_no'];
  $customer = $_POST['cus_name'];
   $customer_add = $_POST['address'];
   $customer_add2 = $_POST['address2'];
   $totalretail = $_POST['totalretail'];
   $evat = $_POST['evat'];
  $payment_term = $_POST['payment_terms'];
   if($payment_term=='15'){
    $paymentdue=date('Y/m/d',strtotime('+15 day'));
   }elseif($payment_term=='30'){
   	 $paymentdue=date('Y/m/d',strtotime('+30 day'));
   }
	 $user_id = $_SESSION['id'];
	 $rcpcode=$_SESSION['rpcode'];
	$extDocNo= $_POST['exdoccode'];
	$vatRegNo=$_POST['tin'];
	$priceVat=$_POST['priceVat'];
	switch ($priceVat) {
		case 'with VAT':
			$priceVat = '1';
			break;
		
		default:
			$priceVat = '0';
			break;
	}
$insOrder = $db->query("INSERT INTO orders(receipt_code,externalDocNo,customer_no, customer_name,customer_address,customer_address2,vatRegNo)VALUES('$rcpcode','$extDocNo','$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo')");
mysqli_query($db, $insOrder);
$postOrder = $db->query("INSERT INTO posted_orders_table (receipt_code,externalDocNo,customer_no, customer_name,customer_address,customer_address2,vatRegNo)VALUES('$rcpcode','$extDocNo','$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo')");
mysqli_query($db, $postOrder);*/

?>