<?php 
include_once 'core/database/connect.php';
  if (isset($_GET['id'])) {
         $id = $_GET['id'];
        $sql = "DELETE FROM transferorder WHERE entryID='$id'";
        $result = $db->query($sql);
        header("location:transfer_ship.php");
     }
     
  ?>