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
			<div class="center">
				<!-- product boxes should be generated with php code -->
				<?php
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
				if (!$manager->isConnected()) {
					header("Location: index.php");
					exit(); //Kill if we cannot connect to the database
				}
				$resultSet = $manager->getProductsAll();
				for($i = 0; $i < count($resultSet); $i++){
					$product = array();
					array_push($product, $resultSet[$i]['name']);
					array_push($product, $resultSet[$i]['description']);
					array_push($product, $resultSet[$i]['price']);
					array_push($product, $resultSet[$i]['nbrInStore']);
					echo '
					<div class="product-box">
						<h3 class="line-title">'.$product[0].'</h3>

						<div class="text-box blue">
							<p class="line-title">Description:</p>
							<p class="description">'.$product[1].'</p>
						</div>

						<div class="text-box green">
							<p class="line-title">Price:</p>
							<p>'.$product[2].'SEK</p>
						</div>
						
						<div class="text-box yellow">
							<p class = "line-title">Nbr in store:</p>
							<p>'.$product[3].'</p>
						</div>

						<!-- form is also php generated from database data -->
						<div class="text-box green">
							<form action="addtocart.php">
								<input type="submit" value="Add">
								<input type="number" name="quantity" value="1" min="1" max="'.$product[3].'">
								to cart
							</form> 
						</div>
					</div>';
				}
				$manager->closeConnection();
				//$_SESSION['manager'] = null;
				?>
			</div>
	  </div>
	</body>

	<footer>
		<p class="float-left">Adrian Hansson, Jan Karlsson, Patrik Brosell, Johan Brantberg</p>
		<p class="float-right">EITF05 - Grupp 12</p>
	</footer>
</html>