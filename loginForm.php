<html>
	<head>
		<title>Login</title>
		<meta name="description" content="WebShop12">
		<meta name="author" content="SitePoint">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<div class="nav-bar">
			<ul class="nav-ul">
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="contact.php">Contact</a></li>
				<div class="align-right">
					<li class="active"><a href="#">Login</a></li>
				</div>
			</ul>
		</div>

		 <div class="content-window">
			<form action="login.php">
				<p><strong>Login</strong></p>
				Username: <input type="text" name="loginUserName" placeholder="username"><br>
				Password: <input type="password" name="loginPassword"><br>
				<input type="submit" value="Login">
			</form>
			<br>
			<form action="registeraccount.php">
				<p><strong>Register account</strong></p>
				Username: <input type="text" name="registerUserName" placeholder="username"><br>
				Password: <input type="password" name="registerPassword"><br>
				Repeat password<input type="password" name="repeatPassword"><br>
				Home address: <input type="text" name="registerHomeAddress" placeholder="home address"><br>
				<input type="submit" value="Register">
			</form>  
		</div>
	</body>
</html>