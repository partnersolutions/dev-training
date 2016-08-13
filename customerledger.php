<?php require 'includes/overall/overall_header.php';

?>
<body>
	<div class='container-fluid'>
			<?php include 'header.php';?>
			
			<div class="row">
<?php include 'includes/side_menu.php';?>
				<div class="col-xs-12 col-sm-6 col-md-10">
						<div class="panel panel-default">
							  <!-- Default panel contents -->
							  <div class="panel-heading" text-right>
								<p class="text-center" style="color:#b1b0b0;font-size:19px; ">Customer Ledger</p>							  	
							  	</div>
									<table class="table table-bordered table-condensed">
										<thead>
									  		<th width='9%'>Entry No.</th>
									  		<th width='9%'>Document Type</th>
									  		<th width='9%'>Posted Doc. No.</th>
									  		<th width='9%'>Posting Date</th>
									  		<th width='9%'>Customer No.</th>									  				  		
									  		<th width='9%'>Pre-Assigned No.</th>
									  		<th width='9%' class='text-right'>Amount</th>
									  		<th class='text-right' width='9%'>Remaining Amount</th>
									  		<th width='9%'>Open</th>
									  		<th width='9%'>Due Date</th>
									  		<th width='9%'>External Doc No.</th>
		
								  		
								  		</thead>
								  		<?php
								  		$cusno=$_GET['cus_no'];
								  		$getOrder = $db->query("SELECT * FROM customers_ledger WHERE customerID='$cusno' ");
										while($row=$getOrder->fetch_assoc()){
											$docType = $row['documentType'];
											$open = $row['open'];
											$positive = $row['positive'];
											switch ($docType) {
												case '0':
													$docType = "Sales Invoice";
													break;
												case '1':
													$docType = "Sales Credit Memo";
													break;
												case '2':
													$docType = "Payment";
													break;
												case '3':
													$docType = "Refund";
													break;	
												
												default:
												echo "ERROR!";
													break;
											}
											switch ($open) {
												case '0':
													$open = "Closed";
													break;
												case '1':
													$open = "Open";
													break;
												default:
												echo "ERROR!";
													break;
											}
						
											switch ($positive) {
												case '0':
													$positive = "Negative";
													break;
												case '1':
													$positive = "Positive";
													break;
							
												default:
													echo "ERROR!";
													break;
											}
								  			echo "<tr>
									  		<td>".$row['entryID']."</td>
									  		<td>$docType</td>
									  		<td>".$row['sourceEntryID']."</td>
									  		<td>".$row['postingDate']."</td>
									  		<td>".$row['customerID']."</td>									  											  		
									  		<td>".$row['documentNo']."</td>
									  		<td class='text-right'>".number_format($row['amount'],2)."</td>
									  		<td class='text-right'>".number_format($row['remainingAmt'],2)."</td>
									  		<td>$open</td>
									  		<td>".$row['dueDate']."</td>
									  		<td>".$row['externalDocNo']."</td>
									  			</tr>
									  		";

								  		}
								  		

								  		?>
									</table>	
							</div>
				</div>
					 	
						</div>
					</div>
	
	
<?php require 'includes/overall/overall_footer.php';?>