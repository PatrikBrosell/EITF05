<?php
	require_once('manager.php');
	session_start();
	$_SESSION['cartArray'] = null;
	header("Location: index.php");
?>