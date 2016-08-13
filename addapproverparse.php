<?php
include_once 'core/database/connect.php';
if(isset($_POST['submit'])){
		
		 $username=$_POST['username'];
		
		 $outlet=$_POST['outlet'];	
			
	
		$insUser = $db->query("INSERT INTO approval_setup(approverID,approverIDAlt,outletCode) VALUES ('$username','$username',' $outlet') ");
	mysqli_query($db, $insUser);
		 
	header("location:approver_list.php");
}
?>