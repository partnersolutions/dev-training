<?php require 'includes/overall/overall_header.php';

?>
<body>
	<div class='container-fluid'>
			<?php include 'header.php';?>
			
			<div class="row">
<?php include 'includes/side_menu.php';?>
				<div class="col-md-8">
						<div class="panel panel-default">
							  <!-- Default panel contents -->
							  <div class="panel-heading">
							  	<h3 class="page-header text-center">Item Ledger	</h3>
							  	</div>
									<table class="table table-bordered table-condensed">
										<thead>
									  		
									  		<th>Source ID</th>
									  		<th>Posting Date</th>
									  		<th>Document Type</th>
									  		<th>Document No#</th>
									  		<th>Quantity</th>
									  		<th>Open</th>
									  		<th>Due Date</th>
									  		<th>Positive</th>
									  		<th>Document Date</th>
									  		<th>External Doc No#</th>
		
								  		
								  		</thead>
								  		<?php
								  		$sourceID=$_GET['id'];
								  		$getOrder = $db->query("SELECT * FROM item_ledger WHERE sourceEntryID='$sourceID' ");
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
													$docType = "Transfer Receipt";
													break;
												case '3':
													$docType = "Transfer Shipment";
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
									  		
									  		<td>".$row['sourceEntryID']."</td>
									  		<td>".$row['postingDate']."</td>
									  		<td>$docType</td>
									  		<td>".$row['documentNo']."</td>
									  		<td class='text-right'>".number_format($row['qty'],2)."</td>
									  		<td>$open</td>
									  		<td>".$row['dueDate']."</td>
									  		<td>$positive</td>
									  		<td>".$row['documentDate']."</td>
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