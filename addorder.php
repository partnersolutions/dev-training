<?php require 'includes/overall/overall_header.php';

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
		height:105; 
		background-color:#FFFFFF;
		}
</style>
<script type="text/javascript">
function multiply(){
//compute for price
		a=Number(document.form1.qty.value);

		b=Number(document.form1.pprice.value);

		if (a>0){
				c=a*b;
				c=c.toFixed(2);
				document.form1.total.value=c;
				if (a!=0|| a=="") // some logic to determine if it is ok to go
		    {document.getElementById("xx").disabled = false;}
		  else // in case it was enabled and the user changed their mind
		    {document.getElementById("xx").disabled = true;}
		}

		}

</script>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	 <div class="container">
	 	<div class="row">
	 			<div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title">Add Item</h3>
						  </div>
						  <div class="panel-body">
						   <form class="form-horizontal" name="form1" action="additionalOrder.php" method="post">
										 
													 <div class="form-group">
													    <div class="col-sm-4 btn-group ">
													    	<a href="searchadditionalItem.php" rel="facebox" id="searchitem" class="btn btn-default" style='cursor:pointer;background:#f1a9a0;color:#ffffff;position:relative;right:-830px;top:0px;'>Search Items(F12)</a>
													    	<a href="edit_order.php?rp=<?php echo $rcode;?>" class="btn btn-default "style='cursor:pointer;background:#f1a9a0;color:#ffffff;position:relative;right:-835px;top:0px;' >Save and Continue Editing</a>
													    	</div>
													    </div>
													<table class="table table-condensed" cellspacing="0" cellpadding="0" id="salesLine" style="background:#dcc6e0;color:#ffffff;">
													 <?php 
														  $rcode=$_SESSION['rcpcode'];
													    if (isset($_GET['id'])){
													    	
													    	   $pid = $_GET['id'];
												    	$curr_date = date('Y-m-d');
													    	$getCustomerNum = $db->query("SELECT * FROM orders WHERE receipt_code='$rcode' ");
													    		while($row0=$getCustomerNum->fetch_assoc()){
													    			 $customer_no = $row0['customer_no'];
													    	}
															$grabcustomer = $db->query("SELECT * FROM customers WHERE customer_no = '$customer_no' ");
																	while ($row = $grabcustomer->fetch_assoc()) {
																		 $priceGroup=$row['cusPriceGroup'];	
																	}
																}
															
															$product = $db->query("SELECT * FROM products WHERE product_id = '$pid' ");
															while ($row1 = $product->fetch_assoc()) {
																		 $pcode = $row1['product_id'];
																		 $product_name = $row1['product_name'];
																		  $price = $row1['price'];
															$selectPrice = $db->query("SELECT unitPrice FROM salesprice WHERE  item_id ='$pid' AND salesCode='$priceGroup' AND startngDate <= '$curr_date' AND endngDate >= '$curr_date' ");
															$activePrice=mysqli_num_rows($selectPrice);
															while ($row2 = $selectPrice->fetch_assoc()) {
																	     $price = $row2['unitPrice'];
																		if($activePrice>=1){
																			  $price = $row2['unitPrice'];
																			 
																		}else{
																			   $price = $row1['price'];
																		}												
																	}

																}
											
							
															 
														?>
														<tr>

															<td>
												            <div class="form-group" >

													    		<label  class="col-sm-6 col-form-label">Item No:</label>
													    		<div class="col-sm-4">
													    			<p><?php  echo $pcode; ?></p>
													    			<input name="PNAME" type="hidden" value="<?php  echo $product_name; ?>"style="border:0px;" readonly required/>
													     			<input name="id" type="hidden" value="<?php  echo $pid; ?>" readonly/>
													      			<input name="procode" type="hidden" value="<?php  echo $pcode; ?>" readonly/>
													      			<input name="CODE" type="hidden" value="<?php  echo $rcode;  ?>" readonly/>
													      			 
													  		
													  		</div>
													  	</div>
													  </td>
													  <td>
													  		<div class="form-group">

													    		<label  class="col-sm-3 col-form-label">Description</label> 
													    		<div class="col-sm-7">
													    			<p><?php  echo $product_name; ?></p>
													    			<input name="PNAME" type="hidden" value="<?php  echo $product_name; ?>"style="border:0px;" readonly required/>
													     			
													      			 
													  		
													  		</div>
													  	</div>

													  </td>
													 <td>
							  		<label class=text-left>Unit of Measure</label>

							  </td>	
													  <td>
													<div class="form-group">
														<label class="col-sm-4 col-form-label">Price:</label>
													    	<div class="col-sm-4">
													    		<div class="input-group">
													    		<input name="pprice" id="pprice" class="text-right" type="hidden" value="<?php echo $price ?>" style="border:0px;"/>
													    		<p class="text-left"><?php echo number_format($price,2); ?></p>
													    		</div>
													    	</div>
													     </div>
													 </td>
													  </tr> 
													  <tr>
													  <td>&nbsp;</td>  
														<td>
															<div class="form-group">
							    	<label for="qty" class="col-sm-4" style='position:relative;right:-345px;width:40px;'>Qty. </label>
							    	<div class='col-sm-8'>
							    		<div class='input-group'>
													    		<div class='input-group'>
													    			<input name="qty" id="qty" class="form-control" style='position:relative;right:-385px;width:240px;' type="number" min="1"  onkeyup="multiply()"  required /></div>
													  			</div>
													  		</div>
													  	</td>
											 <td>&nbsp;</td>  		  	
										<td>			    			 
										  <div class="form-group">
										    <div class="col-sm-offset-2 col-sm-10">
										      <button type="submit" class="btn btn-default " name="submit" type="submit" id="add"  style='cursor:pointer;background-color:#e4f1fe;' id="xx" >ADD(ENTER)</button>
										    </div>
										  </div>
										</td>
										</tr>
									</table>	  
								</form>
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
							  		
							  		$getOrder = $db->query("SELECT * FROM orders WHERE receipt_code='$rcode'");
									$ordersCount=mysqli_num_rows($getOrder);
							  		if($ordersCount==0){
							  			echo "<tr><td colspan='10'>You have no order posted yet
										</td></tr>";
							  		}else{
									while($row=$getOrder->fetch_array()){
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
<script src='js/jquery-2.1.3.min.js'></script>
<script type="text/javascript">
function getProduct(value){
		$.post("addproductsSearch.php",{productId:value},function(data){
						$("#results").html(data);
					});
	}
	$(document).keydown(function(evt){
    if (evt.keyCode==123){
        evt.preventDefault();
         document.getElementById('searchitem').click();
    }
    
    if (evt.keyCode==13){
        evt.preventDefault();
         document.getElementById('add').click();
    }
});
</script>

