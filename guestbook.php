<?php
/*
* NOTE: This page is NOT the login input page. This is where you are taken AFTER login button was pushed.
*/
require_once('manager.php'); //we'll need access to this only once
//require_once("database_connection_data.php"); //same here as above

$comment = $_REQUEST['guestbookComment'];

session_start(); //start this at once!
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

	$comment = $manager->cleanUserInput($comment); //NOTE: Comment out to enable ATTACK!

	$manager->addComment($comment);

	header("Location: index.php");
	$manager->closeConnection(); //close connection to database, since we're done with that for now
?>