<link href="css/bootstrap.min.css" rel="stylesheet" />
<?php
include_once 'core/database/connect.php';
$id=$_GET['id'];
$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$id' ");
			while ($row = $outlet->fetch_assoc()) {
				$tocode=$row["locationCode"];
				$toname=$row["name"];
				$toadd=$row["address"];
				$toadd=$row["address"];
			}

if(isset($_POST["exDoc"]) && $_POST["exDoc"] != ""){
    
    $exDoc =  $_POST['exDoc']; 
    $sql_uname_check = $db->query("SELECT entryID FROM transferorder WHERE externaldocno LIKE '%$exDoc%' AND docType=1 LIMIT 1"); 
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

				<div class="col-md-12">
						<form class="form-horizontal" name="form" action="outletinfo_parse.php" method="post">
							<div class="page-header text-center"><h3>Outlet Information</h3>
										</div>
											<div class='form-group'>
									    <p for='vatRegNo' class='col-sm-6 col-form-label'>To Location Code . . . . . . . . . . . .</p>
									    <div class='col-sm-6'>
									      <input type='text' class='form-control' name='loccode' value='<?php echo $tocode;?>' />
									    </div>
									  </div>
					<div class='form-group'>
									    <p for='vatRegNo' class='col-sm-6 col-form-label'>To Location Name . . . . . . . . . . . .</p>
									    <div class='col-sm-6'>
									      <input type='text' class='form-control' name='tolocname' value='<?php echo $toname;?>' />
									    </div>
									  </div>
									  <div class='form-group'>
									    <p for='vatRegNo' class='col-sm-6 col-form-label'>To Location Address . . . . . . . .</p>
									    <div class='col-sm-6'>
									      <textarea class='form-control' name='tolocadd' ><?php echo $toadd; ?></textarea>
									    </div>
									  </div>
									  <div class='form-group'>
									    <p for='vatRegNo' class='col-sm-6 col-form-label'>To Location Address 2 . . . .</p>
									    <div class='col-sm-6'>
									       <textarea class='form-control' name='tolocadd2' ><?php echo $toadd; ?></textarea>
									    </div>
									  </div>
									  <div class="form-group">
											    <p for="vatRegNo" class="col-sm-6 col-form-label">Order Date . . . . . . .</p>
											    <div class="col-sm-6">
											      <input type="date" class="form-control" name="orddate" value="<?php echo date('Y-m-d');?>" />
											    </div>
											  </div>
											  <div class="form-group">
											    <p for="vatRegNo" class="col-sm-6 col-form-label">Shipment Date . . . .</p>
											    <div class="col-sm-6">
											      <input type="date" class="form-control" name="shipdate" value="<?php echo date('Y-m-d');?>" />
											    </div>
											  </div>
									  <div class='form-group'>
								 <p for='vatRegNo' class='col-sm-6 col-form-label'>External Doc. No. . . . . . . . . . . . .</p>
								 <div class='col-sm-6'>
								   <input type='text' class='form-control' name='orno' />
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