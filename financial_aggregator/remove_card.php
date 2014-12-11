<?php 

	require_once __DIR__.'/server.php';

	// Start the session
	session_set_cookie_params(86400, "/financial_aggregator");
	session_start();

	if(!isset($_SESSION["username"])) {
		echo "Operation not authorized";
		die();
	}

	$username = $_SESSION["username"];

	$db->accounts->update(array("username" => $username), array('$unset' => array("bank" => "", "bank_token" => "", "bank_username" => "")));

	header('Location: '."./");

	
?>
