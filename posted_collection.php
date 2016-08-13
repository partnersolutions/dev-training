<?php require 'includes/overall/overall_header.php';
$rp=$_GET['rp'];
$postedCollection = $db->query("SELECT * FROM collection_receipt_entry WHERE entryID='$rp' ");
while($row=$postedCollection->fetch_array()){

		$id=$row['entryID'];
		$customer_no=$row['customerID'];
		$postDate=$row['postingDate'];
		$createDate=$row['createdDate'];
		$exDocNum =$row['externalDocNo'];
		$PostedORNo=$row['no'];		
		$CRNo=$row['documentNo'];
		$ORNo=$row['externalDocNo'];
		$ORRemarks=$row['remarks'];
		$ORPaymentMethod=$row['payment_method'];
		$ORCheckNo=$row['check_no'];
		$ORAmount=$row['amount'];
		
$getCustomerInfo = $db->query("SELECT * FROM customers WHERE customer_no='$customer_no' ");
while($row0=$getCustomerInfo->fetch_array()){

		$customer =$row0['name'];
		$customer_add =$row0['address'];
		$customer_add2 =$row0['address2'];	
		$vatreg =$row0['vatRegNo'];	
		$pvat =$row0['pricesIncVat'];	
	
	}
}
?>
<body>
	<div class='container-fluid'>
			<?php include 'header.php';?>
			
		
				<div class="row">
					<?php include "includes/side_menu.php";?>
					<div class="col-md-8">
						<div class="panel panel-default" id="salesOrder">
										  <!-- Default panel contents -->
										  <div class="panel-heading">
										  	<h4 class="text-center">Posted Collection Receipt
										  		
										  	</h4>
											
								 		</div>
								<div class="panel-body"> 
										<div class="row">
											<form class="form-horizontal" name="form1" action="edititemorderparse.php" method="post">
												<div class="col-md-6">
													<div class="form-group" >
													    <label for="rpcode" class="col-sm-4 col-form-label">Posted OR No.</label>
													    <div class="col-sm-5">
													      <input type="text" class="form-control" name="rpcode"   value="<?php echo $PostedORNo; ?>" readonly />													     													    
													    </div>
													 </div>													
													<div class="form-group" >
													    <label for="rpcode" class="col-sm-4 col-form-label">CR No:</label>
													    <div class="col-sm-5">
													      <input type="text" class="form-control" name="rpcode"   value="<?php echo $CRNo; ?>" readonly />													     													    
													    </div>
													 </div>
													 <div class="form-group" >
													    <label for="rpcode" class="col-sm-4 col-form-label">Customer No</label>
													    <div class="col-sm-5">
													      <input type="text" class="form-control" name="customer_no"   value="<?php echo $customer_no; ?>" readonly />
													      <input type="hidden" class="form-control" name="customer_name"   value="<?php echo $customer; ?>" readonly />
													      
													    </div>
													 </div>
													  <div class="form-group" >
													    <label for="rpcode" class="col-sm-4 col-form-label">Customer Name</label>
													    <div class="col-sm-5">
													      <textarea class="form-control" name="customer_add" rows="1" required readonly><?php echo $customer ; ?> </textarea>
													      
													    </div>
													 </div>
													  <div class="form-group" >
													    <label for="rpcode" class="col-sm-4 col-form-label">Remarks</label>
													    <div class="col-sm-5">
													       <textarea class="form-control" name="customer_add2" rows="2" required readonly><?php echo $ORRemarks; ?> </textarea>
													      
													    </div>
													 </div>
													  
												</div>
										<div class="col-md-6">
											<div class="form-group">
										    <label for="reqDelDate" class="col-sm-5 col-form-label">Posting Date</label>
										    <div class="col-sm-4">
										      <div class="input-group">
												  <input type="date" class="form-control" name="reqDelDate" value="<?php echo $postDate;?>" readonly required />
												</div>
										    </div>
										  </div>
										 <div class="form-group" >
										    <label for="rpcode" class="col-sm-5 col-form-label">Payment Method</label>
										    <div class="col-sm-5">
										      <input type="text" class="form-control" name="customer_no"   value="<?php echo $ORPaymentMethod; ?>" readonly />
										      <input type="hidden" class="form-control" name="customer_name"   value="<?php echo $ORPaymentMethod; ?>" readonly />
										      
										    </div>
										 </div>
											<div class="form-group" >
													    <label for="productdetail" class="col-sm-5 col-form-label">OR No.</label>
													    <div class="col-sm-4">
													      <input type="text" class="form-control" name="exdoccode"   value="<?php echo $ORNo;?>" readonly />
													    </div>
													 </div>
											<div class="form-group" >
													    <label for="productdetail" class="col-sm-5 col-form-label">Check No.</label>
													    <div class="col-sm-4">
													      <input type="text" class="form-control" name="exdoccode"   value="<?php echo $ORCheckNo;?>" readonly />
													    </div>
													 </div>				
											<div class="form-group" >
													    <label for="productdetail" class="col-sm-5 col-form-label">Amount Tendered</label>
													    <div class="col-sm-4">
													      <input type="text" class="form-control" name="exdoccode"   value="<?php echo number_format($ORAmount,2);?>" readonly />
													    </div>
													 </div>		
										
										</div>	
									</div>	
										<div class="panel panel-default"> 
											<div class="panel-heading">
										  	<h4 class="text-left">Applied Document
										  		
										  	</h4>
											
								 		</div>
								<div class="panel-body"> 
										
											<table class="table table-bordered">
												<tr>
											  		<th>Document Type</th>
											  		<th>Document No</th>
											  		<th>Applied Amount</th>
										  		</tr>
										  		<?php
										  $rp=$_GET['rp'];
										  		$getOrder = $db->query("SELECT * FROM collection_receipt_entry_app WHERE subEntryID='$rp' ");
										 $customerLedgCount=mysqli_num_rows($getOrder);

									while($row2=$getOrder->fetch_array()){
										$docType=$row2['documentType'];
										switch ($docType) {
																				case '0':
																					$docType= "Sales Invoice";
																					break;
																				case '1':
																					$docType= "Sales Credit Memo";
																					break;
																				default:
																					# code...
																					break;
																			}
							  			echo "<tr>
								  		<td>$docType</td>
								  		<td >".$row2['documentNo']."</td>
								  		
								  		<td class='text-right'>".number_format($row2['ApplyingAmt'],2)."</td>
								  		
								  		</tr>
								  		";

							  		}

/*
										<div class="form-group">
										    <label for="productprice" class="col-sm-5 col-form-label">Amount Tendered</label>
										    <div class="col-sm-4">
										      <div class="input-group">
										      	<?php
															$result = $db->query("SELECT sum(amount) FROM collection_receipt_entry WHERE documentNo='$rp'");
															while($row2 = $result->fetch_array())
																  {
																     $yy=$row2['sum(amount)'];
																	  
																	  }

														?>
											      <input type="text" class="form-control" name="payTerm"  value="<?php 

											      echo number_format($yy);?>" readonly/>
											    </div>
										    </div>
										  </div>
*/

										  		

										  		?>
											</table>	
											
										</div>
									</div>
								</form>
							</div>

					</div>
				</div>
					 	
			</div>				
	</div>
</div>

	
<?php require 'includes/overall/overall_footer.php';?>