<?php require 'includes/overall/overall_header.php';

unset($_SESSION['cus_no']);
				unset($_SESSION['salesInvoice']);
				unset($_SESSION['dueDate']);
				unset($_SESSION['reqdeldate']);
				unset($_SESSION['promdeldate']);
				unset($_SESSION['payterms']);
?>
	<div class='container-fluid'>
			<?php include 'header.php';?>
			<div class="container-fluid">
				<div class="row">
					
						<?php include 'includes/side_menu.php';?>

				
					 <div class="col-xs-12 col-sm-6 col-md-10">	
					 	<div class="panel panel-default" id="panel-header">
							  <!-- Default panel contents -->
							  <div class="panel-heading">
							  		<form action="customer_list.php" method="post" name="form1" class="form-inline pull-right">	
										<div class="form-group ">	
											<div id="search" >
												<input type="search" class="form-control" name="search"  required />
											</div>
											
										</div>
																  		
										<input type="submit" name="sort" value="   Filter   "/>
										
								</form>			
							  	<p class="text-center" style="color:#b1b0b0;font-size:19px; ">Customer List</p>
					 	</div>
					 
							  <!-- Table -->
							  <table class="table table-bordered">
							  	<thead>
							  		<th>Customer No.</th>
							  		<th>Name</th>
							  		<th width='220'>Address</th>
							  		<th width='220'>Address 2</th>
							  		<th width='220'>Payment Terms</th>
							  		<th width='80' class="text-right">Credit Limit</th>
							  		<th class='text-right'>Balance</th>
							  		<th class='text-center' width='40'>Action</th>
							  		
							  	</thead>
							    <?php 
							    $query="SELECT * FROM customers ";
							    if(isset($_POST['search'])){
									 $search=$_POST['search'];
									$query ="SELECT * FROM customers WHERE customer_no LIKE '%$search%' OR name  LIKE '%$search%' ";
														   			
									}
								$customer = $db->query($query);
									$customerCount=mysqli_num_rows($customer);
									if($customerCount==0){
										echo 
										"<tr><td colspan='9'>0 Results
										</td></tr>
										";
										
									}else{
										while ($row = $customer->fetch_assoc()) {
											$getTotal = $db->query("SELECT SUM(amount) FROM customers_ledger WHERE customerID= '".$row['customer_no']."' ");
																					while($row1=$getTotal->fetch_assoc()){
																							$yy =$row1['SUM(amount)'];
																					}
											echo "<tr>
													<td > ".$row['customer_no']."</td> 
													<td> ".$row['name']."</td> 
													<td> ".$row['address']."</td> 
													<td> ".$row['address2']."</td>
													<td> ".$row['payment_terms']."</td> 
													<td class='text-right'> ".number_format($row['credit_limit'],2)."</td>
													<td class='text-right'>".number_format($yy,2)."</td> 
													<td><a href='customerledger.php?cus_no=".$row['customer_no']."' class='btn btn-warning'>Ledger</a></td> ";
												
										}
									}
							     ?>
							  </table>
							</div>

  				 
				</div>
			</div>
			
</div>
<?php require 'includes/overall/overall_footer.php';?>