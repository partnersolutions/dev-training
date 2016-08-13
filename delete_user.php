<?php 
include_once 'core/database/connect.php';
  if (isset($_GET['id'])) {
         $id = $_GET['id'];
        $sql = "DELETE FROM users WHERE user_id='$id'";
        $result = $db->query($sql);
        header("location:users_list.php");
     }
     
  ?>