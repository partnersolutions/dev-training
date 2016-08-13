<?php require 'includes/overall/overall_header.php';?>
	<div class='container-fluid'>
			<?php include 'header.php';
				unset($_SESSION['rcpcode']);
				unset($_SESSION['cus_no']);
				unset($_SESSION['salesInvoice']);
				unset($_SESSION['duedate']);
				unset($_SESSION['reqdeldate']);
				unset($_SESSION['promdeldate']);
				unset($_SESSION['payterms']);
				 $user = $db->query("SELECT * FROM users WHERE user_id='$user_id'");
				while ($row = $user->fetch_assoc()) {
				  $u_outlet=$row['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row = $outlet->fetch_assoc()) {
				 $locCode=$row['locationCode'];
				  $DocCode=$row['outletDocCode'];	
				
				}
			}
			//$result = $db->query("SELECT * FROM socode");
			//while($row = $result->fetch_array())
			//		{
			//		      $fefe=$row['code']; 
			//		}
			// $finalcode= $DocCode.'-SO-'.$fefe;
			//$_SESSION['rcpcode']=$finalcode;
			$_SESSION['trans_type']=0;

if(isset($_GET['docStatus'])){
  $docStatus=$_GET['docStatus'];
}
			?>



				<div class="row" >
					
						<?php include 'includes/side_menu.php';?>

					
					 <div class="col-xs-12 col-sm-6 col-md-10">
					
					
					 	<div class="panel panel-default" id="panel-header">
							  <!-- Default panel contents -->
							  <div class="panel-heading" >
							  	<form action="order_list.php" method="post" name="form1" class="form-inline pull-right">
					 			<div class="form-group " id="dateform"  >
															
															<input type="date" class="form-control" name="date1"  />
															
												</div>	
										<input type="submit" name="sort" value="Filter"/>
										<input type="reset" name="reset" value="Reset"/>
										
								</form>	 
							  	<p class="text-center" id="theader"  >Sales Order List</p>
							  	
					 	</div>

							  <!-- Table -->

							  <div class="pull-right">
										<div class="btn-group " role="group">
											<a href="new_order.php" class="btn btn-default" id="tbutton" >New Sales Order</a>
											</div>
								</div>
							
								
							  <table class="table table-bordered table-condensed" cellspacing='0' cellpadding='0' >
							  <thead>
							  	<tr >
							  		<th class='text-left' width='130' >Order No.</th>
						  		    <th class='text-left' width='130'>Order Date</th>		
							  		<th class='text-left' width='70'>Customer No.</th> <!--{%XXX}-->
							  		<th class='text-left' width='250'>Customer Name</th>
							  		<th class='text-right' width='70'>Total Amount</th>
							  		<th class='text-left' width='70'>Payment Terms</th>
							  		<th class='text-left' width='80'>Due Date</th>
							  		<th class='text-left' width='50'>Status</th>
							  		
							  		<th class='text-center' width='165'>Action</th>
							  		
							  	</tr>

							  </thead>	
							
							  	
							    <?php

							    if($docStatus==""){
							     $query1=$db->query("SELECT * FROM orders WHERE documentType=0 AND outletCode='$locCode' GROUP BY receipt_code");
							 	}else{
							 	 $query1=$db->query("SELECT * FROM orders WHERE documentType=0 AND outletCode='$locCode' AND status='$docStatus' GROUP BY receipt_code");							 		
							 	}							 	
							     while($row0=$query1->fetch_assoc()){
							     	$finalcode=$row0['receipt_code'];
							     }
								$error=$_GET['error'];
											if($error=='dupInv'){
											 	echo "<div class='alert alert-danger' role='alert'>
											 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>Sales Invoice No. already exist.</h3>
														
														<br />

													</div>";
											 }
											if($error=='dupCM'){
											 	echo "<div class='alert alert-danger' role='alert'>
											 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>CM No. already exist.</h3>
														
														<br />

													</div>";
											 }					
											 if($error=='docForApproval'){
											 	echo "<div class='alert alert-danger' role='alert'>
											 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>This document has been submitted for approval.</h3>
														
														<br />

													</div>";
											}		
											 if($error=='docRejected'){
											 	echo "<div class='alert alert-danger' role='alert'>
											 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>This document has been rejected.</h3>
														
														<br />

													</div>";													
											 }								
								 if($error=='ovrdue'){
											 	echo "<div class='alert alert-danger' role='alert'>
											 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>This customer still has a balance overdue. Please wait for the approval</h3>
														
														<br />

													</div>";
											 }
 								if($error=='dupinv'){
											 	echo "<div class='alert alert-danger' role='alert'>
											 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>Sales Invoice Number already exist.</h3>
														
														<br />

													</div>";
											 }
							    if($error=='crdlmt'){
											 	 echo "<div class='alert alert-danger' role='alert'>
											 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>This customer has exceeded the Credit Limit. would you like to send an approval?</h3>
														<a href='sendapproval.php?rp=$finalcode' class='btn btn-primary pull-right'>Send Approval Request</a>
														<br />

													</div>";
											 }
								if($error=='asend'){
											 	echo "<div class='alert alert-danger' role='alert'>
											 	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>Approval has already been sent</h3>
														
														<br />

													</div>";
											 }
								 if(isset($_GET['sent'])){
											 	echo "<div class='alert alert-success' role='alert'>
											 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>Approval Request has been successfully sent and this current order has been saved</h3>
														
														<br />

													</div>";
											 }
							    	
					                         
					                          $user_id=$_SESSION['id'];
					                          if(isset($docStatus)){
												$query="SELECT * FROM orders WHERE documentType=0 AND outletCode='$locCode' AND item_id <> ''  AND status='$docStatus' GROUP BY receipt_code DESC $limit";
											  }else{
												$query="SELECT * FROM orders WHERE documentType=0 AND outletCode='$locCode'  GROUP BY receipt_code ASC $limit";											  	
											  }
											
									if(isset($_POST['date1'])){
											 $date1=$_POST['date1'];
											if($docStatus==""){ 
											$query ="SELECT * FROM orders WHERE date_ordered LIKE '%$date1%' AND documentType=0 AND outletCode='$locCode' AND item_id <> '' GROUP BY receipt_code ASC $limit";
											}else{
											$query ="SELECT * FROM orders WHERE date_ordered LIKE '%$date1%' AND documentType=0 AND outletCode='$locCode' AND item_id <> ''  AND status='$docStatus' GROUP BY receipt_code ASC $limit";												
											}
																   			
											}
											$product = $db->query($query);
									$date = date('Y-m-d');
									$productCount=mysqli_num_rows($product);
									if($productCount==0){
										echo 
										"<tr><td colspan='9'>You have no order posted in the store yet
										</td></tr>
										";
										
									}else{
										while ($row = $product->fetch_assoc()) {
										 $dd=$row['dueDate'];
										 $finalcode=$row['receipt_code'];
										 $status=$row['status'];
										
										
											$result = $db->query("SELECT sum(total) FROM orders WHERE  receipt_code='$finalcode' AND  outletCode='$locCode'   ");
												while($row2 = $result->fetch_array())
													  {
													     $yy=$row2['sum(total)'];
														  
														  }
											if($status=='For Approval'){
											$status = 'disabled=disabled';
											$ds = 'disabled=disabled';
											}elseif($yy==0){
												$status = 'disabled=disabled';
											}				  
											echo "<tr>
													<td class='align-left'> ".$row['receipt_code']."</td> 
													<td class='align-left'> ".$row['date_ordered']."	</td> 													
													<td class='align-left'> ".$row['customer_no']."</td>  
													<td class='align-left'> ".$row['customer_name']."</td> 
													<td class='text-right'> ".number_format($yy,2)."</td> 
													<td> ".$row['paymentTermCode']." </td> 
													<td class='align-left'> ".$row['dueDate']."	</td> 												
													<td> ".$row['status']." </td> 
													<td><div class='btn-group' role='group' aria-label='...' >
													
													   <a href='new_order.php?rp=".$row['receipt_code']."' class='btn btn-default' style='background-color:#36d7b7;' $ds>Edit</a>														
														<a class='btn btn-danger' href='delete_orders.php?id=".$row['receipt_code']."' onclick=\"return confirm('Are you sure you want to delete this order?')\" $status>Delete</a>
													</div>
														
														</td>
														</tr>
													 ";
												
										}
									}
									//<a href='addorderparse.php?rp=".$row['receipt_code']."&&cmd=POST' class='btn btn-default ' style='background-color:#f1a9a0;'$status>Post</a>
							     ?>
							  </table>

							</div>
							</div>
					 </div>
			</div>
	</div>
	<script type="text/javascript">
   
	</script>
<?php require 'includes/overall/overall_footer.php';?>