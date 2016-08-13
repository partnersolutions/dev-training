<html>
<head>
	<title></title>
	<?php 

include_once 'core/database/connect.php';
$rpcode=$_GET["rp"];

	$getInvoice =$db->query("SELECT * FROM posted_orders_table WHERE receipt_code='$rpcode' GROUP BY receipt_code LIMIT 1");
	while ($row=$getInvoice->fetch_array()) {
		$receipt_code = $row['receipt_code'];
		$customer_no = $row['customer_no'];
		 $customer = $row['customer_name'];
		$customer_add = $row['customer_address'];
		$customer_add2  = $row['customer_address2'];
		$paymentTerms  = $row['paymentTermCode'];
		$dueDate  = $row['dueDate'];
		$extDocNo= $row['externalDocNo'];
		$vatRegNo=$row['vatRegNo'];
		$salesInvo=$row['salesinvno'];
		$userid=$row['posted_by'];
		
	}
?>
<style type="text/css" media="print">
   <!--


    @page { size : portrait; margin:0;padding:0; }
   @page rotated { size : landscape }
   table { page : rotated }
   -->
 
</style>
<style type="text/css">
	  *{
   	margin: 0;
   	padding: 0;
   }
   p{
font-size: 0.70em;
   
   }
 
   #cusname{
   	position:relative;
   	left:105px;
   	top:97px;
   	margin-bottom: 0;
   }
   #tin{
   	position:relative;
   	left:105px;
   	top:94px;
   	margin-bottom: 0;
   }
   #address{
   	position:relative;
   	left:105px;
   	top:92px;
   	margin-bottom: 0;
   }
   #externaldoc{
   	position:relative;
   	left:100px;
   }
   #salesinvoice{
   	position:relative;
   	top: 20;
   	left:-10px;
   }
   #date{
   	position:relative;
   	top: 77;
   	left:-80px;
   	margin-bottom:0;
   }
   #payterms{
   	position:relative;
   	top: 76;
   	left:-90px;
   }
    #withoutVat{
   	position:relative;
   	top: 10;
   	margin-bottom:0;
    font-size: .97em;
   	   }
   #vat{
   	position:relative;
   	top: 10;
   	margin-bottom:0;
   	font-size: .97em;
   	   }
   #total{
   	position:relative;
   	top: 10;
   	margin-bottom:0;
   	font-size: .97em;
      }
   #orderline{
   	font-size:0.70em; 
   	position:relative;
   	top:80px; 
   	left:70px;
   	width: 650px;

   }
   #due{
    font-size:0.70em; 
   	position:absolute;
   	top:360px; 
   	left:706px;  	
   }
</style>
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="myFunction('div1')">
	<div class="container" id="printout ">
		<div class="row" >
			<div class="col-md-8" id='div1'>
				
					
						<div class="col-xs-6"> 
							
							<p class="text-left" id="cusname">  <?php echo $customer ;?></p>
							<p class="text-left" id="tin"> <?php echo $vatRegNo ;?></p>
							<p class="text-left" id="address">  <?php echo $customer_add;?></p>
							
						</div>
						<div class="col-xs-6">

							<p class="text-right" id="salesinvoice"> <?php echo $salesInvo; ?></p>
							<p class="text-right" id="date"> <?php echo date("d/m/Y");?></p>
							<p class="text-right" id="payterms"> <?php echo $paymentTerms;?></p>
						</div>
					
				
							<table id="orderline">
								<tr style="font-weight:bold; font-size:11px;" height='20'>
									<td  width="10%" class='text-left' >Product ID</td>
									<td  width="10%" class='text-right'>Quantity</td>
									<td  width="10%" class='text-right'></td>
									<td  width="40%" class='text-left'>Product Description</td>
									<td  width="10%" class='text-right'>Unit Price</td>
									<td  width="10%" class='text-right'>Amount</td>
								</tr>
								<?php
							  		$getProduct = $db->query("SELECT * FROM posted_orders_table WHERE receipt_code='$receipt_code' LIMIT 8");
									while($row=$getProduct->fetch_array()){

							  			echo "<tr height='20'>
								  		<td class='text-left'>".$row['item_id']."</td>
								  		<td class='text-right'> ".number_format($row['quantity'],2)."</td>
								  		<td class='text-right'> ".($row[''])."</td>
								  		<td class='text-left'>".$row['item_description']."</td>
								  		<td class='text-right'> ".number_format($row['price'],2)."</td>
								  		<td class='text-right'>".number_format($row['total'],2)."</td>
								  		</tr>
								  		";

							  		}
							  		?>
							  		</table>
							  		<div style="font-weight:bold" class="text-right"  id="due">
							  		<p id="withoutVat"> <?php $countRetail = $db->query("SELECT sum(total) FROM posted_orders_table WHERE receipt_code='$receipt_code' "); 
							  									while($row=$countRetail->fetch_array()){
							  										$woutVat=number_format($row['sum(total)'],2);
							  										echo $woutVat;
							  									}
							  								
							  								?></p>
							  								
							  								<p id="vat"> <?php $countRetail = $db->query("SELECT sum(total) FROM posted_orders_table WHERE receipt_code='$receipt_code' "); 
							  									while($row=$countRetail->fetch_array()){
							  										$vat=number_format($row['sum(total)']*0.12,2);
							  										echo $vat;
							  									}
							  								
							  								?></p>
							  								
							  								
							  								<p id="total"> <?php  $countRetail = $db->query("SELECT sum(total) FROM posted_orders_table WHERE receipt_code='$receipt_code' "); 
							  									while($row=$countRetail->fetch_array()){
							  										$total=$row['sum(total)'];
							  										$total+=$row['sum(total)']*0.12;
							  										echo number_format($total,2);
							  									}
							  				?></p>
							  							
							  		</div>
							  		
							
					
				</div>
		</div>

	</div>

	<script src='js/jquery-2.1.3.min.js'></script>
		<script type="text/javascript">
		function myFunction(el) {
    var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
	window.location.href = 'posted_order_list.php';
}
</script>
<script src="js/bootstrap.min.js"></script>	
</body>
</html>