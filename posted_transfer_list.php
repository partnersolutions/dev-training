<?php require 'includes/overall/overall_header.php';?>
	<div class='container-fluid'>
			<?php 

				unset($_SESSION['cus_no']);
				unset($_SESSION['salesInvoice']);
				unset($_SESSION['dueDate']);
				unset($_SESSION['reqdeldate']);
				unset($_SESSION['promdeldate']);
				unset($_SESSION['payterms']);



	$getuser = $db->query("SELECT * FROM users WHERE user_id='$user_id'");
				while ($row1 = $getuser->fetch_assoc()) {
				 
				 $users_outlet=$row1['outlet'];	
				$gettooutlet = $db->query("SELECT * FROM outlets WHERE locationID='$users_outlet'");
				while ($row2 = $gettooutlet->fetch_assoc()) {
				  $locID=$row2['locationID'];	
				  $locCode=$row2['locationCode'];	
				 	$locname=$row2['name'];	
				
				}
			}
			?>

				<div class="row" >
					
						<?php include 'includes/side_menu.php';?>

					
					 <div class="col-xs-12 col-sm-6 col-md-10">
					
					
					 	<div class="panel panel-default" id="panel-header">
							  <!-- Default panel contents -->
							  <div class="panel-heading">
							  	<form action="posted_transfer_list.php" method="post" name="form1" class="form-inline pull-right">
					 			<div class="form-group " id="dateform"  >
															
															<input type="date" class="form-control" name="date1"  />
															
												</div>	
										<input type="submit" name="sort" value="   Filter   "/>
										
								</form>	 
							  	<p class="text-center">Posted Transfer Receipt </p>
							  	
					 	</div>
<?php 
					 		if(isset($_GET['success'])){
					 			echo "<div class='alert alert-success alert-dismissible' role='alert'>
								  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								Transfer Order has been successfully posted!
								</div>";

					 		}
					 	?>
							  <table class="table table-bordered table-condensed" cellspacing='0' cellpadding='0' >
							  <thead>
							  	<tr >
							  		<th width="14%" class='text-left' >Transfer Order No.</th>
							  		<th class='text-left' >Order Date</th>
							  		<th width="13%" class='text-left' >Shipment Date</th>
							  		<th class='text-left' >From Location Code</th>
							  		<th class='text-rleft'>To Location Code</th>
							  		<th width="13%" class='text-left' >OR No.</th>
							  		<th width="15.5%" class='text-center'>Action</th>
							  		
							  	</tr>

							  </thead>	
							
							  	
							    <?php 

							   
							    				  // First query is just to get the total count of rows
					                  $sql = "SELECT COUNT(id) FROM transferentry"; 
					                  $query = mysql_query($sql);
					                  $row = mysql_fetch_row($query);
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
					                          $query = "SELECT * FROM transferentry WHERE docType=0 AND transfertocode='$locCode'   GROUP BY transorderno ASC $limit";
					                          if(isset($_POST['date1'])){
												 $date1=$_POST['date1'];
												$query ="SELECT * FROM transferentry WHERE postingDate LIKE '%$date1%' AND docType=0 AND transfertocode='$locCode'  GROUP BY transorderno ASC $limit";
																	   			
												}
								$transfer = $db->query($query);
									$date = date('Y-m-d');
									$productCount=mysqli_num_rows($transfer);
									if($productCount==0){
										echo 
										"<tr><td colspan='9'>You have no transfer posted in the store yet
										</td></tr>
										";
										
									}else{
										while ($row = $transfer->fetch_assoc()) {
										 $dd=$row['dueDate'];
										
								
											echo "<tr>
													<td class='align-left'> ".$row['transorderno']."</td> 
													<td class='align-left'> ".$row['transferorddate']."</td> 
													<td class='align-left'> ".$row['shipmentdate']."	</td> 
													<td class='align-left'> ".$row['transferfromcode']."	</td> 
													<td class='align-left'> ".$row['transfertocode']."	</td> 
													<td class='align-left'> ".$row['extrnaldocno']."	</td> 
													
													<td><div class='btn-group' role='group' aria-label='...'>
														  <a href='transfer_receipt_view.php?tcode=".$row['transorderno']."' class='btn btn-default' style='background-color:#36d7b7;'>View Order</a>
														  <a href='print_receipt_transfership.php?id=".$row['transorderno']."' class='btn btn-warning' style='background-color:#f1a9a0;'>Print RR</a>
			
														</div>
													</div>
														
														</td>
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
	<script type="text/javascript">
   
	</script>
<?php require 'includes/overall/overall_footer.php';?>