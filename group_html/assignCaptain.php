<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";

//Check the values are passed
if (!isset($_POST['users'], $_POST['teams'])) {
	//Could not get the data
	exit('Please fill both the user and team fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare("UPDATE squad SET captainID = " . $_POST['users'] . " WHERE squadID = " . $_POST['teams'] . ";")) {
	//Execute SQL
	$stmt->execute();
	//Return to the homepage
	echo "<script> alert('Captain Assigned');
		window.location.href='home.php';
		</script>";
} else {
	// Incorrect email
	echo "<script> alert('Failed to Assign Captain');
		window.location.href='home.php';
		</script>";
}
//close statement
$stmt->close();
