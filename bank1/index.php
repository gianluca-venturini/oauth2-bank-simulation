<?php 

	require_once __DIR__.'/server.php';
	require_once __DIR__.'/view.php';

	// Start the session
	session_set_cookie_params(86400, "/bank1");
	session_start();

	printHeader();

	// logout
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
		printLoginForm();
		/*
		echo "<form method='POST'>";
		echo "<input type='text' name='username'>";
		echo "<input type='text' name='password'>";
		echo "<input type='submit' value='login'>";
		echo "</form>";
		*/
		
		die();
	}

	$balance = $db->accounts->findOne(array("username" => $_SESSION["username"]))["balance"];

	printBalance($_SESSION["username"], $balance);


	/*
	$m = new MongoClient();
	$db = $m->selectDB("example");
	$a = [
		"username" => "Gianluca",
		"password" => "Ciao",
	];
	$db->users->insert($a);
	*/

	/*

	require_once('lib/OAuth2/Autoloader.php');
	OAuth2\Autoloader::register();

	$mongo = new \MongoClient();
	$db = $mongo->foo;

	$storage = new OAuth2\Storage\Mongo($db);

	// now you can perform storage functions, such as the one below
	$client_id = "gianluca";
	$client_secret = "ciao";
	$redirect_uri = "http://10.0.0.4:1234";
	$storage->setClientDetails($client_id, $client_secret, $redirect_uri);
	*/

/*
	echo "<form method='POST'>";
		echo "<input type='submit' value='logout'>";
		echo "<input type='hidden' value='true' name='logout'>";
		echo "</form>";
		*/

	printFooter();
	
?>
