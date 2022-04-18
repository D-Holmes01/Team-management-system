<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'unn_w19003579';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT userPassword, userEmail FROM user WHERE userId = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['userID']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Profile Page</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css">
</head>

<body class="loggedin">
	<nav class="navtop">
		<div>
			<h1>Website Title</h1>
			<a href="home.php"><i class="fa-solid fa-house"></i>Home</a>
			<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav>
	<div class="content">
		<h2>Profile Page</h2>
		<div>
			<p>Your account details are below:</p>
			<form action="editAccount.php" method="post">
				<input id="Fname" name="Fname" type="text" value="<?= $_SESSION['name'] ?>">
				<input id="Sname" name="Sname" type="text" value="<?= $_SESSION['surname'] ?>">
				<input id="Bio" name="Bio" type="text" value="<?= $_SESSION['bio'] ?>">
				<select type="checkbox" name="Position" placeholder="Position" id="Position" content=<?= $_SESSION['position'] ?>>
					<option selected disabled><?= $_SESSION['position'] ?></option>
					<option value="null">Non-playing user</option>
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
				<input type="submit" id="editUser"></input>
		</div>
</form>
		<div id="deleteUser">
			<form action="deleteUser.php" method="post">
				<input type= "hidden" name="user" value = <?=$_SESSION['userID']?>>
				<input type="submit" id="deleteUser"></input>
			</form>
		</div>
	</div>
</body>

</html>