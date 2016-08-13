<?php 
include_once 'core/database/connect.php';
$docType=$_SESSION['trans_type'];
			$chars='012345678910';
		 $salesInvNum=substr(str_shuffle($chars), 0, 20);
		 $pname=$_POST['PNAME'];
		$rpcode=$_POST['CODE'];
		$getCusInfo = $db->query("SELECT * FROM orders WHERE receipt_code='$rpcode'");
		while ($row = $getCusInfo->fetch_assoc()) {
					 $salesInvNo=$row['salesinvno'];
					 $itemID=$row['item_id'];
		  			 $customer_no=$row['customer_no'];
		  			 $customer_name=$row['customer_name'];
		  			 $customer_address=$row['address'];
		  			 $customer_address2=$row['address2'];
				 	 $dueDate=$row['dueDate'];
				 	 $extrnalDocNum=$row['externalDocNo'];
				 	$vatRegNum=$row['vatRegNo'];
					$reqDelDate=$row['reqDelDate'];
					$promDelDate=$row['promDelDate'];
					$dueDate=$row['dueDate'];
					$paymentTermCode=$row['paymentTermCode'];
				 }
		$pid=$_POST['id'];
	 	$pcode=$_POST['procode'];
		$docDate=date('Y-m-d');
		$qty=$_POST['qty'];
		$user_id=$_POST['posted_by'];
		$total=$_POST['total'];
		$price=$_POST['pprice'];
 		$user = $db->query("SELECT * FROM users WHERE user_id='$user_id'");
				while ($row = $user->fetch_assoc()) {
				  $u_outlet=$row['outlet'];	
				$outlet = $db->query("SELECT * FROM outlets WHERE locationID='$u_outlet'");
				while ($row = $outlet->fetch_assoc()) {
				   $locCode=$row['locationCode'];	
				
				}
			}
			if($priceVat==1 && $prodpriceVat==1){
	 //netUnitPrice
	  $netUnitPrice=$price/(1+(12.00/100));
	  //netAmount
	  $netAmount=$qty*$netUnitPrice;
	 //VATPerc
	  $vatPerc=12;
	 //VatAmount
	   $vatAmount = $total - $netAmount;
}elseif($priceVat==0 && $prodpriceVat==1){
	 $price=$price/(1+(12.00/100));
	//netUnitPrice
	  $netUnitPrice=$price;
	  //netAmount
	  $netAmount=$qty*$netUnitPrice;
	  //VATPerc
	  $vatPerc=0;
	 //VatAmount
	   $vatAmount = 0;

}elseif($priceVat==1 && $prodpriceVat==0){
	//netUnitPrice
	  $netUnitPrice=$price;
	  //netAmount
	  $netAmount=$qty*$netUnitPrice;
	   //VATPerc
	  $vatPerc=0;
	 //VatAmount
	   $vatAmount = 0;
}elseif($priceVat==0 && $prodpriceVat==0){
	//netUnitPrice
	  $netUnitPrice=$price;
	  //netAmount
	  $netAmount=$qty*$netUnitPrice;
	   //VATPerc
	  $vatPerc=0;
	 //VatAmount
	   $vatAmount = 0;
	 }
		 $insOrder = $db->query("INSERT INTO orders(receipt_code,item_id,item_description,quantity,price,total,date_ordered,outletCode,documentType,customer_no,customer_name,customer_address,customer_address2,vatRegNo,externalDocNo,reqDelDate,promDelDate,dueDate,pricesIncVAT,netUnitPrice,netAmount,vatPerc,vatAmount,paymentTermCode,posted_by) 
		VALUES('$rpcode','$pcode','$pname','$qty','$price','$total','$docDate','$locCode','$docType','$customer_no','$customer_name','$customer_add','$customer_add2','$vatRegNo','$extDocNo','$reqdelvDate','$promdelvDate','$paymentdue','$priceVat','$netUnitPrice','$netAmount','$vatPerc','$vatAmount','$paymentCode','$user_id')");
	mysqli_query($db, $insOrder);
	
		header("Location:addorder.php");


	/*	
	
	*/

?>