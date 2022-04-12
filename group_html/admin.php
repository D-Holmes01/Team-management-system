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

$result = $con->query("SELECT * from user");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/all.css">
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
        <div>
            <h2>Admin Page</h2>
            <p>Which admin action would you like to perform:</p>
            <li><a href="userAdmin.php"><i class="fa-solid fa-user-pen"></i>Users</a></li>
            <li><a href="teamAdmin.php"><i class="fa-solid fa-people-group"></i>Squads</a></li>
            <li><a href="deleteAdmin.php"><i class="fa-solid fa-delete-left"></i>Remove Data</a></li>
        </div>
    </div>
</body>

</html>