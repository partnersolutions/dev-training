<?php 
require_once 'core/database/connect.php';
$id=$_POST['id'];
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$pass=md5($_POST['password']);
$outlet=$_POST['outlet'];

if(isset($_POST['submit'])){
$updateUser=$db->query("UPDATE users SET first_name = '$fname', last_name='$lname', password='$pass',outlet='$outlet' WHERE user_id ='$id' ");
mysqli_query($db,$updateUser);
header("location:users_list.php");

}
?>