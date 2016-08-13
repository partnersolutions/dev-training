<?php
session_start();
include_once 'core/database/connect.php';
$docType=$_SESSION['trans_type'];

if(isset($_POST["exDoc"]) && $_POST["exDoc"] != ""){
    
    $exDoc =  $_POST['exDoc']; 
    $sql_uname_check = $db->query("SELECT id FROM posted_orders_table WHERE externalDocNo LIKE '%$exDoc%' AND documentType='$docType' LIMIT 1"); 
   $uname_check = mysqli_num_rows($sql_uname_check);
    if ($uname_check < 1) {
	    
    } else {
	    echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <strong>Warning! This is a duplicate External Doc Number</strong>
</div>';
	    exit();
    }
}

$finalcode=$_GET['rp'];

?>
<link href="css/bootstrap.min.css" rel="stylesheet" />

<div class="container">
	
			<div class="page-header" style="color:#b1b0b0; ">
		<p class="text-center">Customer Info</p>
	</div>
	<form action="addcustomerinfo.php" class="form-horizontal" method="post">
		<?php
		include_once 'core/database/connect.php';
			$cid = $_GET['cid'];			
			
		$getCustomer = $db->query("SELECT * FROM customers WHERE customer_no = '$cid' LIMIT 1");		
		while($row=$getCustomer->fetch_assoc()){
			$priceVat = $row['pricesIncVAT'];
			$pterms = $row['payment_terms'];
			if($pterms!=""){
			   $selectTerms = $db->query("SELECT * FROM paymentterms WHERE payment_code='".$row['payment_terms']."'");						
				while($row1 = $selectTerms -> fetch_assoc()){
					$formula = $row1['due_date_formula'];
				 $dateFormula = "+".$row1['due_date_formula']."Days";
				}
			}else{
				$dateFormula = "+0Days";
			}
			
			$paymentdue=date('Y-m-d',strtotime("$dateFormula"));		
			switch ($priceVat) {
				case '1':
					$priceVat = 'with VAT';
					break;
				
				default:
					$priceVat = 'no VAT';
					break;			
			}
			if ($docType==0){
				echo "
						<div class='col-md-6'>
							<div class='form-group'>
									    <p for='productprice' class='col-sm-4 '> Name . . . . . . . . . . . . .</p>
									    <div class='col-sm-4'>
									      <div class='input-group'>
										     <input type='text' class='form-control' name='cus_name' value='".$row['name']."' readonly>
										     <input type='hidden' class='form-control' name='cus_no' value='$cid' readonly>
										     <input type='hidden' class='form-control' name='finalcode' value='$finalcode' readonly>
										    
										    </div>
										    
									    </div>
									  </div>

									  <div class='form-group'>
									    <p for='productprice' class='col-sm-4 col-form-control-label'>Address . . . . . . . . . . .</p>
									    <div class='col-sm-4'>
									      <div class='input-group'>
									      <textarea class='form-control' name='address' rows='3'>".$row['address']."</textarea>
										  
										    </div>
										    
									    </div>
									  </div>

									  <div class='form-group'>
									    <p for='productprice' class='col-sm-4 col-form-control-label'>Address 2 . . .  . . . . . .</p>
									    <div class='col-sm-4'>
									      <div class='input-group'>
										     <textarea class='form-control' name='address2' rows='3'>".$row['address2']."</textarea>
										    
										   	 </div> 
									   	 </div>
									</div>

									     <div class='form-group'>
										    <p for='productprice' class='col-sm-4 col-form-control-label'>Price Incl. VAT . . . . . .</p>
										    <div class='col-sm-4'>
										      <div class='input-group'>
											<input type='text' class='form-control' name='priceVat' value='$priceVat' readonly>
												 </div>							    
									  	</div>
									</div>
									</div>

						
								
							<div class='col-md-6'>
							     <div class='form-group'>
							    <p for='productprice' class='col-sm-4 control-label'>Payment Terms. . . . . .</p>
							    <div class='col-sm-6'>
							      <div class='input-group'>
								      <input type='text' class='form-control' name='payment_terms' value='$pterms' readonly />
								     	
								    </div>
							    </div>
							   
							  
							  </div>
							 <div class='form-group'>
							    <p for='productprice' class='col-sm-4 col-form-label'>Due Date. . . . . .</p>
							    <div class='col-sm-6'>
							      <div class='input-group'>
								      <input type='date' class='form-control'name='dueDate' value='$paymentdue' readonly />
								     	
								    </div>
							    </div>
							   
							  
							  </div>
								<div class='form-group'>
								    <p for='reqDelDate' class='col-sm-4 col-form-control-label'>Req. Del. Date . . . . . .</p>
								    <div class='col-sm-4'>
								      <div class='input-group'>
										  <input type='date' class='form-control' name='reqDelDate' required/>
										</div>
								    </div>
								  </div>
									   <div class='form-group'>
									    <p for='promDelDate' class='col-sm-4 col-form-control-label'>Prom. Del. Date . . . .</p>
									    <div class='col-sm-4'>
									      <div class='input-group'>
											  <input type='date' class='form-control' name='promDelDate' required/>
											  
											</div>
									    </div>
									  </div>									
									<div class='form-group ' style='margin-bottom:8px;'>
										<p for='productdetail' class='col-sm-4 col-form-control-label text-left'>Sales Invoice No. . . .</p>
												<div class='col-sm-4'>
													<div class='input-group'>
											  			<input type='text' class='form-control' name='exdoccode' id='exdoccode'   value='$exDoc'  required autocomplete='off'/>
											  			
												 	</div>
												 	<span class='text-danger' id='usernamestatus'></span>
									</div>
								</div>
								
						 </div>	

								<div class='form-group text-center' style='margin-right:50px;'>
   								 <div class='col-sm-offset-2 col-sm-10'>								
									<div class='btn-group' role='group' style='position:relative;right:50px;' >	
									 <button type='submit' class='btn btn-default btn-lg' name='submitinfo'  style='cursor:pointer;background:#e9d460;color:#ffffff;' data-dismiss='modal'>Submit</button>
										
										</div>
									</div>
								</div>
													";
												}elseif ($docType==1) {
													
				echo "
						<div class='col-md-6'>
							<div class='form-group'>
									    <p for='productprice' class='col-sm-4 '> Name . . . . . . . . . . . . .</p>
									    <div class='col-sm-4'>
									      <div class='input-group'>
										     <input type='text' class='form-control' name='cus_name' value='".$row['name']."' readonly>
										     <input type='hidden' class='form-control' name='cus_no' value='$cid' readonly>
										     <input type='hidden' class='form-control' name='finalcode' value='$finalcode' readonly>
										    
										    </div>
										    
									    </div>
									  </div>

									  <div class='form-group'>
									    <p for='productprice' class='col-sm-4 col-form-control-label'>Address . . . . . . . . . . .</p>
									    <div class='col-sm-4'>
									      <div class='input-group'>
									      <textarea class='form-control' name='address' rows='3'>".$row['address']."</textarea>
										  
										    </div>
										    
									    </div>
									  </div>

									  <div class='form-group'>
									    <p for='productprice' class='col-sm-4 col-form-control-label'>Address 2 . . .  . . . . . .</p>
									    <div class='col-sm-4'>
									      <div class='input-group'>
										     <textarea class='form-control' name='address2' rows='3'>".$row['address2']."</textarea>
										    
										   	 </div> 
									   	 </div>
									</div>

									     <div class='form-group'>
										    <p for='productprice' class='col-sm-4 col-form-control-label'>Price Incl. VAT . . . . . .</p>
										    <div class='col-sm-4'>
										      <div class='input-group'>
											<input type='text' class='form-control' name='priceVat' value='$priceVat' readonly>
												 </div>							    
									  	</div>
									</div>
									</div>

						
								
							<div class='col-md-6'>
							        <div class='form-group'>
							    <p for='productprice' class='col-sm-4 col-form-label'>Payment Terms. . . . . .</p>
							    <div class='col-sm-6'>
							      <div class='input-group'>
								      <input type='text' class='form-control' name='payment_terms' value='$pterms' readonly>
								     	
								    </div>
							    </div>
							   
							  
							  </div>
							 <div class='form-group'>
							    <p for='productprice' class='col-sm-4 col-form-label'>Due Date. . . . . .</p>
							    <div class='col-sm-6'>
							      <div class='input-group'>
								      <input type='date' class='form-control'name='dueDate' value='$paymentdue' readonly>
								     	
								    </div>
							    </div>
							   
							  
							  </div>
									
									<div class='form-group ' style='margin-bottom:8px;'>
										<p for='productdetail' class='col-sm-4 col-form-control-label text-left'>CM No. . . .</p>
												<div class='col-sm-4'>
													<div class='input-group'>
											  			<input type='text' class='form-control' name='exdoccode' id='exdoccode'   value='$exDoc'  required autocomplete='off'/>
											  			
												 	</div>
												 	<span class='text-danger' id='usernamestatus'></span>
									</div>
								</div>
								
						 </div>	

								<div class='form-group text-center' style='margin-right:50px;'>
   								 <div class='col-sm-offset-2 col-sm-10'>								
									<div class='btn-group' role='group' style='position:relative;right:50px;' >	
									 <button type='submit' class='btn btn-default btn-lg' name='submitinfo'  style='cursor:pointer;background:#e9d460;color:#ffffff;' data-dismiss='modal'>Submit</button>
										
										</div>
									</div>
								</div>
													";													
												}
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
	var u = document.getElementById("exdoccode").value;
	if(u != ""){
		status.innerHTML = 'checking...';
		var hr = new XMLHttpRequest();
		hr.open("POST", "customerinfo.php", true);
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