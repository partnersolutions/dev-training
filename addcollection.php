<?php require 'includes/overall/overall_header.php';
 $rcpcode=$_SESSION['rp'];
 $cus_no=$_SESSION['cus_no'];
$totalAmount=$_SESSION['totalamt'];
 


 $user = $db->query("SELECT * FROM users WHERE user_id='$user_id'");
				while ($row = $user->fetch_assoc()) {
				   $u_outlet=$row['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row = $outlet->fetch_assoc()) {
				  $locCode=$row['locationCode'];	
				
				}
			}

?>

<body onload='multiply()'>
	 <link href="css/bootstrap.min.css" rel="stylesheet">

	 <div class="container">

	 	<div class="row">
	 			<div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title "><strong>Applying Document</strong></h3>
						  </div>
						  <div class="panel-body">
						  
						   

								<?php

								 $error=$_GET['error'];

								if($error=='BalExceeded'){
								 	echo "<div class='alert alert-danger' role='alert'>
								 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h3>The amount exceeds the balance.</h3>
											
											<br />

										</div>";
								}
								if($error=='RemAmtExceeded'){
								 	echo "<div class='alert alert-danger' role='alert'>
								 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h3>The amount exceeds the Remaining Amount Due.</h3>
											
											<br />

										</div>";
								}
								if($error=='NoOpenTrans'){
								 	echo "<div class='alert alert-danger' role='alert'>
								 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h3>No open transaction was found for this Customer.</h3>
											
											<br />

										</div>";													
								 }			
								
								
								$getledger2 = $db->query("SELECT SUM(AmtToApply) FROM selectedledger WHERE receipt_code='$rcpcode' ");
												while($row00=$getledger2->fetch_assoc()){								
													 $AmtToAppTotal=$row00['SUM(AmtToApply)'];	
												}
								$colBal=$totalAmount-$AmtToAppTotal;
								$_SESSION['CR_RemAmt']=$colBal;								
								?>
		<div class="btn-group pull-right " role="group" aria-label="...">
								  <a href="deledger.php?rp=<?php echo $rcpcode;?>&&resp=discard" id='myBtn' class="btn btn-default" <?php if($yy>$totalAmount){ echo "disabled='true'";} ?> style='background:#dcc6e0;color:#ffffff;' >Back </a>								  
								  <a href="deledger.php?rp=<?php echo $rcpcode;?>" id="save" class="btn btn-default" <?php if($yy>$totalAmount){ echo "disabled='true'";} ?> style='cursor:pointer;background:#e4f1fe;color:#44ac88;' >Save</a>								  
								</div>
								<br/>
								<br/>
								<div class="form-group pull-right" style="position:relative;left:170px;">

													 	 <label for="productdetail" class="col-sm-5 control-label" style="position:relative;left:100px;">Tendered Amount</label>
													 	<div class="col-sm-4" style="margin-bottom:5px;">
													 	<input name='ramt' id='ramt' class='text-right form-control' type='text' value="<?php echo number_format($totalAmount,2);?>" readonly /> 
													 </div>
													  <label for="productdetail" class="col-sm-5 control-label" style="position:relative;left:100px;">Balance</label>
													 	<div class="col-sm-4">
													 	<input name='ramt' id='ramt' class='text-right form-control' type='text' value="<?php echo number_format($colBal,2);?>" readonly /> 
													 </div>
													 </div>
								<br />
									 
													 
													 <?php 												

													    if (isset($_GET['id'])){
													    	$pid = $_GET['id'];
															
																		if($saleinvcount==1){
																			echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Document already been added.
</div>';
																		}

																}
														?>
												
								<table class="table table-bordered">
									<tr>
								  		
								  		<th width='20%'><strong>Document Type</strong></th>
								  		<th width='20%'><strong>Document No.</strong></th>
								  		<th width='20%'><strong>Date Ordered</strong></th>
								  		<th class='text-right' width='20%'><strong>Amount</strong></th>
								  		<th class='text-right' width='20%'><strong>Amount to Apply</strong></th>
								  		<th width='10%'><strong>Action</strong></th>
	
							  		
							  		</tr>
							  		<?php							  	

							  		$getledger = $db->query("SELECT * FROM selectedledger WHERE customerID='$cus_no' AND receipt_code='$rcpcode' ");
									$ledgerCount=mysqli_num_rows($getledger);
									if($ledgerCount==0){
							  			echo "<tr><td colspan='5'>You have not seletect from ledger yet
										</td></tr>";
							  		}else{
									while($row=$getledger->fetch_array()){
										$date=date_create($row['postingDate']);
										$dateOrd=date_format($date,'m/d/Y');
										$docType=$row['doctype'];
										$docNo=$row['docNo'];
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
								  		<td class='text-right'>".number_format($row['amount'],2)."</td>
								  		<td class='text-right'>".number_format($row['AmtToApply'],2)."</td>
								  		<td> <a href='editColAmt.php?id=".$row['id']."' rel='facebox' class='btn btn-primary'>Apply</a></td>
								  			
								  			</tr>
								  		";

							  		}
							  	}	

							  		?>
								</table>								
						  </div>
						</div>			
	 				</div>
				</div>
		</body>		
<?php require 'includes/overall/overall_footer.php';?>
<script src='js/jquery-2.1.3.min.js'></script>
<script type="text/javascript">
	function selectPayment(value){
		$.post("selectPayment.php",{docID:value},function(data){
						$("#results").html(data);
					});
				
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

     if (document.form1.ramt.value < 0) // some logic to determine if it is ok to go
        {
         alert("The applied amount is not sufficient to cover the amount of the applying document");
          	 document.getElementById("myBtn").disabled = true;
        }
        
    }
   


</script>