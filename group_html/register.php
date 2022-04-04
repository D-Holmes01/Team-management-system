<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Register</title>
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="register">
			<h1>Register</h1>
			<form action="register.php" method="post" autocomplete="off">
				<label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<label for="fName">
					<i class="fas fa-fname"></i>
				</label>
				<input type="text" name="fname" placeholder="First Name" id="fname" required>
				<label for="sname">
					<i class="fas fa-sname"></i>
				</label>
				<input type="text" name="sname" placeholder="Second Name" id="sname" required>
				<label for="position">
					<i class="fas fa-position"></i>
				</label>
				<select type="checkbox" name="position" placeholder="Position" id="position" required>
					<option value="0">Non-playing user</option>
     				<option value="1">Loosehead</option>
     				<option value="2">Hooker</option>
     				<option value="3">Tighthead Prop</option>
					<option value="4">Loosehead Lock</option>
     				<option value="5">Tighthead Lock</option>
     				<option value="6">Blindside Flanker</option>
					<option value="7">Openside Flanker</option>
     				<option value="8">Numer Eight</option>
     				<option value="9">Scrumhalf</option>
					<option value="10">Flyhalf</option>
					<option value="11">Left Wing</option>
					<option value="12">Inside Centre</option>
					<option value="13">Outside Centre</option>
					<option value="14">Right Wing</option>
					<option value="15">Fullback</option>
</select>
				<a href="index.html"><i class="login"></i>Already have an account? Login</a>
				<input type="submit" value="Register">
			</form>
		</div>
	</body>
</html>

<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'unn_w19003579';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['email'], $_POST['password'], $_POST['fname'], $_POST['sname'], $_POST['position'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['email'] || $_POST['password'] || $_POST['fname'] || $_POST['sname'] || $_POST['position'])) {
	// One or more values are empty.
	exit('Please complete the registration form');
}
// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT UserId FROM user WHERE userEmail = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// email already exists
		echo 'Email exists, please choose another!';
	} else {
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			exit('Email is not valid!');
		}
		if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
			exit('Password must be between 5 and 20 characters long!');
		}
	
// Username doesnt exists, insert new account
 if ($_POST['position'] == "0"){
	if ($stmt = $con->prepare("INSERT INTO user (userEmail, userPassword, userFName, userSName) VALUES (?, ?, ?, ?)")) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$_SESSION["name"] = $stmt;
 	$stmt->bind_param('ssss', $_POST['email'], $password, $_POST['fname'], $_POST['sname']);
	if ($stmt->execute())
	{
	echo 'You have successfully registered, you can now login!';
	}
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
	}
// Username doesnt exists, insert new account
else if ($_POST['position'] != "0"){
	if ($stmt = $con->prepare("INSERT INTO user (userEmail, userPassword, userFName, userSName, userPosition) VALUES (?, ?, ?, ?, ?)")) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$_SESSION["name"] = $stmt;
 	$stmt->bind_param('ssssi', $_POST['email'], $password, $_POST['fname'], $_POST['sname'], $_POST['position']);
	if ($stmt->execute())
	{
	echo 'You have successfully registered, you can now login!';
	}
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
	}
}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$con->close();
?>