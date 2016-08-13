<?php 
include_once 'core/database/connect.php';
  if (isset($_GET['rp'])) {
        
          $rp = $_GET['rp'];

        $sql0 = "DELETE FROM collection_journ WHERE receipt_code='$rp'";
        $result = $db->query($sql0);
        header("location:collection_list.php");
       
     }
     
  ?>