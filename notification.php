<?php require 'includes/overall/overall_header.php';

unset($_SESSION['cus_no']);
				unset($_SESSION['salesInvoice']);
				unset($_SESSION['dueDate']);
				unset($_SESSION['reqdeldate']);
				unset($_SESSION['promdeldate']);
				unset($_SESSION['payterms']);
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

    #TodayCue{    
    width: 100px;
	height: 100px;
	font-size: 60px;
	padding: 0 0 0 0;
	background-color: #ffcc66;
	color: #ffffff;
   }

    #YesterdayCue{    
    width: 80px;
	height: 80px;
	font-size: 50px;
	padding: 0 0 0 0;
	background-color: #99e6e6;
	color: #ffffff;
   }

    #OlderCue{    
    width: 60px;
	height: 60px;
	font-size: 40px;
	padding: 0 0 0 0;
	background-color: #99ffcc;
	color: #ffffff;
   }   




	<div class='container-fluid'>
			<?php include 'header.php';?>
			<div class="container-fluid">
				<div class="row">
					
						<?php include 'includes/side_menu.php';?>

	
					 <div class="col-xs-12 col-sm-6 col-md-10">	
					 	<div class="panel panel-default" id="panel-header">
							  <!-- Default panel contents -->
							  <div class="panel-heading text-center"><h3>Approval Request</h3>
					 	</div>
					 
							  <!-- Table -->
							  <table class="table table-bordered">
							  	<thead>
							  		<th>Sales Order No.</th>
							  		<th>Document Date</th>
							  		<th class=text-right >Document Amount</th>
							  		<th>Request Date</th>
							  		<th>Posted By</th>
							  		<th width="19%">Action</th>
							  	</thead>
							    <?php 
							     $userID=$_SESSION['id'];
							     	
														$outlet = $db->query("SELECT * FROM approval_setup WHERE approverID='$userID'");
														while ($row1 = $outlet->fetch_assoc()) {
													 
													  $outCode=$row1['outletCode'];
														$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$outCode'");
														while ($row2 = $outlet->fetch_assoc()) {
													  $locCode=$row2['locationID'];
													   $outletCode=$row2['outletDocCode'];
														
														
														}
														
														}
												
								$product = $db->query("SELECT * FROM approval_entry WHERE status=0   GROUP By docNo ");
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
													<td class=text-right> ".$row['docAmt']."</td> 
													<td> ".$row['reqDate']."</td> 
													<td>$username</td> 
													<td><div class='btn-group' role='group' aria-label='...' style='margin-right:-80px;'>
													
													    <a rel='facebox' href='view_approval.php?rp=".$row['docNo']."' class='btn btn-default' onclick='alert('what?')'  style='background-color:#36d7b7;'>View</a>
														<a href='approverequest.php?eid=".$row['entryID']."&docno=".$row['docNo']."' class='btn btn-default ' style='background-color:#f1a9a0;'>Approve</a>
														<a href='rejectrequest.php?eid=".$row['entryID']."&docno=".$row['docNo']."' class='btn btn-danger ' >Reject</a>
														
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
<?php 
/*
</style>
	<div class='container-fluid'>
			<?php include 'header.php';?>
			<div class="container-fluid">
				<div class="row">
				
						<?php include 'includes/side_menu.php';												
					  		$getOrder = $db->query("SELECT DISTINCT(receipt_code) FROM orders WHERE documentType=0 AND status='Open' AND outletCode='$outletCode'");
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
							<td colspan='4'>&nbspApproval Requests</td>	
						</tr>	
							<tr align='center' style='border-style:hidden;' >	
							<td></td>								
							<td><a class='btn btn-default' href='order_list.php?docStatus=Open' id='TodayCue'>".$ordersCount."</a>
							<p class='text-center' style='font-bold;''>Today</p>
							</td>
							<td><a class='btn btn-default' href='returnOrder_list.php' id='YesterdayCue'>".$CMCount."</a>
							<p class='text-center'>Yesterday</p>
							</td>
							<td><a class='btn btn-default' href='returnOrder_list.php' id='OlderCue'>".$CMCount."</a>
							<p class='text-center'>Older</p>
							</td>
							<td>
							</td>	
							<td>
							</td>
							<td>
							</td>	
							</td>
							<td>
							</td>								
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
							<tr><td></td></tr>						
						</table>
					</div>"

						?>
			</div>
			
</div>
/*


*/
?>

<?php require 'includes/overall/overall_footer.php';?>