<?php
	require_once('lib/OAuth2/Autoloader.php');
	OAuth2\Autoloader::register();

	$mongo = new \MongoClient();
	$db = $mongo->citybank;

	$storage = new OAuth2\Storage\Mongo($db);

	// now you can perform storage functions, such as the one below
	$client_id = "financial_aggregator";
	$client_secret = "115ec9855f";
	$redirect_uri = "http://financial_aggregator/update_token.php";
	$storage->setClientDetails($client_id, $client_secret, $redirect_uri);

?>