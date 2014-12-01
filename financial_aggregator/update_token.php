<?php 

	require_once __DIR__.'/server.php';

	// Start the session
	session_start();

	if(!isset($_SESSION["username"])) {
		echo "You're not authenticated";
		die();
	}

	if(!isset($_REQUEST["code"])) {
		echo "The code is not present in the request";
		die();
	}

	if(!isset($_REQUEST["state"])) {
		echo "The bank is not present in the request";
		die();
	}

	$code = $_REQUEST["code"];
	$url = urldecode($_REQUEST["state"]);

	echo "Request token to url: ".$url;

	$fields = array(
			"grant_type" => "authorization_code",
			"code" => $code
		);

	// Request the token to the bank
	$ch = curl_init("http://127.0.0.1".$url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	// Return the trasfer as a string
	curl_setopt($ch, CURLOPT_USERPWD, "$oauth_client_id:$oauth_client_secret");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	$output = curl_exec($ch); 						// Execute the operation
	curl_close($ch);


	$outputArray = json_decode($output);

	if(!array_key_exists("access_token",$outputArray)) {
		echo "Error: something goes wrong";
		echo $output;
		die();
	}

	//print_r( json_decode($output) );

	$token = $outputArray["access_token"];

	echo "New token added: ".$token;


	//header('Location: '."./");
	
?>
