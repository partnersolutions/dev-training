<?php require 'includes/overall/overall_header.php';?>
	<div class='container-fluid'>
			<?php include 'header.php';?>
			
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3">
						<?php include 'includes/side_menu.php';?>

					</div>
					 <div class="col-md-9">
					
					
					 	<div class="panel panel-default">
							  <!-- Default panel contents -->
							  <div class="panel-heading"><h2>Approver List</h2>
							  	<a class="btn btn-primary" rel="facebox"  href="add_approver.php" name="add">Add Approver</a>
					 	
					 	
					 	</div>
					 
							  <!-- Table -->
							  <table class="table table-bordered">
							  	<tr>
							  		<th>Username</th>
							  		<th>First Name</th>
							  		<th>Last Name</th>
							  		
							  		<th>Outlet</th>
							  		
							  	</tr>
							    <?php 
							    				  // First query is just to get the total count of rows
					                  $sql = "SELECT COUNT(id) FROM "; 
					                  $query = mysql_query($sql);
					                  $row = mysql_fetch_row($query);
					                  //total row count
					                  $rows = $row[0];
					                  //Number of results we want displayed per page
					                  $page_rows=10;
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
								$users = $db->query("SELECT * FROM approval_setup ");
									$countUser=mysqli_num_rows($users);
									if($countUser==0){
										echo 
										"<tr><td colspan='9'>You have no new user yet
										</td></tr>
										";
										
									}else{
										while ($row = $users->fetch_assoc()) {
											$outlet = $db->query("SELECT * FROM outlets WHERE locationID='".$row['outletCode']."'");
											while ($row1 = $outlet->fetch_assoc()) {
												$outletName=$row1['locationCode'];
												
												}
													$approverUser = $db->query("SELECT * FROM users WHERE user_id='".$row['approverID']."' ");
													while ($row3 = $approverUser->fetch_assoc()) {
														$username=$row3['username'];
														$fname=$row3['first_name'];
														$lname=$row3['last_name'];
														$access=$row3['access'];
													}
											
											
											switch ($access){
												case '0':
													$access='Admin';
													break;
												case '1':
													$access='Approver';
													break;
													case '2':
													$access='Processor';
													break;
												default:
													$access="ERROR!";
													break;
											}
											echo "<tr>
													<td>$username</td> 
													<td>$fname</td> 
													<td>$lname</td> 
													
													<td>$outletName</td> 

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
	<?php require 'includes/overall/overall_footer.php';?>		
	</div>
