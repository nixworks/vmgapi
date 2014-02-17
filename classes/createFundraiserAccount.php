	<?php

class createFundraiserAccount { 

	private $submit_data; // variable to hold the tidied up post array

	private $output; // variable to hold the response

	private $redirect = "https://www.cancerresearchuk.org"; // redirect URI, as set in the API UI

	private $apikey = "t43knf5zfsbpea9qw5npr96p";

	private $ch; // for the curl resource


	function __construct($array) { 

	// the constructor initiates the object, takes in the post array and tidies it up, assigning it to the private $submit_data variable
	
	// make sure that the variable is an array

		if (gettype($array) != "array") { 
			echo "Debug message - this is not an array";
		}

		else { 

		// make sure the array contains a day, week and month key 
		
			if (!array_key_exists('day', $array) || !array_key_exists('month', $array) || !array_key_exists('year', $array)) { 

				echo "Debug message - your date of birth seems to be formatted wrong"; 
			}
			
			else {			

				// then concatenate the DOB values into one, remove from them then push the nw  $dob into the array
		
				$dob = $array['year'] . $array['month'] . $array['day'];
				unset($array['year']);
				unset($array['month']);
				unset($array['day']);

				$array['dateOfBirth'] = $dob;
			}
			$this->submit_data = json_encode($array);
			
		} 
	}

	function preparecUrl ()  { 

		// initiate cURL
		$this->ch = curl_init();

		// set to post
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");

		// set to pass the json file
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->submit_data);


		// return the value as a string
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
  
		// set the header
		curl_setopt($this->ch,CURLOPT_HTTPHEADER, array(
		'Accept: application/json',
		'X-Originating-Ip: 143.65.196.4',
		'Content-Type: application/json'));

		// set url
  	curl_setopt($this->ch, CURLOPT_URL, "https://sandbox.api.virginmoneygiving.com/fundraisers/v1/newaccount?redirect_uri=$this->redirect&api_key=t43knf5zfsbpea9qw5npr96p");

	}

	function execute() { 

		// make the cUrl execute
		$this->output = curl_exec($this->ch);			
		
		// and check it for errors 
	
		if (array_key_exists('errors', json_decode($this->output))) { 
			$errors = new errorHandler($this->output); 
			return false; 
		} 
		else return true; 
	} 
	

	function getResult() { 
		// decode return the output
		return json_decode($this->output, true);
	} 
} 

?>

