<?php
session_start();
include_once 'core/database/connect.php';
$docType=$_SESSION['trans_type'];
		$docType=$_SESSION['trans_type'];
		$CurrUSERID=$_SESSION['user'];
		$rpcode=mysql_escape_string(trim($_POST['rpcode']));
		 $customer_no = mysql_escape_string(trim($_POST['customer_no']));
		 $user_id=mysql_escape_string(trim($_POST['posted_by']));
		 $pcode=mysql_escape_string(trim($_POST['procode']));
		 $payment_term = mysql_escape_string(trim($_POST['payment_terms']));
	  
 $reqdelvDate=mysql_escape_string(trim($_POST['reqDelDate']));
	 $promdelvDate=mysql_escape_string(trim($_POST['promDelDate']));
//Parse to add inventory item
	if(isset($_POST['submit'])){
		
		$pname=mysql_escape_string(trim($_POST['PNAME']));
		$pid=mysql_escape_string(trim($_POST['id']));
		$docDate=mysql_escape_string(trim($_POST['date']));
		$qty=mysql_escape_string(trim($_POST['qty']));
		$total=mysql_escape_string(trim($_POST['total']));
		$price=mysql_escape_string(trim($_POST['pprice']));
		$user_id = mysql_escape_string(trim($_SESSION['id']));
		$sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id' ");
		while($row=$sql->fetch_assoc()){
			$access = $row['access'];
  			 $u_outlet=$row['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row1 = $outlet->fetch_assoc()) {
			 $locCode=$row1['locationCode'];	
				
				}
		}
		$documentDate = date('Y-m-d');
  		$customer = mysql_escape_string(trim($_POST['customer_name']));
  	    $customer_add = mysql_escape_string(trim($_POST['customer_add']));
        $customer_add2 = mysql_escape_string(trim($_POST['customer_add2']));
	 	$extDocNo= mysql_escape_string(trim($_POST['exdoccode']));
		$vatRegNo=mysql_escape_string(trim($_POST['tin']));
		 $priceVat=mysql_escape_string(trim($_POST['priceVat']));
		 $prodpriceVat=mysql_escape_string(trim($_POST['prodpriceVat']));
		$paymentCode = mysql_escape_string(trim($_POST['payment_terms']));

	      $paymentdue= mysql_escape_string(trim($_POST['dueDate']));

	 $reqdelvDate=mysql_escape_string(trim($_POST['reqDelDate']));
	 $promdelvDate=mysql_escape_string(trim($_POST['promDelDate']));


if($priceVat==1 && $prodpriceVat==1){
	 //netUnitPrice
	  $netUnitPrice=$price/(1+(12.00/100));
	  //netAmount
	  $netAmount=$qty*$netUnitPrice;
	 //VATPerc
	  $vatPerc=12;
	 //VatAmount
	   $vatAmount = $total - $netAmount;
}elseif($priceVat==0 && $prodpriceVat==1){
	 $price=$price/(1+(12.00/100));
	//netUnitPrice
	  $netUnitPrice=$price;
	  //netAmount
	  $netAmount=$qty*$netUnitPrice;
	  //VATPerc
	  $vatPerc=0;
	 //VatAmount
	   $vatAmount = 0;

}elseif($priceVat==1 && $prodpriceVat==0){
	//netUnitPrice
	  $netUnitPrice=$price;
	  //netAmount
	  $netAmount=$qty*$netUnitPrice;
	   //VATPerc
	  $vatPerc=0;
	 //VatAmount
	   $vatAmount = 0;
}elseif($priceVat==0 && $prodpriceVat==0){
	//netUnitPrice
	  $netUnitPrice=$price;
	  //netAmount
	  $netAmount=$qty*$netUnitPrice;
	   //VATPerc
	  $vatPerc=0;
	 //VatAmount
	   $vatAmount = 0;
	 }
	 
     //echo $vatAmount;
	 //$insOrder = $db->query("INSERT INTO orders(receipt_code,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,externalDocNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,netUnitPrice,netAmount,vatPerc,vatAmount,paymentTermCode,posted_by) 
	////	VALUES('$rpcode','$pcode','$pname','$qty','$price','$total','$docDate','$locCode','$docType','$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo','$extDocNo','$reqdelvDate','$promdelvDate','$paymentdue','$priceVat','$netUnitPrice','$netAmount','$vatPerc','$vatAmount','$paymentCode','$user_id')");
	//mysqli_query($db, $insOrder); 
	//$insOrder = $db->query("UPDATE orders SET item_id='$pcode',item_description='$pname',quantity='$qty',price='$price',total='$total',date_ordered='$docDate',outletCode='$locCode',documentType='0',netUnitPrice='$netUnitPrice',netAmount=' $netAmount',vatPerc='$vatPerc',vatAmount='$vatAmount',paymentTermCode='$paymentCode',posted_by='$user_id' WHERE receipt_code='$rpcode'");
	//mysqli_query($db, $insOrder);

	$insOrder = $db->query("INSERT INTO orders(receipt_code,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,externalDocNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,netUnitPrice,netAmount,vatPerc,vatAmount,paymentTermCode,posted_by,status) 
		VALUES('$rpcode','$pcode','$pname','$qty','$price','$total','$docDate','$locCode',$docType,'$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo','$extDocNo','$reqdelvDate','$promdelvDate','$paymentdue','$priceVat','$netUnitPrice',' $netAmount','$vatPerc','$vatAmount','$paymentCode','$user_id','Open')");
	mysqli_query($db, $insOrder);

	header("location:new_order.php");
	/**/
}	

if(isset($_POST['save'])){
	$sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id' ");
		while($row=$sql->fetch_assoc()){
			$access = $row['access'];
  			 $u_outlet=$row['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row1 = $outlet->fetch_assoc()) {
			 $locCode=$row1['locationCode'];	
				
				}
		}
	 $extDocNo= mysql_escape_string(trim($_POST['exdoccode']));
	$getexDoc = $db->query("SELECT * FROM posted_orders_table WHERE externalDocNo='$extDocNo' AND outletCode='$locCode' LIMIT 1");
		 $ItemCount=mysqli_num_rows($getexDoc);
		if($ItemCount==1){
			header("location:new_order.php?error=dupInv");
		}else{
				
	if($docType==0){
		$update3 = $db->query("UPDATE orders SET status='Open', externalDocNo='$extDocNo' WHERE receipt_code='$rpcode' ");
	mysqli_query($db, $update3);
	header("location:order_list.php");
	}elseif($docType==1){
		$update3 = $db->query("UPDATE orders SET status='Open', externalDocNo='$extDocNo' WHERE receipt_code='$rpcode' ");
	mysqli_query($db, $update3);
	header("location:returnOrder_list.php");
	}		 
	
	}/**/

	//$update1 = $db->query("UPDATE orders SET reqDelDate='$reqdelvDate',promDelDate='$promdelvDate',dueDate='$paymentdue',pricesIncVAT='$priceVat',externalDocNo='$extDocNo',paymentTermCode='$payment_term' WHERE receipt_code='$rcpcode' ");
		//$insOrder = $db->query("INSERT INTO orders(receipt_code,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,externalDocNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,paymentTermCode,posted_by) 
		//VALUES('$rpcode','$pcode','$pname','$qty','$price','$total','$docDate','$locCode','0','$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo','$extDocNo','$reqDelDate','$promDelDate','$paymentdue','$priceVat','$payment_term','$user_id')");
	//mysqli_query($db, $insOrder);
	//$update2 = $db->query("UPDATE posted_orders_table SET reqDelDate='$reqdelvDate',promDelDate='$promdelvDate',dueDate='$paymentdue',pricesIncVAT='$priceVat',paymentTermCode='$payment_term' WHERE receipt_code='$rcpcode' ");
	

	}

if((isset($_GET['rp']))&&($_GET['cmd']=='POST')){
	//if(isset($_GET['rp'])){
	//	$finalcode=$_GET['rp'];		
	//}else{ na nailing sa
	
	$finalcode=$_GET['rp'];	
	$rpcode=$finalcode;
	$user_id=$_SESSION['id'];
	//}

	$getOrder = $db->query("SELECT * FROM orders WHERE receipt_code='$finalcode'  AND documentType='$docType' AND item_id=''");
	while($row=$getOrder->fetch_array()){
		$DocStatus=$row['status'];
		$customer_no=$row['customer_no'];
		$extDocNo=$row['externalDocNo'];
	}

	if($DocStatus=="For Approval"){
		header("location:order_list.php?error=docForApproval");
		exit;
	}

	if($DocStatus=="Rejected"){
		header("location:order_list.php?error=docRejected");
		exit;
	}	

	//$extDocNo= mysql_escape_string(trim($_POST['exdoccode']));
	$getexDoc = $db->query("SELECT * FROM posted_orders_table WHERE externalDocNo='$extDocNo' LIMIT 1");
 	$ItemCount=mysqli_num_rows($getexDoc);
	if($ItemCount==1){		
		if ($docType==0) {
			header("location:order_list.php?error=dupInv");
		}
		elseif ($docType==1) {
			header("location:order_list.php?error=dupCM");
		}
		exit;
	}else{		
		$getOrder = $db->query("SELECT sum(total) FROM orders WHERE receipt_code='$finalcode'  AND documentType='$docType'");
		while($rowSum=$getOrder->fetch_array()){
			$ordertotal=$rowSum['sum(total)'];			
		}
		//$ordertotal=$_POST['linetotal'];
	}
	
	$sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id'");
		while($row00=$sql->fetch_assoc()){
			$access = $row00['access'];
  			 $u_outlet=$row00['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row01 = $outlet->fetch_assoc()) {
			 $locDocCode=$row01['outletDocCode'];	
			 $outlocCode=$row01['locationCode'];	
				
				}
		}
		
	$date = date('Y-m-d');
	$postingDate = date('Y-m-d');
	$documentDate = date('Y-m-d');
	$ok=1;

	if($docType==0){
		$docTypeCode="sales";
		$docPrefix="SI";
	}elseif ($docType==1) {
		$docTypeCode="return";		
		$docPrefix="CM";
	}
	
	//Get Credit Limit of the Customer
	if(($docType==0)&&($DocStatus=="Open")){
		$cred_limit=0;
		$getCusInfo = $db->query("SELECT * FROM customers WHERE customer_no='$customer_no'");
					while ($row5 = $getCusInfo->fetch_assoc()) {
						  $cred_limit = $row5['credit_limit'];
					}

		//**** VALIDATE ACCORDING TO CREDIT LIMIT ****						
		if($cred_limit>0){
			//get outstanding balance
			$getCustLedger =$db->query("SELECT SUM(amount) FROM customers_ledger WHERE customerID='$customer_no'");
					while ($row4 = $getCustLedger->fetch_assoc()) {
						 
						 $cc= $row4['SUM(amount)'];
					}		

			//sum-up outstanding balance with the current transaction amount
			$totalCred=$cc+$ordertotal;	
			if($totalCred>=$cred_limit){
				
				$ok=0;
				header("location:order_list.php?error=crdlmt");
					
			}

		}

		//**** VALIDATE ACCORDING TO OVERDUE BALANCE *****
		if($ok==1){
			$getCustLedger =$db->query("SELECT * FROM customers_ledger WHERE customerID='$customer_no' AND documentType=0 AND open=1 AND dueDate <'$date'");	
			$ledgercount = mysqli_num_rows($getCustLedger);  
			if($ledgercount>0){
				
				$ok=0;
				header("location:order_list.php?error=ovrdue&&rp=$rpcode&&cusno=$customer_no");	
			}
		}
	}		

	if($ok==1){

		//check for entry in the customer_ledger
		$getCusInfo = $db->query("SELECT * FROM orders WHERE receipt_code='$finalcode' AND customer_no='$customer_no' ");
			$orderCount=mysqli_num_rows($getCusInfo);

	    //Insert to Posted Order & Item Ledger
		$linectr = 0;
		while ($row = $getCusInfo->fetch_assoc()) {

		    $rpcode=$row['receipt_code'];
		    
		    $pcode=$row['item_id'];
		    $pname=mysql_escape_string(trim($row['item_description']));
		    $qty=$row['quantity'];
		    $price=$row['price'];
		    $total =$row['total'];
		    $docDate=$row['date_ordered'];
		    $locCode=$row['outletCode'];
		    $customer_no=$row['customer_no'];
		    $customer=$row['customer_name'];
		    $customer_add=$row['customer_address'];
		    $customer_add2=$row['customer_address2'];
		    $vatRegNo=$row['vatRegNo'];
		    $reqdelvDate=$row['reqDelDate'];
		    $promdelvDate=$row['promDelDate'];
		    $paymentdue=$row['dueDate'];
		    $priceVat=$row['pricesIncVAT'];
		     
		    $netUnt=$row['netUnitPrice'];
			$netAmt=$row['netAmount'];
			$vatPr=$row['vatPerc'];
			$vatAmnt=$row['vatAmount'];
		    $payment_term=$row['paymentTermCode'];
		    $user_id =$row['posted_by'];


			$linectr += 1;
			//Generate Posted 
			if($linectr==1){		

				//Parse to insert customer Ledger
				$result1 = $db->query("SELECT sum(total) FROM orders where receipt_code='$rpcode'");
														while($row1 = $result1->fetch_array())
															  {
															     $yy=$row1['sum(total)'];
																  
														 }	
				$result2 = $db->query("SELECT sum(quantity) FROM orders where receipt_code='$rpcode'");
														while($row2 = $result2->fetch_array())
															  {
															     $zz=$row2['sum(quantity)'];
																  
														 }
				 $result3 = $db->query("SELECT sum(price) FROM orders where receipt_code='$rpcode'");
													while($row3 = $result3->fetch_array())
														{
															     $aa=$row3['sum(price)'];
																  
														 }													
				$lineAmnt=number_format($total);

				//Generate a new Posted Document No.
				$result0 = $db->query("SELECT * FROM posted_source_id WHERE type='$docTypeCode' AND locationID='$u_outlet'");
					while($row6 = $result0->fetch_array())
					  {
					        $fefe=$row6['source_id']; 
					  }
				$sasa=$fefe+1;
				$db->query("UPDATE posted_source_id SET source_id = '$sasa' WHERE type='$docTypeCode' AND locationID='$u_outlet'");
				$postedCode =  $locDocCode."-".$docPrefix."-".$sasa;				
				
				//Insert to Customer Ledger
				$insertCustomerLedger = $db->query("INSERT INTO customers_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,amount,remainingAmt,open,dueDate,positive,documentDate,externalDocNo,userID)
					VALUES('$locCode','$postedCode','$customer_no','$date','$docType','$postedCode','$yy','$yy','1','$paymentdue','1',' $docDate','$extDocNo','$CurrUSERID')");
				mysqli_query($db, $insertCustomerLedger);

				//Insert to Integration register
				$insertIntReg = $db->query("INSERT INTO integration_register(batchNo,createdDate,status,transType)VALUES('','$date','0','$docType')");
				mysqli_query($db, $insertIntReg);
				$batchNum=mysqli_insert_id($db);
			}

			if($pcode!=""){
				//Parse to insert item Ledger
				$insertItemLedger = $db->query("INSERT INTO item_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,description,amount,qty,remainingAmt,userID,open,dueDate,positive,documentDate,externalDocNo)
					VALUES('$locCode','$pcode','$customer_no','$postingDate',$docType,'$postedCode','$pname','$total','-$qty','$total','$CurrUSERID','1','$paymentdue','0','$documentDate','$extDocNo')");
				mysqli_query($db, $insertItemLedger);
			}
			//insert into posted table
			$postOrder = $db->query("INSERT INTO posted_orders_table(salesinvno,receipt_code,externalDocNo,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,netUnitPrice,netAmount,vatPerc,vatAmount,paymentTermCode,userID) 
									VALUES('$postedCode','$rpcode','$extDocNo','$pcode','$pname','$qty','$price','$total','$docDate','$locCode',$docType,'$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo','$reqdelvDate','$promdelvDate','$paymentdue','$priceVat','$netUnt',' $netAmt','$vatPr','$vatAmnt','$payment_term','$user_id','$CurrUSERID')");mysqli_query($db, $postOrder);			

			//Parse to insert Integration Registry
			$insertIntRegEnt = $db->query("INSERT INTO integration_register_entry(batchNo,locationCode,transType,sourceType,sourceNo,postingDate,postedDocNo,preAssignedNo,externalDocNo,documentLineType,documentLineTypeNo,paymentTermCode,quantity,unitAmount,lineAmount,productID)
			VALUES('$batchNum','$locCode','1','1','$customer_no','$date','$postedCode','$rpcode','$extDocNo',$docType,'$pcode','$payment_term','$qty',' $price','$total','$pcode')");
			mysqli_query($db, $insertIntRegEnt);																	 	 	

			//Parse to delete order from order table
			$sql = "DELETE FROM orders WHERE receipt_code='$finalcode'";
			$result = $db->query($sql);
			if($docType==0){
				header("location:posted_order_list.php?success=success");
			}elseif($docType==1){
				header("location:posted_returnorder_list.php?success=success");
			}			
		}		

	}	
}//END ORDER LIST POSTING

if(isset($_POST['post'])){
	//if(isset($_GET['rp'])){
	//	$finalcode=$_GET['rp'];		
	//}else{ na nailing sa 
	$finalcode=$_SESSION['rcpcode'];
	//}

	$getOrder = $db->query("SELECT * FROM orders WHERE receipt_code='$finalcode'  AND documentType='$docType'");
	while($row=$getOrder->fetch_array()){
		$DocStatus=$row['status'];
	}

	if($DocStatus=="For Approval"){
		header("location:new_order.php?error=docForApproval");
		exit;
	}

	if($DocStatus=="Rejected"){
		header("location:new_order.php?error=docRejected");
		exit;
	}	

	$extDocNo= mysql_escape_string(trim($_POST['exdoccode']));
	$getexDoc = $db->query("SELECT * FROM posted_orders_table WHERE externalDocNo='$extDocNo' LIMIT 1");
 	$ItemCount=mysqli_num_rows($getexDoc);
	if($ItemCount==1){		
		if ($docType==0) {
			header("location:new_order.php?error=dupInv");
		}
		elseif ($docType==1) {
			header("location:new_order.php?error=dupCM");
		}
		exit;
	}else{
		$ordertotal=$_POST['linetotal'];
	}


	$sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id' ");
		while($row00=$sql->fetch_assoc()){
			$access = $row00['access'];
  			 $u_outlet=$row00['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row01 = $outlet->fetch_assoc()) {
			 $locDocCode=$row01['outletDocCode'];	
			 $outlocCode=$row01['locationCode'];	
				
				}
		}
		
	$date = date('Y-m-d');
	$postingDate = date('Y-m-d');
	$documentDate = date('Y-m-d');
	$ok=true;

	if($docType==0){
		$docTypeCode="sales";
		$docPrefix="SI";
	}elseif ($docType==1) {
		 $docTypeCode="return";		
		 $docPrefix="CM";
	}
	//echo $DocStatus;
	//Get Credit Limit of the Customer
	if(($docType==0)&&($DocStatus=="Open")){
		$cred_limit=0;
		$getCusInfo = $db->query("SELECT * FROM customers WHERE customer_no='$customer_no'");
					while ($row5 = $getCusInfo->fetch_assoc()) {
						  $cred_limit = $row5['credit_limit'];
					}

		//**** VALIDATE ACCORDING TO CREDIT LIMIT ****
		if($cred_limit>0){
			//get outstanding balance
			$getCustLedger =$db->query("SELECT SUM(amount) FROM customers_ledger WHERE customerID='$customer_no'");
					while ($row4 = $getCustLedger->fetch_assoc()) {
						 
						 $cc= $row4['SUM(amount)'];
					}		

			//sum-up outstanding balance with the current transaction amount
			$totalCred=$cc+$ordertotal;	
			if($totalCred>=$cred_limit){
				
				$ok=false;
				header("location:new_order.php?error=crdlmt");
					
			}

		}

		//**** VALIDATE ACCORDING TO OVERDUE BALANCE *****
		if($ok==true){
			$getCustLedger =$db->query("SELECT * FROM customers_ledger WHERE customerID='$customer_no' AND documentType=0 AND open=1 AND dueDate <'$date'");	
			$ledgercount = mysqli_num_rows($getCustLedger);  
			if($ledgercount>0){
				
				$ok=false;
				header("location:new_order.php?error=ovrdue&&rp=$rpcode&&cusno=$customer_no");	
			}
		}
	}	

	if($ok==true){
		//check for entry in the customer_ledger
		$getCusInfo = $db->query("SELECT * FROM orders WHERE receipt_code='$rpcode' AND customer_no='$customer_no' ");
			$orderCount=mysqli_num_rows($getCusInfo);

	    //Insert to Posted Order & Item Ledger
		$linectr = 0;
		while ($row = $getCusInfo->fetch_assoc()) {

		    $rpcode=$row['receipt_code'];
		    
		    $pcode=$row['item_id'];
		    $pname=mysql_escape_string(trim($row['item_description']));
		    $qty=$row['quantity'];
		    $price=$row['price'];
		    $total =$row['total'];
		    $docDate=$row['date_ordered'];
		    $locCode=$row['outletCode'];
		    $customer_no=$row['customer_no'];
		    $customer=$row['customer_name'];
		    $customer_add=$row['customer_address'];
		    $customer_add2=$row['customer_address2'];
		    $vatRegNo=$row['vatRegNo'];
		    $reqdelvDate=$row['reqDelDate'];
		    $promdelvDate=$row['promDelDate'];
		    $paymentdue=$row['dueDate'];
		    $priceVat=$row['pricesIncVAT'];
		     
		    $netUnt=$row['netUnitPrice'];
			$netAmt=$row['netAmount'];
			$vatPr=$row['vatPerc'];
			$vatAmnt=$row['vatAmount'];
		    $payment_term=$row['paymentTermCode'];
		    $user_id =$row['posted_by'];


			$linectr += 1;
			//Generate Posted 
			if($linectr==1){		

				//Parse to insert customer Ledger
				$result1 = $db->query("SELECT sum(total) FROM orders where receipt_code='$rpcode'");
														while($row1 = $result1->fetch_array())
															  {
															     $yy=$row1['sum(total)'];
																  
														 }	
				$result2 = $db->query("SELECT sum(quantity) FROM orders where receipt_code='$rpcode'");
														while($row2 = $result2->fetch_array())
															  {
															     $zz=$row2['sum(quantity)'];
																  
														 }
				 $result3 = $db->query("SELECT sum(price) FROM orders where receipt_code='$rpcode'");
													while($row3 = $result3->fetch_array())
														{
															     $aa=$row3['sum(price)'];
																  
														 }													
				$lineAmnt=number_format($total);

				//Generate a New Posted Document No.
				$result0 = $db->query("SELECT * FROM posted_source_id WHERE type='$docTypeCode' AND locationID='$u_outlet'");
					while($row6 = $result0->fetch_array())
					  {
					        $fefe=$row6['source_id']; 
					  }
				$sasa=$fefe+1;
				$db->query("UPDATE posted_source_id SET source_id = '$sasa' WHERE type='$docTypeCode' AND locationID='$u_outlet'");
				$postedCode =  $locDocCode."-".$docPrefix."-".$sasa;				
				
				//Insert to Customer Ledger
				if($docType==0){
					$insertCustomerLedger = $db->query("INSERT INTO customers_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,amount,remainingAmt,open,dueDate,positive,documentDate,externalDocNo,userID)
					VALUES('$locCode','$postedCode','$customer_no','$date','$docType','$postedCode','$yy','$yy','1','$paymentdue','1',' $docDate','$extDocNo','$CurrUSERID')");
				mysqli_query($db, $insertCustomerLedger);

					}elseif($docType==1){
						$insertCustomerLedger = $db->query("INSERT INTO customers_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,amount,remainingAmt,open,dueDate,positive,documentDate,externalDocNo,userID)
					VALUES('$locCode','$postedCode','$customer_no','$date','$docType','$postedCode','-$yy','-$yy','1','$paymentdue','1',' $docDate','$extDocNo','$CurrUSERID')");
				mysqli_query($db, $insertCustomerLedger);

					}				

				//Insert to Integration register
				$insertIntReg = $db->query("INSERT INTO integration_register(batchNo,createdDate,status,transType)VALUES('','$date','0','$docType')");
				mysqli_query($db, $insertIntReg);
				$batchNum=mysqli_insert_id($db);
			}

			//Parse to insert item Ledger
			if($pcode!=""){
				if($docType==0){
					$insertItemLedger = $db->query("INSERT INTO item_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,description,amount,qty,remainingAmt,userID,open,dueDate,positive,documentDate,externalDocNo)
					VALUES('$locCode','$pcode','$customer_no','$postingDate',$docType,'$postedCode','$pname','$total','-$qty','$total','$CurrUSERID','1','$paymentdue','0','$documentDate','$extDocNo')");
				mysqli_query($db, $insertItemLedger);
				}elseif($docType==1){
					$insertItemLedger = $db->query("INSERT INTO item_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,description,amount,qty,remainingAmt,userID,open,dueDate,positive,documentDate,externalDocNo)
					VALUES('$locCode','$pcode','$customer_no','$postingDate',$docType,'$postedCode','$pname','$total','$qty','-$total','$CurrUSERID','1','$paymentdue','1','$documentDate','$extDocNo')");
				mysqli_query($db, $insertItemLedger);
				}
			}			

			//insert into posted table
			$postOrder = $db->query("INSERT INTO posted_orders_table(salesinvno,receipt_code,externalDocNo,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,netUnitPrice,netAmount,vatPerc,vatAmount,paymentTermCode,userID) 
									VALUES('$postedCode','$rpcode','$extDocNo','$pcode','$pname','$qty','$price','$total','$docDate','$locCode',$docType,'$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo','$reqdelvDate','$promdelvDate','$paymentdue','$priceVat','$netUnt',' $netAmt','$vatPr','$vatAmnt','$payment_term','$CurrUSERID')");
			mysqli_query($db, $postOrder);			

			//Parse to insert Integration Registry
			$insertIntRegEnt = $db->query("INSERT INTO integration_register_entry(batchNo,locationCode,transType,sourceType,sourceNo,postingDate,postedDocNo,preAssignedNo,externalDocNo,documentLineType,documentLineTypeNo,paymentTermCode,quantity,unitAmount,lineAmount,productID)
			VALUES('$batchNum','$locCode','1','1','$customer_no','$date','$postedCode','$rpcode','$extDocNo',$docType,'$pcode','$payment_term','$qty',' $price','$total','$pcode')");
			mysqli_query($db, $insertIntRegEnt);																	 	 	
		}		

		//Parse to delete order from order table
		$sql = "DELETE FROM orders WHERE receipt_code='$rpcode'";
		$result = $db->query($sql);
		if($docType==0){
			header("location:posted_order_list.php?success=success");
		}elseif($docType==1){
			header("location:posted_returnorder_list.php?success=success");
		}
	}	
}
/*
	$getCustLedger =$db->query("SELECT SUM(amount) FROM customers_ledger WHERE customerID='$customer_no'");
			while ($row4 = $getCustLedger->fetch_assoc()) {
				 
				 $cc= $row4['SUM(amount)'];
			}
				$totalCred=$cc+$ordertotal;	
				if($cred_limit==0){
					
			 
							$result0 = $db->query("SELECT * FROM posted_source_id WHERE type='sales'");
											while($row6 = $result0->fetch_array())
											  {
											        $fefe=$row6['source_id']; 
											  }
											 $sasa=$fefe+1;
											$db->query("UPDATE posted_source_id SET source_id = '$sasa' WHERE type='sales'");
											$postedCode =  $locCode.'-SI-'.$sasa;
												//check for entry in the customer_ledger
												$getCusInfo = $db->query("SELECT * FROM orders WHERE receipt_code='$rpcode' AND customer_no='$customer_no' ");
												echo $orderCount=mysqli_num_rows($getCusInfo);
																while ($row = $getCusInfo->fetch_assoc()) {

														 				    $rpcode=$row['receipt_code'];
														 				    
														 				    $pcode=$row['item_id'];
														 				    $pname=mysql_escape_string(trim($row['item_description']));
														 				    $qty=$row['quantity'];
														 				    $price=$row['price'];
														 				    $total =$row['total'];
														 				    $docDate=$row['date_ordered'];
														 				    $locCode=$row['outletCode'];
														 				    $customer_no=$row['customer_no'];
														 				    $customer=$row['customer_name'];
														 				    $customer_add=$row['customer_address'];
														 				    $customer_add2=$row['customer_address2'];
														 				    $vatRegNo=$row['vatRegNo'];
														 				    $reqdelvDate=$row['reqDelDate'];
														 				    $promdelvDate=$row['promDelDate'];
														 				    $paymentdue=$row['dueDate'];
														 				    $priceVat=$row['pricesIncVAT'];
														 				    $netUnt=$row['netUnitPrice'];
																			$netAmt=$row['netAmount'];
																			$vatPr=$row['vatPerc'];
																			$vatAmnt=$row['vatAmount'];
														 				    $payment_term=$row['paymentTermCode'];
														 				    $user_id =$row['posted_by'];

																$result1 = $db->query("SELECT sum(total) FROM orders where receipt_code='$rpcode'");
																										while($row1 = $result1->fetch_array())
																											  {
																											     $yy=$row1['sum(total)'];
																												  
																										 }	
																$result2 = $db->query("SELECT sum(quantity) FROM orders where receipt_code='$rpcode'");
																										while($row2 = $result2->fetch_array())
																											  {
																											     $zz=$row2['sum(quantity)'];
																												  
																										 }
																 $result3 = $db->query("SELECT sum(price) FROM orders where receipt_code='$rpcode'");
																									while($row3 = $result3->fetch_array())
																										{
																											     $aa=$row3['sum(price)'];
																												  
																										 }		
																										
																										$lineAmnt=number_format($total);	

																							//Parse to insert item Ledger
		$insertItemLedger = $db->query("INSERT INTO item_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,description,amount,qty,remainingAmt,userID,open,dueDate,positive,documentDate,externalDocNo)
			VALUES('$locCode','$pcode','$customer_no','$postingDate','1','$postedCode','$pname','$total','-$qty','$total','$user_id','1','$paymentdue','0','$documentDate','$extDocNo')");
		mysqli_query($db, $insertItemLedger);
																				//insert into posted table
																				$postOrder = $db->query("INSERT INTO posted_orders_table(salesinvno,receipt_code,externalDocNo,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,netUnitPrice,netAmount,vatPerc,vatAmount,paymentTermCode,posted_by) 
																										VALUES('$postedCode','$rpcode','$extDocNo','$pcode','$pname','$qty','$price','$total','$docDate','$locCode',$docType,'$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo','$reqdelvDate','$promdelvDate','$paymentdue','$priceVat','$netUnitPrice',' $netAmount','$vatPr','$vatAmount','$payment_term','$user_id')");
																				mysqli_query($db, $postOrder);
																			//Parse to insert Integration Registry
																			$insertIntRegEnt = $db->query("INSERT INTO integration_register_entry(batchNo,locationCode,transType,sourceType,sourceNo,postingDate,postedDocNo,preAssignedNo,externalDocNo,documentLineType,documentLineTypeNo,paymentTermCode,quantity,unitAmount,lineAmount,productID)
																			VALUES('$batchNum','$locCode','1','1','$customer_no','$date','$postedCode','$rpcode','$extDocNo','1','$pcode','$payment_term','$qty',' $price','$total','$pcode')");
																			mysqli_query($db, $insertIntRegEnt);																	 	 	
																		}//cusinfo query
																		//Parse to insert customer Ledger
															$insertCustomerLedger = $db->query("INSERT INTO customers_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,amount,remainingAmt,open,dueDate,positive,documentDate,externalDocNo)
																VALUES('$locCode','$postedCode','$customer_no','$date','0','$rpcode','$yy','$yy','1','$paymentdue','1',' $docDate','$extDocNo')");
															mysqli_query($db, $insertCustomerLedger);								
																		//Parse to delete order from order table
																				$sql = "DELETE FROM orders WHERE receipt_code='$rpcode'";
																				$result = $db->query($sql);
																			header("location:posted_order_list.php?success=success");
				// condition when credit limit is zero
			
				}elseif($cred_limit>0){
						//if($ordertotal > $cred_limit){
						// header("location:new_order.php?error=crdlmt");	
					//}elseif($cc>=$cred_limit){
					//	header("location:new_order.php?error=crdlmt");
					}if($totalCred>=$cred_limit){
						header("location:new_order.php?error=crdlmt");
					}else{
						
			 
							$getCustLedger =$db->query("SELECT * FROM customers_ledger WHERE customerID='$customer_no' AND documentType=0 AND locationID='$outlocCode'AND open=1");
								  $ledgercount = mysqli_num_rows($getCustLedger);  XXXX
											if($ledgercount===0){
												
											
											}elseif($ledgercount>=1){
											 while ($row0 = $getCustLedger->fetch_assoc()){
											  	$curr_date = date("Y-m-d");
											   $dueDate=$row0['dueDate'];
											   $docDate=$row0['documentDate'];
											   

											if($curr_date <= $docDate && $dueDate > $curr_date){
												$result0 = $db->query("SELECT * FROM posted_source_id WHERE type='sales'");
											while($row6 = $result0->fetch_array())
											  {
											        $fefe=$row6['source_id']; 
											  }
											 $sasa=$fefe+1;
											$db->query("UPDATE posted_source_id SET source_id = '$sasa' WHERE type='sales'");
											$postedCode =  $locCode.'-SI-'.$sasa;
												//check for entry in the customer_ledger
												$getCusInfo = $db->query("SELECT * FROM orders WHERE receipt_code='$rpcode' AND customer_no='$customer_no' ");
																echo $orderCount=mysqli_num_rows($getCusInfo);
																while ($row = $getCusInfo->fetch_assoc()) {

														 				    $rpcode=$row['receipt_code'];
														 				   
														 				    $pcode=$row['item_id'];
														 				    $pname=mysql_escape_string(trim($row['item_description']));
														 				    $qty=$row['quantity'];
														 				    $price=$row['price'];
														 				    $total =$row['total'];
														 				    $docDate=$row['date_ordered'];
														 				    $locCode=$row['outletCode'];
														 				    $customer_no=$row['customer_no'];
														 				    $customer=$row['customer_name'];
														 				    $customer_add=$row['customer_address'];
														 				    $customer_add2=$row['customer_address2'];
														 				    $vatRegNo=$row['vatRegNo'];
														 				    $reqdelvDate=$row['reqDelDate'];
														 				    $promdelvDate=$row['promDelDate'];
														 				    $paymentdue=$row['dueDate'];
														 				    
														 				     $priceVat=$row['pricesIncVAT'];
														 				    $netUnt=$row['netUnitPrice'];
																			$netAmt=$row['netAmount'];
																			$vatPr=$row['vatPerc'];
																			$vatAmnt=$row['vatAmount'];
														 				    $payment_term=$row['paymentTermCode'];
														 				    $user_id =$row['posted_by'];

																$result1 = $db->query("SELECT sum(total) FROM orders where receipt_code='$rpcode'");
																										while($row1 = $result1->fetch_array())
																											  {
																											     $yy=$row1['sum(total)'];
																												  
																										 }	
																$result2 = $db->query("SELECT sum(quantity) FROM orders where receipt_code='$rpcode'");
																										while($row2 = $result2->fetch_array())
																											  {
																											     $zz=$row2['sum(quantity)'];
																												  
																										 }
																 $result3 = $db->query("SELECT sum(price) FROM orders where receipt_code='$rpcode'");
																									while($row3 = $result3->fetch_array())
																										{
																											     $aa=$row3['sum(price)'];
																												  
																										 }		
																										$lineAmnt=number_format($total);	

																							//Parse to insert item Ledger
		$insertItemLedger = $db->query("INSERT INTO item_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,description,amount,qty,remainingAmt,userID,open,dueDate,positive,documentDate,externalDocNo)
			VALUES('$locCode','$pcode','$customer_no','$postingDate','1','$postedCode','$pname','$total','-$qty','$total','$user_id','1','$paymentdue','0','$documentDate','$extDocNo')");
		mysqli_query($db, $insertItemLedger);
																				//insert into posted table
																				$postOrder = $db->query("INSERT INTO posted_orders_table(salesinvno,receipt_code,externalDocNo,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,netUnitPrice,netAmount,vatPerc,vatAmount,paymentTermCode,posted_by) 
																										VALUES('$postedCode','$rpcode','$extDocNo','$pcode','$pname','$qty','$price','$total','$docDate','$locCode',$docType,'$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo','$reqdelvDate','$promdelvDate','$paymentdue','$priceVat','$netUnitPrice',' $netAmount','$vatPr','$vatAmount','$payment_term','$user_id')");
																				mysqli_query($db, $postOrder);
																			//Parse to insert Integration Registry
																			$insertIntRegEnt = $db->query("INSERT INTO integration_register_entry(batchNo,locationCode,transType,sourceType,sourceNo,postingDate,postedDocNo,preAssignedNo,externalDocNo,documentLineType,documentLineTypeNo,paymentTermCode,quantity,unitAmount,lineAmount,productID)
																			VALUES('$batchNum','$locCode','1','1','$customer_no','$date','$postedCode','$rpcode','$extDocNo','1','$pcode','$payment_term','$qty',' $price','$total','$pcode')");
																			mysqli_query($db, $insertIntRegEnt);																	 	 	
																		}//cusinfo query
																		//Parse to insert customer Ledger
															$insertCustomerLedger = $db->query("INSERT INTO customers_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,amount,remainingAmt,open,dueDate,positive,documentDate,externalDocNo)
																VALUES('$locCode','$postedCode','$customer_no','$date','0','$rpcode','$yy','$yy','1','$paymentdue','1',' $docDate','$extDocNo')");
															mysqli_query($db, $insertCustomerLedger);								
																		//Parse to delete order from order table
																				$sql = "DELETE FROM orders WHERE receipt_code='$rpcode'";
																				$result = $db->query($sql);
																			header("location:posted_order_list.php?success=success");
													
													}else{
														//POST IS EXPIRED
													  header("location:new_order.php?error=ovrdue&rp=$rpcode&cusno=$customer_no");	
													}

												}
											}

							}
					}
	
				}// condition when credit limit is greater than zero
		
	
	  }elseif($docType==1){
	  		$extDocNo=mysql_escape_string(trim($_POST['exdoccode']));
$getexDoc = $db->query("SELECT * FROM posted_orders_table WHERE externalDocNo='$extDocNo'  LIMIT 1");
		 $ItemCount=mysqli_num_rows($getexDoc);
		if($ItemCount==1){
			header("location:returnOrder.php?error=dupInv");
		}else{
			$result = $db->query("SELECT * FROM posted_source_id WHERE type='return'");
											while($row6 = $result->fetch_array())
											  {
											        $fefe=$row6['source_id']; 
											  }
											 $sasa=$fefe+1;
											$db->query("UPDATE posted_source_id SET source_id = '$sasa' WHERE type='return'");
											$postedCode =   $fromlocCode.'-CM-'.$sasa;
	
$receipt_code=mysql_escape_string(trim($_POST['rcpcode']));
			$updateOrd = $db->query("UPDATE posted_orders_table SET status='return' WHERE receipt_code='$receipt_code'");
			mysqli_query($db, $updateOrd);
$date = date('Y-m-d');
$documentDate = date('Y-m-d');
//Parse to insert Integration Registry
		$insertIntReg = $db->query("INSERT INTO integration_register(batchNo,createdDate,status,transType)VALUES('','$date','0','2')");
		mysqli_query($db, $insertIntReg);
		$batchNum=mysqli_insert_id($db); 	
$getPostOrder = $db->query("SELECT * FROM `posted_orders_table` WHERE `receipt_code`='$receipt_code' AND customer_no='$cusId' ");
while($row=$getPostOrder->fetch_assoc()){
			 $dateOrd=$row['date_ordered'];
			 $pcode=$row['item_id'];
			 $pname=$row['item_description'];
			 $qty=$row['quantity'];
			 $price=$row['price'];
			 $total=$row['total'];
			 $customer_no=$row['customer_no'];
			 $customer=$row['customer_name'];
			 $customer_add=$row['customer_address'];
			 $customer_add2=$row['customer_address2'];
			 $vatRegNo=$row['vatRegNo'];
			 $priceVat=$row['pricesIncVAT'];
			  $documentType=$row['documentType'];
			  $locCode=$row['outletCode'];
			  $promdelvDate = $row['promDelDate'];
			  $reqdelvDate = $row['reqDelDate'];
			  $dueDate = $row['dueDate'];
			  if($documentType == 1){
						 $intDocType = 2;// posted order
					}
$postingDate = date('Y-m-d');
$lineAmnt= $qty*$price;	

		//insert into posted table
		$postOrder = $db->query("INSERT INTO posted_orders_table(appliedDocNo,salesinvno,receipt_code,externalDocNo,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,paymentTermCode,posted_by) 
								VALUES('$appDocNo','$postedCode','$receipt_code','$extDocNo','$pcode','$pname','$qty','$price','$total','$docDate','$locCode','1','$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo','$reqdelvDate','$promdelvDate','$dueDate','$priceVat','$payment_term','$user_id')");
		mysqli_query($db, $postOrder);	
			
	//Parse to insert item Ledger
		$insertItemLedger = $db->query("INSERT INTO item_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,description,amount,qty,remainingAmt,open,dueDate,positive,documentDate,externalDocNo)
			VALUES('$locCode','$pcode','$customer_no','$documentDate','2','$postedCode','$pname','$total','$qty','$total','1','$paymentdue','1','$documentDate','$extDocNo')");
		mysqli_query($db, $insertItemLedger);

		//Parse to insert Integration Registry Entry
		$insertIntRegEnt = $db->query("INSERT INTO integration_register_entry(batchNo,locationCode,transType,sourceType,sourceNo,postingDate,postedDocNo,preAssignedNo,externalDocNo,documentLineType,documentLineTypeNo,quantity,unitAmount,lineAmount,productID)
		VALUES('$batchNum','$locCode','1','1','$customer_no','$postingDate','$postedCode','$receipt_code','$extDocNo','1','$pcode',' $qty',' $price','$lineAmnt','$itemID')");
		mysqli_query($db, $insertIntRegEnt);
			
		}

		$result1 = $db->query("SELECT sum(total) FROM posted_orders_table where receipt_code='$receipt_code'");
												while($row1 = $result1->fetch_array())
													  {
													     $yy=$row1['sum(total)'];
														  
												 }	
		$result2 = $db->query("SELECT sum(quantity) FROM posted_orders_table where receipt_code='$receipt_code'");
												while($row2 = $result2->fetch_array())
													  {
													     $zz=$row2['sum(quantity)'];
														  
												 }
		 $result3 = $db->query("SELECT sum(price) FROM posted_orders_table where receipt_code='$receipt_code'");
											while($row3 = $result3->fetch_array())
												{
													     $aa=$row3['sum(price)'];
														  
												 }		
		//Parse to insert customer Ledger
		$insertCustomerLedger = $db->query("INSERT INTO customers_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,amount,remainingAmt,open,dueDate,positive,documentDate,externalDocNo)
			VALUES('$locCode','$postedCode','$customer_no','$postingDate','1','$receipt_code','-$yy','$yy','1','$dueDate','0','$documentDate','$extrnalDocNum')");
		mysqli_query($db, $insertCustomerLedger);
		$sql = "DELETE FROM orders WHERE receipt_code='$receipt_code'";
       $result = $db->query($sql);
header("location:posted_returnorder_list.php?success=success");		
				 	 	
		}

	  }// end of else doctype
*/		
//post button

									 		
/*
	if(isset($_POST['pstndprnt'])){
	$extDocNo= mysql_escape_string(trim($_POST['exdoccode']));
	$getexDoc = $db->query("SELECT * FROM posted_orders_table WHERE externalDocNo='$extDocNo' LIMIT 1");
 	$ItemCount=mysqli_num_rows($getexDoc);
	if($ItemCount==1){
		
		if ($docType==0) {
			header("location:new_order.php?error=dupInv");
		}
		elseif ($docType==1) {
			header("location:new_order.php?error=dupCM");
		}
		exit;
	}else{
		$ordertotal=$_POST['linetotal'];
	}


	$sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id' ");
		while($row00=$sql->fetch_assoc()){
			$access = $row00['access'];
  			 $u_outlet=$row00['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row01 = $outlet->fetch_assoc()) {
			 $locDocCode=$row01['outletDocCode'];	
			 $outlocCode=$row01['locationCode'];	
				
				}
		}
		
	$date = date('Y-m-d');
	$postingDate = date('Y-m-d');
	$documentDate = date('Y-m-d');
	$ok=true;

	if($docType==0){
		$docTypeCode="sales";
		$docPrefix="SI";
	}elseif ($docType==1) {
		$docTypeCode="return";		
		$docPrefix="CM";
	}

	//Get Credit Limit of the Customer
	if($docType==0){
		$cred_limit=0;
		$getCusInfo = $db->query("SELECT * FROM customers WHERE customer_no='$customer_no'");
					while ($row5 = $getCusInfo->fetch_assoc()) {
						  $cred_limit = $row5['credit_limit'];
					}

		//**** VALIDATE ACCORDING TO CREDIT LIMIT ****
		if($cred_limit>0){
			//get outstanding balance
			$getCustLedger =$db->query("SELECT SUM(amount) FROM customers_ledger WHERE customerID='$customer_no'");
					while ($row4 = $getCustLedger->fetch_assoc()) {
						 
						 $cc= $row4['SUM(amount)'];
					}		

			//sum-up outstanding balance with the current transaction amount
			$totalCred=$cc+$ordertotal;	
			if($totalCred>=$cred_limit){
				$ok=false;
				header("location:new_order.php?error=crdlmt");
					
			}

		}

		//**** VALIDATE ACCORDING TO OVERDUE BALANCE *****
		if($ok==true){
			$getCustLedger =$db->query("SELECT * FROM customers_ledger WHERE customerID='$customer_no' AND documentType=0 AND open=1 AND dueDate <='$date'");	
			$ledgercount = mysqli_num_rows($getCustLedger);  
			if($ledgercount>0){
				$ok=false;
				header("location:new_order.php?error=ovrdue&rp=$rpcode&cusno=$customer_no");	
			}
		}
	}	

	if($ok==true){
		//check for entry in the customer_ledger
		$getCusInfo = $db->query("SELECT * FROM orders WHERE receipt_code='$rpcode' AND customer_no='$customer_no' ");
			$orderCount=mysqli_num_rows($getCusInfo);

	    //Insert to Posted Order & Item Ledger
		$linectr = 0;
		while ($row = $getCusInfo->fetch_assoc()) {

		    $rpcode=$row['receipt_code'];
		    
		    $pcode=$row['item_id'];
		    $pname=mysql_escape_string(trim($row['item_description']));
		    $qty=$row['quantity'];
		    $price=$row['price'];
		    $total =$row['total'];
		    $docDate=$row['date_ordered'];
		    $locCode=$row['outletCode'];
		    $customer_no=$row['customer_no'];
		    $customer=$row['customer_name'];
		    $customer_add=$row['customer_address'];
		    $customer_add2=$row['customer_address2'];
		    $vatRegNo=$row['vatRegNo'];
		    $reqdelvDate=$row['reqDelDate'];
		    $promdelvDate=$row['promDelDate'];
		    $paymentdue=$row['dueDate'];
		    $priceVat=$row['pricesIncVAT'];
		     
		    $netUnt=$row['netUnitPrice'];
			$netAmt=$row['netAmount'];
			$vatPr=$row['vatPerc'];
			$vatAmnt=$row['vatAmount'];
		    $payment_term=$row['paymentTermCode'];
		    $user_id =$row['posted_by'];


			$linectr += 1;
			//Generate Posted 
			if($linectr==1){		

				//Parse to insert customer Ledger
				$result1 = $db->query("SELECT sum(total) FROM orders where receipt_code='$rpcode'");
														while($row1 = $result1->fetch_array())
															  {
															     $yy=$row1['sum(total)'];
																  
														 }	
				$result2 = $db->query("SELECT sum(quantity) FROM orders where receipt_code='$rpcode'");
														while($row2 = $result2->fetch_array())
															  {
															     $zz=$row2['sum(quantity)'];
																  
														 }
				 $result3 = $db->query("SELECT sum(price) FROM orders where receipt_code='$rpcode'");
													while($row3 = $result3->fetch_array())
														{
															     $aa=$row3['sum(price)'];
																  
														 }													
				$lineAmnt=number_format($total);

				//Insert to Customer Ledger
				$insertCustomerLedger = $db->query("INSERT INTO customers_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,amount,remainingAmt,open,dueDate,positive,documentDate,externalDocNo)
					VALUES('$locCode','$postedCode','$customer_no','$date','0','$rpcode','$yy','$yy','$docType','$paymentdue','1',' $docDate','$extDocNo')");
				mysqli_query($db, $insertCustomerLedger);


				$result0 = $db->query("SELECT * FROM posted_source_id WHERE type='$docTypeCode' AND locationID='$u_outlet'");
					while($row6 = $result0->fetch_array())
					  {
					        $fefe=$row6['source_id']; 
					  }
					$sasa=$fefe+1;
					$db->query("UPDATE posted_source_id SET source_id = '$sasa' WHERE type='$docTypeCode' AND locationID='$u_outlet'");
					$postedCode =  $locDocCode."-".$docPrefix."-".$sasa;

				//Insert to Integration register
				$insertIntReg = $db->query("INSERT INTO integration_register(batchNo,createdDate,status,transType)VALUES('','$date','0','$docType')");
				mysqli_query($db, $insertIntReg);
				$batchNum=mysqli_insert_id($db);
			}

			//Parse to insert item Ledger
			$insertItemLedger = $db->query("INSERT INTO item_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,description,amount,qty,remainingAmt,userID,open,dueDate,positive,documentDate,externalDocNo)
				VALUES('$locCode','$pcode','$customer_no','$postingDate',$docType,'$postedCode','$pname','$total','-$qty','$total','$user_id','1','$paymentdue','0','$documentDate','$extDocNo')");
			mysqli_query($db, $insertItemLedger);

			//insert into posted table
			$postOrder = $db->query("INSERT INTO posted_orders_table(salesinvno,receipt_code,externalDocNo,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,netUnitPrice,netAmount,vatPerc,vatAmount,paymentTermCode,posted_by) 
									VALUES('$postedCode','$rpcode','$extDocNo','$pcode','$pname','$qty','$price','$total','$docDate','$locCode',$docType,'$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo','$reqdelvDate','$promdelvDate','$paymentdue','$priceVat','$netUnitPrice',' $netAmnt','$vatPerc','$vatAmount','$payment_term','$user_id')");mysqli_query($db, $postOrder);			

			//Parse to insert Integration Registry
			$insertIntRegEnt = $db->query("INSERT INTO integration_register_entry(batchNo,locationCode,transType,sourceType,sourceNo,postingDate,postedDocNo,preAssignedNo,externalDocNo,documentLineType,documentLineTypeNo,paymentTermCode,quantity,unitAmount,lineAmount,productID)
			VALUES('$batchNum','$locCode','1','1','$customer_no','$date','$postedCode','$rpcode','$extDocNo',$docType,'$pcode','$payment_term','$qty',' $price','$total','$pcode')");
			mysqli_query($db, $insertIntRegEnt);																	 	 	
		}		

		//Parse to delete order from order table
		$sql = "DELETE FROM orders WHERE receipt_code='$rpcode'";
		$result = $db->query($sql);		
		////header("location:posted_order_list.php?success=success");
		header("location:print_invoice.php?rp=$rpcode");

	}	

	  
	  /*
	  $extDocNo= mysql_escape_string(trim($_POST['exdoccode']));
	$getexDoc = $db->query("SELECT * FROM posted_orders_table WHERE externalDocNo='$extDocNo'  LIMIT 1");
		 $ItemCount=mysqli_num_rows($getexDoc);
		if($ItemCount==1){
			header("location:new_order.php?error=dupInv");
		}else{
						$ordertotal=$_POST['linetotal'];
	$sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id' ");
		while($row00=$sql->fetch_assoc()){
			$access = $row00['access'];
  			 $u_outlet=$row00['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row01 = $outlet->fetch_assoc()) {
			 $locCode=$row01['outletDocCode'];	
			 $outlocCode=$row01['locationCode'];	
				
				}
		}
				
	$date = date('Y-m-d');
	$postingDate = date('Y-m-d');
	$documentDate = date('Y-m-d');
	$insertIntReg = $db->query("INSERT INTO integration_register(batchNo,createdDate,status,transType)VALUES('','$date','0','1')");
	mysqli_query($db, $insertIntReg);
	$batchNum=mysqli_insert_id($db);

		$getCusInfo = $db->query("SELECT * FROM customers WHERE customer_no='$customer_no'");
			while ($row5 = $getCusInfo->fetch_assoc()) {
				  $cred_limit = $row5['credit_limit'];
			}
	$getCustLedger =$db->query("SELECT SUM(amount) FROM customers_ledger WHERE customerID='$customer_no' AND documentType=0 AND locationID='$outlocCode' AND open=1 ");
			while ($row4 = $getCustLedger->fetch_assoc()) {
				 
				 $cc= $row4['SUM(amount)'];
			}
				$totalCred=$cc+$ordertotal;	
				if($cred_limit==0){
					$result = $db->query("SELECT * FROM socode");
											while($row = $result->fetch_array())
											  {
											        $ee=$row['code']; 
											  }
				 $ss=$ee+1;
				$db->query("UPDATE socode SET code = '$ss'");
									
			 $finalcode=$outDocCode.'-SO-'.$ss;
							$result0 = $db->query("SELECT * FROM posted_source_id WHERE type='sales'");
											while($row6 = $result0->fetch_array())
											  {
											        $fefe=$row6['source_id']; 
											  }
											 $sasa=$fefe+1;
											$db->query("UPDATE posted_source_id SET source_id = '$sasa' WHERE type='sales'");
											$postedCode =  $locCode.'-SI-'.$sasa;
												//check for entry in the customer_ledger
												$getCusInfo = $db->query("SELECT * FROM orders WHERE receipt_code='$rpcode' AND customer_no='$customer_no' ");
																while ($row = $getCusInfo->fetch_assoc()) {

														 				    $rpcode=$row['receipt_code'];
														 				    
														 				    $pcode=$row['item_id'];
														 				    $pname=mysql_escape_string(trim($row['item_description']));
														 				    $qty=$row['quantity'];
														 				    $price=$row['price'];
														 				    $total =$row['total'];
														 				    $docDate=$row['date_ordered'];
														 				    $locCode=$row['outletCode'];
														 				    $customer_no=$row['customer_no'];
														 				    $customer=$row['customer_name'];
														 				    $customer_add=$row['customer_address'];
														 				    $customer_add2=$row['customer_address2'];
														 				    $vatRegNo=$row['vatRegNo'];
														 				    $reqdelvDate=$row['reqDelDate'];
														 				    $promdelvDate=$row['promDelDate'];
														 				    $paymentdue=$row['dueDate'];
														 				    
														 				     $priceVat=$row['pricesIncVAT'];
														 				    $netUnt=$row['netUnitPrice'];
																			$netAmt=$row['netAmount'];
																			$vatPr=$row['vatPerc'];
																			$vatAmnt=$row['vatAmount'];
														 				    $payment_term=$row['paymentTermCode'];
														 				    $user_id =$row['posted_by'];

																$result1 = $db->query("SELECT sum(total) FROM orders where receipt_code='$rpcode'");
																										while($row1 = $result1->fetch_array())
																											  {
																											     $yy=$row1['sum(total)'];
																												  
																										 }	
																$result2 = $db->query("SELECT sum(quantity) FROM orders where receipt_code='$rpcode'");
																										while($row2 = $result2->fetch_array())
																											  {
																											     $zz=$row2['sum(quantity)'];
																												  
																										 }
																 $result3 = $db->query("SELECT sum(price) FROM orders where receipt_code='$rpcode'");
																									while($row3 = $result3->fetch_array())
																										{
																											     $aa=$row3['sum(price)'];
																												  
																										 }		
																										
																										$lineAmnt=number_format($total);	

																							//Parse to insert item Ledger
		$insertItemLedger = $db->query("INSERT INTO item_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,description,amount,qty,remainingAmt,userID,open,dueDate,positive,documentDate,externalDocNo)
			VALUES('$locCode','$pcode','$customer_no','$postingDate','1','$postedCode','$pname','$total','-$qty','$total','$user_id','1','$paymentdue','0','$documentDate','$extDocNo')");
		mysqli_query($db, $insertItemLedger);
																				//insert into posted table
																				$postOrder = $db->query("INSERT INTO posted_orders_table(salesinvno,receipt_code,externalDocNo,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,netUnitPrice,netAmount,vatPerc,vatAmount,paymentTermCode,posted_by) 
																										VALUES('$postedCode','$rpcode','$extDocNo','$pcode','$pname','$qty','$price','$total','$docDate','$locCode','0','$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo','$reqdelvDate','$promdelvDate','$paymentdue','$priceVat','$netUnitPrice',' $netAmount','$vatPr','$vatAmount','$payment_term','$user_id')");
																				mysqli_query($db, $postOrder);
																			//Parse to insert Integration Registry
																			$insertIntRegEnt = $db->query("INSERT INTO integration_register_entry(batchNo,locationCode,transType,sourceType,sourceNo,postingDate,postedDocNo,preAssignedNo,externalDocNo,documentLineType,documentLineTypeNo,paymentTermCode,quantity,unitAmount,lineAmount,productID)
																			VALUES('$batchNum','$locCode','1','1','$customer_no','$date','$postedCode','$rpcode','$extDocNo','1','$pcode','$payment_term','$qty',' $price','$total','$pcode')");
																			mysqli_query($db, $insertIntRegEnt);																	 	 	
																		}//cusinfo query
																		//Parse to insert customer Ledger
															$insertCustomerLedger = $db->query("INSERT INTO customers_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,amount,remainingAmt,open,dueDate,positive,documentDate,externalDocNo)
																VALUES('$locCode','$postedCode','$customer_no','$date','0','$rpcode','$yy','$yy','1','$paymentdue','1',' $docDate','$extDocNo')");
															mysqli_query($db, $insertCustomerLedger);								
																		//Parse to delete order from order table
																				$sql = "DELETE FROM orders WHERE receipt_code='$rpcode'";
																				$result = $db->query($sql);
																			header("location:print_invoice.php?rp=$rpcode");
				// condition when credit limit is zero
				}elseif($cred_limit>0){
						if($ordertotal > $cred_limit){
						 header("location:new_order.php?error=crdlmt");	
					}elseif($cc>=$cred_limit){
						header("location:new_order.php?error=crdlmt");
					}elseif($totalCred>=$cred_limit){
						header("location:new_order.php?error=crdlmt");
					}else{
						$result = $db->query("SELECT * FROM socode");
											while($row = $result->fetch_array())
											  {
											        $ee=$row['code']; 
											  }
				 $ss=$ee+1;
				$db->query("UPDATE socode SET code = '$ss'");
									
			 $finalcode=$outDocCode.'-SO-'.$ss;
							$getCustLedger =$db->query("SELECT * FROM customers_ledger WHERE customerID='$customer_no' AND documentType=0 AND locationID='$outlocCode'AND open=1");
								  $ledgercount = mysqli_num_rows($getCustLedger);
											if($ledgercount===0){
												$result0 = $db->query("SELECT * FROM posted_source_id WHERE type='sales'");
											while($row6 = $result0->fetch_array())
											  {
											        $fefe=$row6['source_id']; 
											  }
											 $sasa=$fefe+1;
											$db->query("UPDATE posted_source_id SET source_id = '$sasa' WHERE type='sales'");
											$postedCode =  $locCode.'-SI-'.$sasa;
												//check for entry in the customer_ledger
												$getCusInfo = $db->query("SELECT * FROM orders WHERE receipt_code='$rpcode' AND customer_no='$customer_no' ");
																while ($row = $getCusInfo->fetch_assoc()) {

														 				    $rpcode=$row['receipt_code'];
														 				    
														 				    $pcode=$row['item_id'];
														 				    $pname=mysql_escape_string(trim($row['item_description']));
														 				    $qty=$row['quantity'];
														 				    $price=$row['price'];
														 				    $total =$row['total'];
														 				    $docDate=$row['date_ordered'];
														 				    $locCode=$row['outletCode'];
														 				    $customer_no=$row['customer_no'];
														 				    $customer=$row['customer_name'];
														 				    $customer_add=$row['customer_address'];
														 				    $customer_add2=$row['customer_address2'];
														 				    $vatRegNo=$row['vatRegNo'];
														 				    $reqdelvDate=$row['reqDelDate'];
														 				    $promdelvDate=$row['promDelDate'];
														 				    $paymentdue=$row['dueDate'];
														 				    $priceVat=$row['pricesIncVAT'];
														 				     
														 				    $netUnt=$row['netUnitPrice'];
																			$netAmt=$row['netAmount'];
																			$vatPr=$row['vatPerc'];
																			$vatAmnt=$row['vatAmount'];
														 				    $payment_term=$row['paymentTermCode'];
														 				    $user_id =$row['posted_by'];

																$result1 = $db->query("SELECT sum(total) FROM orders where receipt_code='$rpcode'");
																										while($row1 = $result1->fetch_array())
																											  {
																											     $yy=$row1['sum(total)'];
																												  
																										 }	
																$result2 = $db->query("SELECT sum(quantity) FROM orders where receipt_code='$rpcode'");
																										while($row2 = $result2->fetch_array())
																											  {
																											     $zz=$row2['sum(quantity)'];
																												  
																										 }
																 $result3 = $db->query("SELECT sum(price) FROM orders where receipt_code='$rpcode'");
																									while($row3 = $result3->fetch_array())
																										{
																											     $aa=$row3['sum(price)'];
																												  
																										 }		
																										
																										$lineAmnt=number_format($total);	

																							//Parse to insert item Ledger
		$insertItemLedger = $db->query("INSERT INTO item_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,description,amount,qty,remainingAmt,userID,open,dueDate,positive,documentDate,externalDocNo)
			VALUES('$locCode','$pcode','$customer_no','$postingDate','1','$postedCode','$pname','$total','-$qty','$total','$user_id','1','$paymentdue','0','$documentDate','$extDocNo')");
		mysqli_query($db, $insertItemLedger);
																				//insert into posted table
																				$postOrder = $db->query("INSERT INTO posted_orders_table(salesinvno,receipt_code,externalDocNo,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,netUnitPrice,netAmount,vatPerc,vatAmount,paymentTermCode,posted_by) 
																										VALUES('$postedCode','$rpcode','$extDocNo','$pcode','$pname','$qty','$price','$total','$docDate','$locCode','0','$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo','$reqdelvDate','$promdelvDate','$paymentdue','$priceVat','$netUnitPrice',' $netAmount','$vatPr','$vatAmount','$payment_term','$user_id')");
																				mysqli_query($db, $postOrder);
																			//Parse to insert Integration Registry
																			$insertIntRegEnt = $db->query("INSERT INTO integration_register_entry(batchNo,locationCode,transType,sourceType,sourceNo,postingDate,postedDocNo,preAssignedNo,externalDocNo,documentLineType,documentLineTypeNo,paymentTermCode,quantity,unitAmount,lineAmount,productID)
																			VALUES('$batchNum','$locCode','1','1','$customer_no','$date','$postedCode','$rpcode','$extDocNo','1','$pcode','$payment_term','$qty',' $price','$total','$pcode')");
																			mysqli_query($db, $insertIntRegEnt);																	 	 	
																		}//cusinfo query
																		//Parse to insert customer Ledger
															$insertCustomerLedger = $db->query("INSERT INTO customers_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,amount,remainingAmt,open,dueDate,positive,documentDate,externalDocNo)
																VALUES('$locCode','$postedCode','$customer_no','$date','0','$rpcode','$yy','$yy','1','$paymentdue','1',' $docDate','$extDocNo')");
															mysqli_query($db, $insertCustomerLedger);								
																		//Parse to delete order from order table
																				$sql = "DELETE FROM orders WHERE receipt_code='$rpcode'";
																				$result = $db->query($sql);
																			header("location:print_invoice.php?rp=$rpcode");
											
											}elseif($ledgercount>=1){
											 while ($row0 = $getCustLedger->fetch_assoc()){
											  	$curr_date = date("Y-m-d");
											   $dueDate=$row0['dueDate'];
											   $docDate=$row0['documentDate'];
											   

											if($curr_date <= $docDate && $dueDate > $curr_date){
												$result0 = $db->query("SELECT * FROM posted_source_id WHERE type='sales'");
											while($row6 = $result0->fetch_array())
											  {
											        $fefe=$row6['source_id']; 
											  }
											 $sasa=$fefe+1;
											$db->query("UPDATE posted_source_id SET source_id = '$sasa' WHERE type='sales'");
											$postedCode =  $locCode.'-SI-'.$sasa;
												//check for entry in the customer_ledger
												$getCusInfo = $db->query("SELECT * FROM orders WHERE receipt_code='$rpcode' AND customer_no='$customer_no' ");
																while ($row = $getCusInfo->fetch_assoc()) {

														 				    $rpcode=$row['receipt_code'];
														 				   
														 				    $pcode=$row['item_id'];
														 				    $pname=mysql_escape_string(trim($row['item_description']));
														 				    $qty=$row['quantity'];
														 				    $price=$row['price'];
														 				    $total =$row['total'];
														 				    $docDate=$row['date_ordered'];
														 				    $locCode=$row['outletCode'];
														 				    $customer_no=$row['customer_no'];
														 				    $customer=$row['customer_name'];
														 				    $customer_add=$row['customer_address'];
														 				    $customer_add2=$row['customer_address2'];
														 				    $vatRegNo=$row['vatRegNo'];
														 				    $reqdelvDate=$row['reqDelDate'];
														 				    $promdelvDate=$row['promDelDate'];
														 				    $paymentdue=$row['dueDate'];
														 				    $priceVat=$row['pricesIncVAT'];
														 				    $netUnt=$row['netUnitPrice'];
																			$netAmt=$row['netAmount'];
																			$vatPr=$row['vatPerc'];
																			$vatAmnt=$row['vatAmount'];
														 				    $payment_term=$row['paymentTermCode'];
														 				    $user_id =$row['posted_by'];

																$result1 = $db->query("SELECT sum(total) FROM orders where receipt_code='$rpcode'");
																										while($row1 = $result1->fetch_array())
																											  {
																											     $yy=$row1['sum(total)'];
																												  
																										 }	
																$result2 = $db->query("SELECT sum(quantity) FROM orders where receipt_code='$rpcode'");
																										while($row2 = $result2->fetch_array())
																											  {
																											     $zz=$row2['sum(quantity)'];
																												  
																										 }
																 $result3 = $db->query("SELECT sum(price) FROM orders where receipt_code='$rpcode'");
																									while($row3 = $result3->fetch_array())
																										{
																											     $aa=$row3['sum(price)'];
																												  
																										 }		
																										$lineAmnt=number_format($total);	

																							//Parse to insert item Ledger
		$insertItemLedger = $db->query("INSERT INTO item_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,description,amount,qty,remainingAmt,userID,open,dueDate,positive,documentDate,externalDocNo)
			VALUES('$locCode','$pcode','$customer_no','$postingDate','1','$postedCode','$pname','$total','-$qty','$total','$user_id','1','$paymentdue','0','$documentDate','$extDocNo')");
		mysqli_query($db, $insertItemLedger);
																				//insert into posted table
																				$postOrder = $db->query("INSERT INTO posted_orders_table(salesinvno,receipt_code,externalDocNo,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,netUnitPrice,netAmount,vatPerc,vatAmount,paymentTermCode,posted_by) 
																										VALUES('$postedCode','$rpcode','$extDocNo','$pcode','$pname','$qty','$price','$total','$docDate','$locCode','0','$customer_no','$customer','$customer_add','$customer_add2','$vatRegNo','$reqdelvDate','$promdelvDate','$paymentdue','$priceVat','$netUnitPrice',' $netAmount','$vatPr','$vatAmount','$payment_term','$user_id')");
																				mysqli_query($db, $postOrder);
																			//Parse to insert Integration Registry
																			$insertIntRegEnt = $db->query("INSERT INTO integration_register_entry(batchNo,locationCode,transType,sourceType,sourceNo,postingDate,postedDocNo,preAssignedNo,externalDocNo,documentLineType,documentLineTypeNo,paymentTermCode,quantity,unitAmount,lineAmount,productID)
																			VALUES('$batchNum','$locCode','1','1','$customer_no','$date','$postedCode','$rpcode','$extDocNo','1','$pcode','$payment_term','$qty',' $price','$total','$pcode')");
																			mysqli_query($db, $insertIntRegEnt);																	 	 	
																		}//cusinfo query
																		//Parse to insert customer Ledger
															$insertCustomerLedger = $db->query("INSERT INTO customers_ledger(locationID,sourceEntryID,customerID,postingDate,documentType,documentNo,amount,remainingAmt,open,dueDate,positive,documentDate,externalDocNo)
																VALUES('$locCode','$postedCode','$customer_no','$date','0','$rpcode','$yy','$yy','1','$paymentdue','1',' $docDate','$extDocNo')");
															mysqli_query($db, $insertCustomerLedger);								
																		//Parse to delete order from order table
																				$sql = "DELETE FROM orders WHERE receipt_code='$rpcode'";
																				$result = $db->query($sql);
																			header("location:print_invoice.php?rp=$rpcode");
													
													}else{
														//POST IS EXPIRED
													  header("location:new_order.php?error=ovrdue&rp=$rpcode&cusno=$customer_no");	
													}

												}
											}
							}
						}
	
				}// condition when credit limit is greater than zero
	}*/
?>
