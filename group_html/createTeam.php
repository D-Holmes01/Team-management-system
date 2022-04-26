<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";

//Check the values are passed
if (!isset($_POST['name'])) {
	// Could not get the data
	exit('Please fill the name field!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare("Insert into squad(squadName) values('" . $_POST['name'] . "');")) {
	//Execute SQL
	$stmt->execute();
} else {
	// Incorrect email
	echo "<script> alert('Failed to Create team');
		window.location.href='home.php';
		</script>";
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare("INSERT INTO teamsquad (squadID, teamID) values ((SELECT squadID from squad where squadName = '" . $_POST['name'] . "'), " . $_SESSION['teamID'] . ");")) {
	//Execute SQL
	$stmt->execute();
	//Return to the homepage
	echo "<script> alert('Team created');
		window.location.href='home.php';
		</script>";
} else {
	// Failed to assign squad ot team
	echo "<script> alert('Failed to assign team to club');
		window.location.href='home.php';
		</script>";
}
