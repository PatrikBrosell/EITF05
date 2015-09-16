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
				<li class="active"><a href="#">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="contact.php">Contact</a></li>
				<div class="align-right">
					<?php
            	if(isset($_SESSION['loginUserName'])){
            		echo '<li class="login-box"><a href="#">'.$_SESSION['loginUserName'].'</a></li>';
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
	  	<p>Text.</p>
	  </div>

	</body>
</html>