<?php

include "classes/tokenExchange.php";
include "classes/createFundraiserPage.php"; 

print_r($_GET);


$auth = new tokenExchange($_GET); 

$auth->callApi(); 

print_r($auth->getResult()); 

echo "<p>So far so good</p>"; 

$page = new createFundraiserPage($auth->getResult()); 

?>
