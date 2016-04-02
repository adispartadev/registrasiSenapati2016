<?php

	function base_url(){
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)).'/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = '/'.trim($uri,'/');
		return $uri;
	}

	function routes($base_url){
		$routes = array();
		$routes = explode('/', $base_url);
		$result_route = array();

		foreach ($routes as $key => $value) {
			if($value != '')
				array_push($result_route, $value);
		}
		return $result_route;
	}

	function middleware($login){
		if (!$login){
			echo "<script>location.replace('".BASE_URL."/login')</script>";
			exit();
		}
	}