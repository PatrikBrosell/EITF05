<?php
	require_once('manager.php'); //we'll need access to this only once

	session_start();
	$_SESSION = array(); //_SESSION is now an empty array

	if (isset($_COOKIE[session_name()])) { 
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
	}
	session_destroy();

	header("Location: index.php");
?>