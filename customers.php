<?php require 'includes/overall/overall_header.php';?>
	<div class='container-fluid'>
			<?php include 'header.php';?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4">
						<?php include 'includes/side_menu.php';?>

					</div>
					 <div class="col-md-8">	
					 	<div class="panel panel-default">
							  <!-- Default panel contents -->
							  <div class="panel-heading"><h2>Customer List</h2>
					 	</div>
					 
							  <!-- Table -->
							  <table class="table table-bordered">
							  	<tr>
							  		<td>Customer No#</td>
							  		<td>Customer Name</td>
							  		<td>Address</td>
							  		<td>Address2</td>
							  		<td>Vat Reg Number</td>
							  		<td>Options</td>
							  	</tr>
							    <?php 
								$product = $db->query("SELECT * FROM customers GROUP BY customer_no");
									$productCount=mysqli_num_rows($product);
									if($productCount==0){
										echo 
										"<tr><td colspan='9'>You have no customer posted in the store yet
										</td></tr>
										";
										
									}else{
										while ($row = $product->fetch_assoc()) {
											echo "<tr>
													<td> ".$row['customer_no']."</td> 
													<td> ".$row['name']."</td> 
													<td> ".$row['address']."</td> 
													<td> ".$row['address2']."</td>
													<td> ".$row['vatRegNo']."</td> 
													<td><a class='btn btn-primary' href='customerledger.php?cusno=".$row['customer_no']."'>Customer Ledger Entry</a></td> ";
			
										}
									}
							     ?>
							  </table>
							</div>

  				 
				</div>
			</div>
			<div class="row">
				<nav class="navbar navbar-default navbar-fixed-bottom">
				  <div class="container">
				    &copy; ALL RIGHTS RESERVED 2015
				  </div>
				</nav>
			</div>
	 </div>
</div>
<?php require 'includes/overall/overall_footer.php';?>