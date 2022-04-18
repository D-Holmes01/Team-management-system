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
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['email'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the email and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT user.userID, user.userPassword, userRole, user.userFName, user.userSName, user.userBio, user.userTeam, user.userPosition FROM User left join role on role.roleID = user.userRole WHERE user.userEmail = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
    
    if ($_POST['email'] != null) {
        $stmt->bind_result($id, $password, $role, $name, $surname, $bio, $team, $position);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['userID'] = $id;
			$_SESSION['userRole'] = $role;
			$_SESSION['teamID'] = $team;
			if($name == null)
			{
				$name = "user";
			}
			$_SESSION['name'] = $name;
			$_SESSION['surname'] = $surname;
			$_SESSION['bio'] = $bio;
			$_SESSION['position'] = $position;
            header('Location: home.php');
        } else {
            // Incorrect password
			echo "<script> alert('Failed to log in: incorrect details.');
			window.location.href='index.html';
			</script>";
        }
    } else {
        // Incorrect email
		echo "<script> alert('Failed to log in: incorrect details.');
		window.location.href='index.html';
		</script>";
    }
	$stmt->close();
}
?>
