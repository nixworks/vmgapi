<?php 

include '../classes/checkFundraiserUrl.php'; 

$array[] = $_GET['urlToCheck'];

$array[] = 'something';	

$obj = new checkFundraiserUrl(); 

$obj->setUrl($array[0]); 

$array[] = $obj->getJson(); 

$output = json_encode($array);

print $output;



?>
