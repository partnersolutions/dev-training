<?php 
include_once 'core/database/connect.php';
session_start();
  if (isset($_SESSION['rpcode'])) {
          $id =  $_SESSION['rpcode'];
         unset($_SESSION['rpcode']);
      
      header("location:returnOrder.php?");
     }
     
  ?>