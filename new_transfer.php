<?php require 'includes/overall/overall_header.php';
session_start();
$id = $_GET['id'];
$transfer = $db->query("SELECT * FROM transferorder WHERE entryID='$id'");
while ($row = $transfer->fetch_assoc()) {
	$transord=$row['transorderno'];
	$tranfrmcode=$row['transferfromcode'];
	$tranfrmname=$row['transferfromname'];
	$tranfrmadd=$row['transferfromadd'];
	$tranfrmadd2=$row['transferfromadd2'];
	$trantocode=$row['transfertocode'];
	$trantoname=$row['transfertoname'];
	$trantoadd=$row['transfertoadd2'];
	$transdate=$row['transferorddate'];
	$shipdate=$row['shipmentdate'];
	$recptdate=$row['receiptdate'];
	$orno=$row['extrnaldocno'];
}
?>
<div  class="container-fluid">		
		<div class="row">

					<?php include 'includes/side_menu.php';?>
			<div class="col-md-8">
						<div class="panel panel-default" id="panel-header">
							  <!-- Default panel contents -->
							  <div class="panel-heading"><h1>Transfer Receipt</h1>
									</div>
									<div class="panel-body">
										<form class="form-horizontal" action="saveinvntrytransfr.php" method="post">
													<div class="pull-right">
													 <div class="btn-group" role="group">
										  				<a rel="facebox" href="changeDate.php?id=<?php echo $_GET['id']; ?>" class="btn btn-default" value="Change" style="cursor:pointer;background:#f1a9a0;color:#ffffff;" > Change Date<a/>
										  			 </div>
										  			 <div class="btn-group" role="group">
										  				<input name="save" class="btn btn-default" id="save" type="submit" value="Save" style="cursor:pointer;background:#f1a9a0;color:#ffffff;"   />
										  			 </div>	
										  			  <div class="btn-group" role="group">
										  				<input name="post" class="btn btn-default" id="post" type="submit" value="Post(F11)" style="cursor:pointer;background:#e9d460;color:#ffffff;" />
										  			   </div>
										  			    <div class="btn-group " role="group">	
										  					<input name="pstndprnt" class="btn btn-default" id="pstndprnt" type="submit" value="Post &amp; Print" style="cursor:pointer;background:#e4f1fe;color:#44ac88;"  />
			  											</div>
			  										</div>
			  										<br />
  										<hr />
									<div class="col-md-6">
										<div class="form-group">
									    	<label for="receiptCode" class="col-sm-5 control-label">Transfer Order No:</label>
									    	<div class="col-sm-4">
									      <input type="text" class="form-control" name="transordno" value="<?php echo $transord; ?>" readonly>
									      <input type="hidden" class="form-control" name="docType" value="0"/>
									    </div>
									  </div>
									  <div class="form-group">
									    <label for="customerName" class="col-sm-5 control-label">From Location Code:</label>
									    <div class="col-sm-4">
									      <input type="text" class="form-control" name="fromloca" value="<?php echo $tranfrmcode;?>" readonly>
									    </div>
									  </div>
									  <div class="form-group">
									    <label for="cusAddress" class="col-sm-5 control-label">From Location Name:</label>
									    <div class="col-sm-4">
									      <input type="text" class="form-control" name="fromlocname" value="<?php echo $tranfrmname;?>" readonly>
									    </div>
									  </div>
									  <div class="form-group">
									    <label for="cusAddress2" class="col-sm-5 control-label">From Location Address:</label>
									    <div class="col-sm-4">
									      <textarea class="form-control" name="fromlocadd" readonly><?php echo $tranfrmadd;?></textarea>
									    </div>
									  </div>
									  <div class="form-group">
									    <label for="vatRegNo" class="col-sm-5 control-label">From Location Address 2:</label>
									    <div class="col-sm-4">
									      <textarea class="form-control" name="fromlocadd2" readonly><?php echo $tranfrmadd2;?></textarea>
									    </div>
									  </div>
									   <div class="form-group">
									    <label for="vatRegNo" class="col-sm-5 control-label">To Location Code:</label>
									    <div class="col-sm-4">
									      <input type="text" class="form-control" name="toloccode" value="<?php echo $trantocode;?>" readonly/>
									    </div>
									  </div>
									  <div class="form-group">
									    <label for="vatRegNo" class="col-sm-5 control-label">To Location Name:</label>
									    <div class="col-sm-4">
									      <input type="text" class="form-control" name="tolocname" value="<?php echo $trantoname; ?>" readonly/>
									    </div>
									  </div>
									  <div class="form-group">
									    <label for="vatRegNo" class="col-sm-5 control-label">To Location Address:</label>
									    <div class="col-sm-4">
									      <textarea class="form-control" name="tolocadd" readonly><?php echo $trantoadd; ?></textarea>
									    </div>
									  </div>
									  <div class="form-group">
									    <label for="vatRegNo" class="col-sm-5 control-label">To Location Address 2:</label>
									    <div class="col-sm-4">
									       <textarea class="form-control" name="tolocadd2" readonly><?php echo $trantoadd; ?></textarea>
									    </div>
									  </div>
									</div>	
									<div class="col-md-6">
											<div class="form-group">
											    <label for="vatRegNo" class="col-sm-3 control-label">Order Date:</label>
											    <div class="col-sm-6">
											      <input type="date" class="form-control" name="orddate" value="<?php echo $transdate;?>" readonly/>
											    </div>
											  </div>
											  <div class="form-group">
											    <label for="vatRegNo" class="col-sm-3 control-label">Shipment Date:</label>
											    <div class="col-sm-6">
											      <input type="date" class="form-control" name="shipdate" value="<?php echo $shipdate;?>" readonly/>
											    </div>
											  </div>
											   <div class="form-group">
											    <label for="vatRegNo" class="col-sm-3 control-label">Receipt Date:</label>
											    <div class="col-sm-6">
											      <input type="date" class="form-control" name="rcptdate" value="<?php echo $_SESSION['repDate'];?>" />
											    </div>
											  </div>
											   <div class="form-group">
											    <label for="vatRegNo" class="col-sm-3 control-label">DR No:</label>
											    <div class="col-sm-6">
											      <input type="text" class="form-control" name="orno" value="<?php echo $orno;?>" readonly/>
											    </div>
											  </div>
										</div>
								
									
									</div>
								  <div class="panel panel-default">
							  <!-- Default panel contents -->
							  <div class="panel-heading">Transfer Receipt Line</div>
									<table class="table table-bordered">
										<thead>
									  		<th>Item No.</th>
									  		<th>Description</th>
									  		<th>Quatity</th>
									  		<th>Unit of Measure Code</th>
									  		<th>Quantity to Receive</th>
									  		<th>Action</th>
												
										</thead>
					  				<?php
							  		$gettransfer = $db->query("SELECT * FROM  transferorder WHERE transorderno='$transord' ");
									while ($row = $gettransfer->fetch_array()) {
										echo "<tr>
													<td class='align-left'> ".$row['itemno']."</td> 
													<td class='align-left'> ".$row['itemdesc']."</td> 
													<td class='align-right'> ".number_format($row['qty'],2)."	</td> 
													<td class='align-right'> ".number_format($row['qtyperunitofmeasure'],2)."	</td> 
													<td class='align-right'> ".number_format($row['qtytorcve'],2)."	<input type='hidden' name='qtyrcve' value='".$row['qtytorcve']."'/></td> 
													
													<td><div class='btn-group' role='group' aria-label='...' style='margin-right:-80px;'>
														<a class='btn btn-success' rel='facebox' href='editTransItem.php?id=".$row['entryID']."'>Edit Quantity</a>
													</div>
														
														</td>
														</tr>
													 ";
									}
									?>
								</table>	
								</div> 
						</form>
					</div>
				</div>
		</div>
</div>		
<?php require 'includes/overall/overall_footer.php';?>