<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['user'])) {
	// Could not get the data
	exit('Please fill both the email and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare("Delete from user WHERE userID =" . $_POST['userID'] . " and userRole <> 4;")) {
	//Execute SQL
	$stmt->execute();
	//Return to the homepage
	echo "<script> alert('User deleted');
		window.location.href='home.php';
		</script>";
} else {
	// Incorrect email
	echo "<script> alert('Failed to delete user');
		window.location.href='home.php';
		</script>";
}
//close statement
$stmt->close();
