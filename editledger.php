<?php 
include_once 'core/database/connect.php';
session_start();
$chars='012345678910';
$seledger=substr(str_shuffle($chars), 0, 20);
 $cus_no=$_SESSION['cus_no'];
 $rcpcode=$_POST['rpcode'];
 $salesInvo=$_SESSION['ornum'];
 $doctype=$_POST['docType'];
 $docno=$_POST['docNo'];
 $pdate=$_POST['pdate'];
 $amount=$_POST['amount'];
  $id=$_SESSION['id'];
 $user = $db->query("SELECT * FROM users WHERE user_id='$id'");
				while ($row = $user->fetch_assoc()) {
				  $u_outlet=$row['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row = $outlet->fetch_assoc()) {
				  $locCode=$row['locationCode'];	
				
				}
			}
		
$insCol = $db->query("INSERT INTO collection_journ(locationID,documentNo,customerID,postingDate,externalDocNo,amount) 
		VALUES('$locCode','$rcpcode','$cus_no','$pdate','$salesInvo','$amount')");
	mysqli_query($db, $insCol);

$insCol = $db->query("INSERT INTO collection_receipt_entry(locationID,documentNo,customerID,postingDate,externalDocNo,amount) 
		VALUES('$locCode','$rcpcode','$cus_no','$pdate','$salesInvo','$amount')");
	mysqli_query($db, $insCol);

$insOrder = $db->query("INSERT INTO selectedledger(seledgerID,doctype,docNo,postingDate,amount,customerID,receipt_code,locationCode) 
		VALUES('$seledger','$doctype','$docno','$pdate','$amount','$cus_no','$rcpcode','$locCode')");
	mysqli_query($db, $insOrder);
	header("Location:editapplycollection.php");

?>