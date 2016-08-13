<?php require 'includes/overall/overall_header.php';?>
	<div class='container-fluid'>
			<?php
				unset($_SESSION['rp']);
				unset($_SESSION['cus_no']);
				unset($_SESSION['totalamt']);
			
			?>

				<div class="row" >
					
						<?php include 'includes/side_menu.php';?>

					
					 <div class="col-xs-12 col-sm-6 col-md-10">
					
					
					 	<div class="panel panel-default" id="panel-header">
							  <!-- Default panel contents -->
							  <div class="panel-heading">
							  <form action="posted_collection_list.php" method="post" name="form1" class="form-inline pull-right">
					 			<div class="form-group " id="dateform"  >
															
															<input type="date" class="form-control" name="date1"  />
															
												</div>	
										<input type="submit" name="sort" value="Filter"/>
										
								</form>	 
							  	<p class="text-center">Collection Receipt</p>
							  	
					 	</div>
							  <!-- Table -->
							<p>
							  <div class="pull-right">
										<div class="btn-group " role="group">
											<a href="new_collection.php" class="btn btn-default" style="background:#dcc6e0;color:#ffffff;margin-right:10px;">Add New Collection</a>
										</div>
								</div>
							</p>
								<br />
								<hr />
								
							  <table class="table table-bordered table-condensed" cellspacing='0' cellpadding='0' >
							  <thead>
							  	<tr >
							  		<th class='text-left' width=15% >Coll. Rcpt. No.</th>
							  		<th class='text-left' width=15%>Document Date</th>
							  		<th class='text-left' width=15%>Customer No.</th>							  		
							  		<th class='text-left' width=15%>OR No</th>
							  		<th class='text-right' width=15%>Tendered Amount</th>
							  		
							  		<th class='text-center' width=14%>Action</th>
							  		
							  	</tr>

							  </thead>	
							
							  	
							    <?php 
							    				  // First query is just to get the total count of rows
					                  $sql = "SELECT COUNT(id) FROM collection_journ"; 
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
					                          $query="SELECT * FROM collection_journ WHERE locationID='$locCode' GROUP BY receipt_code ASC $limit";
					                          if(isset($_POST['date1'])){
											 $date1=$_POST['date1'];
											$query ="SELECT * FROM collection_journ WHERE postingDate LIKE '%$date1%' AND locationID='$locCode' GROUP BY receipt_code ASC $limit";
																   			
											}
									$collection = $db->query($query);
									$collectionCount=mysqli_num_rows($collection);
									if($collectionCount==0){
										echo 
										"<tr><td colspan='9'>You have no order posted in the store yet
										</td></tr>
										";
										
									}else{
										while ($row = $collection->fetch_assoc()) {
											 
											//$CurrRcpt=$row['receipt_code'];
											$getTotal = $db->query("SELECT SUM(amount) FROM collection_journ WHERE customerID='".$row['customerID']."' AND receipt_code='".$row['receipt_code']."'");
										while($row1=$getTotal->fetch_assoc()){
												 $yy =$row1['SUM(amount)'];
										}
											echo "<tr>
													<td class='align-left'> ".$row['receipt_code']."</td> 
													<td class='align-left'> ".$row['postingDate']."</td> 
													<td class='align-left'> ".$row['customerID']."</td> 													
													<td class='text-left'> ".$row['externalDocNo']."</td> 
													<td class='text-right'>" .number_format($yy,2)." </td> 
													<td >
													<div class='btn-group' role='group' aria-label='...' >
													
													    <a href='new_collection.php?rp=".$row['receipt_code']."' class='btn btn-default'  style='background-color:#36d7b7;'>Edit</a>														
														<a class='btn btn-danger' href='delete_collection_list.php?rp=".$row['receipt_code']."'  onclick=\"return confirm('Are you sure you want to delete this order?')\">Delete</a>
													</div>
														
														</td>
														</tr>
													 ";
												
										}
									}
								//<a href='postcollectionparse.php?rp=".$row['documentNo']."' class='btn btn-default ' style='background-color:#f1a9a0;'>Post</a>	
							     ?>
							  </table>

							</div>
							</div>
					 </div>
			</div>
	</div>
<?php require 'includes/overall/overall_footer.php';?>