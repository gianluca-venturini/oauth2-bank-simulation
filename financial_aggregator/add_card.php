<?php 

	require_once __DIR__.'/server.php';

	// Start the session
	session_set_cookie_params(86400, "/financial_aggregator");
	session_start();

	echo "<!DOCTYPE html>";
	echo "<html>";
	echo "<body>";

	// No bank specified
	if(!isset($_REQUEST["bank"])) {
		echo "Error: no bank specified";
		die();
	}

	$bank = $_REQUEST["bank"];
	$_SESSION["bank"] = $bank;

	if(count($db->banks->findOne(array("bank" => $bank))) == 0) {
		echo "Error: the bank is not yet supported";
	}

	$bankUrl = $db->banks->findOne(array("bank" => $bank))["authUrl"];
	header('Location: '.$bankUrl);


	echo "</body>";
	echo "</html>";
	
?>
