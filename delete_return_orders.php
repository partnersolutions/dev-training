<?php 
include_once 'core/database/connect.php';
  if (isset($_GET['id'])) {
         echo $id = $_GET['id'];
        $sql = "DELETE FROM orders WHERE receipt_code='$id' AND documentType=1 ";
        $result = $db->query($sql);
        header("location:returnOrder_list.php");
     }
     
  ?>