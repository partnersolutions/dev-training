<link href="css/bootstrap.min.css" rel="stylesheet" />
<?php
include_once 'core/database/connect.php';
echo $id=$_GET['id'];
if(isset($_POST['orddate'])){
	echo $id=$_GET['id']; 
	$recDate=$_POST['orddate'];
$_SESSION['repDate']=$recDate;
header("location:new_transfer.php?id=$id");
}

?>		

				<div class="col-md-12">
						<form class="form-horizontal" name="form" action="changeDate.php" method="post">
							<div class="page-header text-center"><h3>Change Date</h3>
										</div>
										
									  <div class="form-group">
											    <p for="vatRegNo" class="col-sm-6 col-form-label">Receipt Date . . . . . . .</p>
											    <div class="col-sm-6">
											      <input type="date" class="form-control" name="orddate" value="<?php echo date('Y-m-d');?>" />
											    </div>
											  </div>
											  
									
								<br />
								<div class='form-group text-center' style='margin-right:50px;'>
   								 <div class='col-sm-offset-2 col-sm-10'>								
									<div class='btn-group' role='group' style='position:relative;right:0px;' >	
									 <button type='submit' class='btn btn-default btn-lg' name='submit'  style='cursor:pointer;background:#e9d460;color:#ffffff;'>Submit</button>
										
										</div>
									</div>
								</div>
					</form>
				</div>
				
		
<script src='js/jquery-2.1.3.min.js'></script>
   <script src="js/bootstrap.min.js"></script>