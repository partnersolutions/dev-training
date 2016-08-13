<?php
session_start();
include_once 'core/database/connect.php';
$customer_no = $_POST['cus_no'];
$rcpcode=$_SESSION['rpcode'];
$date=date("Y-m-dd");

	$salesReturn=mysql_escape_string(trim($_POST['exdoccode']));
	$paydueDate=mysql_escape_string(trim($_POST['dueDate']));
	$reqDelvDate=mysql_escape_string(trim($_POST['reqDelDate']));
	$promDelvDate=mysql_escape_string(trim($_POST['promDelDate']));
	$payment_terms=mysql_escape_string(trim($_POST['payment_terms']));
if(isset($_POST['submit'])){
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
											$result = $db->query("SELECT * FROM retcode");
																					while($row = $result->fetch_array())
																					  {
																					        $fefe=$row['code']; 
																					  }
														 $sasa=$fefe+1;
														$db->query("UPDATE retcode SET code = '$sasa'");
																			
													 $finalcode=$outDocCode.'-SR-'.$sasa;
	$_SESSION['rcpcode']=$finalcode;
	$_SESSION['cus_no']=$customer_no;
	$_SESSION['salesReturn']=$salesReturn;
	$_SESSION['dueDate']=$paydueDate;
	$_SESSION['reqdeldate']=$reqDelvDate;
	$_SESSION['promdeldate']=$promDelvDate;
	$_SESSION['payterms']=$payment_terms;
	header("location:returnOrder.php");
	}
if(isset($_POST['update'])){
	 $customer_no = $_POST['cus_no'];
 $customer_add=mysql_escape_string(trim($_POST['address']));
	 $customer_add2=mysql_escape_string(trim($_POST['address2']));
	 $_SESSION['rcpcode']=$finalcode;
	$_SESSION['cus_no']=$customer_no;
	$_SESSION['salesReturn']=$salesReturn;
	$_SESSION['dueDate']=$paydueDate;
	$_SESSION['reqdeldate']=$reqDelvDate;
	$_SESSION['promdeldate']=$promDelvDate;
	$_SESSION['payterms']=$payment_terms;
	$updateCus = $db->query("UPDATE customers SET address='$customer_add', address2='$customer_add2' WHERE customer_no='$customer_no' ");
	mysqli_query($db, $updateCus);
	header("location:returnOrder.php");
}






?>