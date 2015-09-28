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



	// Koden har under ska tillata oss att utfora en SQLi, det ar i alla fall tanken.

	// Stang av error reporting, mysql_query ar for gammal och dalig for php 5.5.
	error_reporting(E_ALL ^ E_DEPRECATED);

	// Connecta til ldatabasen.
	$link = mysql_connect('localhost', 'admin', 'admin');
	// Vet inte om detta verkligen behovs.
	mysql_select_db('webshop12database', $link);

	// Egentligen vill jag ha query som ar
	// SELECT * FROusers WHERE userName='$loginUserName'e' AND password='$hashedLoginPassword'
	// For da kan vi satta $loginUserName till admin'-- och resten av reuqey:n kommer bli kommentar.
	// Vi behover da inte kanna till korrekt losenord.
	$result = mysql_query("SELECT * FROM `users` WHERE `userName`='$loginUserName'");

	// mysql_query returns false on error.
	if ($result) {
		// $result should be 1 row, (one user)
		if (mysql_num_rows($result) == 1) {
			// verify the password
			if (password_verify($loginPassword, mysql_fetch_assoc($result)['password'])) {
				$_SESSION['loginUserName'] = $loginUserName;
				echo "login successful";
				header("Location: products.php");
			}
		}
	{
	else {
		echo 'could not login';
	}


//	KOMMENTERAR BORT KOD SOM FUGNERAR.
//
//	$loginUserName = $manager->cleanUserInput($loginUserName);
//
//	if($manager->loginUser($loginUserName, $loginPassword)){ //now let's see if we can actually login
//		$_SESSION['loginUserName'] = $loginUserName; //login = success, so let's store our username to display on pages
//		//$_SESSION['token'] = time().$loginUserName;
//		echo "login successful";
//		header("Location: products.php");
//	}
//	else{
//		echo "could not log in";
//		header("Location: index.php");
//	}
//	//$id = $_REQUEST['palletId'];
	$manager->closeConnection(); //close connection to database, since we're done with that for now
?>
