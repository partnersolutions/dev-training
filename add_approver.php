<?php include_once 'core/database/connect.php';?>
<link href="css/bootstrap.min.css" rel="stylesheet" />
<div class="col-md-12">
	<div class="page-header">
		<h1>Add User</h1>
	</div>
<form action="addapproverparse.php" method="post" class="form-horizontal">
	
										  <div class="form-group">
										    <label for="inputEmail3" class="col-sm-3 control-label">Username &nbsp;&nbsp; </label>
										    <div class="col-sm-9">
										       <select name="username" class="form-control">
											 			<option disabled selected>Please Select</option>
											 			<?php 
											 			
											 			$outlet = $db->query("SELECT * FROM users WHERE access=1");
															while ($row1 = $outlet->fetch_assoc()) {
																echo "<option value=".$row1['user_id'].">".$row1['username']."</option>";
															}
											 			?>
											 		</select>
										    </div>
										  </div> 
										      <div class="form-group">
											    <label class="col-sm-3 control-label">Outlet &nbsp;&nbsp;&nbsp; </label>
											    <div class="col-sm-9">
											      <select name="outlet" class="form-control">
											 			<option disabled selected>Please Select</option>
											 			<?php 
											 			
											 			$outlet = $db->query("SELECT * FROM outlets");
															while ($row1 = $outlet->fetch_assoc()) {
																echo "<option value=".$row1['locationID'].">".$row1['locationCode']."</option>";
															}
											 			?>
											 		</select>
											    </div>
											  </div>

										  <div class="form-group">
										    <div class="col-sm-offset-2 col-sm-10">
										      <button type="submit" class="btn btn-default" name='submit'>Add</button>
										    </div>
										  </div>
						 		</form>
</div>	
<script src='js/jquery-2.1.3.min.js'></script>
<script src="js/bootstrap.min.js"></script>	