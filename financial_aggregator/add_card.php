<?php 

	require_once __DIR__.'/server.php';

	// Start the session
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

	if(count($db->banks->findOne(array("bank" => $bank))) == 0) {
		echo "Error: the bank is not yet supported";
	}

	$bankUrl = $db->banks->findOne(array("bank" => $bank))["url"];
	header('Location: '.$bankUrl);


	echo "</body>";
	echo "</html>";
	
?>
