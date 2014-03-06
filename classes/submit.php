<html>
<head>
<title>Thanks!</title>
<link rel="stylesheet" type="text/css" href="../form/style.css"></script> 
</head>
<body>

<div class = "wrapper">

<div class='form' id='personal'>

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
	
	$page = new createFundraiserPage($create->getResult());

	// call the API using the new array
	
	$page->callApi();

	// then get the results, or handle the errors	

	$page->getResult($_POST['personalUrl']);	



}

// TODO would be nice to put this into a proper object at some point

else if ($create->getErrors() == "002.01.31") { 

	$url = "https://connect.virginmoneygiving.com/vmgauthentication-web/vmgconnect/loginStartup.action?redirectSuccessURL=https://www.cancerresearchuk.org/api/vmg/successfulAuthorisation.do&redirectUnsuccessURL=https://www.cancerresearchuk.org/api/vmg/failedAuthorisation.do&api_key=t43knf5zfsbpea9qw5npr96p&emailAddress=" . $_POST['emailAddress'] ."&dateOfBirth=" . $_POST['year'] . $_POST['month'] . $_POST['day'];

	echo "<a href=$url>Please click here to sign into your account</a>";
} 

?>

</div>
</div>

</body>
</html>	
