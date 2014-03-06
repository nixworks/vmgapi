var jsdebug = true; 

function MakeRequest() { 
	
	// recover the first name and surname from the form page

	var input = document.getElementById("forename").value + document.getElementById("surname").value;

	if (jsdebug) { console.log(input); }

	// set up a new HTTP requests
	
	var xmlHttp = new XMLHttpRequest();

	// and have it call the response handler if it recieves a ready response

	// @todo - improve error handling for other response codes	

		xmlHttp.onreadystatechange = function()
		{
		  if(xmlHttp.readyState === 4)
		  {
		    HandleResponse(xmlHttp.responseText);
		  }
		}

	// set up the method and target

		xmlHttp.open("POST", "scripts/script.php", true);

	// set the reqeust header (because otherwise it won't construct the array properly

		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
 
	// and send in your values

		xmlHttp.send("urlToCheck="+input);
}

function HandleResponse(response) {
	document.getElementById('personalUrl').value = response;
}
