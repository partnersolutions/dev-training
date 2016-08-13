<?php 
session_start();
include_once 'core/database/connect.php';
?>

<div class="container-fluid" >
	<div class="page-header">
		<h3 class="text-center">Search Customer </h3>
	</div>
<form  method="post" class="form-horizontal">
	  <div class="form-group">
					<div class="col-md-12">												     
						<input type="text" class="form-control" name="cus_no" onkeyup="getCustomer(this.value)" autocomplete="off" placeholder="Customer No/Name:" autofocus/>
						</div>
												    
				 </div>
									
			 <div id="Cusresults"></div>
										 
	</form>
</div>
<script src='js/jquery-2.1.3.min.js'></script>
<script type="text/javascript">
function getCustomer(value){
		$.post("customerSearchReturn.php",{CustomerId:value},function(data){
						$("#Cusresults").html(data);
					});
				
	}
</script>
