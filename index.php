<?php
require_once('manager.php'); //we'll need access to this only once
//require_once("database_connection_data.php"); //same here as above
session_start(); //start this at once!
if(!isset($_SESSION['manager'])){
	$manager = new Manager();
	$manager->openConnection();
	if (!$manager->isConnected()) {
		header("Location: index.php");
		exit(); //Kill if we cannot connect to the database
	}
	$_SESSION['manager'] = $manager;
	$manager->closeConnection();
}
$manager = $_SESSION['manager'];
$manager->openConnection();
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
				<li class="active"><a href="#">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="contact.php">Contact</a></li>
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
	  	<p>Welcome to WebShop12. Please write in our excellent guestbook below!</p>

	  	<form action="guestbook.php">
			<p><strong>Guestbook Editor</strong></p>
			<input type="text" name="guestbookComment" placeholder="Your guestbook comment"><br>
			<input type="submit" value="Post Comment">
		</form>
		<?php
			$manager->readComments();
		?>
	  </div>

	</body>

		<footer>
		<p class="float-left">Adrian Hansson, Jan Karlsson, Patrik Brosell, Johan Brantberg</p>
		<p class="float-right">EITF05 - Grupp 12</p>
	</footer>
</html>