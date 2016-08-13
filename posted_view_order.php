<?php require 'includes/overall/overall_header.php';
$docType=$_SESSION['trans_type'];
$rp=$_GET['rp'];
$getOrder = $db->query("SELECT * FROM posted_orders_table WHERE receipt_code='$rp' AND documentType='$docType'");
while($row=$getOrder->fetch_array()){
	$dateOrd=$row['date_ordered'];

		$customer_no=$row['customer_no'];
		$customer =$row['customer_name'];
		$customer_add =$row['customer_address'];
		$customer_add2 =$row['customer_address2'];	
		$exDocNum =$row['externalDocNo'];	
	    $paymentCode =$row['paymentTermCode'];	
		$reqDelvDate =$row['reqDelDate'];	
		$proDelvDate =$row['promDelDate'];	
		$dueDate =$row['dueDate'];
		$pricesincVAT=$row['pricesIncVAT'];	
		$psino=$row['salesinvno'];
	}
$result = $db->query("SELECT sum(total) FROM posted_orders_table where receipt_code='$rp'");
															while($row2 = $result->fetch_array())
																  {
																     $yy=$row2['sum(total)'];
																	  
																	  }
																	  switch ($pricesincVAT) {
																				case '0':
																					$pricesincVAT= "No";
																					break;
																				case '1':
																					$pricesincVAT= "Yes";
																					break;
																				default:
																					# code...
																					break;
																			}

$Prop_SalesOrder=0;
$Prop_SalesCM=0;

if($docType==0){
	$PageCaption='Posted Sales Order';
	$PostedRefCaption='PSI No.';
	$PreRefCaption='Order No.';
	$Prop_SalesOrder="<div class='form-group'>
										    <label for='reqDelDate' class='col-sm-5 col-form-label'>Req. Del. Date . . . . . . . . . .</label>
										    <div class='col-sm-4'>
										      <div class='input-group'>
												  <input type='date' class='form-control' name='reqDelDate' value='$reqDelvDate' readonly />
												</div>
										    </div>
										  </div>
										   <div class='form-group'>
										    <label for='promDelDate' class='col-sm-5 col-form-label'>Prom. Del. Date . . . . . . . . .</label>
										    <div class='col-sm-4'>
										      <div class='input-group'>
												  <input type='date' class='form-control' name='promDelDate' value='$proDelvDate' readonly />
												</div>
										    </div>
										  </div>	
										  <div class='form-group' >
													    <label for='productdetail' class='col-sm-5 col-form-label'>Sales Invoice No. . . . . . . .</label>
													    <div class='col-sm-4'>
													      <input type='text' class='form-control' name='exdoccode'   value=' $exDocNum' readonly/>
													    </div>
													    
													 </div>";

}elseif ($docType=1) {
	$PageCaption='Posted Sales Return';
	$PostedRefCaption='PCM No.';
	$PreRefCaption='Return Order No.';
	$Prop_SalesOrder="<div class='form-group' >
													    <label for='productdetail' class='col-sm-5 col-form-label'>Credit Memo No. . . . . . . .</label>
													    <div class='col-sm-4'>
													      <input type='text' class='form-control' name='exdoccode'   value=' $exDocNum' readonly/>
													    </div>
													    
													 </div>";
}

?>

<body>
	<div class='container-fluid'>
			<?php include 'header.php';?>
					
				<div class="row">
					<?php include "includes/side_menu.php";?>
					<div class="col-md-10">						
						<div class="panel panel-info" id="salesOrder">
										  <!-- Default panel contents -->
										  <div class="panel-heading">
										  	<h4 class="text-center"><?php echo $PageCaption ?>
										  		
										  	</h4>
											
								 		</div>
								<div class="panel-body"> 
										<div class="row">
											<form class="form-horizontal" name="form1" action="edititemorderparse.php" method="post">
												<div class="col-md-6">
													<div class="form-group" >
													    <label for="rpcode" class="col-sm-4 col-form-label" ><?php echo $PostedRefCaption ?>. . </label>
													    <div class="col-sm-4">
													      <input type="text" class="form-control" name="rpcode"   value="<?php echo $psino; ?>" readonly />
													    </div>
													 </div>												
													<div class="form-group" >
													    <label for="rpcode" class="col-sm-4 col-form-label" ><?php echo $PreRefCaption ?>. . </label>
													    <div class="col-sm-4">
													      <input type="text" class="form-control" name="rpcode"   value="<?php echo $rp; ?>" readonly />
													     
													     
													    </div>
													 </div>
													 <div class="form-group" >
													    <label for="rpcode" class="col-sm-4 col-form-label">Customer No. . . . . .</label>
													    <div class="col-sm-4">
													      <input type="text" class="form-control" name="customer_no"   value="<?php echo $customer_no; ?>" readonly />
													      <input type="hidden" class="form-control" name="customer_name"   value="<?php echo $customer; ?>" readonly />
													      
													    </div>
													 </div>
													  <div class="form-group" >
													    <label for="rpcode" class="col-sm-4 col-form-label">Address . . . . . . . . . .</label>
													    <div class="col-sm-5">
													      <textarea class="form-control" name="customer_add" rows="2" readonly><?php echo $customer_add ; ?> </textarea>
													      
													    </div>
													 </div>
													  <div class="form-group" >
													    <label for="rpcode" class="col-sm-4 col-form-label">Address 2 . . . . . . . . .</label>
													    <div class="col-sm-5">
													       <textarea class="form-control" name="customer_add2" rows="2" readonly ><?php echo $customer_add2; ?> </textarea>
													      
													    </div>
													 </div>
													  <div class="form-group" >
													    <label for="productprice" class="col-sm-4 col-form-label">Price Incl. VAT . . . . . </label>
													    <div class="col-sm-5">
													       <input type="text" class="form-control" name="pricevat"   value="<?php echo $pricesincVAT; ?>" readonly />
													      
													    </div>
													 </div>	
													  
												</div>
										<div class="col-md-6">
											<div class="form-group" >
													    <label for="productdetail" class="col-sm-5 col-form-label">Document Date. . . . . . . . . .</label>
													    <div class="col-sm-4">
													      <input type="text" class="form-control" name="docdate"   value="<?php echo $dateOrd;?>" readonly />
													    </div>
													 </div>		
										<div class="form-group">
										    <label for="productprice" class="col-sm-5 col-form-label">Payment Terms . . . . . . . . .</label>
										    <div class="col-sm-4">
										      <div class="input-group">
											      <input type="text" class="form-control" name="payTerm"  value="<?php echo $paymentCode;?> " readonly/>
											    </div>
										    </div>
										  </div>
										  <div class="form-group">
										    <label for="promDelDate" class="col-sm-5 col-form-label">Due Date . . . . . . . . . . . . . . .</label>
										    <div class="col-sm-4">
										      <div class="input-group">
												  <input type="date" class="form-control" name="dueDate" value="<?php echo $dueDate;?>" readonly />
												</div>
										    </div>
										  </div>
										  <?php echo $Prop_SalesOrder;?>									  
											
										   <div class='form-group' style='margin-bottom:8px;'>
										     <label class='col-sm-5 col-form-label text-left'>Total Amount . . . . . . . . . . .</label>
												<div class='col-sm-5'>
												<div class='input-group'>
												<input name='linetotal' id='linetotal' class='text-right form-control' type='text' value='<?php echo number_format($yy,2); ?>'  readonly='readonly'/> 
															    					
											</div>
															    					
										</div>
									</div>
										</div>	
									</div>									
										<div class="panel panel-default"> 
											<div class="panel-heading">
										  	<h4 class="text-left">Posted Sales Line										  		
										  	</h4>
											
								 		</div>
								<div class="panel-body"> 
											
											<table class="table table-bordered">
												<tr>
<tr>
								  		<th>Item No</th>
								  		<th>Description</th>
								  		<th class="text-right">Quantity</th>
								  		<th class="text-right">UOM</th>
								  		<th class="text-right">Unit Price</th>
								  		<th class="text-right">Net Amount</th>
		         				  		<th class="text-right">VAT %</th>
								  		<th class="text-right">VAT Amount</th>
								  		<th class="text-right">Line Amount</th>
								  										  	
							  		
							  		</tr>
										  		
										  		</tr>
										  		<?php
										  		
										  		$getOrder = $db->query("SELECT * FROM posted_orders_table WHERE receipt_code='$rp' AND documentType='$docType' AND item_id !='' ");
												$ordersCount=mysqli_num_rows($getOrder);
										  		if($ordersCount==0){
										  			echo "<tr><td colspan='5'>You have no order posted yet
													</td></tr>";
										  		}else{
												while($row=$getOrder->fetch_array()){
													$dateOrd=$row['date_ordered'];
													$qty=$row['quantity'];
										$price=$row['price'];
										$lineamount = $price * $qty;
										  			echo "<tr>
											  		<td class='text-left'>".$row['item_id']."</td>
											  		<td>".$row['item_description']."</td>
											  		<td class='text-right'>".number_format($row['quantity'],2)."</td>
											  		<td class='text-right'>".($row['untMsrcode'])."</td>
											  		<td class='text-right'>".number_format($row['price'],2)."</td>
											  		<td class='text-right'>".number_format($row['netAmount'],2)."</td>
											  		<td class='text-right'>".number_format($row['vatPerc'],2)."</td>
											  		<td class='text-right'>".number_format($row['vatAmount'],2)."</td>
											  		<td class='text-right'>".number_format($lineamount,2)."</td>
											  		
											  		</tr>
											  		";

										  		}
										  	}	

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