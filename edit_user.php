<link href="css/bootstrap.min.css" rel="stylesheet" />
<div class="col-md-12">
	<div class="page-header">
		<h1>Edit User</h1>
	</div>
	<?php 
	$user_id = $_GET['id'];
	require_once 'core/database/connect.php';
		$users = $db->query("SELECT * FROM users WHERE user_id='$user_id' ");
		while ($row = $users->fetch_assoc()) {
			$fname=$row['first_name'];
			$lname=$row['last_name'];
			$access=$row['access'];
		}
	?>
<form action="edituserparse.php" method="post" class="form-horizontal">
	
										   <div class="form-group">
										    <label for="inputEmail3" class="col-sm-4 control-label">First Name &nbsp;&nbsp; </label>
										    <div class="col-sm-8">
										      <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo $fname; ?>">
<input type="hidden" class="form-control" name="id" placeholder="First Name" value="<?php echo $user_id;?>">
										    </div>
										  </div>
										  <div class="form-group">
										    <label for="inputEmail3" class="col-sm-4 control-label">Last Name &nbsp;&nbsp; </label>
										    <div class="col-sm-8">
										      <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo $lname; ?>">
										    </div>
										  </div>
										  <div class="form-group">
										    <label for="inputPassword3" class="col-sm-4 control-label">New Password &nbsp;&nbsp; </label>
										    <div class="col-sm-8">
										      <input type="password" class="form-control" name="password" placeholder="Password"  onchange="form.conf_password.pattern = this.value;" required />
										    </div>
										  </div>
										  <div class="form-group">
										    <label for="inputPassword3" class="col-sm-4 control-label">Confirm Password &nbsp;&nbsp; </label>
										    <div class="col-sm-8">
										      <input type="password" class="form-control" name="conf_password" placeholder="Confirm Password" required title="Please enter the same Password as above." onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
" />
										    </div>
										  </div>
										  <?php 
										  if($access==1){
										  	$stat="style='display:none;'";
										  }else{
										  	$stat="style='display:block;'";
										  }
										  ?>
										 <div class="form-group" <?php echo $stat;?>>
											    <label class="col-sm-4 control-label">Outlet &nbsp;&nbsp;&nbsp; </label>
											    <div class="col-sm-8">
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
										      <button type="submit" class="btn btn-default" name="submit">Update</button>
										    </div>
										  </div>
						 		</form>
</div>	
<script src='js/jquery-2.1.3.min.js'></script>
<script src="js/bootstrap.min.js"></script>	