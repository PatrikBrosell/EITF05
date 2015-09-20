<?php
	require_once('manager.php');
	session_start();
	$manager = $_SESSION['manager'];
	$manager->openConnection();
	if (!$manager->isConnected()) {
		header("Location: index.php");
		exit(); //Kill if we cannot connect to the database
	}

	if(isset($_SESSION['cartArray'])){
		for($i = 0; $i < count($_SESSION['cartArray']); $i++){
			$id = $_SESSION['cartArray'][$i][0];
			$nbr = $_SESSION['cartArray'][$i][1];
			$manager->buyProduct($id, $nbr);
			//header("Location: index.php");
		}
		$_SESSION['receiptArray'] = $_SESSION['cartArray'];
		$_SESSION['cartArray'] = null;
		header("Location: recite.php");
	}
	else{
		header("Location: index.php");
	}
	$manager->closeConnection();
?>