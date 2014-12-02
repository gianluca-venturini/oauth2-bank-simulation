<?php
	require_once __DIR__.'/server.php';

	$db->accounts->drop();
	$db->banks->drop();

	$db->accounts->insert(array(username => "gianluca", password => "gianluca"));
	$db->banks->insert(array(bank => "citybank", 
							 authUrl => "/bank1/authorize.php?response_type=code&client_id=financial_aggregator&state=/bank1/token.php&scope=balance%20request_transfer",
							 balanceUrl => "/bank1/balance.php",
							 transferUrl => "/bank1/transfer.php",));
?>