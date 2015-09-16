<?php
require_once('manager.php');
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
            <li class="active"><a href="#">Products</a></li>
            <li><a href="contact.php">Contact</a></li>
            <div class="align-right">
            	<?php
            	if(isset($_SESSION['loginUserName'])){
            		echo '<li class="login-box"><a href="#">'.$_SESSION['loginUserName'].'</a></li>';
            	}?>
	            <li class="login-box"><a href="loginForm.php">Login</a></li><!--this line should be generated with php code, it should switch between "Login" and "Logout" depending on your status-->
	            <li class="login-box"><a href="shopcart.php">Cart</a></li><!--this line should be generated with php code and should not even be displayed unless LOGGED IN-->
            </div>
         </ul>
	  </div>

	  <div class="content-window">

	  <!-- product boxes should be generated with php code -->
	  <?php
	  	$manager = $_SESSION['manager'];
	  	$manager->openConnection();
		if (!$manager->isConnected()) {
			header("Location: home.php");
			exit(); //Kill if we cannot connect to the database
		}
		$resultSet = $manager->getProductsAll();
		for($i = 0; $i < count($resultSet); $i++){
			$product = array();
			array_push($product, $resultSet[$i]['name']);
			array_push($product, $resultSet[$i]['description']);
			array_push($product, $resultSet[$i]['price']);
			array_push($product, $resultSet[$i]['nbrInStore']);
			echo '<div class="product-box">
			<h3>'.$product[0].'</h3>

			<p class="description-title">Description:</p>
			<p class="description">'.$product[1].'</p>

			<p class="price-title">Price:</p>
			<p class="price">'.$product[2].'SEK</p>

			<p class="in-store-title">Nbr in store:</p>
			<p class="in-store">'.$product[3].'</p>

			<!-- form is also php generated from database data -->
			<form action="addtocart.php">
				<input type="submit" value="Add">
				<input type="number" name="quantity" value="1" min="1" max="'.$product[3].'">
				to cart
			</form> 
		</div>';
		}
		$manager->closeConnection();
	  ?>
		<div class="product-box">
			<h3>Product Title</h3>

			<p class="description-title">Description:</p>
			<p class="description">This product is very nice. It has capabilities and can do things. Buy it or weep.</p>

			<p class="price-title">Price:</p>
			<p class="price">200SEK</p>

			<p class="in-store-title">Nbr in store:</p>
			<p class="in-store">25</p>

			<!-- form is also php generated from database data -->
			<form action="addtocart.php">
				<input type="submit" value="Add">
				<input type="number" name="quantity" value="1" min="1" max="5">
				to cart
			</form> 
		</div>

		<div class="product-box">
			<h3>Product Title</h3>

			<p class="description-title">Description:</p>
			<p class="description">This product is very nice. It has capabilities and can do things. Buy it or weep.</p>

			<p class="price-title">Price:</p>
			<p class="price">200SEK</p>

			<p class="in-store-title">Nbr in store:</p>
			<p class="in-store">25</p>

			<!-- form is also php generated from database data -->
			<form action="addtocart.php">
				<input type="submit" value="Add">
				<input type="number" name="quantity" value="1" min="1" max="5" size="3">
				to cart
			</form> 
		</div>

	</div>
	</body>
</html>