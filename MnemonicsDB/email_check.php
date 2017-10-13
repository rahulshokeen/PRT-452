<?php
session_start();
require 'dict.inc';
if(isset($_POST['email'])){
	$name = $_POST['email'];
	$result_set = mysqli_query($dbcon, "SELECT `Sno` FROM `users` WHERE `Email` = '$name'");
	$num_rows = mysqli_num_rows($result_set);
	if ($num_rows>0){
		echo "email is already taken";
	}else{
		echo "email is available";
	}
}
else{
	header('Location: index.php');
}
