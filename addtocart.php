<?php
	require_once('manager.php');
	session_start();
	if(isset($_SESSION['loginUserName'])){ //must be logged in to buy stuff
		$_SESSION['manager']->addToCart($_POST["productID"], $_SESSION['manager']->cleanUserInput($_POST["productCount"]));
		header("Location: products.php");
	}
	else{ //Not logged in = you can't buy
		header("Location: index.php");
	}
?>