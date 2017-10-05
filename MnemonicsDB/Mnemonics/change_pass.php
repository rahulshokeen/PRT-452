<?php
require 'dict.inc';
session_start();
if(isset($_POST['pre_pass'])){
	$pre_pass = mysqli_real_escape_string($dbcon,$_POST['pre_pass']);
	$new_pass =  mysqli_real_escape_string($dbcon,$_POST['new_pass']);
	$user = $_SESSION['username'];
	$validate = mysqli_query($dbcon, "SELECT Password from users where UserName= '$user' ");
	if (mysqli_num_rows($validate)>0) {
		$passwd = mysqli_fetch_array($validate);
		if($pre_pass==$passwd[0]){
			$save_new = mysqli_query($dbcon, "UPDATE users SET Password = '$new_pass' WHERE UserName = '$user' AND Password = '$pre_pass'");
			if($save_new){
				echo "<div class=\"header\"> Password Successfully changed.</div>";
			}
			else{
				echo "<div class=\"header\"> Password change was Unsuccessfully. Please Try again.</div>";
			}
		}
	}else{
		echo "<div class=\"header\"> Current Password Invalid. Please Try again.</div>";
	}
}
?>
