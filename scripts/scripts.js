function checkUrl() {

	// concatenate the first and last name	

	var output = document.getElementById("forename").value + document.getElementById("surname").value;

	//alert(output); // debug - we know it still functions
	
	// use the javascript jquery class

$.ajax({
      type: "get",
      url: "script.php",
      data: {
				urlToCheck : output
			},
			dataType: 'json',
      success: function(data) {
	
				console.log("Success function works, then");				
	

				/**

				var json = $.parseJSON(data[2]);
				console.log(json);
				console.log(json.available);
				if (json.available != undefined) {
					console.log(json.requestedUrl);	
					document.getElementById("personalUrl").value = json.requestedUrl;
				}	
				else document.getElementById("personalUrl").value = "Not available";
			
				**/

			}
	});
}
