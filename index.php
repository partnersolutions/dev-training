<?php require 'includes/overall/overall_header.php';

unset($_SESSION['cus_no']);
				unset($_SESSION['salesInvoice']);
				unset($_SESSION['dueDate']);
				unset($_SESSION['reqdeldate']);
				unset($_SESSION['promdeldate']);
				unset($_SESSION['payterms']);
					$id=$_SESSION['id'];
					 		$sql = $db->query("SELECT * FROM users WHERE user_id ='$id' ");
								while($row=$sql->fetch_assoc()){
									$access = $row['access'];
								}
if($access==0){
								header("location:users_list.php");
							}elseif($access==1){
								header("location:notification.php");
							}else{
								//header("location:index.php");
							}

$outletCode = $_SESSION['outletCode'];

?>
<style type="text/css">
	  *{
   	margin: 0;
   	padding: 0;
   }
   p{
   font-size: 0.875em;
   
   } 
    #dashboardlinksales{    
    width: 80px;
	height: 80px;
	font-size: 50px;
	padding: 0 0 0 0;
	background-color: #0066cc;
	color: #ffffff;
   }

    #dashboardlinktransfer{    
    width: 80px;
	height: 80px;
	font-size: 50px;
	padding: 0 0 0 0;
	background-color: #9999ff;
	color: #ffffff;
   }   

      #dashboardlinkapproval{    
    width: 80px;
	height: 80px;
	font-size: 50px;
	padding: 0 0 0 0;
	background-color: #3399ff;
	color: #ffffff;
   }  

         #dashboardlinkapprovala{    
    width: 80px;
	height: 80px;
	font-size: 50px;
	padding: 0 0 0 0;
	background-color: #9fdfbf;
	color: #ffffff;
   }  

         #dashboardlinkapprovalr{    
    width: 80px;
	height: 80px;
	font-size: 50px;
	padding: 0 0 0 0;
	background-color: #ff9999;
	color: #ffffff;
   }  

</style>
	<div class='container-fluid'>
			<?php include 'header.php';?>
			<div class="container-fluid">
				<div class="row">
				
						<?php include 'includes/side_menu.php';												
					  		$getOrder = $db->query("SELECT DISTINCT(receipt_code) FROM orders WHERE documentType=0 AND status='Open' AND outletCode='$outletCode' And item_id <> '' ");
							$ordersCount=mysqli_num_rows($getOrder);					  		

					  		$getOrder = $db->query("SELECT DISTINCT(receipt_code) FROM orders WHERE documentType=1 AND outletCode='$outletCode'");					  		
							$CMCount=mysqli_num_rows($getOrder);			

					  		$getOrder = $db->query("SELECT DISTINCT(receipt_code) FROM orders WHERE documentType=0 AND status='For Approval' AND outletCode='$outletCode'");
							$FAordersCount=mysqli_num_rows($getOrder);	

					  		$getOrder = $db->query("SELECT DISTINCT(receipt_code) FROM orders WHERE documentType=0 AND status='Approved' AND outletCode='$outletCode'");
							$APordersCount=mysqli_num_rows($getOrder);	

					  		$getOrder = $db->query("SELECT DISTINCT(receipt_code) FROM orders WHERE documentType=0 AND status='Rejected' AND outletCode='$outletCode'");
							$RJordersCount=mysqli_num_rows($getOrder);	

							$getOrder = $db->query("SELECT DISTINCT(transorderno) FROM transferorder WHERE documentType=0  AND transfertocode='$outletCode'");
							$TRCount=mysqli_num_rows($getOrder);						

					  		$getOrder = $db->query("SELECT DISTINCT(transorderno) FROM transferorder WHERE documentType=1 AND transferfromcode='$outletCode'");
							$TSCount=mysqli_num_rows($getOrder);														  																	
					echo "
					<div class='col-xs-12 col-sm-6 col-md-8'>
						<div class='panel panel-default' style='border:0px;'>							  
							 	 <div class='panel-heading'><h4 class='text-center'>Role Center</h4>
					 			</div>					 			
						<table class='table table-condensed' >							
							<tr align='center' style='border-style:hidden;' >
							<td colspan='3'>&nbsp Sales</td>	
							<td colspan='9'>&nbsp Transfer</td>	
						</tr>	
							<tr align='center' style='border-style:hidden;' >	
							<td></td>								
							<td><a class='btn btn-default' href='order_list.php?docStatus=Open' id='dashboardlinksales'>".$ordersCount."</a>
							<p class='text-center' style='font-bold;''>Sales Order</p>
							</td>
							<td><a class='btn btn-default' href='returnOrder_list.php' id='dashboardlinksales'>".$CMCount."</a>
							<p class='text-center'>Sales Return</p>
							</td>
							<td>
							</td>
							<td>
							</td>	
							<td>
							</td>
							<td>
							</td>	
							<td><a class='btn btn-default' href='transfer_ship_list.php' id='dashboardlinktransfer'>".$TSCount."</a>
							<p class='text-center' style='font-bold;''>Transfer Shipment</p>
							</td>
							<td><a class='btn btn-default' href='transfer_list.php' id='dashboardlinktransfer'>".$TRCount."</a>
							<p class='text-center'>Transfer Receipt</p>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
							<tr><td></td></tr>						
						</tr>	
							<tr align='center' style='border-style:hidden;' >
							<td colspan='3'>&nbsp Approval Status</td>	
							<td colspan='9'>&nbsp </td>	
						</tr>							
						<tr align='center' style='border-style:hidden;' >	
							<td></td>								
							<td><a class='btn btn-default' href='order_list.php?docStatus=For Approval' id='dashboardlinkapproval'>".$FAordersCount."</a>
							<p class='text-center' style='font-bold;''>For Approval</p>
							</td>
							<td>
							</td>
							<td>
							</td>
							<td>
							</td>	
							<td>
							</td>
							<td>
							</td>	
							<td>
							</td>
							<td></td>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
						</tr>	
													<tr align='center' style='border-style:hidden;' >	
							<td></td>								
							<td><a class='btn btn-default' href='order_list.php?docStatus=Approved' id='dashboardlinkapprovala'>".$APordersCount."</a>
							<p class='text-center' style='font-bold;''>Approved</p>
							</td>
							<td><a class='btn btn-default' href='order_list.php?docStatus=Rejected' id='dashboardlinkapprovalr'>".$RJordersCount."</a>
							<p class='text-center' style='font-bold;''>Rejected</p>							
							<td>
							</td>
							<td>
							</td>
							<td>
							</td>	
							<td>
							</td>
							<td>
							</td>	
							<td>
							</td>
							<td></td>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
						</tr>		
						</table>
					</div>"

						?>


						<!--
							<div class='panel panel-default' id='panel-header'>
							  
							 	 <div class='panel-heading'><h3 class='text-center'>Order List</h3>
					 			</div>
								<table class='table table-bordered'>
							  	<tr>
							  		<th>Order ID</th>
							  		<th>Recipient</th>
							  		<th>Item Description</th>
							  		<th>Date</th>
							  		<th>Total</th>
							  	</tr>
									 	<?php /*
									 	$table = $db->query("SELECT * FROM orders WHERE documentType=0 AND outletCode='$locCode' GROUP BY receipt_code");
													$tableCount=mysqli_num_rows($table);
													if($tableCount==0){
														echo 
														"<tr><td colspan='9'>You have no order posted in the store yet
														</td></tr>
														";
														
													}else{
														while ($row = $table->fetch_assoc()) {
															echo "<tr>
																	<td> ".$row['receipt_code']."</td> 
																	<td> ".$row['customer_name']."</td> 
																	<td> ".$row['item_description']."</td> 
																	<td> ".$row['date_ordered']."</td> 
																	<td> ".$row['total']."</td> 

																	</tr>
																";
																
														}
													
													}
								 	?>
					 	
									</table>
							</div>

						<div class='panel panel-default' id='panel-header'>
							  
							 	 <div class='panel-heading'><h3 class='text-center'>RETURN Order List</h3>
					 			</div>
								<table class='table table-bordered'>
							  	<tr>
							  		<th>Order ID</th>
							  		<th>Recipient</th>
							  		<th>Item Description</th>
							  		<th>Date</th>
							  		<th>Total</th>
							  	</tr>
					 	<?php 
					 	
								$table = $db->query("SELECT * FROM orders WHERE documentType=1 AND outletCode='$locCode' GROUP BY receipt_code");
									$tableCount=mysqli_num_rows($table);
									if($tableCount==0){
										echo 
										"<tr><td colspan='9'>You have no order posted in the store yet
										</td></tr>
										";
										
									}else{
										while ($row = $table->fetch_assoc()) {
											echo "<tr>
													<td> ".$row['receipt_code']."</td> 
													<td> ".$row['customer_name']."</td> 
													<td> ".$row['item_description']."</td> 
													<td> ".$row['date_ordered']."</td> 
													<td> ".$row['total']."</td> 

													</tr>
												";
												
										}
									}
						
					 	?>
					 	</table>
					</div>
						<div class='panel panel-default' id='panel-header'>
							  
							 	 <div class='panel-heading'><h3 class='text-center'>Transfer Receipt</h3>
					 			</div>
								<table class='table table-bordered'>
							  	 <thead>
							  	
							  		<th class='text-left' >Transfer Order ID</th>
							  		<th class='text-left' >Order Date</th>
							  		<th class='text-left' >Shipment Date</th>
							  		<th class='text-left' >From Location Code</th>
							  		<th class='text-right'>To Location Code</th>
							  		<th class='text-left' >OR No.</th>
							  		<th class='text-center'>Action</th>
							  		
							 

							  </thead>	
					 	<?php 
					 	
								$transfer = $db->query($query="SELECT * FROM transferorder WHERE docType=0 AND transfertocode='$locCode'  GROUP BY transorderno ASC $limit");
$productCount=mysqli_num_rows($transfer);
									if($productCount==0){
										echo 
										"<tr><td colspan='9'>You have no transfer posted in the store yet
										</td></tr>
										";
										
									}else{
										while ($row = $transfer->fetch_assoc()) {
										 $dd=$row['dueDate'];
										
								
											echo "<tr>
													<td class='align-left'> ".$row['transorderno']."</td> 
													<td class='align-left'> ".$row['transferorddate']."</td> 
													<td class='align-left'> ".$row['shipmentdate']."	</td> 
													<td class='align-left'> ".$row['transferfromcode']."	</td> 
													<td class='align-left'> ".$row['transfertocode']."	</td> 
													<td class='align-left'> ".$row['extrnaldocno']."	</td> 
													
													<td><div class='btn-group' role='group' aria-label='...' style='margin-right:-80px;'>
														<a class='btn btn-success' href='new_transfer.php?id=".$row['entryID']."'>Receive</a>
													</div>
														
														</td>
														</tr>
													 ";
												
										}
									}
					 	?>
					 	</table>
					</div>
					<div class='panel panel-default' id='panel-header'>
							  
							 	 <div class='panel-heading'><h3 class='text-center'>Transfer Shipment</h3>
					 			</div>
								<table class='table table-bordered'>
							  	 <thead>
							  	
							  		<th class='text-left' >Transfer Order ID</th>
							  		<th class='text-left' >Order Date</th>
							  		<th class='text-left' >Shipment Date</th>
							  		<th class='text-left' >From Location Code</th>
							  		<th class='text-right'>To Location Code</th>
							  		<th class='text-left' >OR No.</th>
							  		<th class='text-center'>Action</th>
							  		
							 

							  </thead>	
					 	<?php 
					 	
								$transfer = $db->query($query="SELECT * FROM transferorder WHERE docType=0 AND transfertocode='$locCode'  GROUP BY transorderno ASC $limit");
$productCount=mysqli_num_rows($transfer);
									if($productCount==0){
										echo 
										"<tr><td colspan='9'>You have no transfer posted in the store yet
										</td></tr>
										";
										
									}else{
										while ($row = $transfer->fetch_assoc()) {
										 $dd=$row['dueDate'];
										
								
											echo "<tr>
													<td class='align-left'> ".$row['transorderno']."</td> 
													<td class='align-left'> ".$row['transferorddate']."</td> 
													<td class='align-left'> ".$row['shipmentdate']."	</td> 
													<td class='align-left'> ".$row['transferfromcode']."	</td> 
													<td class='align-left'> ".$row['transfertocode']."	</td> 
													<td class='align-left'> ".$row['extrnaldocno']."	</td> 
													
													<td><div class='btn-group' role='group' aria-label='...' style='margin-right:-80px;'>
														<a class='btn btn-success' href='new_transfer.php?id=".$row['entryID']."'>Receive</a>
													</div>
														
														</td>
														</tr>
													 ";
												
										}
									}*/
					 	?>
					 	</table>
					</div>	-->
			</div>
			
</div>
<?php require 'includes/overall/overall_footer.php';?>