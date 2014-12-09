<?php 
	
	require_once __DIR__.'/server.php';

	// Start the session
	session_set_cookie_params(86400, "/financial_aggregator");
	session_start();

	echo "<!DOCTYPE html>";
	echo "<html>";
	echo "<body>";

	if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["re_password"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$rePassword = $_POST["re_password"];

		if($password == $rePassword && filter_var($username, FILTER_VALIDATE_EMAIL)) {
			if(count($db->accounts->findOne(array("username" => "$username"))) == 0) {
				$db->accounts->insert(array(username => "$username", password => "$password"));
				echo "Account registered with success";
			}
			else {
				echo "Username already present";
			}
		}
		else {
			echo "Passwords don't match or username is not valid";
		}
	}
	else {
		echo "<form method='POST'>";
		echo "<input type='text' name='username'>";
		echo "<input type='text' name='password'>";
		echo "<input type='text' name='re_password'>";
		echo "<input type='submit' value='register'>";
		echo "</form>";
	}

	echo "</body>";
	echo "</html>";
	
?>
