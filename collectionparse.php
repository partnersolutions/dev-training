<?php
if ($_POST['save']) {
	$eid = $_POST['eid'];
	$wasFound = false;
	$i = 0;
	if(!isset($_SESSION["collection_array"])|| count($_SESSION["collection_array"])<1){
		$_SESSION["collection_array"]=array(1=>array("entry_id"=>$eid, "quantity" => 1));
	}else{
		foreach ($_SESSION["collection_array"] as $eachPayment) {
			$i++;
			while(list($key,$value)=each($eachPayment)){
				if($key == "entry_id" && $value==$eid ){
					array_splice($_SESSION['collection_array'],$i-1,1, array(array("item_id"=>$pid, "quantity"=>$eachPayment['quantity']+1)));
					$wasFound = true;
				}//close if condition
			}//close while loop
		}//close foreach loop
		if($wasFound==false){
			array_push($_SESSION["collection_array"], array("item_id"=>$eid, "quantity"=>1));
		
		}
	}//close of else

}//close of if

/*
include_once 'core/database/connect.php'; 
if ($_POST['save']) {
   $checkbox = $_POST['checkbox'];
  $numSelected = count($_POST['checkbox']);
  echo $amount = $_POST['total'];
 	$i=0;
	 	foreach ($checkbox as $ch) {
	 		 $i++;
	 		$getAmount = $db->query("SELECT amount FROM customers_ledger WHERE entryID='$ch' ");
				while($row=$getAmount->fetch_assoc()){
					echo "<h2>Member $i</h2>"; 
					echo $Amount = $row['amount'];
				 
				}

				while (list($key, $value) = each ($ch)) {                                 
			        echo "$key: $value<br />"; 
			}	
				 
	 	}
	
	  }
*/	 
?>
