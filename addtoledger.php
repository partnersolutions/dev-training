<?php 
include_once 'core/database/connect.php';
session_start();
$cus_no=$_SESSION['cus_no'];
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
//$getledger = $db->query("SELECT * FROM selectedledger WHERE customerID='$cus_no' AND receipt_code='$rcpcode' AND locationCode='$locCode' ");
//			$ledgerCount=mysqli_num_rows($getledger);
			
//if($ledgerCount==0){
						$product = $db->query("SELECT * FROM customers_ledger WHERE customerID = '$cus_no' AND open=1 AND documentType in(0,1)");
						$num_rows = mysql_num_rows($product);						
						if($num_rows>0){
							while ($row = $product->fetch_assoc()) {
								$docTypeNo=$row['documentType'];
								$docNo=$row['documentNo'];
								$postDate=date("Y-m-d");
								$amount=$row['amount'];
								
								$postDate=$row['postingDate'];
								$amnt=$row['amount'];
								$inv_num=$row['externalDocNo'];															
								$cus_no=$row['customerID'];
								$seledger=$row['entryID'];
												
									$insOrder = $db->query("INSERT INTO selectedledger(seledgerID,doctype,docNo,postingDate,amount,invoice_num,customerID,receipt_code,locationCode) 
									VALUES('$seledger','$docTypeNo','$docNo','$postDate','$amount','$inv_num','$cus_no','$rcpcode','$locCode')");
								mysqli_query($db, $insOrder);

							
								header("location:addcollection.php");		
								}
						}else{
							header("location:addcollection.php?error=NoOpenTrans");		
						}
//					}
//					else{
//						header("location:addcollection.php");
//					}
					
?>