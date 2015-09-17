<?php
session_start(); //start this at once!
?>

<html lang="en">
	<head>
	  <meta charset="utf-8">

	  <title>WebShop12</title>
	  <meta name="description" content="WebShop12">
	  <meta name="author" content="SitePoint">

	  <link rel="stylesheet" href="style.css">

	  <!--[if lt IE 9]>
	  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	  <![endif]-->
	</head>

	<body>
	  <!-- <script src="js/scripts.js"></script> -->
		<div class="nav-bar">
			<ul class="nav-ul">
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li class="active"><a href="#">Contact</a></li>
				<div class="align-right">
					<?php
            	if(isset($_SESSION['loginUserName'])){
            		echo '<li class="login-box-user"><a href="#">'.$_SESSION['loginUserName'].'</a></li>';
	           		echo '<li class="login-box"><a href="logout.php">Logout</a></li>';
	           		echo '<li class="login-box"><a href="shopcart.php">Cart</a></li>';
            	}
            	else{
            		echo '<li class="login-box"><a href="loginForm.php">Login</a></li>';
            	}
            	?>
				</div>
			</ul>
		</div>

	  <div class="content-window">
	  	<h2>Who are we?</h2>
	  	<p>We are Group 12, creators of WebShop12.</p>
	  	<ul>
	  		<li>Adrian Hansson</li>
	  		<li>Jan Karlsson</li>
	  		<li>Patrik Brosell</li>
	  		<li>Johan Brantberg</li>
	  	</ul>
	  </div>

	</body>

	<footer>
		<p class="float-left">Adrian Hansson, Jan Karlsson, Patrik Brosell, Johan Brantberg</p>
		<p class="float-right">EITF05 - Grupp 12</p>
	</footer>
</html>