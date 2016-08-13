<?php 
session_start();
include_once 'core/database/connect.php';


?>
<link href="css/bootstrap.min.css" rel="stylesheet" />
   <style type="text/css">
   		#searchcus{
   			height: 250px;
   		}

   </style>
<div class="container-fluid" id="searchcus">
	<div class="page-header">
		<h3 class="text-center">Search Item </h3>
	</div>
<form  method="post" class="form-horizontal">
	  <div class="form-group">
		
				<div class="col-md-12">
				 	
			     		<input type="text" class="form-control" name="product"  id="product" size="50" placeholder="Product Code" onkeyup="getProduct(this.value)" autocomplete='off' />
												    
					</div>
			</div>
		 <div  id="Cusresults"></div>
										 
	</form>
</div>
<script src='js/jquery-2.1.3.min.js'></script>
<script type="text/javascript">
function getCustomer(value){
		$.post("customerSearch.php",{CustomerId:value},function(data){
						$("#Cusresults").html(data);
					});
				
	}
</script>
