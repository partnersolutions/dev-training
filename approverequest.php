<?php 
include_once 'core/database/connect.php'; 
$eid=$_GET['eid'];
$docno=$_GET['docno'];

$date = date('Y-m-d');
$appEntry = $db->query("SELECT * FROM approval_entry WHERE entryID='$eid'");
while($row=$appEntry->fetch_assoc()){
	$docNo = $row['docNo'];
	$dateOrd= $row['docDate'];
	$docAmt= $row['docAmt'];
	$reqDate= $row['reqDate'];
	$userID= $row['userID'];
	$approverID= $row['approverID'];
	$approverIDAlt= $row['approverIDAlt'];
	$insertApprovalreq= $db->query("INSERT INTO approval_request_entry(docNo,docDate,docAmt,reqDate,userID,approverID,approverIDAlt,status)
		VALUES('$docNo','$dateOrd','$docAmt','$reqDate','$userID','$approverID','$approverIDAlt','1')");
	mysqli_query($db, $insertApprovalreq);
}
$update = $db->query("UPDATE  orders SET status='Approved' WHERE receipt_code='$docno'");
mysqli_query($db, $update);
$updateNotification = $db->query("DELETE FROM approval_entry WHERE entryID='$eid'");
mysqli_query($db, $updateNotification);
$updateNotification = $db->query("UPDATE approval_request_entry SET status='1' WHERE entryID='$eid'");
mysqli_query($db, $updateNotification);

													
header("location:approved_notification.php");/**/
?>