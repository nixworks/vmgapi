<?php

class errorHandler { 

	private $errors; // holds the errors array 

	function __construct($array) { 

		$this->errors = json_decode($array); 

		// in case URL is already taken
		
		if ($this->errors->errors[0]->errorCode == "001.00.010") { 
			echo "<p>" . $this->errors->errors[0]->errorMessage . "</p>";
			foreach ($this->errors->errors[0]->messageDetails as $options) { 
				echo "<p>" . $options . "</p>";
			}
		}

		else if ($this->errors->errors[0]->errorCode == "001.00.008") { 
			echo "<p>" . $this->errors->errors[0]->errorMessage . "</p>";
			foreach ($this->errors->errors[0]->messageDetails as $options) { 
				echo "<p>" . $options . "</p>";
			}
		}

		else if ($this->errors->errors[0]->errorCode == "002.01.31") { 
			echo "<p>" . $this->errors->errors[0]->errorMessage . "</p>";
			foreach ($this->errors->errors[0]->messageDetails as $options) { 
				echo "<p>" . $options . "</p>";
			}
		}



		


		else echo "<p>Unrecognised error. Debug data as follows:</p>"; 
		print_r($this->errors); 
	} 
} 

?>
