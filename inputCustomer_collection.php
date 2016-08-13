<?php 
session_start();
include_once 'core/database/connect.php';


?>
<link href="css/bootstrap.min.css" rel="stylesheet" />

	<div class="page-header">
		<h3 class="text-center">Search Customer </h3>
	</div>

<form action="addcustomerinfo_collection.php" method="post" class="form-horizontal">

	  <div class="form-group">
			    
			   	<div class="col-md-12">
			      
				     <input type="text" class="form-control" name="cus_no" onkeyup="getCustomerInfo(this.value)" placeholder="Customer No:" autocomplete="off" autofocus />
				     	
				
				    
			    </div>
			  </div>
		
	<div id="Cusresults" style="margin-right:-30px;"></div>							 
	</form>
<script src='js/jquery-2.1.3.min.js'></script>
<script type="text/javascript">
function getCustomerInfo(value){
		$.post("customerinfoSearch.php",{CustomerId:value},function(data){
						$("#Cusresults").html(data);
					});
				
	}
</script>
