<?php
//start session so that variables can be passed if needed
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'unn_w19003579';
$DATABASE_PASS = 'Group123.';
$DATABASE_NAME = 'unn_w19003579';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html>

<head>
	<!-- setup title, charset and style-->
	<meta charset="utf-8">
	<title>Register</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- registration div -->
	<div class="register">
		<h1>Register</h1>
		<!-- form which will attempt to register the inputted detail -->
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
			<select type="select" name="position" placeholder="Position" id="position" required>
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
			<div></div><br>
			<label for="team">
				<i class="fas fa-team"></i>
			</label>
			<!-- list of selects are loaded from database -->
			<select type="select" name="team" id="team">
				<?php
				$result = $con->query('SELECT * from team;');
				while (
					$ri = mysqli_fetch_array($result)
				) {
				?>
					<option value="<?php echo $ri['teamID'] ?>">
						<?php echo $ri['teamName']  ?>
					</option>
				<?php
				}
				?>
			</select>
			<a href="index.html"><i class="login"></i>Already have an account? Login</a>
			<input type="submit" value="Register">
		</form>
	</div>
</body>

</html>

<?php
// Check is the data is submitted
if (!isset($_POST['email'], $_POST['password'], $_POST['fname'], $_POST['sname'], $_POST['position'])) {
	// Warning message
	exit('Please complete the registration form!');
}
//Ensure the inputs are filled
if (empty($_POST['email'] || $_POST['password'] || $_POST['fname'] || $_POST['sname'] || $_POST['position'])) {
	// Warning message
	exit('Please complete the registration form');
}
//Check that the username entered does not exist
if ($stmt = $con->prepare('SELECT UserId FROM user WHERE userEmail = ?')) {
	//Bind username to string
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	// Store result to check later as seen below
	if ($stmt->num_rows > 0) {
		// username already exists
		exit('username exists, please choose another!');
	} else {
		//Check password is the correct length
		if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
			exit('Password must be between 5 and 20 characters long!');
		}

		// Username doesnt exists, insert new account
		else if ($_POST['position'] != 0) {
			if ($stmt = $con->prepare("INSERT INTO user (userEmail, userPassword, userFName, userSName, userPosition, userTeam) VALUES (?, ?, ?, ?, ?, ?)")) {
				//Hash password
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$_SESSION["name"] = $stmt;
				$stmt->bind_param('ssssii', $_POST['email'], $password, $_POST['fname'], $_POST['sname'], $_POST['position'], $_POST['team']);
				if ($stmt->execute()) {
					echo 'You have successfully registered, you can now login!';
				}
			} else {
				// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
				echo 'Could not prepare statement!';
			}
		}

		// Username doesnt exists, insert new account where position is null
		if ($_POST['position'] == 0) {
			if ($stmt = $con->prepare("INSERT INTO user (userEmail, userPassword, userFName, userSName, userTeam) VALUES (?, ?, ?, ?, ?)")) {
				//Hash password
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$_SESSION["name"] = $stmt;
				$stmt->bind_param('ssssi', $_POST['email'], $password, $_POST['fname'], $_POST['sname'], $_POST['team']);
				if ($stmt->execute()) {
					echo 'You have successfully registered, you can now login!';
				}
			} else {
				// Something is wrong with the sql statement
				echo 'Could not prepare statement!';
			}
		}
	}
	$stmt->close();
} else {
	//Warning message
	echo 'Could not prepare statement!';
}
$con->close();
?>
