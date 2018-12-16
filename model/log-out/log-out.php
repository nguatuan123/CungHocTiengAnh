<?php
	session_start();
	$check = false;
	if ( isset( $_COOKIE['username']) && isset( $_COOKIE['password'] ) ){
		setcookie('username', null, -1, '/');
    	setcookie('password', null, -1, '/');
		$check = true;
	}

	if ( isset($_SESSION['username']) ) {
		unset($_SESSION['username']);
		$check = true;
	}

	if ( $check = true ) {
		header('Location: ../../');
	}
?>