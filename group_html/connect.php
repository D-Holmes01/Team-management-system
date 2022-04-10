<?php 
//Describe function, variables and parameters

/*//creating the getConnection function, linking the website/php to the database.
function getConnection() {
try {
$connection = new PDO("mysql:host=localhost;dbname=unn_w19003579",
  "unn_w18018436", "john1998");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $connection;
} catch (Exception $e) {
throw new Exception("Connection error ". $e->getMessage(), 0, $e);
}
}/*
/*
function validate_logon(){

	
	return array ($input, $errors);
}

function show_errors(....)[

}

function functionName(parameters...){

}*/
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'unn_w19003579';
$DATABASE_PASS = 'Group123.';
$DATABASE_NAME = 'unn_w19003579';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>



