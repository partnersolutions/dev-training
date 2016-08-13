<?php require 'includes/overall/overall_header.php';
$rp=$_GET['rp'];
$_SESSION['rcpcode']=$rp;
$getOrder = $db->query("SELECT * FROM orders WHERE receipt_code='$rp'  AND documentType=0 GROUP BY receipt_code ASC  ");
while($row=$getOrder->fetch_array()){
		$ordId=$row['id'];
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
	}

?>

<body>
	<div class='container-fluid'>
			<?php include 'header.php';?>
			
		
				<div class="row">
					<?php include "includes/side_menu.php";?>
					<div class="col-md-10">
						<form class="form-horizontal" name="form1" action="edititemorderparse.php" method="post">
						<div class="panel panel-default" id="salesOrder">
										  <!-- Default panel contents -->
										  <div class="panel-heading">
										  	<h4 class="text-center">Edit Order</h4>
											
								 		</div>
								<div class="panel-body">
								<div class="pull-right">
			    								<div class="btn-group " role="group">
										  		 <button type="submit" name="save" class="btn btn-default" style='cursor:pointer;background:#f1a9a0;color:#ffffff;margin-top:-2px;margin-bottom:5px;'>Save Changes</button>	  		
										  		</div>
										  	</div>
										  	<br />
										  	<hr /> 
										<div class="row">
											
												<div class="col-md-6">
													<div class="form-group" >
													    <label for="rpcode" class="col-sm-5 col-form-label">Order No. . . . . . . . . . . . . .</label>
													    <div class="col-sm-5">
													      <input type="text" class="form-control" name="rpcode"   value="<?php echo $rp; ?>" readonly />
													     
													     
													    </div>
													 </div>
													 <div class="form-group" >
													    <label for="rpcode" class="col-sm-5 col-form-label">Customer No. . . . . . . . . . .</label>
													    <div class="col-sm-5">
													      <input type="text" class="form-control" name="customer_no"   value="<?php echo $customer_no; ?>" readonly />
													      
													    </div>
													 </div>
													 <div class="form-group" >
													    <label for="rpcode" class="col-sm-5 col-form-label">Name. . . . . . . . . . . . . . . . .</label>
													    <div class="col-sm-5">
													      <input type="text" class="form-control" name="customer_name"   value="<?php echo $customer; ?>" readonly />
													      
													    </div>
													 </div>
													  <div class="form-group" >
													    <label for="rpcode" class="col-sm-5 col-form-label">Address . . . . . . . . . . . . . . .</label>
													    <div class="col-sm-5">
													      <textarea class="form-control" name="customer_add" rows="2" required><?php echo $customer_add ; ?> </textarea>
													      
													    </div>
													 </div>
													  <div class="form-group" >
													    <label for="rpcode" class="col-sm-5 col-form-label">Address 2 . . . . . . . . . . . . .</label>
													    <div class="col-sm-5">
													       <textarea class="form-control" name="customer_add2" rows="2" required ><?php echo $customer_add2; ?> </textarea>
													      
													    </div>
													 </div>
													  <div class="form-group" >
													    <label for="productprice" class="col-sm-5 col-form-label">Price Incl. VAT . . . . . . . . . </label>
													    <div class="col-sm-5">
													       <input type="text" class="form-control" name="pricevat"   value="<?php echo $pricesincVAT; ?>" readonly />
													      
													    </div>
													 </div>						  
												</div>
										<div class="col-md-6">
													 
											<div class="form-group" >
													    <label for="productdetail" class="col-sm-5 col-form-label">Document Date. . .</label>
													    <div class="col-sm-4">
													      <input type="text" class="form-control" name="docdate"   value="<?php echo $dateOrd;?>"  />
													    </div>
													 </div>													 
										<div class="form-group">
										    <label for="productprice" class="col-sm-5 col-form-label">Payment Terms . . . .</label>
										    <div class="col-sm-4">
										      <div class="input-group">
											      <select class="form-control" name="payTerm"  onchange='getPaymentTerm(this.value)'>
											      	<option  disabled selected><?php echo $paymentCode;?> Days</option>
												<?php 
												 $selectTerms = $db->query("SELECT * FROM paymentterms");
												while($row1=$selectTerms->fetch_assoc()){
												echo $terms = "<option value=".$row1['due_date_formula'].">".$row1['payment_term_description']."</option>";
												}
											?>
											</select>
											    </div>
										    </div>
										  </div>
										  <div class="form-group">
										    <label for="promDelDate" class="col-sm-5 col-form-label">Due Date . . . . . . . . .</label>
										    <div class="col-sm-4">
										      <div class="input-group" id="paymentresults">
												  <input type="date" class="form-control" name="dueDate" value="<?php echo $dueDate;?>" readonly />
												</div>
										    </div>	
										   </div> 									  
											<div class="form-group">
										    <label for="reqDelDate" class="col-sm-5 col-form-label">Req. Del. Date . . . . .</label>
										    <div class="col-sm-4">
										      <div class="input-group">
												  <input type="date" class="form-control" name="reqDelDate" value="<?php echo $reqDelvDate;?>" readonly />
												</div>
										    </div>
										  </div>
										   <div class="form-group">
										    <label for="promDelDate" class="col-sm-5 col-form-label">Prom. Del. Date . . . .</label>
										    <div class="col-sm-4">
										      <div class="input-group">
												  <input type="date" class="form-control" name="promDelDate" value="<?php echo $proDelvDate;?>" readonly />
												</div>
										    </div>
										  </div>
											<div class="form-group" >
													    <label for="productdetail" class="col-sm-5 col-form-label">Sales Invoice No. . .</label>
													    <div class="col-sm-4">
													      <input type="text" class="form-control" name="exdoccode"   value="<?php echo $exDocNum;?>"  />
													    </div>
													 </div>										  
										  </div>
										</div>	
									</div>	
										<div class="panel panel-default"> 
											<div class="panel-heading">
										  	<h4 class="text-center">Sales Line
										  		
										  	</h4>
											
								 		</div>

								<div class="panel-body" style='position:relative;top:-30px'> 
											<a href="addorder.php" class="btn btn-primary" style='cursor:pointer;background:#f1a9a0;color:#ffffff;position:relative;right:-980px;top:20px; 	0px;'>Add Item</a>
											<br />
											<br />
			                	<table class="table table-bordered">
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
										  		<?php
										  		
										  		$getOrder = $db->query("SELECT * FROM orders WHERE receipt_code='$rp' AND documentType=0 ");
												$ordersCount=mysqli_num_rows($getOrder);
										  		if($ordersCount==0){
										  			echo "<tr><td colspan='5'>You have no order posted yet
													</td></tr>";
										  		}else{
												while($row=$getOrder->fetch_array()){
													$dateOrd=$row['date_ordered'];

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

										  <td>&nbsp;</td>
										  	
			  							
										</div>
									</div>
								</form>
							</div>

					</div>
				</div>
					 	
			</div>				
	</div>
</div>
<script type="text/javascript">
function getPaymentTerm(value){
		$.post("paymentDueSearch.php",{paymentCode:value},function(data){
						$("#paymentresults").html(data);
					});
				
	}
</script>
<?php require 'includes/overall/overall_footer.php';?>