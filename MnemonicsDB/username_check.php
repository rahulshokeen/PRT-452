<?php
session_start();
require 'dict.inc';
if(isset($_POST['username'])){
	$name = $_POST['username'];
	$result_set = mysqli_query($dbcon, "SELECT `Sno` FROM `users` WHERE `UserName` = '$name'");
	$num_rows = mysqli_num_rows($result_set);
	if ($num_rows>0){
		echo "username is not available";
	}else{
		echo "username is available";
	}
}
else{
	header('Location: index.php');
}
