<?php
	require_once('manager.php'); //we'll need access to this only once
	//require_once("database_connection_data.php"); //same here as above

	session_start(); //Time to start a session now
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

	$registerUserName = $_REQUEST['registerUserName'];
	$registerPassword = $_REQUEST['registerPassword'];
	$repeatPassword = $_REQUEST['repeatPassword'];
	$registerHomeAddress = $_REQUEST['registerHomeAddress'];

	$registerUserName = $manager->cleanUserInput($registerUserName);
	$registerHomeAddress = $manager->cleanUserInput($registerHomeAddress);


	if($registerPassword == $repeatPassword){
		$result = $manager->registerUser($registerUserName, $registerPassword, $registerHomeAddress);
		if($result){
			header("Location: loginForm.php");
			echo "Please login with your new account.";
		}
		else{
			header("Location: loginForm.php");
			echo "Account already exists.";	
		}
	}
	else{
		header("Location: loginForm.php");
		echo "Password does not match.";
	}

	$manager->closeConnection(); //close connection to database, since we're done with that for now
?>