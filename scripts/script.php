<?php 

$debug = false;

include '../classes/checkFundraiserUrl.php'; 

// make a new checkFundraiserURL object

$obj = new checkFundraiserUrl(); 

// pass the string to check into the new object

if ($debug) {$obj->setUrl("JamesDodd");}
else {$obj->setUrl($_POST['urlToCheck']);} 

// check the URL

$obj->checkUrl(); 

// and return the reslt @todo my method is called getJson and it doesn't get Json

echo $obj->getJson();



?>
