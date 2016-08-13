<?php
			include_once 'core/database/connect.php';
				$pid = $_POST['productId'];
				
				$getProduct = $db->query("SELECT * FROM products WHERE product_id LIKE '%$pid%'  OR product_name LIKE '%$pid%' ");
				while($row=$getProduct->fetch_array()){
					$id = $row['product_id'];
					$name = $row['product_name'];
					echo "<p><a href='addorder.php?id=".$row['product_id']."'>$id - $name</p>";
				}

			?>

