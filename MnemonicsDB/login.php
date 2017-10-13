<?php
	session_start();
	include 'dict.inc';
	function connection($dbcon){
		if(!$dbcon){
			die("Connection Not Established . TRY AGAIN AFTER SOME TIME " . mysqli_connect_error());
		}
	}

	function sendmail($email,$userName,$verifyhash){
		if (file_exists("phpmailer/PHPMailerAutoload.php")) {
				require 'phpmailer/PHPMailerAutoload.php';
		}
		else {
				echo "Please try later\n";
				header('Location: index.php');
		}
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = "mnemonicscdu@gmail.com";
		$mail->Password = "simonmoss";
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;
		$mail->SMTPDebug = 2;
		$mail->setFrom('mnemonics@test.com', 'Mnemonics');
		$mail->addAddress($email,$userName);
		$mail->Subject = 'Mnemonics Signup verificaion';
		$mail->Body = '
		Hello '.$userName.',

		Your account has been created, you can login post verification.
		------------------------
		Please click the link below to activate your account:

		http://localhost/mnemonics_v2/finalmne/project/userverify.php?email='.$email.'&hash='.$verifyhash.'
		';

		if ($mail->send()) {
			$_SESSION['username']= $username;
			$_SESSION['success'] = "Signed Up successfully. Verify EmailID to login.";
			header('Location: Mnemonics/index.php');
		} else {
			$_SESSION['success'] = "Something went wrong! Please try again later.";
			header('Location: Mnemonics/index.php');
		}

	}

	function login($dbcon){
		$name = mysqli_real_escape_string($dbcon, $_POST['username']);
		$pass = mysqli_real_escape_string($dbcon, $_POST['password']);
			$validate = "SELECT * from users WHERE UserName = '$name' limit 1";
			$exec = mysqli_query($dbcon,$validate);
			$array = mysqli_fetch_array($exec);
		if($pass==$array['Password'] && $array['Email_verified']=='1'){
			$_SESSION["username"]= "$name";
			header('Location: /project/Mnemonics/index.php');
		}else if($pass==$array['Password'] && $array['Email_verified']=='0'){
			$email = $array['Email'];
			$verifyhash= $array['VerificationHash'];
			sendmail($email,$name,$verifyhash);
			$_SESSION['success'] = "Email not verified! Please verify to login.";
			header('Location: Mnemonics/index.php');
		}else if($pass!=$array['Password']){
			$_SESSION['success'] = "Invalid Username or Password";
			header('Location: Mnemonics/index.php');
		}else {
			header('Location: index.php');
		}
	}

	function signUp($dbcon){
		$userName = mysqli_real_escape_string($dbcon, $_POST['username']);
		$password = mysqli_real_escape_string($dbcon, $_POST['password']);
		$studentid = mysqli_real_escape_string($dbcon, $_POST['studentid']);
		$email = mysqli_real_escape_string($dbcon, $_POST['email']);
		$course = mysqli_real_escape_string($dbcon, $_POST['course']);
		$verifyhash = md5($userName.rand(0,1000));
		$sign = "INSERT INTO `users` (`StudentID`, `UserName`, `Password`, `Email`, `Course`,`VerificationHash`,`Email_verified`,`LinkExpired`) VALUES ('$studentid', '$userName', '$password', '$email', '$course', '$verifyhash','0','0')";
		$update = mysqli_query($dbcon,$sign);
			if($update){
				sendmail($email,$userName,$verifyhash);
			}
			else{
				$_SESSION['signup'] = "EmailID already exists .";
				header('Location: index.php');
			}
	}


	function new_pass($dbcon){
		$password = mysqli_real_escape_string($dbcon, $_POST['new_password']);
		$studentid = $_SESSION['recovery_studentid'];
		$update_password = mysqli_query($dbcon, "UPDATE `users` SET `Password` = '$password' WHERE `StudentID` = '$studentid'");
		if($update_password){
			$_SESSION['success'] = "Password Reset Successfull!";
			header('Location: index.php');
		}else {
			$_SESSION['success'] = "Something went wrong";
			header('Location: index.php');
		}
	}

	function sendemailrecovery($email_id,$verifyhash,$studentid){
		if (file_exists("phpmailer/PHPMailerAutoload.php")) {
				require 'phpmailer/PHPMailerAutoload.php';
		}
		else {
				echo "Please try later\n";
				header('Location: index.php');
		}
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = "mnemonicscdu@gmail.com";
		$mail->Password = "simonmoss";
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;
		$mail->SMTPDebug = 2;
		$mail->setFrom('mnemonics@test.com', 'Mnemonics');
		$mail->addAddress($email_id,'');
		$mail->Subject = 'Mnemonics Password Recovery';
		$mail->Body = '
		Hello ,

		You can reset your password by clicking the link below.
		------------------------
		Reset Password :

		http://localhost/mnemonics_v2/finalmne/project/passwdrecovery.php?studentid='.$studentid.'&hash='.$verifyhash.'
		';

		if ($mail->send()){
			$_SESSION['username']= $username;
			$_SESSION['success'] = "Recovery Link has been sent.";
			header('Location: Mnemonics/index.php');
		} else {
			$_SESSION['success'] = "Something went wrong! Please try again later.";
			header('Location: Mnemonics/index.php');
		}
	}

	function sendrecoverymail($dbcon,$email_id){
		$id = mysqli_query($dbcon,"SELECT StudentID,UserName from users where Email = '$email_id' limit 1");
		if (mysqli_num_rows($id)>0) {
			$data = mysqli_fetch_array($id);
			$studentid = $data[0];
			$username = $data[1];
			$verifyhash = md5($studentid.rand(0,1000));
			$check_from_recovery = mysqli_query($dbcon,"SELECT RecoveryHash AND RecoveryTimeStamp from recovery where StudentID = '$studentid' limit 1") ;//or die(mysqli_error($dbcon));
			if (mysqli_num_rows($check_from_recovery)>0) {
				$data_arr = mysqli_fetch_array($check_from_recovery);
				$r_hash = $data_arr[0];
				$r_hash_ts = $data[1];
				$overwrite_previous_recovery_hashes = mysqli_query($dbcon,"UPDATE recovery SET PreviousRecoveryHash='$r_hash', PreviousRecoveryTimeStamp= '$r_hash_ts' where StudentID = '$studentid' ") ;//or die(mysqli_error($dbcon));
				$update_new_recovery = mysqli_query($dbcon,"UPDATE recovery SET RecoveryHash = '$verifyhash' and RecoveryTimeStamp =TIMESTAMP where StudentID = '$studentid' ") ;//or die(mysqli_error($dbcon));
				if($update_new_recovery){
					sendemailrecovery($email_id,$verifyhash,$studentid);
				}
			}else {
				$fresh_insert = mysqli_query($dbcon,"INSERT INTO recovery(StudentID,RecoveryHash)VALUES('$studentid','$verifyhash') ") ;//or die(mysqli_error($dbcon));
				if($fresh_insert){
					sendemailrecovery($email_id,$verifyhash,$studentid);
				}
			}
		}
	}

	function forgot($dbcon){
		$email = mysqli_real_escape_string($dbcon, $_POST['recover_email']);
		$verify = mysqli_query($dbcon, "SELECT `Email` FROM `users` WHERE `Email` = '$email' limit 1");// or die(mysqli_error($dbcon));
		if (!$verify) {
			die('Error: '.mysqli_error($dbcon));
		}
		if(mysqli_num_rows($verify) >0){
			$email_tosend = mysqli_fetch_array($verify);
			$email_id = $email_tosend[0];
			sendrecoverymail($dbcon,$email_id);
		}else{
			die('Error');
		}
	}


	/**********************************/
	$count = count($_POST);
	if (isset($_POST['username'])) {
	 	if($count==2){
			login($dbcon);
		}
		else{
			signUp($dbcon);
		}
	}
	if(isset($_POST['recover_email'])){
		forgot($dbcon);
	}
	if(isset($_POST['new_password'])){
		new_pass($dbcon);
	}else {
		header('Location: index.php');
	}

?>
