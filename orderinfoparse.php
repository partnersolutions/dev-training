<?php
$totalretail = $_POST['totalretail'];
		   $evat = $_POST['evat'];
		  $payment_term = $_POST['payment_terms'];
		   if($payment_term=='15'){
		    $paymentdue=date('Y/m/d',strtotime('+15 day'));
		   }elseif($payment_term=='30'){
		   	 $paymentdue=date('Y/m/d',strtotime('+30 day'));
		   }
			 $user_id = $_SESSION['id'];
			 $rcpcode=$_SESSION['rpcode'];
			$extDocNo= $_POST['exdoccode'];
			$vatRegNo=$_POST['tin'];
			

?>