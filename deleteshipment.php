<?php 
include_once 'core/database/connect.php';
  if (isset($_GET['tcode'])) {
         $id = $_GET['tcode'];
        $sql = "DELETE FROM transferorder WHERE transorderno='$id'";
        $result = $db->query($sql);
        header("location:transfer_ship_list.php");
     }
     
  ?>