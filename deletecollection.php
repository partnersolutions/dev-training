<?php 
include_once 'core/database/connect.php';
  if (isset($_GET['id'])) {
         $id = $_GET['id'];
         $rp = $_GET['rp'];
        $sql = "DELETE FROM selectedledger WHERE id='$id'";
        $result = $db->query($sql);
        $sql1 = "DELETE FROM collection_journ WHERE documentNo='$rp'";
        $result = $db->query($sql1);
        header("location:new_collection.php");
     }
     
  ?>