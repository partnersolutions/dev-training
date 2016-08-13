<?php require 'includes/overall/overall_header.php';
session_start();
$totalAmount=$_SESSION['totalamt'];
$user_id=$_SESSION['id'];
 $user = $db->query("SELECT * FROM users WHERE user_id='$user_id'");
				while ($row = $user->fetch_assoc()) {
				  $u_outlet=$row['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row = $outlet->fetch_assoc()) {
				  $locCode=$row['locationCode'];	
				
				}
			}
			$rcpcode=$_SESSION['rcpcode'];
?>
<style type="text/css">
#results{
		position:absolute;
		top:;
		left:;
		width:150;
		z-index:1;
		padding:5px;
		overflow:auto; 
		height:auto; 
		background-color:#FFFFFF;
		}
		table tr th{
	background-color:#e4f1fe;
	color:#b1b0b0; 
	font-family:Calibri;
	font-size:18px;
	font-style: normal;
	table-layout:fixed;
	
}
</style>
<script type="text/javascript">
function multiply(){
//compute for price
    a=Number(document.form1.total.value);

    b=Number(document.form1.stotal.value);
    
    if (a>0){
      c=a-b;
        d=c.toFixed(2);
        document.form1.ramt.value=d; 

    }
  
      if (a!=0) // some logic to determine if it is ok to go
        {
        
          //document.getElementById("save").disabled = false;
          //document.getElementById("post").disabled = false;
          //document.getElementById("pstndprnt").disabled = false;
          //document.getElementById("xx").disabled = false;
          
      }else{
        
          document.getElementById("save").disabled = false;
          document.getElementById("post").disabled = false;
          document.getElementById("pstndprnt").disabled = false;
          document.getElementById("xx").disabled = false;
          
      }
     if (document.form1.ramt.value < 0) // some logic to determine if it is ok to go
        {
          alert("The applied amount is not sufficient to cover the amount of the applying document");
          document.getElementById("myBtn").disabled = false;
        }
    }

</script>
<body onload="multiply()">
	 <link href="css/bootstrap.min.css" rel="stylesheet">

	 <div class="container">
	 	<div class="row">
	 			<div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title">Edit Applying Document</h3>
						  </div>
						  <div class="panel-body">
						   <form class="form-horizontal" name="form1" action="editledger.php" method="post">
						   	<div class="form-group pull-right">
													 	 <label for="productdetail" class="col-sm-8 control-label">Total. Amt Applied:</label>
													 	<div class="col-sm-4">
													 	<input name='ramt' value="<?php echo $_SESSION['totalamt']; ?>" class='text-right form-control' type='text' readonly /> 
													 </div>
													 </div>
										 <div class="form-group" >
													    <label for="productdetail" class="col-sm-3 control-label">Enter Document Referrence Here:</label>
													    <div class="col-sm-4">
													      <input type="text" class="form-control" name="product"   placeholder="Document Referrence" onkeyup="selectAddPayment(this.value)" autocomplete='off' />
													      <div id="results" style="margin-right:-30px;"></div><br />

													    </div>
													 </div>
													 
													 <?php 
													
													    if (isset($_GET['id'])){
													    	$pid = $_GET['id'];
															$product = $db->query("SELECT * FROM customers_ledger WHERE entryID = '$pid'");
																	while ($row = $product->fetch_assoc()) {
																		
																		 $docType=$row['documentType'];
																		$docNo=$row['documentNo'];
																		$postDate=date("Y-m-d");
																		$amount=$row['amount'];
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
																			$saleInv = $db->query("SELECT * FROM selectedledger WHERE docNo = '$docNo'");
																	  $saleinvcount=mysqli_num_rows($saleInv);

																		}
																		if($saleinvcount==1){
																			echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Document already been added.
</div>';
																		}
																}
														?>
												<div class="form-group">
													    		<label class="col-sm-4 control-label">Document Type:</label> 
													    		<div class="col-sm-4">
													    		<div class="input-group">
													    			<input name="docType" type="text" value="<?php  echo $docType; ?>"style="border:0px;" readonly required/>
													    			<input name="rpcode" type="hidden" value="<?php  echo $rcpcode; ?>"style="border:0px;" readonly required/>
													     		
													  			</div>
													  		</div>
													  	</div>
													<div class="form-group">
														<label class="col-sm-4 control-label">Document No:</label>
													    	<div class="col-sm-4">
													    		<div class="input-group">

													    		<input name="docNo" class="text-right" type="text" value="<?php echo $docNo; ?>" style="border:0px;"/>
													    		</div>
													    	</div>
													     </div>
														<div class="form-group">
													    	<label for="qty" class="col-sm-4 control-label">Posting Date:</label>
													    	<div class='col-sm-4'>
													    		<div class='input-group'>
													    			<input name="pdate" class="text-right" type="text" value="<?php echo 	$postDate; ?>" style="border:0px;"/>
													    		
													    		<input name="cus_num" class="form-control" type="hidden" value="<?php echo $cus_no; ?>"   /></div>
													  			</div>
													  		</div>
															<div class="form-group">
													    			<label class="col-sm-4 control-label">Amount:</label>
													    				<div class='col-sm-4'>
													    				<div class='input-group'>
													    					<input name="amount" class="text-right" type="text" style="border:0px;" readonly="readonly" value="<?php echo $amount;?>"/> 
													    					<input type="hidden" name="posted_by" value="<?php echo $user_id; ?>">
																			<input name='total' id='total' class='text-right form-control' type='hidden' size='25' value='<?php echo $totalAmount; ?>'  />
																			 <input type="hidden" name="stotal" id="stotal" value="<?php
																			$getTotal = $db->query("SELECT SUM(amount) FROM selectedledger WHERE customerID= '$cus_no' AND receipt_code='$rcpcode' ");
																					while($row=$getTotal->fetch_assoc()){
																							echo $yy =$row['SUM(amount)'];
																					}
																			 ?>" />
																			 
													    					</div>
													    			</div>	 
													    		</div>	 
										  <div class="form-group">
										    <div class="col-sm-offset-2 col-sm-10">
										      <button type="submit" class="btn btn-default" name="submit" type="submit" value="ADD TO CART" style="cursor:pointer;background:#e4f1fe;color:#44ac88;" id="xx" <?php   if (!isset($_GET['id'])|| $saleinvcount==1 ){ echo "disabled='true'"; }?> >Add</button>
										    </div>
										  </div>
								</form>
								<table class="table table-bordered">
									<thead>
								  		
								  		<th>Document Type</th>
								  		<th>Document No</th>
								  		<th>Date Ordered</th>
								  		<th>Amount</th>
								  		<th>Option</th>
	
							  		
							  		</thead>
							  		<?php
							  		
							  		
							  		$getledger = $db->query("SELECT * FROM selectedledger WHERE receipt_code='$rcpcode' AND locationCode='$locCode' ");
									$ledgerCount=mysqli_num_rows($getledger);
							  		if($ledgerCount==0){
							  			echo "<tr><td colspan='5'>You have not seletect from ledger yet
										</td></tr>";
							  		}else{
									while($row=$getledger->fetch_array()){
										$date=date_create($row['postingDate']);
										$dateOrd=date_format($date,'m/d/Y');
										 $docType=$row['doctype'];
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
								  		<td>".$row['docNo']."</td>
								  		<td >$dateOrd</td>
								  		<td class='text-right'>".number_format($row['amount'])."</td>
								  		<td><a href='deleteledger.php?id=".$row['id']."'>Remove</a></td>
								  			
								  			</tr>
								  		";
								  		

							  		}
							  	}	

							  		?>
								</table>
								
								
								<a href="edit_collection.php?rp=<?php echo $rcpcode; ?>" id="myBtn" class="btn btn-default" style="cursor:pointer;background:#f1a9a0;color:#ffffff;">Save and Continue Editing</a>
								<a href="edit_collection.php?rp=<?php echo $rcpcode; ?>" id="myBtn" class="btn btn-default" onclick='goBack()' style="cursor:pointer;background:#e9d460;color:#ffffff;">Back</a>
						  </div>
						</div>			
	 				</div>
				</div>
		</body>	
<script src='js/jquery-2.1.3.min.js'></script>
<script type="text/javascript">
	function selectAddPayment(value){
		$.post("selectAddPayment.php",{docID:value},function(data){
						$("#results").html(data);
					});
				
	}

</script>			
<?php require 'includes/overall/overall_footer.php';?>