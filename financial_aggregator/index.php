<?php 

	require_once __DIR__.'/server.php';
	require_once __DIR__.'/view.php';

	// Start the session
	session_set_cookie_params(86400, "/financial_aggregator");
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
		printLogin();
		/*
		echo "<form method='POST'>";
		echo "<input type='text' name='username'>";
		echo "<input type='text' name='password'>";
		echo "<input type='submit' value='login'>";
		echo "</form>";
		*/
		die();
	}

	@$bank = $db->accounts->findOne(array("username" => $_SESSION["username"]))["bank"];
	@$bankToken = $db->accounts->findOne(array("username" => $_SESSION["username"]))["bank_token"];

	if(isset($bank)) {
		// Search the bank urls
		$balanceUrl = null;
		$transferUrl = null;
		foreach($banks as $b) {
			if($b["bank"] == $bank) {
				$balanceUrl = $b["balanceUrl"];
				$transferUrl = $b["transferUrl"];
			}
		}

		if($balanceUrl != null && $transferUrl != null) {

			// Request the balance from the bank
			$ch = curl_init("http://127.0.0.1".$balanceUrl); 
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "access_token=".$bankToken);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	// Return the trasfer as a string
			$output = curl_exec($ch); 						// Execute the operation
			curl_close($ch);

			$balance = json_decode($output, true)["balance"];
			$owner = json_decode($output, true)["username"];
			//echo "Owner of the account: $owner<br>";
			//echo "Balance: $balance<br>";

			// transfer money
			if(isset($_POST["transfer"])) {

				// Lookup for the user in the DB
				$toUserAccount = $db->accounts->findOne(array("username" => $_POST["to_user"]));
				if(count($toUserAccount) > 0 && isset($toUserAccount["bank_username"])) {

					$toUser = $toUserAccount["bank_username"];
					$fromUser = $owner;
					$amount = $_REQUEST["amount"];

					// Transfer money with the bank
					$ch = curl_init("http://127.0.0.1".$transferUrl); 
					curl_setopt($ch, CURLOPT_POST, 4);
					curl_setopt($ch, CURLOPT_POSTFIELDS, "access_token=$bankToken&".
														 "from_user=$fromUser&".
														 "to_user=$toUser&".
														 "amount=$amount");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	// Return the trasfer as a string
					$output = json_decode(curl_exec($ch), true); 						// Execute the operation
					curl_close($ch);

					if($output["success"] != "true") {
						printError("Transaction refused from bank");
					}
					else {
						printSuccess();
					}
					//print_r($output);
				}
				else {
					printError("User not present or no active card connected");
				}
			}
		}

		/*
		echo "Bank: $bank<br>";
		echo "<form method='POST' action='remove_card.php'>";
			echo "<input type='submit' value='remove card'>";
		echo "</form>";
		*/

		printTransfer($owner, $balance, $bank);

		/*
		echo "Make a transfer<br>";
		echo "<form method='POST'>";
			echo "to user: <input type='text' value='' name='to_user'><br>";
			echo "amount: <input type='text' value='' name='amount'>";
			echo "<input type='hidden' name='transfer' value='yes'>";
			echo "<input type='submit' value='transfer money'>";
		echo "</form>";
		*/
	}
	else {
		printAddCard();
		/*
		echo "<form method='GET' action='add_card.php'>";
			echo "<input type='submit' name='bank' value='citybank'>";
		echo "</form>";
		*/
	}

	


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
	printLogout();
	/*

	echo "<form method='POST'>";
		echo "<input type='submit' value='logout'>";
		echo "<input type='hidden' value='true' name='logout'>";
	echo "</form>";
	*/

	printRefresh();

	/*
	echo "<form method='POST'>";
		echo "<input type='submit' value='refresh'>";
	echo "</form>";
	*/

	printFooter();
	
?>
