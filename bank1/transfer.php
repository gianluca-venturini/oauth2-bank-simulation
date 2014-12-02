<?php
	// include our OAuth2 Server object
	require_once __DIR__.'/server.php';

	$request = OAuth2\Request::createFromGlobals();
	$response = new OAuth2\Response();

	$scopeRequired = 'request_transfer'; // this resource requires "postonwall" scope

	// Handle a request for an OAuth2.0 Access Token and send the response to the client
	if (!$server->verifyResourceRequest($request, $response, $scopeRequired)) {
	    $response->send();
	    die;
	}

	// Authenticated client
	$token = $server->getAccessTokenData(OAuth2\Request::createFromGlobals());

	$fromUser = $_REQUEST["from_user"];
	$toUser = $_REQUEST["to_user"];
	$amount = $_REQUEST["amount"];

	if($fromUser != $token['user_id']) {
		echo json_encode(array('success' => false, 'from_user' => $fromUser, 'to_user' => $toUser, 'amount' => $amount, 'reason' => 'token not valid for this transfer'));
		die;
	}

	if(count($db->accounts->findOne(array("username" => $fromUser))) == 0) {
		echo count($db->accounts->findOne(array("username" => $fromUser)));
		echo json_encode(array('success' => false, 'from_user' => $fromUser, 'to_user' => $toUser, 'amount' => $amount, 'reason' => 'destination user not available'));
		die;
	}

	$fromAccount = $db->accounts->findOne(array("username" => $fromUser));
	$toAccount = $db->accounts->findOne(array("username" => $toUser));

	if($fromAccount["balance"] < $amount) {
		echo json_encode(array('success' => false, 'from_user' => $fromUser, 'to_user' => $toUser, 'amount' => $amount, 'reason' => 'insufficient founds'));
		die;
	}

	// Update the two accounts
	$newBalance = $fromAccount["balance"] - $amount;
	$db->accounts->update(array("username" => $fromUser), array('$set' => array("balance" => $newBalance)));

	$newBalance = $toAccount["balance"] + $amount;
	$db->accounts->update(array("username" => $toUser), array('$set' => array("balance" => $newBalance)));

	echo json_encode(array('success' => true, 'from_user' => $fromUser, 'to_user' => $toUser, 'amount' => $amount));
?>