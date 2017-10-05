<?php
	include 'dict.inc';
	session_start();
	if($_SESSION['username']==NULL){
		header('Location: ../');
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="Results Page">
	<meta name="author" content="Sriker">
	<meta name="">
	<meta name="viewport" content="width=device-width, height=device-height,initial-scale=1.0">
	<title>Project</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/stylesheet.css"> -->
	<link rel="stylesheet" type="text/css" href="">
			<link rel="stylesheet" href= "semantic/dist/semantic.min.css" >

		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/reset.css" >
		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/site.css" >
		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/grid.css" >
		<link rel="stylesheet" type="text/css" href= "semantic/dist/card.min.css" >


		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/icon.css"  >
		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/button.css"   >
		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/card.css"  >
		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/label.css"  >
		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/image.css"  >
		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/reveal.css"  >
		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/dimmer.css"  >
		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/rating.css"  >
		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/transition.css"  >
		<link rel="stylesheet" type="text/css" href= "semantic/dist/components/popup.css"  >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- <script type="text/javascript" src= "js/jquery-1.11.1.min.js" ></script> -->
		<script type="text/javascript" src= "semantic/dist/components/popup.js" ></script>
		<script type="text/javascript" src= "semantic/dist/components/dimmer.js" ></script>
		<script type="text/javascript" src= "semantic/dist/components/rating.js" ></script>
		<script type="text/javascript" src= "semantic/dist/components/transition.js" ></script>
	<style type="text/css">
		.container {
			position: absolute;
			top: 50%;
			left:50%;
     		transform: translate(-50%,-50%);
		    display: flex;
		    justify-content: center;
		    align-items: center;
		}
	</style>
	<script type="text/javascript">

  	$(document).ready(function() {


			});
	</script>
</head>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<p class="navbar-text">Signed in as <?php echo $_SESSION['username'];?></p>
		</div>
	</nav>
	<body>
	 <!-- <div class="container ">  -->

<div class="ui centered card" style="position: center; margin-top: 10% ; width: 70%; height: auto;">
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
      <span><h4>Mnemonic:  </h4></span> <p>word</p>
    </div>
  </div>
  <div class="extra content">
    <span class="left floated">
     Average Rating: <?php echo $row[7]; ?>
    </span>
    <span class="right floated">
    	Rate:
       <div class="ui star rating" id="rate" data-rating="<?php echo $get_rating_value[3]; ?>" data-max-rating="5"></div>
    </span>

  </div>
</div>


	</body>
</html>
