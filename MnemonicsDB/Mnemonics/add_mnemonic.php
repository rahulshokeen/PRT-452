<?php
  
session_start(); 
require 'dict.inc';
if(isset($_POST['chapter_no'])){
	$chapter = mysqli_real_escape_string($dbcon, $_POST['chapter_no']);
	$concept = mysqli_real_escape_string($dbcon, $_POST['concept_remember']);
	$mnemonic = mysqli_real_escape_string($dbcon, $_POST['mnemonic']);
	$user = $_SESSION['username'];
	$rep = str_replace('.', '', $chapter);
	$rand = rand(1,1000);
	$keyID = $rep.$rand;
	$sign = "INSERT INTO `keywords` (`Sno`, `ChapterNo`, `ConceptToRemember`, `Mnemonics`, `KeyID`, `AddedBy`) VALUES (NULL, '$chapter', '$concept', '$mnemonic', '$keyID','$user' )";
	$update = mysqli_query($dbcon,$sign);
	if($update){
		echo "  <div class=\"header\"> Added: $concept</div> <p>$mnemonic</p>";
	}
	else{
		echo "Already Exists, Please try new Mnemonic";
	}
}
else{
	echo "cool";
}
