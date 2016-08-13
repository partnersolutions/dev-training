<?php require 'includes/overall/overall_header.php';
$rcpcode=$_SESSION['rp'];
$cus_no=$_SESSION['cus_no'];
$salesInvo=$_SESSION['ornum'];
$totalAmount=$_SESSION['totalamt'];
$paymethod=$_SESSION['pmethod'];
$checkNum=$_SESSION['chkno'];
$rmrks=$_SESSION['remrks'];
$CurrUSERID=$_SESSION['user'];

$user = $db->query("SELECT * FROM users WHERE user_id='$user_id'");
				while ($row = $user->fetch_assoc()) {
				  $u_outlet=$row['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row = $outlet->fetch_assoc()) {
				 $locCode=$row['locationCode'];	
				
				}
			}
						  		
?>
<script type="text/javascript">

function checkBalance() {
    a=Number(document.form1.total.value);
    numbrrow=document.form1.numrow.value; 
      //if(document.form1.checkbox[0].checked=true){
        //alert("Checked");  
  //  }
        for (i = 0; i < numbrrow; i++) {
        text += "The number is " + i + "<br>";
    }
    document.getElementById("demo").innerHTML = text;
    
}
function multiply(){
//compute for price
    a=Number(document.form1.total.value);

    b=Number(document.form1.stotal.value);
    
    if (a>0){
      c=a-b;
        d=c.toFixed(2);
        document.form1.ramt.value=d; 

    }
  	 if (document.form1.stotal.value== 0 || document.form1.stotal.value== "" ) // some logic to determine if it is ok to go
        {
          
          document.getElementById("save").disabled = true;
          document.getElementById("post").disabled = true;
          document.getElementById("pstndprnt").disabled = true;
        }else{
        	document.getElementById("save").disabled = false;
          document.getElementById("post").disabled = false;
          document.getElementById("pstndprnt").disabled = false;
        }
     
    }
    
  </script>
<body onload="multiply()">
	<div class='container-fluid'>
			<?php include 'header.php';?>
				<div class="row">
<?php include 'includes/side_menu.php';?>
					 <div class="col-md-10">
					
					
					 	<div class="panel panel-default" id="panelSalesheader" >
							  <!-- Default panel contents -->
							  <div class="panel-heading" >
							  	<h4 class="text-center">Collection Receipt</h4>
							  	<?php
									 
									?>
									</div>
							<div class="panel-body">
							  
								<form class="form-horizontal" action="savecollection_parse.php" name="form1" method="post" onsubmit="autoScrollTo()">
									
									<div class="pull-right">
										<div class="btn-group " role="group">
											<a rel="facebox" href="inputCustomer_collection.php" class="btn btn-default" id="searchcus" style="background:#dcc6e0;color:#ffffff;">Select Customer Here (F6)</a>
											</div>
										<?php 
										if(isset($cus_no)){	
										//if($cus_no!=''){
							  			 echo "<div class='btn-group' role='group'>
							  				<input name='save' class='btn btn-default' id='save' type='submit' value='Save' style='cursor:pointer;background:#f1a9a0;color:#ffffff;' />
							  			 </div>	
							  			  <div class='btn-group' role='group'>
							  				<input name='post' class='btn btn-default' id='post' type='submit' value='Post (F11)' style='cursor:pointer;background:#e9d460;color:#ffffff;' />
							  			   </div>
							  			    <div class='btn-group ' role='group'>	
							  					<input name='pstndprnt' class='btn btn-default' id='pstndprnt' type='submit' value='Post &amp; Print' style='cursor:pointer;background:#e4f1fe;color:#44ac88;'  />
  											</div>";
  										}else{
  												echo "<div class='btn-group' role='group'>
							  				<input name='save' class='btn btn-default' id='save' type='submit' value='Save' style='cursor:pointer;background:#f1a9a0;color:#ffffff;' disabled />
							  			 </div>	
							  			  <div class='btn-group' role='group'>
							  				<input name='post' class='btn btn-default' id='post' type='submit' value='Post (F11)' style='cursor:pointer;background:#e9d460;color:#ffffff;' disabled />
							  			   </div>
							  			    <div class='btn-group ' role='group'>	
							  					<input name='pstndprnt' class='btn btn-default' id='pstndprnt' type='submit' value='Post &amp; Print' style='cursor:pointer;background:#e4f1fe;color:#44ac88;' disabled  />
  											</div>";
  											}?>
  										</div>
  										<br />
											<hr />
											 <?php 
											 
												$error=$_GET['error'];

											if($error=='dupInv'){
											 	echo "<div class='alert alert-danger' role='alert'>
											 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>OR No. already exist, Please change it before posting.</h3>
														
														<br />

													</div>";
											}																							
											 
											 $sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id' ");
												while($row=$sql->fetch_assoc()){
													$access = $row['access'];
										  			 $u_outlet=$row['outlet'];	
														$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
														while ($row1 = $outlet->fetch_assoc()) {
													 $locCode=$row1['locationCode'];
													 $outDocCode=$row1['outletDocCode'];	
														
														}
												}
													 
											/*if(isset($rcpcode)){
												$customer = $db->query("SELECT * FROM customers WHERE customer_no = '$cus_no' LIMIT 1 ");
																		$customerCount=mysqli_num_rows($customer);
														if($customerCount==0){
															echo 
															"<div class='well'>No customer selected</div>";
															
														}else{
														while ($row = $customer->fetch_assoc()) {
															$outlet=$row['outlet'];
															$priceVat=$row['priceVat'];
															 $priceGroup=$row['cusPriceGroup'];

														switch ($priceVat) {
															case '1':
																$priceVat = 'WTH VAT';
																break;
															
															default:
																$priceVat = 'WTHOUT VAT';
																break;
																}
													
														echo "
															
															<div class='col-md-6' >
																	<div class='form-group' style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left' style='position:relative;'>Document No. . . . .  </label>
																	    <div class='col-sm-5'>
																	    	<div class='input-group'>
																	      		<input type='text' class='form-control' name='rpcode' size='30'   value='$rcpcode' readonly />
																	    	</div>
																	 	</div>
																	 </div>
																	 <div class='form-group' style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left'  style='position:relative;'>Customer No. . . . . . </label>
																	    <div class='col-sm-5'>
																	    	<div class='input-group'>
																	     		 <input type='text' class='form-control' name='customer_no' size='30'   value='".$row['customer_no']."' readonly />
																	   		 </div>
																		 </div>
																	 </div>
																	 <div class='form-group'style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left'  style='position:relative;'>Name . . . . . . . . . . .  </label>
																	    <div class='col-sm-5'>
																	     		 <div class='input-group'>
																	      			<input type='text' class='form-control' name='customer_name' size='30'  value='".$row['name']."' readonly />
																	   			 </div>
																	 		</div>
																	 </div>
																</div>
														<div class='col-md-6'>
																	 <div class='form-group'>
																    	<label class='col-sm-4 col-form-label'>Posted Date .. . . . . . </label>
																    	<div class='col-sm-5'>
																    			<div class='input-group'>
																    				<input name='date' type='text' class='form-control' value=' $da' size='21' readonly /> 
																    			</div>
																    		</div>
																    	</div>
																    	<div class='form-group' style='margin-bottom:8px;'>
															    	<label for='productdetail' class='col-sm-4 control-label text-left'>OR No. . . . . . . . . . . .</label>
																    		<div class='col-sm-5'>
																    			<div class='input-group'>
																    	  			<input type='text' class='form-control' name='exdoccode' id='exdoccode' size='21'   value='$salesInvo' required />
																   			 	</div>
																 		</div>
																 	</div>

																 	  <div class='form-group'>
															    			<label class='col-sm-4 col-form-label'>Total Amount . . . . . </label>
															    				<div class='col-sm-5'>
															    				<div class='input-group'>
															    					<input name='total' id='total' class='text-right form-control' type='text' size='25' value='".number_format($totalAmount,2)."' /> 
															    					<input type='hidden' name='posted_by' value= $user_id'>
															    					</div>
															    					
															    			</div>
															    		</div>
																	  <div class='form-group'>
															    			<label class='col-sm-4 col-form-label'>Rem. Amt. to Apply</label>
															    				<div class='col-sm-5'>
															    				<div class='input-group'>
															    					<input name='ramt' id='ramt' class='text-right form-control' type='text' /> 
															    					<input type='hidden' name='posted_by' value='$user_id'>
															    					</div>	
															    			</div>
															    		</div>
															    		<div class='form-group'>
															    			<label class='col-sm-4 col-form-label'>Payment Method . .</label>
															    				<div class='col-sm-5'>
															    				<div class='input-group'>
															    				
															    				<input name='paymet' class='text-right form-control' type='text' value='$paymethod' /> 
															    					
															    					</div>	
															    			</div>
															    		</div>
															    		<div class='form-group'>
															    			<label class='col-sm-4 col-form-label'>Check No. . . . . . . . .</label>
															    				<div class='col-sm-5'>
															    				<div class='input-group'>
															    					<input name='remarks' class='text-right form-control' type='text' value='$checkNum' /> 
															    					
															    					</div>	
															    			</div>
															    		</div>
															    		<div class='form-group'>
															    			<label class='col-sm-4 col-form-label'>Remarks . . . . . . . . . </label>
															    				<div class='col-sm-5'>
															    				<div class='input-group'>
															    					<input name='remarks' class='text-right form-control' type='text' value='$rmrks' /> 
															    					
															    					</div>	
															    			</div>
															    		</div>

																</div>
															 ";		
														}
												}

											}elseif(isset($_GET['rp'])){
											*/
											if(isset($_GET['rp'])){
												$rcpcode=$_GET['rp'];
											}												 
											$collection = $db->query("SELECT * FROM collection_journ WHERE receipt_code='$rcpcode' AND doctype=2 GROUP BY receipt_code");
											$collectionCount=mysqli_num_rows($collection);
											if($collectionCount==0){
												echo 
												"<div class='well'>No customer selected</div>";														
											}else{
											while ($row = $collection->fetch_assoc()) {
												$outlet=$row['outlet'];
												$priceVat=$row['priceVat'];
												 $priceGroup=$row['cusPriceGroup'];
												 $customer_no=$row['customerID'];
												 $customer_name=$row['customer_name'];
												 $da=$row['postingDate'];
												 	$totalAmount=$row['amount'];
													$paymethod=$row['payment_method'];
													$checkNum=$row['check_no'];
													$rmrks=$row['remarks'];
													$salesInvo=$row['externalDocNo'];
											switch ($priceVat) {
												case '1':
													$priceVat = 'Yes';
													break;
												
												default:
													$priceVat = 'No';
													break;
													}

											$collectionBal = $db->query("SELECT SUM(amount) FROM collection_journ WHERE receipt_code='$rcpcode' GROUP BY receipt_code");		
											while($rowBal0=$collectionBal->fetch_assoc()){
													 $CRBal =$rowBal0['SUM(amount)'];
											}												
											echo "
												
												<div class='col-md-6' >
														<div class='form-group' style='margin-bottom:8px;' >
														    <label for='rpcode' class='col-sm-4 col-form-label text-left' style='position:relative;'>Coll. Rcpt.  No. . . . </label>
														    <div class='col-sm-5'>
														    	<div class='input-group'>
														      		<input type='text' class='form-control' name='rpcode' size='30'   value='$rcpcode' readonly />
														    	</div>
														 	</div>
														 </div>
														 <div class='form-group' style='margin-bottom:8px;' >
														    <label for='rpcode' class='col-sm-4 col-form-label text-left'  style='position:relative;'>Customer No. . . . .</label>
														    <div class='col-sm-5'>
														    	<div class='input-group'>
														     		 <input type='text' class='form-control' name='customer_no' size='30'   value='$customer_no' readonly />
														   		 </div>
															 </div>
														 </div>
														 <div class='form-group'style='margin-bottom:8px;' >
														    <label for='rpcode' class='col-sm-4 col-form-label text-left'  style='position:relative;'> Name . . . . . . . . . .</label>
														    <div class='col-sm-5'>
														     		 <div class='input-group'>
														      			<input type='text' class='form-control' name='customer_name' size='30'  value=' $customer_name' readonly />
														   			 </div>
														 		</div>
														 </div>
												    		<div class='form-group'>
												    			<label class='col-sm-4 col-form-label'>Remarks . . . . . . . .</label>
												    				<div class='col-sm-5'>
												    				<div class='input-group'>
												    					<input name='remarks' class='text-right form-control' type='text' value='$rmrks' /> 
												    					
												    					</div>	
												    			</div>
												    		</div>

													</div>
											<div class='col-md-6'>			
														 <div class='form-group'>
													    	<label class='col-sm-4 col-form-label'>Document Date  . .</label>
													    	<div class='col-sm-5'>
													    			<div class='input-group'>
													    				<input name='date' type='text' class='form-control' value='$da' size='21' readonly /> 
													    			</div>
													    		</div>
													    	</div>
												    		<div class='form-group'>
												    			<label class='col-sm-4 col-form-label'>Payment Method</label>
												    				<div class='col-sm-5'>
												    				<div class='input-group'>
												    				
												    				<input name='paymet' class='text-right form-control' type='text' value='$paymethod' /> 
												    					
												    					</div>	
												    			</div>
												    		</div>

													    	<div class='form-group' style='margin-bottom:8px;'>
												    	<label for='productdetail' class='col-sm-4 col-form-label text-left'>OR No. . . . . . . . . .</label>
													    		<div class='col-sm-5'>
													    			<div class='input-group'>
													    	  			<input type='text' class='form-control' name='exdoccode' id='exdoccode' size='21'   value='$salesInvo' required />
													   			 	</div>
													 		</div>
													 	</div>
												    		<div class='form-group'>
												    			<label class='col-sm-4 col-form-label'>Check No. . . . . . . .</label>
												    				<div class='col-sm-5'>
												    				<div class='input-group'>
												    					<input name='remarks' class='text-right form-control' type='text' value='$checkNum' /> 
												    					
												    					</div>	
												    			</div>
												    		</div>
													 	  <div class='form-group'>
												    			<label class='col-sm-4 col-form-label'>Total Amount . . . .</label>
												    				<div class='col-sm-5'>
												    				<div class='input-group'>
												    					<input name='total' id='total' class='text-right form-control' type='text' size='25' value='".number_format($totalAmount,2)."' /> 
												    					</div>
												    					
												    			</div>
												    		</div>
														  <div class='form-group'>
												    			<label class='col-sm-4 col-form-label'>Rem. Amt. to Apply</label>
												    				<div class='col-sm-5'>
												    				<div class='input-group'>
												    					<input name='ramt' id='ramt' class='text-right form-control' type='text' value='".number_format($CRBal,2)."'/> 
												    					</div>	
												    			</div>
												    		</div>
													</div>

												 ";		
										}
												//}
											}
														

												?>
											</div>
							<div class="panel panel-default">
							  <!-- Default panel contents -->
							  <div class="panel-heading".>
							  	<?php 
							  	if(isset($cus_no)){
							  		echo "<a href='addtoledger.php' id='searchitem' class='btn btn-primary pull-right'>Apply Document (F12)</a><br /><br />";
							  		}else{
							  		echo "<a href='addtoledger.php' class='btn btn-primary pull-right' id='searchitem' disabled>Apply Document (F12)</a><br /><br />";	
							  		}
							 	?>
							  </div>	

							 <table class="table table-bordered">
									<tr>
								  		<th width='15%'>Document Type</th>
								  		<th width='15%'>PSI/PCM No.</th>
								  		<th width='15%'>SI/CM No.</th>
								  		<th width='15%'>Posting Date</th>
								  		<th class="text-right" width=15%>Applied Amount</th>
								  		<th class="text-right" width=15%>Amount</th>
								  		<th class="text-right" width=15%>Remaining Amount</th>								  		
								  		<th class="text-center">Action</th>
							  		
							  		</tr>
							  		<?php
							  		 if(isset($_GET['rp'])){
							  		 	$rcpcode=$_GET['rp'];
							  		 }elseif(isset($_SESSION['rp'])){
							  		 	$rcpcode=$_SESSION['rp'];
							  		 }
							  		//echo $locCode;
									$getCollection = "SELECT * FROM collection_journ WHERE receipt_code='$rcpcode' AND locationID='$locCode' AND doctype<>2 GROUP BY documentNo";
									$getOrder = $db->query($getCollection);
									$customerLedgCount=mysqli_num_rows($getOrder);
									while($row=$getOrder->fetch_array()){
										$docType=$row['doctype'];
										$getTotal = $db->query("SELECT amount FROM collection_journ WHERE doctype=2 AND receipt_code='".$row['receipt_code']."' ");
										while($row1=$getTotal->fetch_assoc()){
												 $yy =$row1['amount'];
										}
										switch ($docType) {
											case '0':
												$docType= "Sales Invoice";
												break;
											case '1':
												$docType= "Sales Credit Memo";
												break;
											default:
												# code...
												break;
										}
							  			echo "<tr>
								  		<td>$docType</td>								  										  		
								  		<td >".$row['documentNo']."</td>
								  		<td >".$row['externalDocNo']."</td>								  		
								  		<td >".$row['postingDate']."</td>
								  		<td class='text-right'>".number_format($row['amount'],2)."</td>
								  		<td class='text-right'>".number_format($row['OriginalAmt'],2)."</td>
								  		<td class='text-right'>".number_format($row['ramt'],2)."</td>								  		
								  		<td><a href='deletecollection.php?id=".$row['documentNo']."&&rp=".$row['documentNo']."'>Remove</a></td>	
								  		</tr>
								  		";

							  		}

							  		?>
							  		
								</table>	
								<input type="hidden" name="stotal" id="stotal" value="<?php echo $yy;?>" />
								 
						</form>
					</div>
					
									</div>
									
						 </div>
					</div>
				</div>
		</div>
			
	</div>
</body>
<?php require 'includes/overall/overall_footer.php';?>