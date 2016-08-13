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

	
					 <div class="col-xs-12 col-sm-6 col-md-8">	
					 	<div class="panel panel-default" id="panel-header">
							  <!-- Default panel contents -->
							  <div class="panel-heading"><h2> Approved Notification List</h2>
					 	</div>
					 
							  <!-- Table -->
							  <table class="table table-bordered">
							  	<thead>
							  		<th>Document No:</th>
							  		<th>Document Date:</th>
							  		<th>Document Amount</th>
							  		<th>Request Date:</th>
							  		<th>Posted By:</th>
							  		<th>Action</th>
							  	</thead>
							    <?php 
								$product = $db->query("SELECT * FROM approval_request_entry WHERE status=1 ");
									$productCount=mysqli_num_rows($product);
									if($productCount==0){
										echo 
										"<tr><td colspan='9'>You have no approval request posted yet
										</td></tr>
										";
										
									}else{
										while ($row = $product->fetch_assoc()) {
										$sql = $db->query("SELECT username FROM users WHERE user_id ='".$row['userID']."' ");
												while($row1=$sql->fetch_assoc()){
													$username= $row1['username'];
												}
											echo "<tr>
													<td> ".$row['docNo']."</td> 
													<td> ".$row['docDate']."</td> 
													<td> ".$row['docAmt']."</td> 
													<td> ".$row['reqDate']."</td> 
													<td>$username </td> 
													<td><div class='btn-group' role='group' aria-label='...' >
													    <a rel='facebox' href='view_request.php?eid=".$row['entryID']."&&docno=".$row['docNo']."' class='btn btn-default' onclick='alert('what?')'  style='background-color:#36d7b7;'>View Request</a>	
													</div></td> 

													";
												
										}
									}
							     ?>
							  </table>
							</div>
				</div>
			</div>
</div>
<?php require 'includes/overall/overall_footer.php';?>