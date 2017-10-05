<?php
include 'dict.inc';
session_start();
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    $email = mysqli_real_escape_string($dbcon,$_GET['email']);
    $hash = mysqli_real_escape_string($dbcon,$_GET['hash']);
    $search = mysqli_query($dbcon,"SELECT * FROM users WHERE Email='$email' AND VerificationHash='$hash' AND Email_verified='0' AND LinkExpired='0' ") or die(mysqli_error());
    $match  = mysqli_num_rows($search);
    if($match > 0){
        $update = mysqli_query($dbcon,"UPDATE users SET Email_verified='1', LinkExpired='1' where Email= '$email' and VerificationHash= '$hash' ");
        echo $update;
        if ($update) {
            $_SESSION['verified'] = "True";
          header('Location: index.php');
        }
    }else{
    echo "Invalid URL/LINK EXPIRED";
    }
}else {
  echo "Invalid URL/LINK EXPIRED";
}
 ?>
