<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";

//Check the values are passed
if (!isset($_POST['teams'], $_POST['users'])) {
	//Could not get the data
	exit('Please fill both the team and user fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare("Insert into squadmember(squadID, userID) values(" . $_POST['teams'] . "," . $_POST['users'] . ");")) {
	//Execute SQL
	$stmt->execute();
	//get user email
	$stmt = $con->prepare("SELECT userEmail from user where userID = ".$_POST['users']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	//bind email to variable
	$stmt->bind_result($email);
	$stmt->fetch();
	//mail the user
	mail($email,"Team update","You have been assigned to a new squad, check the system");

	//Return to the homepage
	echo "<script> alert('Player assigned to team');
		window.location.href='home.php';
		</script>";
} else {
	// Incorrect email
	echo "<script> alert('Failed to assign player to team');
		window.location.href='home.php';
		</script>";
}
//close statement
$stmt->close();
