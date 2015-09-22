<?php
	require_once('manager.php');
	session_start();
	$_SESSION['idToRemove'] = $_REQUEST['productIDRemoveFromCart'];
	header ('Location: shopcart.php');
?>