<?php
include_once 'core/database/connect.php';
$cid = $_GET['cid'];
if(isset($_POST["exDoc"]) && $_POST["exDoc"] != ""){
    
    $exDoc =  $_POST['exDoc']; 
    $sql_uname_check = $db->query("SELECT entryID FROM collection_receipt_entry WHERE externalDocNo = '$exDoc'"); 
    
   $uname_check = mysqli_num_rows($sql_uname_check);
    if ($uname_check < 1) {
	   $disabled = " ";
    } else {
	    echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <strong>Warning! This is a duplicate External Doc Number</strong>
</div>';
	    exit();
    }
}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" />
<div class="container">
	
			<div class="page-header" style="color:#b1b0b0; ">
		<h3 class="text-center">Customer Detail</h3>
	</div>
	<form action="addcustomerinfo_collection.php" class="form-horizontal" method="post">
		<?php
		
			
			$selectTerms = $db->query("SELECT * FROM paymentmethod");
																							    				
																				
		$getCustomer = $db->query("SELECT * FROM customers WHERE customer_no = '$cid' LIMIT 1");
		while($row=$getCustomer->fetch_assoc()){
			$priceVat = $row['pricesIncVAT'];
			switch ($priceVat) {
				case '1':
					$priceVat = 'with VAT';
					break;
				
				default:
					$priceVat = 'no VAT';
					break;
			}

		$DocDate=date("m/d/Y");
			
				echo "
						<div class='col-md-6'>
							<div class='form-group'>
									    <p for='productprice' class='col-sm-4 col-form-label'> Name . . . . . . . . . . . . . </p>
									    <div class='col-sm-4'>
									      <div class='input-group'>
										     <input type='text' class='form-control' name='cus_name' value='".$row['name']."' readonly>
										     <input type='hidden' class='form-control' name='cus_no' value='$cid' readonly>
										    
										    </div>
										    
									    </div>
									  </div>

									  <div class='form-group'>
									    <p for='productprice' class='col-sm-4 col-form-label'>Address . . . . . . . . . . .</p>
									    <div class='col-sm-4'>
									      <div class='input-group'>
									      <textarea class='form-control' name='address' rows='3'>".$row['address']."</textarea>
										  
										    </div>
										    
									    </div>
									  </div>

									  <div class='form-group'>
									    <p for='productprice' class='col-sm-4 col-form-label'>Address 2 . . . . . . . . . .</p>
									    <div class='col-sm-4'>
									      <div class='input-group'>
										     <textarea class='form-control' name='address2' rows='3'>".$row['address2']."</textarea>
										    
										   	 </div> 
									   	 </div>
									</div>

							<div class='form-group'>
								    <p for='productprice' class='col-sm-4 col-form-label'>Price Incl. VAT . . . .  . .</p>
								    <div class='col-sm-4'>
								      <div class='input-group'>
									<input type='text' class='form-control' name='priceVat' value='$priceVat' readonly>
										 </div>							    
							  	</div>
							</div>   
					</div> 
					<div class='col-md-6'>  
							<div class='form-group' style='margin-bottom:8px;'>
															    	<p for='productdetail' class='col-sm-4 col-form-label text-left'>Document Date. . . . .</p>
																    		<div class='col-sm-4'>
																    			<div class='input-group'>
																    	  			<input type='date' class='form-control' name='ordate' id='ordate' required autocomplete = 'off' value='".date('Y-m-d')."'>
																   			 	</div>
																   			 	<span class='text-danger' id='usernamestatus'></span>
																 		</div>

																 	</div>					
							<div class='form-group' style='margin-bottom:8px;'>
															    	<p for='productdetail' class='col-sm-4 col-form-label text-left'>OR No. . . . . . . . . . . . .</p>
																    		<div class='col-sm-4'>
																    			<div class='input-group'>
																    	  			<input type='text' class='form-control' name='ornum' id='ornum'  required autocomplete = 'off'/>
																   			 	</div>
																   			 	<span class='text-danger' id='usernamestatus'></span>
																 		</div>

																 	</div>
																 	  <div class='form-group'>
															    			<p class='col-sm-4 col-form-label'>Amount Tendered . . .</p>
															    				<div class='col-sm-4'>
															    				<div class='input-group'>
															    					<input name='totalamt' class='text-right form-control' type='text' size='25' required  /> 
															    					
															    					</div>
															    					
															    			</div>
															    		</div>
																<div class='form-group'>
															    			<p class='col-sm-4 col-form-label'>Payment Method . . .</>
															    				<div class='col-sm-5'>
															    				<div class='input-group'>
															    					<select class='form-control' name='paymethod' required>
																						  <option disabled selected>Please Select</option>
																						  ";?>
																						  <?php
																						  	 while($row1=$selectTerms->fetch_assoc()){
																						echo $terms = "<option value=".$row1['paymentmethodcode'].">".$row1['description']."</option>";
																						}
																						  ?>

																					<?php	echo"</select>
															    					</div>	
															    			</div>
															    		</div>
															    		<div class='form-group'>
															    			<p class='col-sm-4 col-form-label'>Check No. . . . . . . . . . .</>
															    				<div class='col-sm-4'>
															    				<div class='input-group'>
															    					<input name='chckno' class='text-right form-control' type='text' /> 
															    					
															    					</div>	
															    			</div>
															    		</div>
															    		<div class='form-group'>
															    			<p class='col-sm-4 col-form-label'>Remarks . . . . . . . . . . .</p>
															    				<div class='col-sm-4'>
															    				<div class='input-group'>
															    					<textarea class='form-control' name='remarks' rows='3'>".$row['remarks']."</textarea>
															    					
															    					</div>	
															    			</div>
															    		</div>
										</div>


								<div class='form-group text-center' style='margin-right:50px;'>
   								 <div class='col-sm-offset-2 col-sm-10'>								
									<div class='btn-group' role='group' style='position:relative;right:50px;' >	
									 <input type='submit' class='btn btn-default btn-lg' name='submit'  style='cursor:pointer;background:#e9d460;color:#ffffff;' value='Submit' $disabled />
										
										</div>
									</div>
								</div>
													";
													}
													?>
												</form>
											</div>
<script src='js/jquery-2.1.3.min.js'></script>
<script type="text/javascript">
function getPaymentMethod(value){
		$.post("paymentMethodSearch.php",{paymentCode:value},function(data){
						$("#paymentresults").html(data);
					});
				
	}
function checkusername(){
	var status = document.getElementById("usernamestatus");
	var u = document.getElementById("ornum").value;
	if(u != ""){
		status.innerHTML = 'checking...';
		var hr = new XMLHttpRequest();
		hr.open("POST", "customerinfo_collection.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.onreadystatechange = function() {
			if(hr.readyState == 4 && hr.status == 200) {
				status.innerHTML = hr.responseText;
			}
		}
        var v = "exDoc="+u;
        hr.send(v);
	}
}
</script>
    <script src="js/bootstrap.min.js"></script>