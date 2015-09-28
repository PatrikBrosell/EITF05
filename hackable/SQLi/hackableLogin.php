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

	// Om $loginUserName ar admin'-- sa kommer resten av reuqey:n kommer bli kommentar.
	// Vi behover da inte kanna till korrekt losenord. Username maste dock finnas.
	$hashedPW = md5($loginPassword);
	$result = mysql_query("SELECT * FROM `users` WHERE `userName`='$loginUserName' AND `password`='$hashedPW'");

	// mysql_query returns false on error.
	if ($result) {
		// $result should be 1 row, (one user)
		if (mysql_num_rows($result) == 1) {
			$_SESSION['loginUserName'] = $loginUserName;
			echo "login successful";
			header("Location: products.php");
		}
	}
	else {
		echo 'could not login';
	}

	$manager->closeConnection(); //close connection to database, since we're done with that for now
?>
