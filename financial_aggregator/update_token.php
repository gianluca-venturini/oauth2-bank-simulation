<?php 

	require_once __DIR__.'/server.php';

	// Start the session
	session_set_cookie_params(86400, "/financial_aggregator");
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

	if(!isset($_SESSION["bank"])) {
		echo "The add request is not correctly initialized";
		die();
	}

	$username = $_SESSION["username"];
	$code = $_REQUEST["code"];
	$url = urldecode($_REQUEST["state"]);
	$bank = $_SESSION["bank"];

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


	$outputArray = json_decode($output, true);

	if(!array_key_exists("access_token",$outputArray)) {
		echo "Error: something goes wrong";
		echo $output;
		die();
	}

	$token = $outputArray["access_token"];

	// Search the bank urls
	$balanceUrl = null;
	$transferUrl = null;
	foreach($banks as $b) {
		if($b["bank"] == $bank) {
			$balanceUrl = $b["balanceUrl"];
			$transferUrl = $b["transferUrl"];
		}
	}

	if($balanceUrl != null) {
		// Request the username from the bank
		$ch = curl_init("http://127.0.0.1".$balanceUrl); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "access_token=".$token);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	// Return the trasfer as a string
		$output = curl_exec($ch); 						// Execute the operation
		curl_close($ch);

		$owner = json_decode($output, true)["username"];

		print_r($output);

		$db->accounts->update(array("username" => $username), array('$set' => array("bank" => $bank, "bank_token" => $token, "bank_username" => $owner)));


		echo "New token added: ".$token;

		header('Location: '."./");	
	}


?>
