<?php
include_once 'core/database/connect.php'; 
$id = $_GET['oid'];
$getOrder = $db->query("SELECT item_description,quantity,price FROM orders WHERE id='$id' ");
	while($row=$getOrder->fetch_array()){
  		$itemDesc=$row['item_description'];
  		$itemQuantity=$row['quantity'];
  		$itemPrice=$row['price'];
	}
	?>
<link href="css/bootstrap.min.css" rel="stylesheet">
<form class="form-horizontal" action="edititemorderparse.php" method="post" name="form1">
	<div class="container-fluid">
		<div class="form-group">
						    <label for="itemDesc" class="col-sm-3 control-label">Item Description:</label>
						    <div class="col-sm-5">
						      <input type="textarea" class="form-control" name="itemDesc" value="<?php echo $itemDesc; ?>" required >
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="itemquantity" class="col-sm-3 control-label">Quantity:</label>
						    <div class="col-sm-5">
						      <input type="number" class="form-control" min="1" name="itemquantity" value="<?php echo $itemQuantity; ?>" required/>
						      <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>"/>
						    </div>
						  </div>
						   <div class="form-group pull-right">
							   	<div class="col-sm-4">
							  		<input name="submit" class="btn btn-default btn-lg"  type="submit" value="Save" style="cursor:pointer;" />
  								</div>
  							</div>
  			</div>					
</form>
<script src='js/jquery-2.1.3.min.js'></script>
<script src="js/bootstrap.min.js"></script>	