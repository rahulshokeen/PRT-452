<?php
  session_start();
  include 'dict.inc';
  if(isset($_SESSION["username"])){
      header('Location: Mnemonics');
  }
  else{
  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height,initial-scale=1.0">
    <meta name="author" content="Aman Kathed, Rahul Shokeen, Lin Ma, Rahul Vokerla">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/loginpage.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>MnemonicsDB</title>

    <script type="text/javascript">
    $(document).ready(function() {
	$("#userName").keyup(function(){
		$("#username_small").html('checking...');
			if(this.value.length > 3)
			{
				$("#username_small").html('checking...');
				$.ajax({
				type : 'POST',
				url  : 'username_check.php',
				data : {username:this.value},
				success : function(data)
						  {
					         $("#username_small").html(data);
					      }
				});
				return false;
		}else{
			$("#result").html('');
		}
	});

  $("#StudentID").keyup(function(){
    $("#studentid_unique").html('checking...');
      if(this.value.length > 3)
      {
        $("#studentid_unique").html('checking...');
        $.ajax({
        type : 'POST',
        url  : 'studentid_check.php',
        data : {studentid:this.value},
        success : function(data)
              {
                   $("#studentid_unique").html(data);
                }
        });
        return false;
    }else{
      $("#result").html('');
    }
  });

  $("#userEmail").keyup(function(){
    $("#email_unique").html('checking...');
      if(this.value.length > 3)
      {
        $("#email_unique").html('checking...');
        $.ajax({
        type : 'POST',
        url  : 'email_check.php',
        data : {email:this.value},
        success : function(data)
              {
                   $("#email_unique").html(data);
                }
        });
        return false;
    }else{
      $("#result").html('');
    }
  });

    $('#signup4').prop('disabled', true);
$('#inputPassword4, #inputConfPassword4').on('keyup', function () {
	if (this.value.length< 3) {
		$('#message').html('');
		}
else{
  if ($('#inputPassword4').val() == $('#inputConfPassword4').val()) {
    $('#message').html('Matching').css('color', 'green');
    $('#signup4').prop('disabled', false);
  } else {
    $('#message').html('Not Matching').css('color', 'red');
    $('#signup4').prop('disabled', true);
}
}
});

});
    </script>

  </head>
  <body background="images/data.jpg">
    <nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">MnemonicsDB</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <!-- ########### Category #########
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Category <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Category 1-1</a></li>
          <li><a href="#">Category 1-2</a></li>
          <li><a href="#">Category 1-3</a></li>
        </ul>
      </li>
      ############## -->
      <li><a href="about.html">About</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>

    <div class="container">
      <div class="row">
        <div class="form">
          <ul class="nav nav-pills">
            <li class="active col-md-3 tab"><a data-toggle="pill" href="#login">Login</a></li>
            <li class="col-md-3 tab"><a data-toggle="pill" href="#SignUp">Sign Up</a></li>
             <li class="col-md-3 tab"><a data-toggle="pill" href="#forgot">Forgot Password</a></li>
          </ul>
          <div class="tab-content">
            <div id="login" class="tab-pane fade in active ">
              <br><br>
              <form method="POST" action="login.php" id="login_">
                <div class="form-group">
                  <label for="UserName">Username</label>
                  <input type="text" class="form-control" id="UserName" name="username" aria-describedby="emailHelp" placeholder="Enter Username">
                  <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
            <div id="SignUp" class="tab-pane fade">
              <h3>SignUp</h3>
              <form action="login.php"  method="post" id="signup_">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="userEmail" placeholder="Email" required>
                    <small id="email_unique"></small>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="userName" class="col-form-label">Username</label>
                    <input type="text" pattern=".{6,20}" required name="username" class="form-control" id="userName">
                    <small id="username_small">Enter a preferrend username min 6 characters</small>
                  </div>
               </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="password" class="col-form-label">Password</label>
                    <input pattern=".{8,20}" type="password" name="password"  class="form-control" id="inputPassword4" placeholder="Password (Min 8 Characters)" required>
                  </div>
                   <div class="form-group col-md-6">
                    <label for="password" class="col-form-label">Password</label>
                    <input pattern=".{8,20}" type="password" name="confirmpassword"  class="form-control" id="inputConfPassword4" placeholder="Confirm Password (Min 8 Characters)" required>
                    <small id="message"></small>
                  </div>
                </div>
                <div class="form-group">
                  <label for="StudentID">StudentID</label>
                  <input type="text" name="studentid" class="form-control" id="StudentID">
                  <small id="studentid_unique"></small>
                </div>
                <div class="form-group">
                  <label for="course" class="col-form-label">Course</label>
                  <input type="text" pattern="{3,20}" id="course" name="course" class="form-control" required>
                </div>
                <div class="form-group">
                </div>
                <button type="submit" class="btn btn-primary" id="signup4">Sign Up</button>
              </form>

            </div>
            <div id="forgot" class="tab-pane fade">
              <h3>Enter EmailID to recover password</h3>
              <form method="POST" action="login.php" id="forgot_">
                <div class="form-group">
                  <label for="EmailID">EmailID</label>
                  <input type="email" class="form-control" id="email" name="recover_email" aria-describedby="emailHelp" placeholder="Enter EmailID">
                  <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>

          <?php

              if(isset($_SESSION['signup'])){
              	echo $_SESSION['signup'];
              	echo "Sign Up failed try again";
              }
              if(isset($_SESSION['success'])){
              	echo $_SESSION['success'];
              	// echo "Sign Up failed try again";
              }
              if(isset($_SESSION['verified'])){
                echo "Email Successfully verified. Login to continue.";
              }
              ?>

        </div>

      </div>

    </div>

  </body>
</html>
<?php
$_SESSION= [];

session_destroy();
  }
  ?>
