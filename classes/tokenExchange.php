<?php

include "dummyArrays.php"; 


class tokenExchange { 

	private $ch; // for putting the curl resource in

	private $result; // for putting the result in

	
	function __construct($arr) { 

	$apikey = "t43knf5zfsbpea9qw5npr96p";

	$callbackurl = "https://www.jamesdodd.org/callback.php";

	$authCode = $arr['authorisationCodeValue']; 	
		
	echo "<p>Debug info - what's in the array?</p>"; 	
	echo $arr['authorisationCodeValue'] . "</br>"; 
	echo $arr['authorisationCodeContext'] . "</br>";
	echo $arr['FundraiserResourceId'] . "</br>";

	// create curl resource
	$this->ch = curl_init();

	// return the value as a string
	curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);

	// set the header
	curl_setopt($this->ch,CURLOPT_HTTPHEADER,array
		(	"Accept: application/json",
			"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
	    "charset: utf-8",
	    "Content-Type: application/x-www-form-urlencoded",
			)
		);

	$body = "client_id=$apikey&redirect_uri=$callbackurl&code=$authCode&grant_type=authorization_code";		

	// set to post
	curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");

	// set to pass the json file
	curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body);

	}

		function callApi() {

		// construct the URL

		$url = "https://api.virginmoneygiving.com/token";

		// add it to the set up options

		curl_setopt($this->ch, CURLOPT_URL, $url);

		// put the output string into $this->result

		$this->result = curl_exec($this->ch);

		// close curl resource to free up system resources

		curl_close($this->ch);
  }

	function getResult() { 

			print_r(json_decode($this->result)); 

			echo  "</br>";			

			$arr  = array(); 	
			
			// get the fundraiser resource ID from the GET array, because you'll need it to make the page
					
			if(isset($_GET['FundraiserResourceId'])) {

				// get the return array ready to make the page	
			
				$arr['resourceId'] = $_GET['FundraiserResourceId'];

				$arr['creationSuccessful'] = 1;


				// change the result from json to a PHP object	
				$result = json_decode($this->result);

				// get the access_token variable from the object			
				$arr['accessToken'] = $result->access_token; 

				// and put it into a single index array, 
				return $arr; 

			} 

		else echo "Something is wrong"; 
	}	
} 

?> 	
