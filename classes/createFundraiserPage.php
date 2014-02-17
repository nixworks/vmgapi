<?php

class createFundraiserPage {

private $result;

private $ch; // holds the curl resource

private $apiKey = "t43knf5zfsbpea9qw5npr96p";

private $resourceId;

// takes the array returned by CreateFundraiserAccount, extracts the auth code and the resource code, initiates the curl resource and sets header

	function __construct($arr) {

		// check that it's an array, and it's got the right data

		if (gettype($arr) != "array") echo "Debug message - this is not an array";
		else if (!array_key_exists('creationSuccessful', $arr)) echo "Debug message - this is not the right kind of array";
		else {
			$this->resourceId = $arr['resourceId'];
			$auth = $arr['accessToken'];
			// echo "<p>$auth</p><p>" . $this->resourceId . "</p>";

			// create curl resource
			$this->ch = curl_init();

			// return the value as a string
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);

			// set the header
			curl_setopt($this->ch,CURLOPT_HTTPHEADER,array
			(	"Accept: application/json",
			"Authorization: Bearer $auth",
			"X-Originating-Ip: 143.65.196.4",
			"Content-Type: application/json"
			)
			);

			// make the request body array, change it into JSON

			$title = "My page";

			// This is horrible, I know. Creates the JSON object as a string.

			$body = "{\"pageTitle\":\"$title\",\"eventResourceId\":\"57b77189-7b8b-47ad-9690-6cec4ef9d492\",\"fundraisingDate\":\"\",\"teamPageIndicator\":\"N\",\"teamName\":\"\",\"teamUrl\":\"\",\"activityCode\":\"\",\"activityDescription\":\"\",\"charityContributionIndicator\":\"N\",\"postEventFundraisingInterval\":\"3\",\"fundraisingTarget\":\"1000\",\"charitySplits\":[{\"charityResourceId\":\"f4f84edb-6cd4-4dff-a67b-55c02d8665af\",\"charitySplitPercent\":100}]}";

			//echo $body;

			// set to post
			curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");

			// set to pass the json file
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body);

		}
	}

	function callApi() {

		// construct the URL

		$url = "https://sandbox.api.virginmoneygiving.com/fundraisers/v1/account/secure/" . $this->resourceId . "/newpage?api_key=" . $this->apiKey;

		// add it to the set up options

		curl_setopt($this->ch, CURLOPT_URL, $url);

		// $output contains the output string

		$this->result = curl_exec($this->ch);

		// close curl resource to free up system resources

		curl_close($this->ch);
  }

	function getResult($name) { 
	
	// TODO this is a hack - the name passing - so I can concatenate the name with the Sandbox URL - because the API does not currently provide the full 
	// fundraiser URL	

	$results = json_decode($this->result);
		
			echo "<p><strong>Success!</strong></p>"; 		
		echo "<p>" . $results->message . "</p>"; 
		$page = "http://uk.sandbox.virginmoneygiving.com/" . $name;
		echo "<a href=\"$page\">$page</a>";
 
	}
}

?>
