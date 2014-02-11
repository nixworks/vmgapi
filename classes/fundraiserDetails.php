<?php

	class fundraiserDetails { 	

		public $json; // holds tbe json to return
		
		private $ch; // holds the curl resource

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
			
			$url = "https://sandbox.api.virginmoneygiving.com/fundraisers/v1/account/" . $name ."?api_key=" . $this->apiKey; 

			// add it to the set up options			

			curl_setopt($this->ch, CURLOPT_URL, $url);

			// $output contains the output string
			
			$output = curl_exec($this->ch);

			// change it into an array	

			$this->json = json_decode($output, true);

			// close curl resource to free up system resources
			
			curl_close($this->ch);

		}

		function getJson() { 

			// return the array containing the JSON object
			
			return $this->json['personalUrl']; 
		}

} 

?>
