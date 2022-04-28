<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";
?>

<!DOCTYPE html>
<html>

<head>
    <!-- web page setup, setting charset, title and stylesheets -->
    <meta charset="utf-8">
    <title>Admin</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/all.css">
</head>
<!-- body of webpage, class loggedin so that for different css -->

<body class="loggedin">
    <!-- nav bar -->
    <nav class="navtop">
        <div>
            <!-- Nav title and links, admin link hidden due to being the present page -->
            <h1>Admin</h1>
            <a href="admin.php"><i class="fa-solid fa-screwdriver-wrench"></i>Admin</a>
            <a href="home.php"><i class="fa-solid fa-house"></i>Home</a>
            <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>
    <!-- page content -->
    <div class="content">
        <!-- delete user form -->
        <div id="deleteUser">
            <!-- title -->
            <h2>Delete user/s</h2>
            <!-- delete user form -->
            <form action="deleteUser.php" method="post">
                <h3>Users:</h3>
                <!-- select filled from users from the database -->
                <select name="users" id="users">
                    <?php $result = $con->query("SELECT * from user where user.userTeam = " . $_SESSION['teamID'] . ";");
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
                <!-- submit which will run the delete user code via deleteuser.php -->
                <input type="submit" id="deleteUser"></input>
            </form>
        </div>
        <!-- delete team form -->
        <div id="deleteTeam">
            <h2>Delete team/s</h2>
            <form action="deleteTeam.php" method="post">
                <h3>Teams</h3>
                <!-- select filled from teams in the database associated with the user's club -->
                <select name="teams" id="teams">
                    <?php
                    $result = $con->query("SELECT squad.squadID, squad.squadName from teamsquad LEFT JOIN squad on squad.squadID = teamsquad.squadID where teamsquad.teamID = " . $_SESSION['teamID'] . ";");
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
                <!-- run assign team code on submit -->
                <input type="submit" id="assignTeam"></input>
            </form>
        </div>
    </div>
</body>

</html>

