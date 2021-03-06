<?php require 'includes/overall/overall_header.php';
$_SESSION['trans_type']=0;
?>
	<div class='container-fluid'>
			
			
			<div class="container-fluid">
				<div class="row">
			
						<?php include 'includes/side_menu.php';?>

					
					 <div class="col-xs-12 col-sm-6 col-md-10">
					
					
					 	<div class="panel panel-default" id="panel-header">
							  <!-- Default panel contents -->
							  <div class="panel-heading">
							  	<form action="posted_order_list.php" method="post" name="form1" id="form1" class="form-inline pull-right">	
							  	<div class="form-group ">	
							  				<div class="input-group">
																  		
												<select name="filter" id="filter" class="form-control" onchange="sortData()">
													<option disabled selected>Please Select</option>
													<option value="customer_no">Customer Number</option>
													<option value="customer_name">Customer Name</option>
													<option value="date_ordered">Date</option>
													<option value="dueDate">Due Date</option>
													<option value="externalDocNo">External Document Number</option>
												</select>
												</div>
											</div>
											<div class="form-group " id="dateform"  style="display:none;" >
															<label>From:</label>
															<input type="date" class="form-control" name="date1"  />
															
												</div>	
												<div class="form-group " id="dateform2"  style="display:none;" >
															<label>From:</label>
															<input type="date" class="form-control" name="date2"  />
															
												</div>	
											
										<div class="form-group ">	
											<div id="search" style="display:none;">
												<input type="search" class="form-control" name="search"  required />
											</div>
											
										</div>
																  		
										<input type="submit" name="sort" value="Filter"/>
										<input type="submit" name="reset" value="Reset" />
										
										
								</form>	
							  	<p class='text-center'>
							  
							  	Posted Sales Order List</p>
					 	</div>
					 
							<?php 
					 		if(isset($_GET['success'])){
					 			echo "<div class='alert alert-success alert-dismissible' role='alert'>
								  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								  Order has been successfully posted!
								</div>";

					 		}
					 		$user = $db->query("SELECT * FROM users WHERE user_id='$user_id'");
				while ($row = $user->fetch_assoc()) {
				  $u_outlet=$row['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row = $outlet->fetch_assoc()) {
				   $locCode=$row['locationCode'];	
				
				}
			}
					 	?>
							  <table class="table table-bordered table-condensed" cellspacing='0' cellpadding='0'>
							  	<thead>
							  	<tr>
							  		<th width='110'>PSI No.</th>
							  		<th width='110'>Order No.</th>
							  		<th width='90'>Order Date</th>
							  		<th width='100'>Customer No.</th>
							  		<th width='200'>Customer Name</th>
							  		<th width='80'>Sales Invoice No.</th>
							  		<th width='80'>Payment Terms</th>
							  		<th width='90'>Due Date</th>							  		
							  		<th width='80'>Price Incl. VAT</th>
							  		<th class='text-right' width='10'>Invoice Amount</th>
							  		<th class='text-center' width='125'>Action</th>
							  	</tr>
							  	</thead>
							    <?php 
							    			  // First query is just to get the total count of rows
					                  $sql = "SELECT COUNT(id) FROM posted_orders_table WHERE documentType=0 AND status='posted'"; 
					                  $query = $db->query($sql);
					                  $row = mysqli_fetch_row($query);
					                  //total row count
					                  $rows = $row[0];
					                  //Number of results we want displayed per page
					                 $page_rows=50;
					                  //page number of our last page
					                $last = ceil($rows/$page_rows); 
					                  //this makes sure $last cannot be less than 1
					                  if($last<1){
					                      $last =1;
					                  }
					                  //Establish the $pagenum variable
					                  $pagenum = 1;
					                  //Get pagenum from URL vars if it is present, else it is equal to 1
					                  if(isset($_GET['pn'])){
					                      $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
					                  }
					                  //this makes sute the page number isn't below 1, or more than our $last page
					                  if($pagenum<1){
					                    $pagenum =1;
					                  }else if($pagenum>$last){
					                    $pagenum = $last;
					                  }
					                  //This sets the range of rows to query for the chosen $pagenum
					                  $limit = 'LIMIT '.($pagenum - 1) * $page_rows.','.$page_rows;
					                  $textline1 = "Lessons (<b>$rows</b>)";
					                   $textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
					                  //Establish the $paginationCtrls variable
					                   $paginationCtrls ='';
					                   //if there is more than 1 worth of results
					                   if($last !=1)
					                    /*First we check if we are on page one. If we are then we don't need a link to the previous page 
					                      or the first page so we do nothing. If we aren't then we generate links to the first page, and to the previous page*/
					                   {
					                      if($pagenum>1){
					                        $previous = $pagenum -1;
					                        $paginationCtrls .='<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> ';
					                        //Render clickable number links that should appear on the left of the target page number
					                        for($i=$pagenum -4;$i<$pagenum;$i++){
					                          if($i>0){
					                            $paginationCtrls .='<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> ';
					                          }
					                        }
					                      }
					                      //Render the target page number, but without it being a link
					                      $paginationCtrls .=''.$pagenum.'&nbsp;';
					                      for($i=$pagenum + 1;$i <= $last;$i++){
					                          $paginationCtrls .='<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a>';
					                        if($i>=$pagenum + 4){
					                          break;
					                        }
					                      }
					                   //This does the same as above, only checking if we are on the last page, and then generating the "NEXT"   
					                      if($pagenum !=$last){
					                        $next=$pagenum + 1;
					                        $paginationCtrls .=' <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a> ';
					                                    }
					                           }
					                          $list = '';
					                          $user_id=$_SESSION['id'];
					                          $product = "SELECT * FROM posted_orders_table WHERE documentType=0 AND outletCode='$locCode'AND item_id <> ''  GROUP BY receipt_code DESC $limit ";
					                          	
					   if(isset($_POST['sort'])){
					   			
					   	 if($_POST['filter']=="customer_no"){
					   	 	 $sortby=$_POST['search'];
					   	 	 $product = "SELECT * FROM posted_orders_table WHERE customer_no LIKE '%$sortby%' AND documentType=0 AND outletCode='$locCode'AND item_id <> ''  Group BY receipt_code DESC $limit ";
					   	 }else if($_POST['filter']=="customer_name"){
					   	 	 $sortby=$_POST['search'];
					   	 	 $product ="SELECT * FROM posted_orders_table WHERE customer_name LIKE '%$sortby%' AND documentType=0 AND outletCode='$locCode' AND item_id <> '' Group BY receipt_code DESC $limit";
					   	 }else if($_POST['filter']=="date_ordered"){
					   	 	 echo $date1=$_POST['date1'];
					   	 	 echo $date2=$_POST['date2'];
					   	 	// $product ="SELECT * FROM posted_orders_table WHERE date_ordered LIKE '%$sortby%' Order BY receipt_code DESC $limit";
					   	 }else if($_POST['filter']=="dueDate"){
							 $sortby=$_POST['search'];
							 $product ="SELECT * FROM posted_orders_table WHERE dueDate LIKE '%$sortby%' AND documentType=0 AND outletCode='$locCode'AND item_id <> ''  Group BY receipt_code DESC $limit";
					   	 }else if($_POST['filter']=="externalDocNo"){
					   	 	 $sortby=$_POST['search'];
					   	 	 $product ="SELECT * FROM posted_orders_table WHERE externalDocNo LIKE '%$sortby%' AND documentType=0 AND outletCode='$locCode' AND item_id <> '' Group BY receipt_code  DESC $limit";
					   	 }
					   }



									$query =  $db->query($product);
									$productCount=mysqli_num_rows($query);
									if($productCount==0){
										echo 
										"<tr><td colspan='9'>You have no order posted in the store yet
										</td></tr>
										";
										
									}else{
										while ($row = $query->fetch_assoc()) {
											$priceVat = $row['pricesIncVAT'];

											$result = $db->query("SELECT sum(total) FROM posted_orders_table WHERE  outletCode='$locCode' AND receipt_code='".$row['receipt_code']."'   ");
												while($row2 = $result->fetch_array())
													  {
													     $yy=$row2['sum(total)'];
														  
														  }
												switch ($priceVat) {
													case '1':
														$priceVat = 'Yes';
														break;
													
													default:
														$priceVat = 'No';
														break;
												}
											echo "<tr>
												
													<td>".$row['salesinvno']."</td> 
													<td>".$row['receipt_code']."</td> 
													<td>".$row['date_ordered']."</td> 
													<td>".$row['customer_no']."</td> 
													<td>".$row['customer_name']."</td> 
													<td>".$row['externalDocNo']."</td>
													<td>".$row['paymentTermCode']."</td> 
													<td>".$row['dueDate']."</td> 	 
													<td class='text-center'>$priceVat </td> 
													<td class='text-right'> ".number_format($yy,2)."</td> 
													<td><div class='btn-group' role='group' aria-label='...'>
														  <a href='posted_view_order.php?rp=".$row['receipt_code']."' class='btn btn-default' style='background-color:#36d7b7;'> View</a>
														  <a href='print_invoice.php?rp=".$row['receipt_code']."' class='btn btn-warning' style='background-color:#f1a9a0;'>Print</a>
			
														</div></td>
													</td>
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
	<script type="text/javascript">
		function sortData(){
		if (document.getElementById('filter').value =='customer_no') {
				document.getElementById("search").style.display = "inline";
				document.getElementById("dateform").style.display = "none";
					document.getElementById("dateform2").style.display = "none";
			
		}
		if (document.getElementById('filter').value =='customer_name') {
					document.getElementById("search").style.display = "inline";
					document.getElementById("dateform").style.display = "none";
					document.getElementById("dateform2").style.display = "none";
		}
		if (document.getElementById('filter').value =='date_ordered') {
					document.getElementById("search").style.display = "none";
					document.getElementById("dateform").style.display = "inline";
					document.getElementById("dateform2").style.display = "inline";
		}
		if (document.getElementById('filter').value =='dueDate') {
					document.getElementById("search").style.display = "inline";
					document.getElementById("dateform").style.display = "none";
					document.getElementById("dateform2").style.display = "none";
		}if (document.getElementById('filter').value =='externalDocNo') {
					document.getElementById("search").style.display = "inline";
					document.getElementById("dateform").style.display = "none";
					document.getElementById("dateform2").style.display = "none";
		}
	}
	
	</script>
<?php require 'includes/overall/overall_footer.php';?>