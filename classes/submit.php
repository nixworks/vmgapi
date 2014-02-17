<?php

include 'fundraiserDetails.php';
include '../classes/createFundraiserAccount.php';
include	'../classes/createFundraiserPage.php';
include '../classes/errorHandler.php';

// Use the post data to create a new createFundraiserAccount object

$create = new createFundraiserAccount($_POST); 

// extract the data from post and use it to initialise the cUrl request

$create->preparecUrl(); 

// execute the request, or handle the errors

if ($create->execute() == true) {
	
	// using the results array returned by createFundraiserAccount, create the new fundraiser page

	$page = new createFundraiserPage($create->getResult());

	// call the API using the new array
	
	$page->callApi();

	// then get the results, or handle the errors	

	$page->getResult($_POST['personalUrl']);	

};



?>
