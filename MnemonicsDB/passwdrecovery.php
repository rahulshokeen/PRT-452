<?php
session_start();
include 'dict.inc';
if(isset($_GET['studentid']) && !empty($_GET['studentid']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    $studentid = mysqli_real_escape_string($dbcon,$_GET['studentid']);
    $hash = mysqli_real_escape_string($dbcon,$_GET['hash']);
    $search = mysqli_query($dbcon,"SELECT * FROM recovery WHERE StudentID='$studentid' AND RecoveryHash='$hash' AND LinkExpired='0' ") or die(mysqli_error());
    $match  = mysqli_num_rows($search);
    if($match > 0){
      $expire_link = mysqli_query($dbcon,"UPDATE recovery SET LinkExpired='1' WHERE StudentID='$studentid' AND RecoveryHash='$hash' ");
      if($expire_link){
        $_SESSION['recovery_studentid']= $studentid;
        $_SESSION['recovery_hash']= $hash;
        header('Location: new_pass.php');
      }else {
        echo "Something went worng! Try again later";
        header('Location: index.php');
      }
    }else{
    echo "Invalid URL/LINK EXPIRED";
    }
}else {
  echo "Invalid URL/LINK EXPIREDD";
}
 ?>
