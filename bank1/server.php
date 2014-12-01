<?php

	//------------- OAUTH PROTOCOL ----------------
	// error reporting (this is a demo, after all!)
	ini_set('display_errors',1);error_reporting(E_ALL);

	require_once('lib/OAuth2/Autoloader.php');
	OAuth2\Autoloader::register();

	$mongo = new \MongoClient();
	$db = $mongo->citybank;

	$storage = new OAuth2\Storage\Mongo($db);

	// create the server
	$server = new OAuth2\Server($storage);

	// Add the "Client Credentials" grant type (it is the simplest of the grant types)
	$server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

	// Add the "Authorization Code" grant type (this is where the oauth magic happens)
	$server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));

	// configure the available scopes
	$defaultScope = 'basic';
	$supportedScopes = array(
	  'basic',
	  'balance',
	  'request_transfer',
	  'execute_transfer'
	);
	$memory = new OAuth2\Storage\Memory(array(
	  'default_scope' => $defaultScope,
	  'supported_scopes' => $supportedScopes
	));
	$scopeUtil = new OAuth2\Scope($memory);

	$server->setScopeUtil($scopeUtil);


	//------------- MONGO DB ----------------

	$m = new MongoClient();
	$db = $m->citybank;

	/*
	$a = [
		"username" => "Gianluca",
		"password" => "Ciao",
	];
	$db->users->insert($a);
	*/

?>