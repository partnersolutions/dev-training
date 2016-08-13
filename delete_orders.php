<?php 
include_once 'core/database/connect.php';
  if (isset($_GET['id'])) {
         $id = $_GET['id'];
        $sql = "DELETE FROM orders WHERE receipt_code='$id'";
       $result = $db->query($sql);
       header("location:order_list.php");
     }
     
  ?>