<?php
include_once 'core/database/connect.php';
	$pid = $_POST['productId'];
	
	$getProduct = $db->query("SELECT * FROM products WHERE product_id LIKE '%$pid%' LIMIT 5 ");
	while($row=$getProduct->fetch_array()){
		echo "<p><a href='addorder.php?id=".$row['product_id']."'>".$row['product_id']."</p>";
	}

?>