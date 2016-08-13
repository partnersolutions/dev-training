<?php
include_once 'core/database/connect.php';
$rpCode=$_GET['rp'];
$product = $db->query("SELECT * FROM orders WHERE receipt_code='$rpCode'");
	while ($row = $product->fetch_assoc()) {
		$receipt_code = $row['receipt_code'];
		$customer_no = $row['customer_no'];
		 $customer = $row['customer_name'];
		$customer_add = $row['customer_address'];
		$customer_add2  = $row['customer_address2'];
		$paymentTerms  = $row['paymentTermCode'];
		$dueDate  = $row['dueDate'];
		$extDocNo= $row['externalDocNo'];
		$vatRegNo= $row['vatRegNo'];
		}								
?>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<div class="page-header">
		<h1>Edit Order</h1>
	</div>
						<form class="form-horizontal">
							<div class="form-group">
						    <label for="receiptCode" class="col-sm-3 control-label">Receipt Code:</label>
						    <div class="col-sm-5">
						      <input type="text" class="form-control" name="receiptCode" value="<?php echo $receipt_code; ?>" readonly>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="customerName" class="col-sm-3 control-label">Customer Name:</label>
						    <div class="col-sm-5">
						      <input type="text" class="form-control" name="customerName" value="<?php echo $customer;?>">
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="cusAddress" class="col-sm-3 control-label">Customer Address:</label>
						    <div class="col-sm-6">
						      <textarea class="form-control" name="cusAddress"><?php echo $customer_add;?></textarea>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="cusAddress2" class="col-sm-3 control-label">Customer Address2:</label>
						    <div class="col-sm-6">
						      <textarea class="form-control" name="cusAddress2"><?php echo $customer_add2;?></textarea>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="vatRegNo" class="col-sm-3 control-label">Prices Incl. VAT:</label>
						    <div class="col-sm-6">
						      <input type="text" class="form-control" name="vatRegNo" value="<?php echo $vatRegNo;?>"/>
						    </div>
						  </div>
						  <div>
							<h3>List of Orders</h3>
							<hr />
							<table class="table table-bordered">
								<tr>
							  		<td>Product ID</td>
							  		<td>Product Description</td>
							  		<td>Retail Price</td>
							  		<td>Quantity</td>
							  		<td>Total</td>
										
								</tr>
			  				<?php
					  		$getOrder = $db->query("SELECT * FROM orders WHERE receipt_code='$rpCode' ");
							while($row=$getOrder->fetch_array()){
								$dateOrd=$row['date_ordered'];
					  			echo "<tr>
						  				<td>".$row['item_id']."</td>
						  				<td>".$row['item_description']."</td>
						  				<td>Php ".$row['price']."</td>
						  				<td>".$row['quantity']."</td>
						  				<td>".$row['total']."</td>
					  				</tr>";
					 			
							}
							?>
						</table>	
						<div class="form-group">
							    <label for="customerName" class="col-sm-3 control-label">Payment Terms Code:</label>
							    <div class="col-sm-3">
							      <input type="text" class="form-control" name="paymentTerms" value="<?php echo $paymentTerms;?>" readonly>
							    </div>
							  </div>

						</div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-default">Save</button>
					    </div>
					  </div>
				</form>
<script src='js/jquery-2.1.3.min.js'></script>
<script src="js/bootstrap.min.js"></script>	