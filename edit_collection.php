<?php require 'includes/overall/overall_header.php';
$rp=$_GET['rp'];

$getcollection = $db->query("SELECT * FROM collection_journ WHERE documentNo='$rp'  GROUP BY documentNo ASC  ");
while($row=$getcollection->fetch_array()){
		$colId=$row['id'];
		$datecol=$row['date_ordered'];
		$customer_no=$row['customerID'];
		$exDocNum =$row['externalDocNo'];	
		$proDelvDate =$row['postingDate'];	
		
	}
 $user = $db->query("SELECT * FROM users WHERE user_id='$user_id'");
				while ($row = $user->fetch_assoc()) {
				  $u_outlet=$row['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row = $outlet->fetch_assoc()) {
				 $locCode=$row['locationCode'];	
				
				}
			}
		 $_SESSION['rcpcode']=$rp;		
	 $_SESSION['cus_no']=$customer_no;
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
										  	<h3 class="text-center">Edit Collection
										  		
										  	</h3>
											
								 		</div>
								<div class="panel-body"> 
										<div class="row">
											<form class="form-horizontal" name="form1" action="#" method="post">
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
													  
												</div>
										<div class="col-md-6">
											<div class="form-group" >
													    <label for="productdetail" class="col-sm-4 control-label">External Document No.:</label>
													    <div class="col-sm-4">
													      <input type="text" class="form-control" name="exdoccode"   value="<?php echo $exDocNum;?>" readonly />
													    </div>
													 </div>
										
										   <div class="form-group">
										    <label for="promDelDate" class="col-sm-4 control-label">Document Date</label>
										    <div class="col-sm-4">
										      <div class="input-group">
												  <input type="date" class="form-control" name="promDelDate" value="<?php echo $proDelvDate;?>" readonly />
												</div>
										    </div>
										  </div>
										</div>	
									</div>	
										<div class="panel panel-default"> 
											<div class="panel-heading">
										  	<h3 class="text-center">Collection Line
										  		
										  	</h3>
											
								 		</div>
								<div class="panel-body"> 
											<a href="editapplycollection.php" class="btn btn-primary">Edit Applying Document</a>
											<br />
											<br />
											<table class="table table-bordered">
												<tr>
											  		
											  		<th>DocType</th>
											  		<th>Order ID</th>
											  		<th>Posting Date</th>
											  		<th>Amount</th>
											  		
				
										  		
										  		</tr>
										  		<?php
										  		
										  		$getOrder = $db->query("SELECT * FROM  selectedledger WHERE receipt_code='$rp' AND locationCode='$locCode' ");
												$ordersCount=mysqli_num_rows($getOrder);
										  		if($ordersCount==0){
										  			echo "<tr><td colspan='5'>You have no order posted yet
													</td></tr>";
										  		}else{
												while($row=$getOrder->fetch_array()){
													$dateOrd=$row['date_ordered'];
													$total=$row['amount'];
													$docType=$row['doctype'];
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
											  		<td class='text-right'>".$row['docNo']."</td>
											  		<td class='text-right'>".$row['postingDate']."</td>
											  		<td class='text-right'>".$row['amount']."</td>
											  		
											  			</tr>
											  		";

										  		}
										  	}	
										  	$_SESSION['totalamt']=$total;
										  		?>
											</table>	
											<div class="form-group  ">
										    <label for="productprice" class="col-sm-3 control-label">Total Retail:</label>
										    	<div class="col-sm-2">
													<div class="input-group">
														<?php
															$result = $db->query("SELECT sum(amount) FROM selectedledger WHERE receipt_code='$rp' AND locationCode='$locCode'");
															while($row2 = $result->fetch_array())
																  {
																     $yy=$row2['sum(amount)'];
																	  
																	  }

														?>
												  		<span class="input-group-addon">Php</span>
												  	<input type="text" class="form-control text-right" name="totalretail" id="rtotal" value="<?php echo number_format($yy); ?>" placeholder="Total" readonly />
													  <span class="input-group-addon">.00</span>
													</div>
										    	</div>
										  	</div>
										  
										  	<div class="form-group pull-right">
			    								<div class="col-sm-offset-2 col-sm-10">
										  		 <a href='collection_list.php' type="submit" name="save" class="btn btn-default btn-lg">Save Changes</a>
										  		</div>
										  	</div>
			  							
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