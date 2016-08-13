<link href="css/bootstrap.min.css" rel="stylesheet" />
<div class="col-md-12">
	<div class="page-header">
		<h1>Add User</h1>
	</div>
<form action="adduserparse.php" method="post" class="form-horizontal">
	
										  <div class="form-group">
										    <label for="inputEmail3" class="col-sm-3 control-label">Username &nbsp;&nbsp; </label>
										    <div class="col-sm-9">
										      <input type="text" class="form-control" name="username" placeholder="Username">
										    </div>
										  </div>
										  <div class="form-group">
										    <label for="inputPassword3" class="col-sm-3 control-label">Password &nbsp;&nbsp; </label>
										    <div class="col-sm-9">
										      <input type="password" class="form-control" name="password" placeholder="Password">
										    </div>
										  </div>
										  <div class="form-group">
										    <label for="inputPassword3" class="col-sm-3 control-label">Confirm Password &nbsp;&nbsp; </label>
										    <div class="col-sm-9">
										      <input type="password" class="form-control" name="conf_password" placeholder="Confirm Password">
										    </div>
										  </div>
										  <div class="form-group">
										    <label for="inputEmail3" class="col-sm-3 control-label">First Name &nbsp;&nbsp; </label>
										    <div class="col-sm-9">
										      <input type="text" class="form-control" name="first_name" placeholder="First Name">
										    </div>
										  </div>
										  <div class="form-group">
										    <label for="inputEmail3" class="col-sm-3 control-label">Last Name &nbsp;&nbsp; </label>
										    <div class="col-sm-9">
										      <input type="text" class="form-control" name="last_name" placeholder="Last Name">
										    </div>
										  </div>
						 				<div class="form-group">
										    <label for="inputEmail3" class="col-sm-3 control-label">Email &nbsp;&nbsp; </label>
										    <div class="col-sm-9">
										      <input type="email" class="form-control" name="email" placeholder="Email">
										    </div>
										  </div>
										  <div class="form-group">
											    <label class="col-sm-3 control-label">Access Level &nbsp;&nbsp;&nbsp; </label>
											    <div class="col-sm-9">
											      <select name="access" id="access" class="form-control" onchange="sortData()">
											 			<option disabled selected>Please Select</option>
											 			<option value="1">Approver</option>
											 			<option value="2">Processor</option>
											 		</select>
											    </div>
											  </div>
										      <div class="form-group" id="userOutlet">
											    <label class="col-sm-3 control-label">Outlet &nbsp;&nbsp;&nbsp; </label>
											    <div class="col-sm-9">
											      <select name="outlet" class="form-control">
											 			<option disabled selected>Please Select</option>
											 			<?php 
											 			include_once 'core/database/connect.php';
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
										      <button type="submit" class="btn btn-default" name='submit'>Register</button>
										    </div>
										  </div>
						 		</form>
</div>	
<script src='js/jquery-2.1.3.min.js'></script>
<script src="js/bootstrap.min.js"></script>	
<script type="text/javascript">
	function sortData(){
		if (document.getElementById('access').value =='1') {
				document.getElementById("userOutlet").style.display = "none";

		}else{
			document.getElementById("userOutlet").style.display = "block";
		}
	}
</script>