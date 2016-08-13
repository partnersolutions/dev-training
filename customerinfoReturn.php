<?php
include_once 'core/database/connect.php';
if(isset($_POST["exDoc"]) && $_POST["exDoc"] != ""){
    
    $exDoc =  $_POST['exDoc']; 
    $sql_uname_check = $db->query("SELECT id FROM posted_orders_table WHERE externalDocNo LIKE '%$exDoc%' AND documentType=1 LIMIT 1"); 
   $uname_check = mysqli_num_rows($sql_uname_check);
   if ($uname_check < 1) {
	    
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
	
			<div class="page-header">
		<h1 class="text-center">Customer Info</h1>
	</div>
	<form action="addcustomerinfo_return.php" class="form-horizontal" method="post">
		<?php
		include_once 'core/database/connect.php';
			$cid = $_GET['cid'];
			
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
			
				echo "
						<div class='col-md-6'>
							<div class='form-group'>
									    <p for='productprice' class='col-sm-4 col-form-label'> Name . . . . . . . . . . . . .</p>
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
									      <textarea class='form-control' name='address' rows='2'>".$row['address']."</textarea>
										  
										    </div>
										    
									    </div>
									  </div>

									  <div class='form-group'>
									    <p for='productprice' class='col-sm-4 col-form-label'>Address 2 . . . . . . . . .</p>
									    <div class='col-sm-4'>
									      <div class='input-group'>
										     <textarea class='form-control' name='address2' rows='2'>".$row['address2']."</textarea>
										   <span class='text-danger' id='usernamestatus'></span>
										   	 </div> 
									   	 </div>
									</div>
								       <div class='form-group'>
										 <p for='productprice' class='col-sm-4 col-form-label'>Price Incl. VAT . . . . . . </p>
										 <div class='col-sm-4'>
										  <div class='input-group'>
											<input type='text' class='form-control' name='priceVat' value='$priceVat' readonly>
											 </div>							    
									  	</div>
									</div>	
								
						 </div>	
						
								
							<div class='col-md-6'>
							<div class='form-group' >
										<p for='productdetail' class='col-sm-4 col-form-label text-left'>CM No. . . . . . . . . . . .</p>
												<div class='col-sm-4'>
													<div class='input-group'>
											  			<input type='text' class='form-control' name='exdoccode' id='exdoccode'   value='$exDoc' required autocomplete='off' />
												 	</div>
												 	<span class='text-danger' id='usernamestatus'></span>
									</div>
								</div>
							   <div id=paymentresults style=margin-right:25px;></div>
									   <div class='form-group'>
												<p for='tin' class='col-sm-4 col-form-label'>VAT Reg. No. . . . . . . .</p>
												<div class='col-sm-4'>
													 <div class='input-group'>
														<input type='text' class='form-control' name='tin' value='".$row['vatRegNo']."' readonly/>
											 		</div>							    
										  		</div>
									  		</div>	

									</div>
					
											<hr />
			   				<div class='btn-group pull-right' role='group' style='position:relative;right:0px;top:90px' >	
									<button type='submit' class='btn btn-default btn-lg' name='submit'>Submit</button>													
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
	var u = document.getElementById("exdoccode").value;
	if(u != ""){
		status.innerHTML = 'checking...';
		var hr = new XMLHttpRequest();
		hr.open("POST", "customerinfoReturn.php", true);
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