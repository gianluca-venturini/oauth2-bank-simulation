<?php

	// include our OAuth2 Server object
	require_once __DIR__.'/server.php';



	$request = OAuth2\Request::createFromGlobals();
	$response = new OAuth2\Response();

	if (!$token = $server->grantAccessToken($request, $response)) {
    	$response->send();
    	die();
	}
	echo json_encode($token);

?>