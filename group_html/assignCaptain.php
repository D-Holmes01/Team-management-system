<?php
session_start();
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

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['users'], $_POST['teams']) ) {
	// Could not get the data that should have been sent.
	echo $_POST['users'], $_POST['role'];
    exit('Please fill both the email and password fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare("UPDATE squad SET captainID = ".$_POST['users']." WHERE squadID = ".$_POST['teams'].";")) {
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
    header('Location: home.php');
    } else {
        // Incorrect email
		echo "<script> alert('Failed to log in: incorrect details.');
		window.location.href='index.html';
		</script>";
    }
	$stmt->close();
?>
