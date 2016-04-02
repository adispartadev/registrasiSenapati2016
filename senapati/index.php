<?php
	session_start();
	include 'define.php';

	if (isset($_SESSION['login'])){
		define("LOGIN", true);
	}
	else{
		define("LOGIN", false);
	}

	include 'helpers/site.php';


	$base = base_url();
	$routes = routes($base);

	include 'config/routes.php';
	
	// sena
	// senapati2016ngxyz
