<?php
	/*
	* NOTE: This page is NOT the login input page. This is where you are taken AFTER login button was pushed.
	*/
	require_once('manager.php'); //we'll need access to this only once
	//require_once("database_connection_data.php"); //same here as above

	$loginUserName;
	$loginPassword;
	
	//($dbHost, $db, $dbUserName, $dbPassword, $loginUserName, $loginPassword)

	$loginUserName = $_REQUEST['loginUserName']; //this was sent here from a form on the previous page
	$loginPassword = $_REQUEST['loginPassword']; //this was sent here from a form on the previous page

	$manager = new Manager();
	$manager->openConnection();
	if (!$manager->isConnected()) {
		header("Location: index.php");
		exit(); //Kill if we cannot connect to the database
	}

	session_start(); //Time to start a session now
	$_SESSION['manager'] = $manager; //Let's save our manager object

	$loginUserName = $manager->cleanUserInput($loginUserName);

	if($manager->loginUser($loginUserName, $loginPassword)){ //now let's see if we can actually login
		$_SESSION['loginUserName'] = $loginUserName; //login = success, so let's store our username to display on pages
		//$_SESSION['token'] = time().$loginUserName;
		echo "login successful";
		header("Location: products.php");
	}
	else{
		echo "could not log in";
		header("Location: index.php");
	}
	//$id = $_REQUEST['palletId'];
	$manager->closeConnection(); //close connection to database, since we're done with that for now
?>