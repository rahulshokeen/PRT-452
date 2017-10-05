<?php
session_start();
require 'dict.inc';
if(isset($_POST['studentid'])){
	$id = $_POST['studentid'];
	$result_set = mysqli_query($dbcon, "SELECT * FROM `users` WHERE `StudentID` = '$id'");
	$num_rows = mysqli_num_rows($result_set);
	if ($num_rows>0){
		echo "Student ID is not available";
	}else{
		echo "Studdent ID is available";
	}
}
else{
	header('Location: index.php');
}
