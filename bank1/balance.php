<?php
	// include our OAuth2 Server object
	require_once __DIR__.'/server.php';

	$request = OAuth2\Request::createFromGlobals();
	$response = new OAuth2\Response();

	$scopeRequired = 'balance'; // this resource requires "postonwall" scope

	// Handle a request for an OAuth2.0 Access Token and send the response to the client
	if (!$server->verifyResourceRequest($request, $response, $scopeRequired)) {
	    $response->send();
	    die;
	}
	$token = $server->getAccessTokenData(OAuth2\Request::createFromGlobals());

	$balance = $db->accounts->findOne(array("username" => $token['user_id']))["balance"];

	echo json_encode(array('success' => true, 'username' => $token['user_id'], 'balance' => $balance));
?>