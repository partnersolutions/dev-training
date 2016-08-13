<?php 
include_once 'core/database/connect.php';
  if (isset($_POST['save'])) {
         $rpcode=$_POST['rpcode'];
       $customer_no=$_POST['customer_no'];
        $customer =$_POST['customer_name'];
        $customer_add =$_POST['customer_add'];
        $customer_add2 =$_POST['customer_add2'];  
        $exDocNum =$_POST['exdoccode']; 
        $paymentCode =$_POST['payTerm'];  
        $reqDelvDate =$_POST['reqDelDate']; 
         $proDelvDate =$_POST['promDelDate'];  
         $dueDate =$_POST['dueDate'];
        $totalretail =$_POST['totalretail'];


  
      $result2 = $db->query("UPDATE orders SET customer_address ='$customer_add',customer_address2 ='$customer_add2' ,reqDelDate='$reqDelvDate',promDelDate='$proDelvDate',dueDate='$dueDate',total='$totalretail' WHERE appliedDocNo='$rpcode'");
      mysqli_query($result2);
       header("location:returnOrder_list.php");
     }
     
  ?>