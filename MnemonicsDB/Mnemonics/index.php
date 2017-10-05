<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: ../');
    }
    else{
        require 'dict.inc';
        $username = $_SESSION['username'];
        $sql_for_user1 = "SELECT `StudentID` FROM `users` WHERE `UserName` = '$username'";
        $sql_for_user_query1 = mysqli_query($dbcon, $sql_for_user1);
        $userID1 = mysqli_fetch_row($sql_for_user_query1);
        $user1 = $userID1[0];
        $sql_get_favourites_list = mysqli_query($dbcon, "SELECT * FROM `userfavourites` WHERE `StudentID` = '$user1' AND `IsFavourite` = '1'");


    }
    if(isset($_GET['id'])){
        $keyid = $_GET['id'];
        $sql = "SELECT * FROM `keywords` WHERE `KeyID` = '$keyid'";
        $sql_query = mysqli_query($dbcon, $sql);
        $row = mysqli_fetch_row($sql_query);
        $username = $_SESSION['username'];
        $sql_for_user = "SELECT `StudentID` FROM `users` WHERE `UserName` = '$username'";
        $sql_for_user_query = mysqli_query($dbcon, $sql_for_user);
        $userID = mysqli_fetch_row($sql_for_user_query);
        $user = $userID[0];
        $get_rating = mysqli_query($dbcon, "SELECT * FROM `userkeysrelation` WHERE `StudentID` = '$user' AND `KeyID` = '$keyid'");
        $get_rating_value = mysqli_fetch_row($get_rating);
        $get_fav_or_not = mysqli_query($dbcon, "SELECT * FROM `userfavourites` WHERE `StudentID` = '$user' AND `KeyID` = '$keyid'");
        $get_fav_or_not_value = mysqli_fetch_row($get_fav_or_not);

    }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="search here" name="description">
      <meta name="author" content="Aman Kathed, Rahul Shokeen, Lin Ma, Rahul Vokerla">
  <meta name="">
  <meta content="width=device-width, height=device-height,initial-scale=1.0" name="viewport">
  <title>Project</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/loginpage.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link href="semantic/dist/semantic.min.css" rel="stylesheet">
  <link href="semantic/dist/components/reset.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/components/site.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/components/grid.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/card.min.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/components/icon.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/components/button.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/components/card.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/components/label.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/components/image.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/components/reveal.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/components/dimmer.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/components/rating.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/components/transition.css" rel="stylesheet" type="text/css">
  <link href="semantic/dist/components/popup.css" rel="stylesheet" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/components/modal.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">

  </script><!-- <script type="text/javascript" src= "js/jquery-1.11.1.min.js" ></script> -->

  <script src="semantic/dist/components/popup.js" type="text/javascript">
  </script>
  <script src="semantic/dist/components/dimmer.js" type="text/javascript">
  </script>
  <script src="semantic/dist/components/rating.js" type="text/javascript">
  </script>
  <script src="semantic/dist/components/transition.js" type="text/javascript">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/components/modal.js" type="text/javascript">
  </script><!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

  <style type="text/css">
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin: 0 0 150px;
        }
        footer {

            position: absolute;
            left: 0;
            bottom: 0;
        }
  </style>
  <script type="text/javascript">
    $(document).ready(function() {
$(".ui.message").hide();



        <?php
        if(isset($_GET['id'])){
        ?>
         $('.ui.star.rating')

                        <?php
                            if($get_rating_value != NULL){
                                ?>
                                .rating('disable');
                                <?php
                            }
                            else{
                                ?>
                                .rating();
                                <?php
                            }
                        ?>

                $('.ui.heart.rating').rating();

                $("#rate").on('click',function(){
                    getRating();
                    function getRating() {
                        var rating = $('#rate').rating("get rating");
                        // alert(rating);
                        var res = ''
                        $.ajax({
                            type: "POST",
                            url: 'rate.php',
                            data: {rate:rating, word:'<?php echo $_GET['id'] ?>' },
                            success: function (data) {
                                //alert(data);
                                $('#rate')
                                .rating('disable');
                            },
                            error: function(jqXHR, text, error){
                            // Displaying if there are any errors
                              $('#result').html(error);
                            }
                        });
                    }

                });

        ;

              $("#fav").on('click',function(){
                  getfav();
                  function getfav() {

                      var fav = $('#fav').rating("get rating");
                      // alert(fav);
                      var res = ''
                      $.ajax({
                          type: "POST",
                          url: 'rate.php',
                          data: {fav:fav, word:'<?php echo $_GET['id'] ?>' },
                          success: function (data) {

                          },
                          error: function(jqXHR, text, error){
                          // Displaying if there are any errors
                            $('#result').html(error);
                          }
                      });
                  }

              });
        <?php
        }
        ?>

        $( "p" ).removeClass( "myClass yourClass" )
        $(".todelete").remove();
        $("#formID").submit(function(event) {
            $(".card").remove();
            $( ".top" ).remove();
            //to prevent normal form submition and reloading page
            event.preventDefault();
            var formDetails = $('#SearchInput').val();
            if (formDetails.length > 0) {
                $(".todelete").remove();
                $.ajax({
                    type: "POST",
                    url: 'aj.php',
                    data: {word:formDetails},
                    success: function (data) {
                        var objData = jQuery.parseJSON(data);
                        var res = "<div class=\"todelete\"><div class=\"card\"> <ul class=\"ui fluid vertical menu\">";
                        for (var link in objData)
                            res = res + "<a class=\"item\" href = \""+objData[link]+"\">"+link+"<\/a>";
                            res = res + "<\/div>";
                            $(".toappend").append(res);
                    },
                    error: function(jqXHR, text, error){
                    // Displaying if there are any errors
                      $('#result').html(error);
                    }
                });
            }
            else {
                $(".attach_top").append( "<div class=\" top\"><\/div>" );
                $(".todelete").remove();
            }
            return false;
        });
        $(".favourites").on('click', function(){
            $('#fav_modal')
            .modal('show');
        });
        $(".add_Mnemonic").on('click', function(){
            $('#add_mne_modal')
            .modal('show');
        });
        $(".change_password").on('click', function(){
            $('#change_pass_modal')
            .modal('show');
        });
        $("#add_Mnemonic").submit(function(event) {
            //to prevent normal form submition and reloading page
            event.preventDefault();
            var formDetails = $('#add_Mnemonic').serializeArray();

                $.ajax({
                    type: "POST",
                    url: 'add_mnemonic.php',
                    data: formDetails,
                    success: function (data) {
                        $("#uimessage").html(data);
                        $("#uimessage").show();
                        $('#add_mne_modal').modal('hide');

                    },
                    error: function(jqXHR, text, error){
                    // Displaying if there are any errors
                      $('#result').html(error);
                    }
                });


            return false;
        });


        $("#add_Mnemonic_text").keyup(function(){
          var mne = $('#add_Mnemonic_text').val();
          $.ajax({
            type: "POST",
            url: 'ajax_swear.php',
            data: {mnemonic:mne},
            success: function (data) {
                if (data.trim() == '') {
                  $('#swear_message').hide();
                  $('#add_mnemonic_submit').prop('disabled', false);

                }else{
                  $('#swear_message').show();
                  $('#swear_message').html(data);
                   $('#add_mnemonic_submit').prop('disabled', true);
                }

            },
            error: function(jqXHR, text, error){
            // Displaying if there are any errors
              $('#result').html(error);
            }
          });
        })




        $("#change_pass_modal_form").submit(function(event) {
            //to prevent normal form submition and reloading page
            event.preventDefault();
            var formDetails = $('#change_pass_modal_form').serializeArray();

                $.ajax({
                    type: "POST",
                    url: 'change_pass.php',
                    data: formDetails,
                    success: function (data) {

                        $("#uimessage_password").html(data);
                        $("#uimessage_password").show();
                        $('#change_pass_modal').modal('hide');

                    },
                    error: function(jqXHR, text, error){
                    // Displaying if there are any errors
                      $('#result').html(error);
                    }
                });


            return false;
        });
    });
  </script>
</head>
<body>

  <div class="attach_top">
    <div class="top">
      <!--
                this div is used so as to remove this class when searched and to append when there is no result
                -->
    </div>
  </div>

  <!-- 
    
        <nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">MnemonicsDB</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="about.html">About</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>


  -->
   <nav class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">MnemonicsDB</a>
        </div>
      <div>
         <ul class="nav navbar-nav">
          <li class="active"><a class="active item" href="." href="index.php">Home</a></li>
          <li><a class="item favourites">Favourites</a></li>
          <li><a class="item add_Mnemonic">Add Mnemonic</a></li>
          <li><a class="item change_password">Change Password</a></li>
        </ul>
      <div>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Signed in as<?php echo " ".$_SESSION["username"];?></a></li>
              <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Sign Out</a></li>
            </ul>
        </div>
      </div>
    </div>
 <div class="ui message" id="uimessage">

</div>
<div class="ui message pass" id="uimessage_password">

</div>
    <div class="column">
      <div class="ui segment">
        <form id="formID" method="post" name="formID">
          <div class="container-fluid" align="center" style="padding: 7em;">
            <h2>Search for Mnenomics</h2><br><br>
            <div>
              <input class="form-control searchbox" id="SearchInput" type="text" placeholder="Type your text over here" style="height: 50px;">
            </div>
          </div>
          <!--############
          <div class="ui transparent icon input ui fluid category search">
            <input class="form-control searchbox" id="SearchInput" placeholder="Search for..." type="text"> 
          </div>
              ############-->
        </form>
      </div>
    </div>
    <div class="column">
      <div class="toappend">
        <!--
                This div is used to append cards when a successsfull ajax request is made
                and cards are returned
                 -->
        <div class="todelete">
          <!--
                    This div will get deleted when an empty ajax request is made
                     -->
        </div>
      </div>
    </div><?php if (isset($_GET['id'])) {
                    # code...
                ?>
      <div class="column">
    <div class="ui container center aligned card" style="width: 100%; text-align: center;">
  <div class="content">
  <div class="extra content">
  <span class="right floated like">
Favorite
    <div class="ui heart rating fav" id="fav" data-rating="<?php echo $get_fav_or_not_value[3]; ?>" data-max-rating="1"></div>
    </span>
    </div>
    <div class="header"><h2> Chapter Title: <?php echo $row[1]; ?></h2></div>
    <div class="description">
      <span><h4>Concept To Remember:   </h4></span> <p><?php echo $row[2]; ?></p>
      <span><h4>Mnemonic:  </h4></span> <p><?php echo $row[3]; ?></p>
    </div>
  </div>
  <div class="extra content">
    <span class="left floated">
     Average Rating: <?php echo round($row[7], 2); ?>
    </span>
    <span class=" floated">Added by: <?php echo $row[8]; ?></span>
    <span class="right floated">
      Rate:
       <div class="ui star rating" id="rate" data-rating="<?php echo $get_rating_value[3]; ?>" data-max-rating="5"></div>
    </span>

  </div>
  <?php
        }
          ?>
      </div>
    </div>
  </div>

<div class="ui modal mnemonic" id="add_mne_modal">
  <div class="header">Add a New Mnemonic</div>
  <div class="content">
    <form class="ui form" id="add_Mnemonic">
      <div class="field">
        <label>Chapter No</label>
        <input type="number" step="0.01" name="chapter_no" placeholder="0.0" required>
      </div>
      <div class="field">
        <div class="field">
          <label>Concept to remember</label>
          <input type="text" name="concept_remember" placeholder="Concept" required>
        </div>
        <div class="field">
          <label>Mnemonic</label>
          <textarea type="text" name="mnemonic" placeholder="Mnemonic" id="add_Mnemonic_text" required></textarea>
          <small style="color: #000;" id="swear_message"></small>
        </div>
      </div>
      <div class="actions">
        <button class="ui button" id="add_mnemonic_submit" type="submit">Submit</button>
        <div class="ui cancel button">Cancel</div>
      </div>
    </form>
  </div>
</div>





  <div class="ui modal" id="fav_modal">
    <div class="header">
      Your Favourites
    </div>
    <div class="scrolling content">
<table class="ui celled table">
  <thead>
    <tr><th>Concept to Remember</th>
    <th>Mnemonic</th>

  </tr></thead>
  <tbody>
  	     <?php
          while($sql_get_favourites_list_values = mysqli_fetch_row($sql_get_favourites_list)){
            if($sql_get_favourites_list_values == NULL){
              echo "Add favorites to view.";
            }
            echo "<tr>";
            $sql_get_word_list = mysqli_query($dbcon, "SELECT `ConceptToRemember`,`Mnemonics` FROM `keywords` WHERE `KeyID` = '$sql_get_favourites_list_values[2]'");
            $sql_get_word_list_values = mysqli_fetch_row($sql_get_word_list);
            echo  "<td>".$sql_get_word_list_values[0]."</td>";
            echo  "<td>".$sql_get_word_list_values[1]."</td>";
            echo "<tr>";
          }
          ?>
  </tbody>
 </table>
    </div>
  </div>


<div class="ui modal change_pass" id="change_pass_modal">
<div class="header">Change Password</div>
<div class="content">
  <form class="ui form" id="change_pass_modal_form">
    <div class="field">
      <div class="field">
        <label>Present Password</label>
        <input type="password" name="pre_pass" placeholder="Present password" required>
      </div>
      <div class="field">
        <label>New Password</label>
        <input type="password" name="new_pass" placeholder="min 8 characters" pattern=".{8,20}" required>
        <small id="new_password_small_text">Enter a preferrend password min 8 characters</small>
      </div>
    </div>
    <div class="actions">
      <button class="ui button" type="submit">Submit</button>
      <div class="ui cancel button">Cancel</div>
    </div>
  </form>
</div>
</div>
  <style type="text/css">
    .body{
        overflow: hidden;
    }
  </style><!-- <script ref="js/bootstrap.js"></script> -->
</body>
</html>
