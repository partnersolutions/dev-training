<?php 
include_once 'core/database/connect.php'; 
$id = $_POST['id'];
$itemNum=$_POST['itemNo'];
$qty=$_POST['itemquantity'];
$updateTrans=$db->query("UPDATE transferorder SET qtytorcve='$qty', qty='$qty' WHERE entryID='$id' AND itemno='$itemNum' ");
mysqli_query($db,$updateTrans);
header("location:new_transfer.php?id=$id");
?>