<?php
  session_start();

  include 'dict.inc';
  //include 'login.php';
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
    <meta name="author" content="Sriker">
    <meta name="">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/loginpage.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="">
    <title>Login to continue</title>
    <script type="text/javascript">
        $(document).ready(function() {
          $('#confirm').prop('disabled', true);


$('#password, #conf_password').on('keyup', function () {
  if (this.value.length< 3) {
    $('#message').html('');
    }
else{
  if ($('#password').val() == $('#conf_password').val()) {
    $('#message').html('Matching').css('color', 'green');
    $('#confirm').prop('disabled', false);
  } else {
    $('#message').html('Not Matching').css('color', 'red');
    $('#confirm').prop('disabled', true);
}
}
});

});
    </script>
     </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="form">
          <ul class="nav nav-pills">
          <li class="active col-md-4 tab">&nbsp</li>
          <br>
            <li class="col-md-4 tab">&nbsp</li>
             <li class="col-md-3 tab">&nbsp</li>

          </ul>
          <div class="tab-content">
            <div id="login" class="tab-pane fade in active ">
              <h3>Enter New Password</h3>
              <form method="POST" action="login.php" id="login_">
                <div class="form-group">
                  <label for="Password">Password</label>
                  <input type="password" class="form-control" id="password" name="new_password" aria-describedby="emailHelp" placeholder="Password" style="width: 50%">
                  <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                  <label for="password">ReType Password</label>
                  <input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="Password" style="width: 50%">
                  <small id="message"></small>
                </div>
                <button type="submit" class="btn btn-primary" id="confirm">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
}
?>