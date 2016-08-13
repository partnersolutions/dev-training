<?php 
include_once 'core/database/connect.php';
  if (isset($_GET['id'])) {
         $id = $_GET['id'];
         
        $sql = "DELETE FROM selectedledger WHERE id='$id'";
        $result = $db->query($sql);
        header("location:editapplycollection.php");
     }
     
  ?>