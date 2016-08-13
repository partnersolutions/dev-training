<?php 
include_once 'core/database/connect.php';
session_start();
if (isset($_POST['submit'])) {
	$result = $db->query("SELECT * FROM tocode");
											while($row = $result->fetch_array())
											  {
											        $fefe=$row['code']; 
											  }
				 $sasa=$fefe+1;
				$db->query("UPDATE tocode SET code = '$sasa'");
				$fgh='000'.$sasa;						
			 $finalcode=date("Y-m-$fgh").'-STO';


			 	$_SESSION['rpcode']=$finalcode;
	$loccode = $_POST['loccode'];
	$locname = $_POST['tolocname'];
	$locadd = $_POST['tolocadd'];
	$orddate = $_POST['orddate'];
	$shipdate = $_POST['shipdate'];
	$drnum = $_POST['orno'];

	
	$_SESSION['locationcode']=$loccode;		
	$_SESSION['locationname']=$locname;		
	$_SESSION['locationadd']=$locadd;		
	$_SESSION['ordDate']=$orddate;		
	$_SESSION['shipDate']=$shipdate;		
	$_SESSION['drnum']=$drnum;
	$insOrdTransfer=$db->query("INSERT INTO transferorder(docType, transorderno, transferfromcode, transferfromname, transferfromadd, transferfromadd2, transfertocode, transfertoname, transfertoadd2, transferorddate, postingdate, shipmentdate, receiptdate, extrnaldocno)
		VALUES ('$docType', '$transfrOrd', '$fromlocCode', '$frmlocname', '$frmlocadd', '$frmlocadd2','$tolocCode','$toname', '$toadd', '$trnsdate', '$postingdate', '$shipdate', '$recptdate') ");		
	header("location:transfer_ship.php");	
}

?>