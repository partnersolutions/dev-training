<html>
<head>
	<title>TEST</title>
	<?php 
/*$cur_date = date("Y-m-d",strtotime('-1 day'));
echo $expiryDate=strtotime($cur_date);
echo time();
if($expiryDate>=time()){
echo "EXPIRED";
}*/
//check if item already exist
							//$checkcrdtlimit = $db->query("SELECT SUM(total) FROM customers_ledger WHERE customer_no='$customer_no' AND open=1");
							//while ($row4 = $checkcrdtlimit->fetch_assoc()) {
							//	 $cc= $row4['SUM(total)'];

								   
							//}
include_once 'core/database/connect.php';
	$getCusInfo = $db->query("SELECT * FROM customers WHERE customer_no='DEC008'");
			while ($row = $getCusInfo->fetch_assoc()) {
				echo $cred_limit = $row['credit_limit'];
			}
	$getCustLedger =$db->query("SELECT SUM(amount) FROM customers_ledger WHERE customerID='DEC008'");
			while ($row4 = $getCustLedger->fetch_assoc()) {
				 
				echo $cc= $row4['SUM(amount)'];



					
				 //echo $expiryDate=strtotime($dueDate);

				// if(time()>=$expiryDate){
				 //	echo "EXPIRED";
				 // }
 				/*
				  $curr_date = date('Y-m-d'); // or your date format

						// loop

						if ($dueDate <= $docDate){
						  echo "post is active";
						}
						else
						{
						   echo "post expired";
						}
						*/
				}
		if($cc>=$cred_limit){
						echo "Exceeded amount";
					}else{
						echo "POST is Active";
					}
	/*
			if($docDate>=$dDate){
						
			}elseif($cred_limit==0){
				header("location:new_order.php?error=crdlmt");	
			}else{
	
		$date = date('Y-m-d');
			*/	
?>
<script>
document.onkeydown = function(event) {
	var key_press = String.fromCharCode(event.keyCode);
	var key_code = event.keyCode;
	document.getElementById('kp').innerHTML = key_press;
    document.getElementById('kc').innerHTML = key_code;
	var status = document.getElementById('status');
	status.innerHTML = "DOWN Event Fired For : "+key_press;
	if(key_code == "123"){
		alert("F12");
	} else if(key_code == "122") {
		alert("Put script to run specific for 'F11' key here");
	} else if(key_code == "13") {
		alert("Put script to run specific for 'ENTER' key here");
	} else if(key_code == "117") {
		alert("Put script to run specific for 'F6' key here");
	}
}
document.onkeyup = function(event){
    var key_press = String.fromCharCode(event.keyCode);
	var status = document.getElementById('status');
	status.innerHTML = "UP Event Fired For : "+key_press;
}
</script>

</head>
<body>
	
<h2>Javascript Capture Keyboard Input Example</h2>
<h3>onkeydown - onkeyup</h3>
Key Pressed : <span id="kp"></span>
<br />
Key Code : <span id="kc"></span>
<p id="status">Keyboard Event Status</p>

<a id="btn" onclick="alert('It Works')">Try</a>
</body>
</html>
