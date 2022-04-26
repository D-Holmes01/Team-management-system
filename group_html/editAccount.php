<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['Fname'], $_POST['Sname'], $_POST['Position'])) {
	// Could not get the data
	exit('Please ensure a first and second name is entered alongside the positon the fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare("UPDATE User SET userFName = '" . $_POST['Fname'] . "', userSName = '" . $_POST['Sname'] . "', userBio = '" . $_POST['Bio'] . "', userPosition = " . $_POST['Position'] . " WHERE userID = " . $_SESSION['userID'] . ";")) {
	//Execute SQL
	$stmt->execute();
	// Update the session data
	$stmt->store_result();
	$_SESSION['name'] = $_POST['Fname'];
	$_SESSION['surname'] = $_POST['Sname'];
	$_SESSION['bio'] = $_POST['Bio'];
	$_SESSION['position'] = $_POST['Position'];
	//Return to the homepage
	echo "<script> alert('User data updated');
		window.location.href='home.php';
		</script>";
} else {
	// Incorrect email
	echo "<script> alert('Failed to updated player');
		window.location.href='home.php';
		</script>";
}
//close statement
$stmt->close();
