<?php
	// include our OAuth2 Server object
	require_once __DIR__.'/server.php';

	// Start the session
	session_set_cookie_params(86400, "/bank1");
	session_start();

	echo "<!DOCTYPE html>";
	echo "<html>";
	echo "<body>";

	if(isset($_POST["logout"])) {
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 
	}

	if(isset($_POST["username"]) && isset($_POST["password"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];

		if(count($db->accounts->findOne(array("username" => $username, "password" => $password))))
			$_SESSION["username"] = $_POST["username"];
	}

	if(!isset($_SESSION["username"])) {
		echo "<form method='POST'>";
		echo "<input type='text' name='username'>";
		echo "<input type='text' name='password'>";
		echo "<input type='submit' value='login'>";
		echo "</form>";
		die();
	}

	$authorized = false;
	if(!isset($_POST["authorized"])) {
		// display an authorization form
		echo "<form method='POST'>";
		echo "<input type='submit' name='authorized' value='authorized'>";
		echo "</form>";

		echo "<form method='POST'>";
		echo "<input type='submit' name='logout' value='logout'>";
		echo "</form>";
		die();
	}
	else {
		$authorized = true;
	}

	$request = OAuth2\Request::createFromGlobals();
	$response = new OAuth2\Response();

	// validate the authorize request
	if (!$server->validateAuthorizeRequest($request, $response)) {
	    $response->send();
	    die;
	}

	// print the authorization code if the user has authorized your client
	$userid = $_SESSION["username"];
	$server->handleAuthorizeRequest($request, $response, $authorized, $userid);
	if ($authorized) {
	  // this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
	  $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
	  //exit("SUCCESS! Authorization Code: $code");
	  $response->send();
	}
	$response->send();

	echo "</body>";
	echo "</html>";
?>