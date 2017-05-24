<?php
function sec_session_start(){
	$session_name = 'sec_session_id';
	session_name($session_name);
	$httponly = isset($secure) ? $secure : isset($_SERVER['HTTPS']);

	if (ini_set('session.use_only_cookies', 1) === FALSE){
		exit();
	}

	$cookieParams =session_get_cookie_params();
	session_set_cookie_params($cookieParams['lifetime'],
		$cookieParams['path'],
		$cookieParams['domain'],
		true,
		$httponly);
	if(!isset($_SESSION)){
		session_start();
	}
	session_regenerate_id(true);
}

?>
