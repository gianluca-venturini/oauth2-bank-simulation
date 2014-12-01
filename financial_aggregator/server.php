<?php

	//------------- MONGO DB ----------------

	$m = new MongoClient();
	$db = $m->paypal;

	//--------------- BANKS -----------------

	$banks = array();
	$cursor = $db->banks->find();
	foreach($cursor as $document) {
		array_push($banks, $document);
	}

	//------------ OAUTH PARAMETERS ------------
	$oauth_client_id = "financial_aggregator";
	$oauth_client_secret = "115ec9855f";
?>