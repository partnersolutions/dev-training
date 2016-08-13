<?php
require_once 'core/database/connect.php';
session_start();
if(isset($_SESSION["username"])){
	header("location:index.php");
	exit();
}
if(isset($_POST["username"]) && isset($_POST["password"])){
		  $username = preg_replace('#(A-Za-z0-9)#i', '',$_POST["username"]);
		 $password = preg_replace('#(A-Za-z0-9)#i', '',md5($_POST["password"]));


	$sql = $db->query("SELECT * FROM users WHERE username='$username' AND password = '$password' AND block=0 ");
		 $existCount = mysqli_num_rows($sql);
		if($existCount==1){
			while($row=$sql->fetch_array()){
				$id = $row['user_id'];
				$access = $row['access'];
				$outlet = $row['outlet'];
			}
			 	
			 $_SESSION['id'] = $id;
			 $_SESSION['user'] = $username;
			 $_SESSION['access'] = $access;
			 $_SESSION['outlet'] = $outlet;

			 $sql2 = $db->query("SELECT * FROM outlets WHERE locationID='$outlet'");			 
			 $existCount = mysqli_num_rows($sql2);
			 if($existCount==1){
				while($row=$sql2->fetch_array()){
					$_SESSION['outletCode'] = $row['locationCode'];
					echo $_SESSION['outletCode'];
				}
			}

			 
			header("location:index.php");
			exit();
		}else{
			header("location:login_failed.php");
			exit();
		}
	}
?>