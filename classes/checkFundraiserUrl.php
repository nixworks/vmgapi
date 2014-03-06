<?php

	class checkFundraiserUrl { 	

		public $json; // holds tbe json to return
		
		private $ch; // holds the curl resource

		private $result; // holds the result

		private $apiKey =  "t43knf5zfsbpea9qw5npr96p"; 		

		function __construct() { 		

			// create curl resource
			$this->ch = curl_init();
	
			// return the value as a string	
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
			
			// set the header 	

			curl_setopt($this->ch,CURLOPT_HTTPHEADER,array('Accept: application/json', 'X-Originating-Ip: 143.65.196.4'));

		}

		function setUrl($name) { 			

			// construct the URL 	
			
			$url = "https://sandbox.api.virginmoneygiving.com/fundraisers/v1/urls/" . $name . "?api_key=" . $this->apiKey; 

			// add it to the set up options			

			curl_setopt($this->ch, CURLOPT_URL, $url);

			// $output contains the output string
			
			$this->json = curl_exec($this->ch);

			// decode the JSON to PHP
			
			$this->json = json_decode($this->json, true);

			// close curl resource to free up system resources
			
			curl_close($this->ch);

		}

		
		function checkUrl() { 

		// check if there are errors in the URL
		// @todo this is wrong - there could be other kinds of errors
		
		if (array_key_exists('errors', $this->json)) {
			$this->result = $this->json['errors'][0]['messageDetails'][0];  
			}

		// or if the URL is available, just return the string that was requested

		else if (array_key_exists('available', $this->json)) { 
			$this->result = $this->json['requestedUrl']; 
			} 
					
		// @todo error handling

		else $this->result = "Unexpected error"; 

	} 
		
	function getJson() { 

		// return the array containing the JSON object
			
		return $this->result; 
	}

}

?>
