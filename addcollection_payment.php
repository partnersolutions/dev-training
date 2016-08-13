<?php require 'includes/overall/overall_header.php';
$rp=$_GET['rp'];
$_SESSION['repcode']=$rp;
$getOrder = $db->query("SELECT * FROM orders WHERE receipt_code LIKE '%$rp%' AND status='processing' AND documentType='0' GROUP BY receipt_code ASC  ");
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
	}

?>

<body>
	<div class='container-fluid'>
			<?php include 'header.php';?>
			
			<div class="container">
					 	<div class="panel panel-default" id="salesOrder">
							  <!-- Default panel contents -->
							  <div class="panel-heading">
							  	<h2 class="page-header">Orders
							  		
							  	</h2>
								
					 		</div>
					
							</div>
							<div class="row">
								<form class="form-horizontal" name="form1" action="edititemorderparse.php" method="post">
									<div class="col-md-6">
										<div class="form-group" >
										    <label for="rpcode" class="col-sm-3 control-label">Receipt No:</label>
										    <div class="col-sm-5">
										      <input type="text" class="form-control" name="rpcode"   value="<?php echo $rp; ?>" readonly />
										     
										     
										    </div>
										 </div>
										 <div class="form-group" >
										    <label for="rpcode" class="col-sm-3 control-label">Customer No:</label>
										    <div class="col-sm-5">
										      <input type="text" class="form-control" name="customer_no"   value="<?php echo $customer_no; ?>" readonly />
										      <input type="hidden" class="form-control" name="customer_name"   value="<?php echo $customer; ?>" readonly />
										      
										    </div>
										 </div>
										  <div class="form-group" >
										    <label for="rpcode" class="col-sm-3 control-label">Customer Address:</label>
										    <div class="col-sm-5">
										      <textarea class="form-control" name="customer_add" rows="5" required><?php echo $customer_add ; ?> </textarea>
										      
										    </div>
										 </div>
										  <div class="form-group" >
										    <label for="rpcode" class="col-sm-3 control-label">Customer Address 2:</label>
										    <div class="col-sm-5">
										       <textarea class="form-control" name="customer_add2" rows="5" required ><?php echo $customer_add2; ?> </textarea>
										      
										    </div>
										 </div>
										  
									</div>
							<div class="col-md-6">
								<div class="form-group" >
										    <label for="productdetail" class="col-sm-3 control-label">External Document No.:</label>
										    <div class="col-sm-4">
										      <input type="text" class="form-control" name="exdoccode"   value="<?php echo $exDocNum;?>" readonly />
										    </div>
										 </div>
							<div class="form-group">
							    <label for="productprice" class="col-sm-3 control-label">Payment Terms</label>
							    <div class="col-sm-4">
							      <div class="input-group">
								      <input type="text" class="form-control" name="payTerm"  value="<?php echo $paymentCode;?> Days" readonly/>
								    </div>
							    </div>
							  </div>
								<div class="form-group">
							    <label for="reqDelDate" class="col-sm-3 control-label">Requested Delivery Date</label>
							    <div class="col-sm-4">
							      <div class="input-group">
									  <input type="date" class="form-control" name="reqDelDate" value="<?php echo $reqDelvDate;?>" required />
									</div>
							    </div>
							  </div>
							   <div class="form-group">
							    <label for="promDelDate" class="col-sm-3 control-label">Promised Delivery Date</label>
							    <div class="col-sm-4">
							      <div class="input-group">
									  <input type="date" class="form-control" name="promDelDate" value="<?php echo $proDelvDate;?>" required />
									</div>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="promDelDate" class="col-sm-3 control-label">Due Date</label>
							    <div class="col-sm-4">
							      <div class="input-group">
									  <input type="date" class="form-control" name="dueDate" value="<?php echo $dueDate;?>" required />
									</div>
							    </div>
							  </div>
							</div>	
						</div>	
							<div class="row"> 
								<h3>Sales Line</h3>
								<hr />
								<a href="addorder.php" class="btn btn-primary">Add Item</a><br /><br />
								<table class="table table-bordered">
									<tr>
								  		
								  		<td>Item Description</td>
								  		<td>Retail Price</td>
								  		<td>Quantity</td>
								  		<td>Total</td>
								  		<td>Option</td>
	
							  		
							  		</tr>
							  		<?php
							  		
							  		$getOrder = $db->query("SELECT * FROM posted_orders_table WHERE receipt_code='$rp' ");
									$ordersCount=mysqli_num_rows($getOrder);
							  		if($ordersCount==0){
							  			echo "<tr><td colspan='5'>You have no order posted yet
										</td></tr>";
							  		}else{
									while($row=$getOrder->fetch_array()){
										$dateOrd=$row['date_ordered'];
							  			echo "<tr>
								  		
								  		<td>".$row['item_description']."</td>
								  		<td class='text-right'>Php ".number_format($row['price'])."</td>
								  		<td class='text-right'>".number_format($row['quantity'])."</td>
								  		<td class='text-right'>".number_format($row['total'])."</td>
								  		<td><a href='delete.php?id=".$row['id']."'>Remove</a></td>
								  			</tr>
								  		";

							  		}
							  	}	

							  		?>
								</table>	
							</div>
						<div class="row">
							<div class="col-md-6">
								
							  
							  </div>
							  <div class="col-md-6">
							  		<div class="form-group  ">
							    <label for="productprice" class="col-sm-3 control-label">Total Retail:</label>
							    	<div class="col-sm-5">
										<div class="input-group">
											<?php
												$result = $db->query("SELECT sum(total) FROM orders where receipt_code='$rp'");
												while($row2 = $result->fetch_array())
													  {
													     $yy=$row2['sum(total)'];
														  
														  }

											?>
									  		<span class="input-group-addon">Php</span>
									  	<input type="text" class="form-control" name="totalretail" id="rtotal" value="<?php echo $yy; ?>" placeholder="Total" readonly />
										  <span class="input-group-addon">.00</span>
										</div>
							    	</div>
							  	</div>
							  	<br />
								<br />
							  	<div class="form-group pull-right">
    								<div class="col-sm-offset-2 col-sm-10">
							  		 <button type="submit" name="save" class="btn btn-default btn-lg">Save Changes</button>
							  		</div>
							  	</div>
  							</div>
						</div>	
						</form>
				</div>
				<br />
				<br />
				<div class="row">
							<nav class="navbar navbar-default navbar-static-bottom">
								 <div class="container-fluid">
						  				&copy; ALL RIGHTS RESERVED 2015
									</div>
							</nav>
					</div>	
		</div>

<script type="text/javascript">
		function addFrame(){
				document.getElementById("frame").style.display = "block";
		}
</script>
<?php require 'includes/overall/overall_footer.php';?>