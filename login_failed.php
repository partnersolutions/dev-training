
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> LOGIN</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style-admin.css" >
</head>
<body>
	<div class='container'>
			<br />
			<br />
			<br />
			<div class="row">
				 <div class="col-md-4"></div>
				 <div class="col-md-4" >
				 	<div class="well" id="login" >
				 		<div class="page-header">
				 			<div class="alert alert-danger" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <a href="#" class="alert-link">Invalid Username and Password </a>
</div>
							<h3 class="text-center" style="color:#BDC3C7;">Login</h3>
						</div>
				 		<form name="form1" action="login_script.php" id="form" method="post">
				 			<div class="form-group">
				 				
				 			 	<input type="text" class="form-control" name="username" Placeholder="Username:" autocomplete="off">
				 			</div>
				 			<div class="form-group">
				 				
				 			 	<input type="password" class="form-control" name="password" Placeholder="Password:" >
				 			</div>
				 			<br/ >
				 			<p class="text-center">
				 			<button class="btn btn-default" type="submit">Login</button>
				 			</p>
				 		</form>
				 	</div>	
				 	
				 </div>
				 <div class="col-md-4"></div>
  				 
			</div>
			
	</div>

<script src='js/jquery-2.1.3.min.js'></script>
<script src="js/bootstrap.min.js"></script>	
</body>
</html>