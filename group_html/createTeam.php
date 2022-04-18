<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'unn_w19003579';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit("Insert into squad(squadName) values(".$_POST['name'] .");INSERT INTO teamsquad (squadID, teamID) values ((SELECT squadID from squad where squadName = '".$_POST['name']."'), ".$_SESSION['teamID'].");");
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['name']) ) {
	// Could not get the data that should have been sent.
	echo $_POST['name'];
    exit('Please fill both the email and password fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare("Insert into squad(squadName) values('".$_POST['name'] ."');")) {
	$stmt->execute();
    } else {
        // Incorrect email
		echo "<script> alert('Failed to log in: incorrect details.');
			window.location.href='index.html';
			</script>";
    }
    
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare("INSERT INTO teamsquad (squadID, teamID) values ((SELECT squadID from squad where squadName = '".$_POST['name']."'), ".$_SESSION['teamID'].");")) {
	$stmt->execute();
    header('Location: home.php');
    } else {
        // Incorrect email
		echo "<script> alert('Failed to log in: incorrect details.');
			window.location.href='index.html';
			</script>";
    }
?>
