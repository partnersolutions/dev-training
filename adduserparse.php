<?php
include_once 'core/database/connect.php';
if(isset($_POST['submit'])){
		
		 $username=$_POST['username'];
		 //$password=$_POST['password'];
		 $password=md5($_POST['password']);
		 $conf_password=$_POST['conf_password'];
		 $first_name=$_POST['first_name'];
		 $last_name=$_POST['last_name'];
		 $email=$_POST['email'];
		 $outlet=$_POST['outlet'];	
		 $access=$_POST['access'];	
	
	
	if($access==1){
		$insUser = $db->query("INSERT INTO users(username,password,first_name,last_name,email,access) VALUES ('$username','$password','$first_name','$last_name','$email','$access') ");
	mysqli_query($db, $insUser);
		 }else{
		 	$insUser = $db->query("INSERT INTO users(username,password,first_name,last_name,email,outlet,access) VALUES ('$username','$password','$first_name','$last_name','$email','$outlet','$access') ");
	mysqli_query($db, $insUser);
		 }
	header("location:users_list.php");
}
?>