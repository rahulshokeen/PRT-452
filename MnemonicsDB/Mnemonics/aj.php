
<?php
require 'dict.inc';
//echo $dbcon;
$word = $_POST['word'];
$sql = "SELECT * FROM `keywords` WHERE `ConceptToRemember` LIKE '%$word%'";
$sql_query = mysqli_query($dbcon,$sql);
// $fetchrow_comment = mysqli_fetch_row($sql_query);
// var_dump($fetchrow_comment);
//$word = array($_POST['word'], "ass", "donkey");
// $word = $fetchrow_comment;
// $row = 1;
while ($row = mysqli_fetch_row($sql_query)) {
	//give link for each word
	//echo $row[2];
	$words[$row[2]] = "?id=".$row[4];
} 
echo json_encode($words);

?>