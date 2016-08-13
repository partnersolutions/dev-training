<?php

session_start();
include_once 'core/database/connect.php';
 $customer_no = $_POST['cus_no'];
 $customer_name = $_POST['cus_name'];
$docType = $_SESSION['trans_type'];
$documentDate = date('Y-m-d');

	$customer_add=mysql_escape_string(trim($_POST['address']));
	$customer_add2=mysql_escape_string(trim($_POST['address2']));
	$salesInvo=mysql_escape_string(trim($_POST['exdoccode']));
	$paydueDate=mysql_escape_string(trim($_POST['dueDate']));
	$reqDelvDate=mysql_escape_string(trim($_POST['reqDelDate']));
	$promDelvDate=mysql_escape_string(trim($_POST['promDelDate']));
	$payment_terms=mysql_escape_string(trim($_POST['payment_terms']));
	$dDate=mysql_escape_string(trim($_POST['dueDate']));
	$finalcode=mysql_escape_string(trim($_POST['finalcode']));
	$user_id = mysql_escape_string(trim($_SESSION['id']));
	
			 //echo $_SESSION['trans_type'];

if(isset($_POST['submitinfo'])){
$sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id' ");
		while($row=$sql->fetch_assoc()){
			$access = $row['access'];
  			  $u_outlet=$row['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row1 = $outlet->fetch_assoc()) {
			 $locCode=$row1['locationCode'];
			 $outDocCode=$row1['outletDocCode'];	
				
				}
		}


if($_SESSION['cus_no'] != $customer_no){
	//$sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id' ");
	//	while($row=$sql->fetch_assoc()){
	//		$access = $row['access'];
  	//		  $u_outlet=$row['outlet'];	
  	//		}

	//echo "hello world";
	if ($docType==0){
		
		$result = $db->query("SELECT * FROM socode WHERE id='$u_outlet'");
									while($row = $result->fetch_array())
									  {
									        $fefe=$row['code']; 
									  }
		$sasa=$fefe+1;
		$db->query("UPDATE socode SET code = '$sasa' WHERE id='$u_outlet' ");
								
		$finalcode=$outDocCode.'-SO-'.$sasa;
	 } 
	 elseif ($docType==1)
	 {
	 	
		$result_sr = $db->query("SELECT * FROM retcode WHERE id='$u_outlet'");
									while($row = $result_sr->fetch_array())
									  {
									        $fefe=$row['code']; 
									  }
		 $sasa=$fefe+1;
		 $db->query("UPDATE retcode SET code='$sasa' WHERE id='$u_outlet'");
							
	     $finalcode=$outDocCode.'-SR-'.$sasa;
	 }


$insOrder = $db->query("INSERT INTO orders(receipt_code,date_ordered,outletCode,customer_no,customer_name,customer_address,customer_address2,vatRegNo,externalDocNo,reqDelDate,promDelDate,dueDate,status,documentType,paymentTermCode) 
		VALUES('$finalcode','$documentDate','$locCode','$customer_no','$customer_name','$customer_add','$customer_add2','$vatRegNo','$salesInvo','$reqDelvDate','$promDelvDate','$paydueDate','Open','$docType','$payment_terms')");			 
	/*
	$delOrd=$db->query("DELETE FROM orders where receipt_code = '".$_SESSION['rcpcode']."' ");
	mysqli_query($db,$delOrd);
	*/
	$_SESSION['rcpcode']=$finalcode;
	$_SESSION['cus_no']=$customer_no;
	$_SESSION['address']=$customer_add;
	$_SESSION['address2']=$customer_add2;
	$_SESSION['salesInvoice']=$salesInvo;
	$_SESSION['dueDate']=$paydueDate;
	$_SESSION['reqdeldate']=$reqDelvDate;
	$_SESSION['promdeldate']=$promDelvDate;
	$_SESSION['payterms']=$payment_terms;	
	$_SESSION['duedate']=$dDate;	
}

//ECHO $_SESSION['trans_type'];
//if($_SESSION['trans_type']=='SALES_ORDER'){
header("location:new_order.php");
//}
	
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
