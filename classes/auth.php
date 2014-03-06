<html>
<head>
<title>This is the authentication workflow</title> 
</head>

<body> 

<?php 
$apikey =  "t43knf5zfsbpea9qw5npr96p"; 

$successUrl = "https://www.jamesdodd.org/callback.php"; 

$failUrl = "https://www.jamesdodd.org/callback.php"; 

$url = "https://connect.virginmoneygiving.com/vmgauthentication-web/vmgconnect/loginStartup.action?redirectSuccessURL=$successUrl&redirectUnsuccessURL=$failUrl&api_key=$apikey"; 

echo "<p>$url</p>"; 

print "<a href = $url>Click here</a>";



?>




</body> 
</html>
