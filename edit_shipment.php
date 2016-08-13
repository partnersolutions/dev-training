<?php 
include_once 'core/database/connect.php';

if (isset($_POST['save'])) {
	$id=$_POST['id'];
	$ordDate=$_POST['orddate'];
	$shipDate=$_POST['shipdate'];
	$ordNum=$_POST['orno'];
	$rcptdate=$_POST['rceptdate'];
$updateShipment = $db->query("UPDATE transferorder SET transferorddate = '$ordDate', shipmentdate = '$shipDate', receiptdate = '$rcptdate',extrnaldocno = '$ordNum' WHERE entryID='$id'");
mysqli_query($updateShipment);
header("location:transfer_ship_list.php");
}


?>