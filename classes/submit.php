<?php 

include 'fundraiserDetails.php'; 

// set up constants like redirect and api key

$redirect = "https://www.cancerresearchuk.org";

$apikey = "t43knf5zfsbpea9qw5npr96p";

	// concatenate the DOB values into one, remove from $_POST, push $dob into $_POST	
	$dob = $_POST['year'] . $_POST['month'] . $_POST['day']; 

	unset($_POST['year']); 
	unset($_POST['month']);
	unset($_POST['day']);

	$_POST['dateOfBirth'] = $dob; 

	// encode the POST array 	
	$data_string = json_encode($_POST); 

	// initiate cURL	
	$ch = curl_init();


	// set to post
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 	

	// set to pass the json file
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 

	
	// return the value as a string	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  	
	// set the header 	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array(
		'Accept: application/json', 
		'X-Originating-Ip: 143.65.196.4',
		'Content-Type: application/json'));



	// set url
  curl_setopt($ch, CURLOPT_URL, "https://sandbox.api.virginmoneygiving.com/fundraisers/v1/newaccount?redirect_uri=$redirect&api_key=t43knf5zfsbpea9qw5npr96p");

  // $output contains the output string
  $output = curl_exec($ch);

	// decode and print the output	
	$top = json_decode($output, true);

	echo "<p><strong>Create Fundraiser Account</strong></p>"; 	

	if (array_key_exists('creationSuccessful', $top))	 {	

	foreach ($top as $key => $value) { 
		echo "<p>$key: $value</p>";
		} 
	} 

	else { 
		echo "<p>Something is wrong</p>"; 
		print_r($top);
		echo "</p>";
		if (array_key_exists('errors', $top) && $top['errors'][0]['errorCode'] == "002.01.31") { 
			echo "<p>Error code</p>" . $top['errors'][0]['errorCode'] . "<p>";
			
			echo "<p>Error code</p>";

 			$error = substr($top['errors'][0]['messageDetails'][0], 1, -1);

			echo $error; 

			echo "</p>";

			$fr = new fundraiserDetails; 

			$fr->setUrl($error); 

			echo "You already have an account. Please sign in at " . $fr->getJson() . "</p>";	


	} 	  
}


class createFundraiserPage { 

	private $result;

	private $ch; // holds the curl resource

	private $apiKey =  "t43knf5zfsbpea9qw5npr96p";

	private $resourceId;  
	
	// takes the array returned by CreateFundraiserAccount, extracts the auth code and the resource code, initiates the curl resource and sets header

	function __construct($arr) { 

		// check that it's an array, and it's got the right data	

		if (gettype($arr) != "array") echo "Debug message - this is not an array"; 
		else if (!array_key_exists('creationSuccessful', $arr)) echo "Debug message - this is not the right kind of array"; 
		else { 
			$this->resourceId = $arr['resourceId']; 
			$auth = $arr['accessToken']; 
			echo "<p>$auth</p><p>" . $this->resourceId . "</p>";

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

	function getResult() { return $this->result;} 
} 

	$page = new createFundraiserPage($top); 
	$page->callApi(); 

	echo "<p><strong>Create Fundraiser Page</strong></p>"; 
		
	print $page->getResult();



?>
