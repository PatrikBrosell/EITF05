<?php
	require_once('manager.php');
	session_start();
	if(isset($_SESSION['idToRemove'])){
		$idToRemove = $_SESSION['idToRemove'];
	}
	else{
		$idToRemove = "";
	}

	$manager = $_SESSION['manager'];
	$manager->openConnection();
	if (!$manager->isConnected()) {
		header("Location: index.php");
		exit(); //Kill if we cannot connect to the database
	}
?>

<html>
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
            <li><a href="contact.php">Contact</a></li>
            
            <div class="align-right">
            	<?php
            	if(isset($_SESSION['loginUserName'])){
            		echo '<li class="login-box-user"><a href="#">'.$_SESSION['loginUserName'].'</a></li>';
	           		echo '<li class="login-box"><a href="logout.php">Logout</a></li>';
	           		echo '<li class="login-box active"><a href="#">Cart</a></li>';
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
				<?php
				if(isset($_SESSION['cartArray'])){
					for($i = 0; $i < count($_SESSION['cartArray']); $i++){
						$id = $_SESSION['cartArray'][$i][0];
						$nbr = $_SESSION['cartArray'][$i][1];
						if($idToRemove != $id){
							$manager->printProductCart($id, $nbr);							
						}
						//header("Location: index.php");
					}
					//unset($_SESSION['cartArray'][$idToRemove]);
				}
				else{
					header("Location: index.php");
				}
				//var_dump($_SESSION['cartArray']);
				$manager->closeConnection();
				?>
			</div>
			<form method=post action="checkout.php">
				<input type="submit" value="Checkout">
			</form>
			<form method=post action="discardCart.php">
				<input type="submit" value="Discard cart">
			</form>
	  </div>
	</body>

	<footer>
		<p class="float-left">Adrian Hansson, Jan Karlsson, Patrik Brosell, Johan Brantberg</p>
		<p class="float-right">EITF05 - Grupp 12</p>
	</footer>
</html>