<?php 
session_start();
include_once 'core/database/connect.php';

$customerID=$_SESSION['cus_no'];
$cus_name=$_SESSION['cus_name'];
$user_id=$_SESSION['id'];
$rcpcode=$_SESSION['rp'];
$salesInvo=$_SESSION['ornum'];
$paymethod=$_SESSION['pmethod'];
$checkNum=$_SESSION['chkno'];

 $user = $db->query("SELECT * FROM users WHERE user_id='$user_id'");
				while ($row = $user->fetch_assoc()) {
				   $u_outlet=$row['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row = $outlet->fetch_assoc()) {
				  $locCode=$row['locationCode'];	
				
				}
			}

  if (isset($_GET['rp'])) {
        $rp = $_GET['rp'];
		$response=$_GET['resp'];
		
		if($response!="discard"){
			$getLedger = $db->query("SELECT * FROM selectedledger WHERE receipt_code='$rp' AND AmtToApply<>0");
			while($row00=$getLedger->fetch_array()){
				$AmtToApply=$row00['AmtToApply'];
				$AppDocNo=$row00['docNo'];
				$AppExtDocNo=$row00['invoice_num'];
				$AppDocType=$row00['doctype'];
				$AppDocDate=$row00['postingDate'];
				$AppOrigAmt=$row00['amount'];
				$AppRemAmt=$row00['ramt'];
				$AppEntryNo=$row00['seledgerID'];

				$insColc = $db->query("INSERT INTO collection_journ(locationID,receipt_code,documentNo,doctype,customerID,customer_name,postingDate,externalDocNo,appAmnt,amount,OriginalAmt,ramt,cle_entryno) 
						VALUES('$locCode','$rp','$AppDocNo','$AppDocType','$customerID','$cus_name','$AppDocDate','$AppExtDocNo','$AmtToApply','-$AmtToApply','$AppOrigAmt','$AppRemAmt','$AppEntryNo')");				
				mysqli_query($db, $insColc);		
			}	
		}

        $sql = "DELETE FROM selectedledger WHERE receipt_code='$rp'";
        $result = $db->query($sql);    
        header("location:new_collection.php");
     }

  ?>