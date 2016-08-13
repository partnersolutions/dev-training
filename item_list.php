<?php require 'includes/overall/overall_header.php';

unset($_SESSION['cus_no']);
				unset($_SESSION['salesInvoice']);
				unset($_SESSION['dueDate']);
				unset($_SESSION['reqdeldate']);
				unset($_SESSION['promdeldate']);
				unset($_SESSION['payterms']);
?>
<script language="JavaScript"> 

function openDir( form ) { 

	var newIndex = form.fieldname.selectedIndex; 

	if ( newIndex == 0 ) { 

		alert( "Please select a location!" ); 

	} else { 

		cururl = form.fieldname.options[ newIndex ].value; 

		window.location.assign( cururl ); 

	} 

} 

</script> 
	<div class='container-fluid'>
			<?php include 'header.php';?>
			<div class="container-fluid">
				<div class="row">
					
						<?php include 'includes/side_menu.php';?>

					
					 <div class="col-xs-12 col-sm-6 col-md-10">	
					 	<div class="panel panel-default" id="panel-header">
							  <!-- Default panel contents -->
							  <div class="panel-heading">

							  	<p class="text-center" style="color:#b1b0b0;font-size:19px; ">Item List</p>
							  	<form action="item_list.php" method="post" name="form1" class="form-inline pull-right">
							  	<div class="form-group">
											<select name="saleprice" size="1"  class="form-control"> 

													<option disabled selected>Please Select</option>
											 			<?php 
											 			
											 			$outlet = $db->query("SELECT * FROM pricegroup");
															while ($row1 = $outlet->fetch_assoc()) {
																echo "<option value='".$row1['priceGroupCode']."'>".$row1['priceGroupCode']."</option>";
															}
											 			?>

												</select> 

										</div>	
										<div class="form-group ">	
											<div id="search" >
												<input type="search" class="form-control" name="search" Placeholder="Product No/Name"  />
											</div>
											
										</div>
																  		
										<input type="submit" name="sort" value="   Filter   "/>
										
								</form>	
							  	<a class="btn btn-primary"   href="stockOnHand.php" name="add">Stock-on-Hand</a>
					 	</div>
					 
							  <!-- Table -->
							  <table class="table table-bordered">
							  	<thead>
							  		<th>Product ID</th>
							  		<th>Product Name</th>
							  		
							  		<th class='text-right'>Price</th>
							  		<th class='text-center' width='10'>Action</th>
							  		
							  	</thead>
							    <?php 
							    $query="SELECT * FROM products";
							    if(isset($_POST['search'])){
									 $search=$_POST['search'];
									$query ="SELECT * FROM products WHERE product_id LIKE '%$search%' OR product_name  LIKE '%$search%' ";
														   			
																	
									}
								$product = $db->query($query);
									$productCount=mysqli_num_rows($product);
									if($productCount==0){
										echo 
										"<tr><td colspan='9'>You have no order posted in the store yet
										</td></tr>
										";
										
									}else{
										while ($row = $product->fetch_assoc()) {
											if(isset($_POST['saleprice'])){
												 $cd=$_POST['saleprice'];
										
												$getTotal = $db->query("SELECT unitPrice FROM salesprice WHERE salesCode='$cd'");
																					while($row1=$getTotal->fetch_assoc()){
																							$price =$row1['unitPrice'];
																					}
											}else{
												$price=$row['price'];
											}
											echo "<tr>
													<td> ".$row['product_id']."</td> 
													<td> ".$row['product_name']."</td> 
													
													<td class='text-right'>".number_format($row['price'],2)."</td>
													<td><a href='itemledger.php?id=".$row['product_id']."' class='btn btn-warning'>Ledger</a></td> ";
													
												
										}
									}
							     ?>
							  </table>
							</div>

  				 
				</div>
			</div>
			
</div>
<?php require 'includes/overall/overall_footer.php';?>