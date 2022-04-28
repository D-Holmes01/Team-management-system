<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";

//Check the values are passed
if (!isset($_POST['users'], $_POST['role'])) {
	//Could not get the data
	exit('Please fill both the user and role fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare("UPDATE user SET userRole = " . $_POST['role'] . " WHERE userID = " . $_POST['users'] . ";")) {
	//Execute SQL
	$stmt->execute();
	//get user email
	$stmt = $con->prepare("SELECT userEmail from user where userID = " . $_POST['users']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	//bind email to variable
	$stmt->bind_result($email);
	$stmt->fetch();
	//mail the user
	mail($email, "Role assigned", "You have been assigned a new role");
	//If edited user is the logined in user edit the session role
	if ($_POST['users'] == $_SESSION['userID']) {
		$_SESSION['userRole'] = $_POST['role'];
	}
	//Return to the homepage
	echo "<script> alert('Role Assigned');
		window.location.href='home.php';
		</script>";
} else {
	// Incorrect email
	echo "<script> alert('Failed to Assign Role');
		window.location.href='home.php';
		</script>";
}
//close statement
$stmt->close();
