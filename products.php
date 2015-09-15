<!doctype html>

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
            <li><a href="index.html">Home</a></li>
            <li class="active"><a href="#">Products</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li class="login-box"><a href="login.php">Login</a></li><!--this line should be generated with php code, it should switch between "Login" and "Logout" depending on your status-->
            <li class="login-box"><a href="shopcart.php">Cart</a></li><!--this line should be generated with php code and should not even be displayed unless LOGGED IN-->
         </ul>
	  </div>

	  <div class="content-window">

	  <!-- product boxes should be generated with php code -->
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
	  </div>

	  <div class="content-window">
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