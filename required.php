
<?php
	$host = "cecs-db01.coe.csulb.edu";
	$user = "cecs470m31";
	$pass = "joo3re";
	$database =  "cecs470og2";
	$connection = mysqli_connect($host, $user, $pass,$database);
	$error = mysqli_connect_error();
	if ($error != null) {
	  $output = "<p>Unable to connect to database<p>" . $error;
	  
	  exit($output);
	}
	
	session_Start();
?>