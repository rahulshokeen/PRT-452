<?php
require 'dict.inc';
session_start();

if(isset($_POST['fav'])){
	if($_POST['fav'] == 1){
		$isfavourite = 1;
	}
	else{
		$isfavourite = 0;
	}
	$word = $_POST['word'];
	$username = $_SESSION['username'];
	$sql_for_keyid = "SELECT `KeyID` FROM `keywords` WHERE `Sno` = '$word'";
	$sql_for_keyid_query = mysqli_query($dbcon, $sql_for_keyid);
	$keyid = mysqli_fetch_row($sql_for_keyid_query);
	$sql_for_user = "SELECT `StudentID` FROM `users` WHERE `UserName` = '$username'";
	$sql_for_user_query = mysqli_query($dbcon, $sql_for_user);
	$userID = mysqli_fetch_row($sql_for_user_query);
	$user = $userID[0];
	$uniqueEntry = $user."".$word;
	$check_if_exists = mysqli_query($dbcon, "SELECT * FROM `userfavourites` WHERE `UniqueEntry` == '$uniqueEntry");
	$check_if_exists_values = mysqli_fetch_row($check_if_exists);
	
	if($check_if_exists_values == NULL){
		$sql_users_key = "INSERT INTO `userfavourites` (`Sno`, `StudentID`, `KeyID`, `IsFavourite`, `UniqueEntry`) VALUES (NULL, '$user','$word' , '$isfavourite', '$uniqueEntry') ON DUPLICATE KEY UPDATE `IsFavourite` = VALUES(IsFavourite)";
		$sql_users_key_query = mysqli_query($dbcon, $sql_users_key);
	}
	else{
		$sql_users_key = "UPDATE `userfavourites` SET  `IsFavourite` = '$isfavourite' WHERE `UniqueEntry` = '$uniqueEntry'";
		$sql_users_key_query = mysqli_query($dbcon, $sql_users_key);
	}

}

if(isset($_POST['rate'])){
	$rating = $_POST['rate'];
	$word = $_POST['word'];
	$username = $_SESSION['username'];
	$sql_for_keyid = "SELECT `KeyID` FROM `keywords` WHERE `Sno` = '$word'";
	$sql_for_keyid_query = mysqli_query($dbcon, $sql_for_keyid);
	$keyid = mysqli_fetch_row($sql_for_keyid_query);
	$sql_for_user = "SELECT `StudentID` FROM `users` WHERE `UserName` = '$username'";
	$sql_for_user_query = mysqli_query($dbcon, $sql_for_user);
	$userID = mysqli_fetch_row($sql_for_user_query);
	$user = $userID[0];
	$uniqueEntry = $user."".$word;
	$sql_users_key = "INSERT INTO `userkeysrelation` (`Sno`, `StudentID`, `KeyID`, `RateGiven`,`UniqueEntry`) VALUES (NULL, '$user','$word' , '$rating', '$uniqueEntry') ";
	$sql_users_key_query = mysqli_query($dbcon, $sql_users_key);
	$update_rating = mysqli_query($dbcon, "UPDATE `keywords` SET `TotalRates` = `TotalRates` + '$rating', `NoRates` = `NoRates` + '1', `AvgRating` = `TotalRates`/`NoRates` WHERE `KeyID` = '$word'");

	//echo $rating."".$userID[0];
}
?>