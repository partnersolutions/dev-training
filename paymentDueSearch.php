<?php
include_once 'core/database/connect.php';
	 $payment_term = $_POST['paymentCode'];
	$selectPayment =$db ->query("SELECT * FROM paymentterms WHERE due_date_formula = '$payment_term' ");
	while($row = $selectPayment -> fetch_assoc()){
	 $dateFormula = "+".$row['due_date_formula']."Days";
	}
	$paymentdue=date('Y-m-d',strtotime("$dateFormula"));
	  echo "<input type='date' class='form-control' name='dueDate' value='$paymentdue' readonly/>";
								  
