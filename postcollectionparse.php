<?php
include_once 'core/database/connect.php';

//Parse to update posted order
	if(isset($_GET['rp'])){
		$rp=$_GET['rp'];	
		$user_id=$_SESSION['id'];
			$sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id' ");
		while($row00=$sql->fetch_assoc()){
			$access = $row00['access'];
  			 $u_outlet=$row00['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row1 = $outlet->fetch_assoc()) {
			 $locCode=$row1['outletDocCode'];	
				
				}
		}
		$result0 = $db->query("SELECT * FROM posted_source_id WHERE type='collection'");
											while($row6 = $result0->fetch_array())
											  {
											        $fefe=$row6['source_id']; 
											  }
											 $sasa=$fefe+1;
											$db->query("UPDATE posted_source_id SET source_id = '$sasa' WHERE type='collection'");
											$postedCode =  $locCode.'-OR-'.$sasa;
			$docDate=date("Y-m-d");
			//Parse to insert Integration Registry
		$insertIntReg = $db->query("INSERT INTO integration_register(batchNo,createdDate,status,transType)VALUES('','$docDate','0','3')");
		mysqli_query($db, $insertIntReg);
		$batchNum=mysqli_insert_id($db);
		



			$postedCollection = $db->query("SELECT * FROM collection_journ WHERE documentNo='$rp' ");
			while($row=$postedCollection->fetch_assoc()){
				$locCode=$row['locationID'];
				$rcpcode=$row['documentNo'];
				$cus_no=$row['customerID'];
				$pdate=$row['postingDate'];
				$salesInvo=$row['externalDocNo'];
				$amount=$row['amount'];


		

			$insCol = $db->query("INSERT INTO collection_receipt_entry(no,locationID,documentNo,customerID,postingDate,externalDocNo,amount) 
		VALUES('$postedCode','$locCode','$rcpcode','$cus_no','$pdate','$salesInvo','$amount')");
	mysqli_query($db, $insCol);
	$entryNum=mysqli_insert_id($db);
		//Parse to insert Integration Registry Entry
		$insertIntRegEnt = $db->query("INSERT INTO integration_register_entry(batchNo,locationCode,transType,sourceType,sourceNo,postingDate,postedDocNo,externalDocNo,unitAmount,lineAmount)
			VALUES('$batchNum','$locCode','3','1','$customerID','$docDate','$rp',' $ornumber',' $total','$total')");
		mysqli_query($db, $insertIntRegEnt);
		
		$sql = "DELETE FROM selectedledger WHERE customerID='$cus_no' AND documentNo='$rp'";
		     $result = $db->query($sql);
		$sql = "DELETE FROM collection_journ WHERE customerID='$cus_no' AND documentNo='$rp'";
		     $result = $db->query($sql);
			header("location:posted_collection_list.php?success=success");			
			}
			
			$insertCustomerLedger = $db->query("INSERT INTO customers_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,amount,remainingAmt,open,dueDate,positive,documentDate,externalDocNo)
			VALUES('$locCode','$postedCode','$cus_no','$pdate','2','$rp','$total','$total','1','$dueDate','0','$docDate','$salesInvo')");
			mysqli_query($db, $insertCustomerLedger);
			
			$entryApp = $db->query("INSERT INTO collection_receipt_entry_app(subEntryID,documentType,documentNo,amtApplied)VALUES('$entryNum','2','$rp','$total')");
			mysqli_query($db, $entryApp);

}

?>