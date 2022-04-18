<?php
include "function.php";
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'unn_w19003579';
$DATABASE_PASS = 'Group123.';
$DATABASE_NAME = 'unn_w19003579';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT userPassword, userEmail FROM user WHERE userId = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['squadID']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();

$result = $con->query('SELECT * from user where user.userTeam = ' . $_SESSION['teamID'] . ';');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/all.css">
    <script type="text/javascript" src="assessmentJS.js"></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
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
        <div id="teamSelect">
            <form action="assignTeam.php" method="post">
                <p>Users:</p>
                <select name="users" id="users">
                    <?php 
                    while (
                        $ri = mysqli_fetch_array($result)
                    ) {
                    ?>
                        <option value="<?php echo $ri['userID'] ?>">
                            <?php echo $ri['userFName'] . " " . $ri['userSName'] ?>
                        </option>

                    <?php
                    }
                    ?>
                </select>
                <select name="teams" id="teams">
                    <p>Teams</p>

                    <?php
                    $result = $con->query("SELECT squad.squadID, squad.squadName from teamSquad LEFT JOIN squad on squad.squadID = teamSquad.squadID where teamSquad.teamID = " . $_SESSION['teamID'] . ";");
                    while (
                        $ri = mysqli_fetch_array($result)
                    ) {
                    ?>
                        <option value="<?php echo $ri['squadID'] ?>">
                            <?php echo $ri['squadName'] ?>
                        </option>

                    <?php
                    }
                    ?>
                </select>
                <input type="submit" id="assignTeam"></input>
            </form>
        </div>
        <div id="captainSelect">
            <form action="assignCaptain.php" method="post">
                
                <select name="teams" id="teams">
                    <p>Teams</p>

                    <?php
                    $result = $con->query("SELECT squad.squadID, squad.squadName from teamSquad LEFT JOIN squad on squad.squadID = teamSquad.squadID where teamSquad.teamID = " . $_SESSION['teamID'] . ";");
                    while (
                        $ri = mysqli_fetch_array($result)
                    ) {
                    ?>
                        <option value="<?php echo $ri['squadID'] ?>">
                            <?php echo $ri['squadName'] ?>
                        </option>

                    <?php
                    }
                    ?>
                </select>
                <p>Users:</p>
                <select name="users" id="users">
                    
                    <?php 
                    echo 'SELECT * from user where user.userTeam = ' . $_SESSION['teamID'] . ' AND user.userRole < 3;';
                    $result = $con->query('SELECT * from user where user.userTeam = ' . $_SESSION['teamID'] . ' AND user.userRole < 3;');
                    while (
                        $ri = mysqli_fetch_array($result)
                    ) {
                    ?>
                        <option value="<?php echo $ri['userID'] ?>">
                            <?php echo $ri['userFName'] . " " . $ri['userSName'] ?>
                        </option>

                    <?php
                    }
                    ?>
                </select>
                <input type="submit" id="assignCaptain"></input>
            </form>
        </div>
        <div id="newTeam">
            <form action="createTeam.php" method="post">
                <input type="text" name = "name">
            <input type="submit" id="createTeam.php"></input>

            </form>
        </div>
    </div>
</body>

</html>
