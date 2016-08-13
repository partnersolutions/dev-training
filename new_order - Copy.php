<?php require 'includes/overall/overall_header.php';			

$docType=$_SESSION['trans_type'];

$sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id' ");
	while($row=$sql->fetch_assoc()){
		$access = $row['access'];
			 $u_outlet=$row['outlet'];	
			$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
			while ($row1 = $outlet->fetch_assoc()) {
		 $locCode=$row1['locationCode'];
		$DocCode=$row1['outletDocCode'];
	}
}


if(isset($_GET['rp'])){
 $finalcode=$_GET['rp'];
$_SESSION['rcpcode']=$rp;

$getOrder = $db->query("SELECT * FROM orders WHERE receipt_code='$finalcode'  AND documentType='$docType' GROUP BY receipt_code ASC  ");
while($row=$getOrder->fetch_array()){

		$ordId=$row['id'];
		$dateOrd=$row['date_ordered'];

		$_SESSION['cus_no']=$row['customer_no'];
		$_SESSION['rcpcode']=$finalcode;
		$_SESSION['salesInvoice']=$row['externalDocNo'];
		$_SESSION['dueDate']=$row['dueDate'];
		$_SESSION['reqdeldate']=$row['reqDelDate'];
		$_SESSION['promdeldate']=$row['promDelDate'];
		$_SESSION['payterms']=$row['paymentTermCode'];

		$cus_no=$_SESSION['cus_no'];
		$rcpcode=$_SESSION['rcpcode'];
		$salesInvo=$_SESSION['salesInvoice'];
		$dueDate=$_SESSION['dueDate'];
		$reqdate=$_SESSION['reqdeldate'];
		$promdate=$_SESSION['promdeldate'];
		$payment_term = $_SESSION['payterms'];

/*		
	$cus_no=$row['customer_no'];
	$salesInvo =$row['externalDocNo'];
	$dueDate=$row['dueDate'];
 	$reqdate =$row['reqDelDate'];
	$promdate =$row['promDelDate'];
	$payment_term=$row['paymentTermCode'];
	*/
	}
}


		if(isset($_GET['REF_SI'])){			
			 $RefPostedInvNo=$_GET['REF_SI'];						
				$getPostOrder = $db->query("SELECT * FROM `posted_orders_table` WHERE `receipt_code`='$RefPostedInvNo' AND outletCode='$locCode' AND item_id != ''");
					$returnsCount=mysqli_num_rows($getPostOrder);
					if($returnsCount==0){
						echo 
						"<tr><td colspan='5'>You have no returned order posted in the store yet
						</td></tr>
						";
						
					}else{
					while($row=$getPostOrder->fetch_assoc()){

						//$dateOrd=$row['date_ordered'];
						//$qty=$row['quantity'];
						//$price=$row['price'];
						//$lineamount = $price * $qty;

						$L_item_id=$row['item_id'];
						$L_item_description=$row['item_description'];
						$L_quantity=$row['quantity'];
						$L_price=$row['price'];
						$L_total=$row['total'];
						//date_ordered=$row['date_ordered'];
						//receipt_code=$row['receipt_code'];
						$L_item_id=$row['item_id'];
						$L_item_description=$row['item_description'];
						$L_quantity=$row['quantity'];
						$L_price=$row['price'];
						$L_total=$row['total='];
						//date_ordered=$row['date_ordered'];
						//outletCode=$row['outletCode'];
						//documentType=$row['documentType'];
						$L_customer_no=$row['customer_no'];
						$L_customer_name=$row['customer_name'];
						$L_customer_address=$row['customer_address'];
						$L_customer_address2=$row['customer_address2'];
						$L_vatRegNo=$row['vatRegNo'];
						//externalDocNo=$row['externalDocNo'];
						//reqDelDate=$row['reqDelDate'];
						//promDelDate=$row['promDelDate'];
						//dueDate=$row['dueDate'];
						$L_pricesIncVAT=$row['pricesIncVAT'];
						$L_netUnitPrice=$row['netUnitPrice'];
						$L_netAmount=$row['netAmount'];
						$L_vatPerc=$row['vatPerc'];
						$L_vatAmount=$row['vatAmount'];
						$L_paymentTermCode=$row['paymentTermCode'];
						//posted_by=$row['posted_by'];

	 $insOrder = $db->query("INSERT INTO orders(receipt_code,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,externalDocNo,dueDate,pricesIncVAT,netUnitPrice,netAmount,vatPerc,vatAmount,paymentTermCode,posted_by) 
										VALUES('$rcpcode','$L_item_id','$L_item_description','$L_quantity','$L_price','$L_total','$dateOrd','$locCode','$docType','$L_customer_no','$L_customer_name','$L_customer_address','$L_customer_address2','$L_vatRegNo','$RefPostedInvNo','$dateOrd','$L_pricesIncVAT','$L_netUnitPrice','$L_netAmount','$L_vatPerc','$L_vatAmount','$L_paymentTermCode','$user_id')");						
	mysqli_query($db, $insOrder); 	 
			  			//echo "<tr>
				  		//<td class='text-right'>".$row['item_id']."</td>
				  		//<td>".$row['item_description']."</td>
				  		//<td class='text-right'>".number_format($row['quantity'],2)."</td>
				  		//<td class='text-right'>".number_format($row['price'],2)."</td>
				  		//<td class='text-right'>".number_format($lineamount,2)."</td>
				  		//<td><a class='btn btn-warning' href='delete_return.php?id=".$row['id']."&&rp=$rcpcode'>Remove</a></td>
				  		//</tr>"
				  		//";

			  		}
			  	}
			}		


if($docType==0){
	$PageCaption='Sales Order';
}elseif ($docType==1){ 
	$PageCaption='Sales Return';
}

?>




  <script type="text/javascript">

	function minus(){
//net total
		a=Number(document.form2.cash.value);

		b=Number(document.form2.rtotal.value);

		c=a-b;

		document.form2.change.value=c;

		}


function mul(){
//discount

		b=Number(document.form2.rtotal.value);
		d=Number(document.form2.aba.value);


		c=b*d;
		o=b-c;
		D=o.toFixed(2)

		document.form2.gtotal.value=addCommas(c);
		document.form2.gtotal.value=D;
		document.form1.gtotal1.value=addCommas(D);
		}

function multiply(){
//compute for price
		a=Number(document.form1.qty.value);

		b=Number(document.form1.pprice.value);
		
		if (a>0){
			c=a*b;
				d=c.toFixed(2);
				document.form1.total.value=d;	
		}	 
}
function check() {
	
	if (document.form1.linetotal.value== 0 || document.form1.linetotal.value== "" ) // some logic to determine if it is ok to go
        {
          
         
          document.getElementById("post").disabled = true;
          document.getElementById("pstndprnt").disabled = true;
        }else{
        	document.getElementById("save").disabled = false;
          document.getElementById("post").disabled = false;
          document.getElementById("pstndprnt").disabled = false;
        }
}

</script>
<body onload='check()'>
	<div class='container-fluid'>
			<?php include 'header.php';?>
				<div class="row">
					<?php include 'includes/side_menu.php';?>
					 <div class="col-xs-12 col-sm-6 col-md-10">
					 	<div class="panel panel-default" id="panelSalesheader" >
							  <!-- Default panel contents -->
							  <div class="panel-heading" style='margin-top:0px'; >
							  	<p class="text-center" id="theader"  ><?php echo $PageCaption;?></p>
							  	<?php
							  				
											//$trans_type='SALES_ORDER';
											//$_SESSION['trans_type']=$trans_type;
											$cus_no=$_SESSION['cus_no'];
											 $rcpcode=$_SESSION['rcpcode'];
											 $salesInvo=$_SESSION['salesInvoice'];
											 $dueDate=$_SESSION['dueDate'];
											 $reqdate=$_SESSION['reqdeldate'];
											$promdate=$_SESSION['promdeldate'];
											$payment_term = $_SESSION['payterms'];
											$finalcode= $rcpcode;
											$date=date('Y-m-d');
											$sql = $db->query("SELECT * FROM users WHERE user_id ='$user_id' ");
														while($row=$sql->fetch_assoc()){
															$access = $row['access'];
												  			 $u_outlet=$row['outlet'];	
																$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
																while ($row1 = $outlet->fetch_assoc()) {
															 $locCode=$row1['locationCode'];
															$DocCode=$row1['outletDocCode'];
																
																}
														}
														//ECHO $docType;
														//ECHo $finalcode;
											//$result = $db->query("SELECT * FROM socode");
											//												while($row = $result->fetch_array())
											//												  {
											//												        $fefe=$row['code']; 
											//												  }
																		//$finalcode= $DocCode.'-SO-'.$fefe;
			
										
									?>
									</div>
							<div class="panel-body">
							  
								<form class="form-horizontal" action="addorderparse.php" name="form1" id="form1" method="post" >
									
									<div class="pull-right">
										<?php	
										if($docType==0){
											echo "<div class='btn-group ' role='group'>
											<a rel='facebox'  href='inputCustomer.php?rp=$finalcode' id='searchcus' class='btn btn-default' style='background:#dcc6e0;color:#ffffff;' >Select Customer Here (F6)</a>
											</div>";
										}elseif($docType==1){
											echo "<div class='btn-group ' role='group'>											
											<a rel='facebox' href='inputCustomer.php?rp=$finalcode' id='searchcus' class='btn btn-default' style='background:#dcc6e0;color:#ffffff;' >Select Customer Here (F6)</a>
											<a href='salesInvoice.php?cid=$cus_no' id='searchitem' rel='facebox' class='btn btn-default ' style='background:#19B5FE;color:#ffffff;'>Retrieve Sales Invoice</a>
											</div>";
										}
											?>
											<?php

											if(isset($_SESSION['cus_no'])&&isset($_SESSION['id'])){
												echo
												"<div class='btn-group' role='group'>
									  				<input name='save' class='btn btn-default'  type='submit' value='Save' style='cursor:pointer;background:#f1a9a0;color:#ffffff;'    />
									  			 </div>	
									  			  <div class='btn-group' role='group'>
									  				<input name='post' class='btn btn-default' id='post' type='submit' value='Post (F11)' style='cursor:pointer;background:#e9d460;color:#ffffff;'  />
									  			   </div>
									  			    <div class='btn-group ' role='group'>	
									  					<input name='pstndprnt' class='btn btn-default' id='pstndprnt' type='submit' value='Post &amp; Print' style='cursor:pointer;background:#e4f1fe;color:#44ac88;'   />
		  											</div>";
												
											}else{
												echo
												"<div class='btn-group' role='group'>
									  				<input name='save' class='btn btn-default' id='save' type='submit' value='Save' style='cursor:pointer;background:#f1a9a0;color:#ffffff;' disabled/>
									  			 </div>	
									  			  <div class='btn-group' role='group'>
									  				<input name='post' class='btn btn-default' id='post' type='submit' value='Post (F11)' style='cursor:pointer;background:#e9d460;color:#ffffff;' disabled/>
									  			   </div>
									  			    <div class='btn-group ' role='group'>	
									  					<input name='pstndprnt' class='btn btn-default' id='pstndprnt' type='submit' value='Post &amp; Print' style='cursor:pointer;background:#e4f1fe;color:#44ac88;' disabled/>
		  											</div>";
													}


											?>
							  			 
  										</div>
  										
  										<br />
											<hr />
											 <?php 
											 $error=$_GET['error'];

											if($error=='dupInv'){
											 	echo "<div class='alert alert-danger' role='alert'>
											 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>Sales Invoice No. already exist.</h3>
														
														<br />

													</div>";
											 }
											if($error=='dupCM'){
											 	echo "<div class='alert alert-danger' role='alert'>
											 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>CM No. already exist.</h3>
														
														<br />

													</div>";
											 }											 
											 if($error=='ovrdue'){
											 	echo "<div class='alert alert-danger' role='alert'>
											 			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>This customer still has a balance overdue. would you like to send an approval?</h3>
														<a href='sendapproval.php?rp=$finalcode' class='btn btn-primary pull-right'>Send Approval Request</a>
														<br />

													</div>";
											 }
											 
											 if($error=='crdlmt'){
											 	echo "<div class='alert alert-danger' role='alert'>
											 	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
														<h3>This customer has exceeded the credit limit. would you like to send an approval?</h3>
														<a href='sendapproval.php?rp=$finalcode' class='btn btn-primary pull-right'>Send Approval Request</a>
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
															$DocCode=$row1['outletDocCode'];
																
																}
														}
													
													 $selectTerms = $db->query("SELECT * FROM paymentterms");
											
														$customer = $db->query("SELECT * FROM customers WHERE customer_no = '$cus_no' LIMIT 1 ");
																		$customerCount=mysqli_num_rows($customer);
																		$getTotal = $db->query("SELECT sum(total) FROM orders WHERE receipt_code='$finalcode' AND outletCode='$locCode' ");
																		while ($row1 = $getTotal->fetch_assoc()) {
																			$total = $row1['sum(total)'];
																		}
														if($customerCount==0){
															echo 
															"<div class='well'>No customer selected</div>";
															
														}else{
														while ($row = $customer->fetch_assoc()) {

															$outlet=$row['outlet'];
															$priceVat=$row['pricesIncVAT'];
															
															  $priceGroup=$row['cusPriceGroup'];

														
													if($docType==0){
														echo "
															
															<div class='col-md-6' >
																	<div class='form-group' style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left' style='position:relative;'>Order No. . . .</label>
																	    <div class='col-sm-5'>
																	    	<div class='input-group'>
																	      		<input type='text' class='form-control' name='rpcode' size='30'   value='$finalcode' readonly />
																	    	</div>
																	 	</div>
																	 </div>
																	 <div class='form-group' style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left'  style='position:relative;'>Customer No.</label>
																	    <div class='col-sm-5'>
																	    	<div class='input-group'>
																	     		 <input type='text' class='form-control' name='customer_no' size='30'   value='".$row['customer_no']."' readonly />
																	   		 </div>
																		 </div>
																	 </div>
																	 <div class='form-group'style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left'  style='position:relative;'> Name . . . . . .</label>
																	    <div class='col-sm-6'>
																	     		 <div class='input-group'>
																	      			<input type='text' class='form-control' name='customer_name' size='30'  value='".$row['name']."' readonly />
																	   			 </div>
																	 		</div>
																	 </div>
																	 
																	  <div class='form-group'style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left'  style='position:relative;'> Address . . . . . </label>
																	   		 <div class='col-sm-6'>
																	      			<div class='input-group'>
																	     				 <textarea class='form-control' name='customer_add' rows='2' cols='30' required>".$_SESSION['address']." </textarea>
																	      
																	    			</div>
																	    	</div>
																	 </div>
																	  <div class='form-group' style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left'  style='position:relative;'> Address 2 . . . </label>
																	    	<div class='col-sm-6'>
																	    		<div class='input-group'>
																	      			 <textarea class='form-control' name='customer_add2' rows='2' cols='30'  required >".$_SESSION['address2']." </textarea>
																	    		</div>
																	 		</div>
																 		</div>
													                 <div class='form-group' style='margin-bottom:8px;'>
										                              <p for='productprice' class='col-sm-4 col-form-control-label'>Price Incl. VAT . . . . .</p>
										                                 <div class='col-sm-4'>
										                                     <div class='input-group'>
										                                        	<input type='text' class='form-control' name='priceVat' value='$priceVat' readonly>
												                                </div>							    
									                                     	</div>
								                                       	</div>
																	</div>

									                               
														<div class='col-md-6'>
																 	<div class='form-group' class='form-group' style='margin-bottom:8px;'>
																    	<label class='col-sm-4 col-form-label text-left'>Document Date . . .</label>
																    	<div class='col-sm-5'>
																    			<div class='input-group'>
																    				<input name='date' type='date' class='form-control' value='".date('Y-m-d')."'  /> 
																    			</div>
																    		</div>
																    	</div>
																						      <div class='form-group'>
																							           <p for='productprice' class='col-sm-4 '>Payment Terms . . . .</p>
																							           <div class='col-sm-6'>
																							            <div class='input-group'>
																								        	<select class='form-control'>
																								        		 ";?>
																					<?php while($row1=$selectTerms->fetch_assoc()){
																							echo $terms = "<option value=".$row1['due_date_formula'].">".$row1['payment_term_description']."</option>";
																							}
																						?>
																				<?php echo"
																								        	</select>
																								    </div>
																							    </div>
																							  	
																							    
																							  </div>
																	

																 	<div class='form-group' style='margin-bottom:8px;'>
																	    <label for='reqDelDate' class='col-sm-4 col-form-label text-left'> Due Date . . . . . . . . .</label>
																	    <div class='col-sm-5'>
																	      <div class='input-group'>
																			  <input type='date' class='form-control' name='dueDate' value='$dueDate' size='21' required/>
																			  <input type='hidden' class='form-control' name='payterms' value='$payment_term'/>
																			</div>
																	    </div>
																	  </div>
															       <div class='form-group' style='margin-bottom:8px;'>
																	    <label for='reqDelDate' class='col-sm-4 col-form-label text-left'>Req. Del. Date . . . . .</label>
																	    <div class='col-sm-5'>
																	      <div class='input-group'>
																			  <input type='date' class='form-control' name='reqDelDate' value='$reqdate' size='25' required/>
																			</div>
																	    </div>
																	  </div>
																	   <div class='form-group' style='margin-bottom:8px;'>
																	    <label for='promDelDate' class='col-sm-4 col-form-label text-left'>Prom. Del. Date . . .</label>
																	    <div class='col-sm-5'>
																	      <div class='input-group'>
																			  <input type='date' class='form-control' name='promDelDate' value='$promdate' size='25' required/>
																			  
																			</div>
																	    </div>
																	  </div>
																	 <div class='form-group' style='margin-bottom:8px;'>
															    	<label for='productdetail' class='col-sm-4 col-form-label text-left'>Sales Invoice No. . . </label>
																    		<div class='col-sm-5'>
																    			<div class='input-group'>
																    	  			<input type='text' class='form-control' name='exdoccode' id='exdoccode' size='21'   value='$salesInvo' required />
																   			 	</div>
																 		</div>
																 	</div>
																	  <div class='form-group' style='margin-bottom:8px;'>
															    			<label class='col-sm-4 col-form-label text-left'>Total Amount . . .  . .</label>
															    				<div class='col-sm-5'>
															    				<div class='input-group'>
															    					<input name='linetotal' id='linetotal' class='text-right form-control' type='text' value='$total' size='25' readonly='readonly'/> 
															    					<input name='total' id='total' class='text-right form-control' type='hidden'/> 
															    					<input type='hidden' name='posted_by' value='$user_id'>
															    					</div>
															    					
															    			</div>
															    		</div>
																</div>
															 ";}	
														elseif($docType==1){
														echo "
															
															<div class='col-md-6' >
																	<div class='form-group' style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left' style='position:relative;'>Order No. . . .</label>
																	    <div class='col-sm-5'>
																	    	<div class='input-group'>
																	      		<input type='text' class='form-control' name='rpcode' size='30'   value='$finalcode' readonly />
																	    	</div>
																	 	</div>
																	 </div>
																	 <div class='form-group' style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left'  style='position:relative;'>Customer No.</label>
																	    <div class='col-sm-5'>
																	    	<div class='input-group'>
																	     		 <input type='text' class='form-control' name='customer_no' size='30'   value='".$row['customer_no']."' readonly />
																	   		 </div>
																		 </div>
																	 </div>
																	 <div class='form-group'style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left'  style='position:relative;'> Name . . . . . .</label>
																	    <div class='col-sm-6'>
																	     		 <div class='input-group'>
																	      			<input type='text' class='form-control' name='customer_name' size='30'  value='".$row['name']."' readonly />
																	   			 </div>
																	 		</div>
																	 </div>
																	 
																	  <div class='form-group'style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left'  style='position:relative;'> Address . . . . . </label>
																	   		 <div class='col-sm-6'>
																	      			<div class='input-group'>
																	     				 <textarea class='form-control' name='customer_add' rows='2' cols='30' required>".$_SESSION['address']." </textarea>
																	      
																	    			</div>
																	    	</div>
																	 </div>
																	  <div class='form-group' style='margin-bottom:8px;' >
																	    <label for='rpcode' class='col-sm-4 col-form-label text-left'  style='position:relative;'> Address 2 . . . </label>
																	    	<div class='col-sm-6'>
																	    		<div class='input-group'>
																	      			 <textarea class='form-control' name='customer_add2' rows='2' cols='30'  required >".$_SESSION['address2']." </textarea>
																	    		</div>
																	 		</div>
																 		</div>
													                 <div class='form-group' style='margin-bottom:8px;'>
										                              <p for='productprice' class='col-sm-4 col-form-control-label'>Price Incl. VAT . . . . .</p>
										                                 <div class='col-sm-4'>
										                                     <div class='input-group'>
										                                        	<input type='text' class='form-control' name='priceVat' value='$priceVat' readonly>
												                                </div>							    
									                                     	</div>
								                                       	</div>
																	</div>

									                               
														<div class='col-md-6'>
																 	<div class='form-group' class='form-group' style='margin-bottom:8px;'>
																    	<label class='col-sm-4 col-form-label text-left'>Document Date . . .</label>
																    	<div class='col-sm-5'>
																    			<div class='input-group'>
																    				<input name='date' type='date' class='form-control' value='".date('Y-m-d')."'  /> 
																    			</div>
																    		</div>
																    	</div>
																						      <div class='form-group'>
																							           <p for='productprice' class='col-sm-4 '>Payment Terms . . . .</p>
																							           <div class='col-sm-6'>
																							            <div class='input-group'>
																								        	<select class='form-control'>
																								        		 ";?>
																					<?php while($row1=$selectTerms->fetch_assoc()){
																							echo $terms = "<option value=".$row1['due_date_formula'].">".$row1['payment_term_description']."</option>";
																							}
																						?>
																				<?php echo"
																								        	</select>
																								    </div>
																							    </div>
																							  	
																							    
																							  </div>
																	

																 	<div class='form-group' style='margin-bottom:8px;'>
																	    <label for='reqDelDate' class='col-sm-4 col-form-label text-left'> Due Date . . . . . . . . .</label>
																	    <div class='col-sm-5'>
																	      <div class='input-group'>
																			  <input type='date' class='form-control' name='dueDate' value='$dueDate' size='21' required/>
																			  <input type='hidden' class='form-control' name='payterms' value='$payment_term'/>
																			</div>
																	    </div>
																	  </div>
																	 <div class='form-group' style='margin-bottom:8px;'>
															    	<label for='productdetail' class='col-sm-4 col-form-label text-left'>CM No. . . </label>
																    		<div class='col-sm-5'>
																    			<div class='input-group'>
																    	  			<input type='text' class='form-control' name='exdoccode' id='exdoccode' size='21'   value='$salesInvo' required />
																   			 	</div>
																 		</div>
																 	</div>
																	  <div class='form-group' style='margin-bottom:8px;'>
															    			<label class='col-sm-4 col-form-label text-left'>Total Amount . . .  . .</label>
															    				<div class='col-sm-5'>
															    				<div class='input-group'>
															    					<input name='linetotal' id='linetotal' class='text-right form-control' type='text' value='$total' size='25' readonly='readonly'/> 
															    					<input name='total' id='total' class='text-right form-control' type='hidden'/> 
															    					<input type='hidden' name='posted_by' value='$user_id'>
															    					</div>
															    					
															    			</div>
															    		</div>
																</div>
															 ";																
														}
																
														}
												}
												

											 ?>
											</div>
							<div class="panel panel-default">
							  <!-- Default panel contents -->
							  <div class="panel-heading">
							  	<div class="pull-right">
							  		<a href="searchItem.php" rel="facebox" id="searchitem"class="btn btn-default" style='cursor:pointer;background:#f1a9a0;color:#ffffff; position:relative;right:-2px;top:-5px;'>Search Items (F12)</a>
							  	</div>
							  	Sales Line

							  </div>				 
							  <table class="table table-condensed" cellspacing="0" cellpadding="0" id="salesLine" style="background:#dcc6e0;color:#ffffff;">
							    <?php 
							    
							  if (isset($_GET['id'])){
							    	 $pid = $_GET['id'];
							    	$curr_date = date('Y-m-d');
										
										$product = $db->query("SELECT * FROM products WHERE product_id = '$pid' ");
										while ($row1 = $product->fetch_assoc()) {
													 $pcode = $row1['product_id'];
													 $product_name = $row1['product_name'];
													  $price = $row1['price'];
										$selectPrice = $db->query("SELECT unitPrice,priceIncVat FROM salesprice WHERE  item_id ='$pid' AND salesCode='$priceGroup' AND startngDate <= '$curr_date' AND endngDate >= '$curr_date' LIMIT 1 ");
										$activePrice=mysqli_num_rows($selectPrice);
										while ($row2 = $selectPrice->fetch_assoc()) {
												    $price = $row2['unitPrice'];
												       $prodpriceVat = $row2['priceIncVat'];
												    

													if($activePrice>=1){
														  $price = $row2['unitPrice'];
														  
														  
														 
													}else{
														   $price = $row1['price'];
													}												
												}

											}
											
										}
															     ?>
							      <tr>
							    <td colspan="1">
							    	<div class="form-group" >
							    <label for="productdetail" class="col-sm-6 control-label" >Item No. </label>
							    <div class="col-sm-6">
							    	<div class="input-group">
										<p class="text-left" ><?php echo $pid; ?></p>
							      		<input type="hidden" class="form-control" name="product"  id="product" size="50" value="<?php echo $pid; ?>" style="border:0px;"    />							      		 
							    	</div>
							    	
							 	</div>
							 </div>							    
							  </td>
							    <td colspan="1">
							    	<div class="form-group">
								    		<label class="col-sm-3 col-form-label">Description</label> 
								    		<div class="col-sm-7">
								    		<div class="input-group">
								    			<p class="text-left" ><?php  echo $product_name; ?></p>
								    			<input name="PNAME" type="hidden" value="<?php  echo $product_name; ?>" style="border:0px;" readonly/>
								     				<input name="id" type="hidden" value="<?php  echo $pid; ?>" readonly/>
								      			<input name="procode" type="hidden" value="<?php echo $pcode; ?>" readonly/>  
								  			</div>
								  		</div>
								  	</div>							    	
							  	</td>
							  	 <td>
							  		<p class=text-left>Unit of Measure</p>

							  </td>	
							    <td colspan="1">
							    	<div class="form-group"><label class="col-sm-4 control-label">Price</label>
							    	<div class="col-sm-4">
							    		<div class="input-group">
							    			<label class="text-left"><?php echo number_format($price,2); ?></label>
							    		<input name="pprice" id="pprice" class="text-right" type="hidden" value="<?php echo number_format($price); ?>" style="border:0px;" readonly/>
							    		<input name="prodpriceVat" class="text-right" type="hidden" value="<?php echo $prodpriceVat; ?>" />
							    		</div>
							    	</div>
							     </div>
							  		</td>							  
							</tr>
							  <tr>
							  	<td>&nbsp;</td>
							  <td align="right" >
								  	<div class="form-group">
							    	<label for="qty" class="col-sm-4" style='position:relative;right:-345px;width:40px;'>Qty. </label>
							    	<div class='col-sm-8'>
							    		<div class='input-group'>
							    						<input name='qty' id='qty' class='form-control' style='position:relative;right:-385px;width:240px;' type='number' min='1'  onkeyup='multiply()' autofocus />
							    						</div>
							    		<?php
							    			/*if(isset($_GET['id'])){
							    				echo "";
							    			}else{
							    				echo "<div class='input-group'>
							    						<input name='qty' id='qty' class='form-control' type='number' min='1'  onkeyup='multiply()'  />
							    						</div>";	
							    			}*/
							    		?>
							    		
							  			
											
							  			</div>
							  										  			
							  		</div>							  		
							  </td>
							  <td>&nbsp;</td>
							  <td align="right" ><?php 
							  			if(isset($_GET['id'])&&isset($_SESSION['cus_no'])){
							  				echo "<input class='btn btn-default' name='submit' type='submit' value='ADD(ENTER)' style='cursor:pointer;background-color:#e4f1fe;' id='add'/>";
							  			}else{
							  				echo "<input class='btn btn-default' name='submit' type='submit' value='ADD(ENTER)' style='cursor:pointer;background-color:#e4f1fe;'   disabled='disabled'/>";
							  			}
							  			?>	</td>						  
							  </tr>
						 </table>
													      										      			
					</form>
				</div>
				<table class="table table-bordered">
									<tr>
								  		<th>Item No</th>
								  		<th>Description</th>
								  		<th class="text-right">Quantity</th>
								  		<th class="text-right">UOM</th>
								  		<th class="text-right">Unit Price</th>
								  		<th class="text-right">Net Amount</th>
		         				  		<th class="text-right">VAT %</th>
								  		<th class="text-right">VAT Amount</th>
								  		<th class="text-right">Line Amount</th>
								  		
								  		<th>Action</th>
							  		
							  		</tr>
							  		<?php
							  		 	$user = $db->query("SELECT * FROM users WHERE user_id='$user_id'");
											while ($row = $user->fetch_assoc()) {
											  $u_outlet=$row['outlet'];	
											$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
											while ($row = $outlet->fetch_assoc()) {
											  $locCode=$row['locationCode'];	
											
											}
										}
										//echo $finalcode;
										//echo $outletCode;
										//echo $_SESSION['rcpcode'];
							  	$order = $db->query("SELECT * FROM orders WHERE receipt_code='$finalcode' AND outletCode='$locCode' AND item_id <> '' AND documentType = '$docType'");

											$orderCount=mysqli_num_rows($order);

											if($orderCount==0){
													echo "<td colspan='6'>No Item ordered yet</td>";
														}
														else{
										while($row=$order->fetch_assoc()){
										$dateOrd=$row['date_ordered'];
										
										$qty=$row['quantity'];
										$price=$row['price'];
										$lineamount = $price * $qty;
							  			echo "<tr>
								  		<td class='text-left'>".$row['item_id']."</td>
								  		<td>".$row['item_description']."</td>
								  		<td class='text-right'>".number_format($row['quantity'],2)."</td>
								  		<td class='text-right'>".($row['untMsrcode'])."</td>
								  		<td class='text-right'>".number_format($row['price'],2)."</td>
								  		<td class='text-right'>".number_format($row['netAmount'],2)."</td>
								  		<td class='text-right'>".number_format($row['vatPerc'],2)."</td>
								  		<td class='text-right'>".number_format($row['vatAmount'],2)."</td>
								  		<td class='text-right'>".number_format($lineamount,2)."</td>
								  		<td><a class='btn btn-warning' href='delete.php?id=".$row['id']."'>Remove</a></td>
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
	</div>
			
</div>
</body>

<?php require 'includes/overall/overall_footer.php';?>
