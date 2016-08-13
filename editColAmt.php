<?php
include_once 'core/database/connect.php'; 
session_start();
	$id = $_GET['id'];
 $rcpcode=$_SESSION['rp'];
 $cr_remamount=$_SESSION['CR_RemAmt'];

$getledger = $db->query("SELECT * FROM selectedledger WHERE id='$id' ");
while($row = $getledger->fetch_assoc()){
	$amount = $row['amount'];
}
	?>
	<style type="text/css">
#apply{
   	position:relative;
   	left:-200px;
   	top:0px;
   	margin-bottom: 0;
   }
   	</style>
<link href="css/bootstrap.min.css" rel="stylesheet">
<form class="form-horizontal" action="updateSeledger.php" method="post" name="form1">
	<div class="container-fluid">
		<div class="page-header">
			<h4>Amount to Apply</h4>
		</div>
		<div class="form-group">
						    <label for="itemDesc" class="col-sm-5 col-form-label">Balance . . . . . . . . . . . . . .</label>
						    <div class="col-sm-5">
						      <input type="text" class="form-control" value="<?php echo number_format($cr_remamount,2); ?>" readonly >
						      <input type="hidden" class="form-control" name="CR_RemBal" value="<?php echo $cr_remamount; ?>" >
						    </div>
						  </div>
						  <div class="form-group">			
						    <label for="itemDesc" class="col-sm-5 col-form-label">Amount Due . . . . . . . . .  .</label>
						    <div class="col-sm-5">
						      <input type="text" class="form-control" value="<?php echo number_format($amount,2); ?>" readonly >
						      <input type="hidden" class="form-control" name="itemNo" value="<?php echo $amount; ?>"  >
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="itemDesc" class="col-sm-5 col-form-label">Amount to Apply . . . . . . . </label>
						    <div class="col-sm-5">
						      <input type="text" class="form-control" name="nAmt" required autocomplete="off" />
						      <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>" required  />
						    </div>
						  </div>
						     <div class="form-group pull-right">
							   	<div class="col-sm-4">
							  		<input name="submit" id='apply' class="btn btn-default btn-lg"  type="submit" value="Apply" style="cursor:pointer;" />
  								</div>
  							</div>
  			</div>					
</form>
<script src='js/jquery-2.1.3.min.js'></script>
<script src="js/bootstrap.min.js"></script>	