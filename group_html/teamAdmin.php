
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
            <!-- Show calendar only if the user role for the logged in user has been set -->
            <?php if (isset($_SESSION['userRole'])){
            echo '<a href="calendar.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>';
            }
            ?>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>
    <!-- page content -->
    <div class="content">
        <!-- team selection form-->
        <div id="teamSelect">
            <form action="assignTeam.php" method="post">
                <h2>Add player to team</h2>
                <h3>Users:</h3>
                <!-- select is populated by database users-->
                <select name="users" id="users">
                    <?php $result = $con->query('SELECT * from user where user.userTeam = ' . $_SESSION['teamID'] . ';');

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
                <h3>Teams</h3>
                <!-- select is populated by database teams -->
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
                <input type="submit" id="assignTeam"></input>
            </form>
        </div>
        <!-- captaincy selection div -->
        <div id="captainSelect">
            <h2>Assign captaincy</h2>
            <!-- captaincy form, on submit this will update the team captaincy to the select user-->
            <form action="assignCaptain.php" method="post">
                <h3>Teams:</h3>
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
                <h3>Players:</h3>
                <!-- fill select with users from db -->
                <select name="users" id="users">

                    <?php
                    echo 'SELECT * from user where user.userTeam = ' . $_SESSION['teamID'] . ' AND user.userRole < 3;';
                    $result = $con->query('SELECT * from user where user.userteam = ' . $_SESSION['teamID'] . ' AND user.userrole < 3;');
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
        <!-- div for new teams -->
        <div id="newTeam">
            <h2>Create new team</h2>
            <!-- form which on submit will create a new squad in the database with the enter name-->
            <form action="createTeam.php" method="post">
                <h3>New team name:</h3>

                <input type="text" name="name">
                <input type="submit" id="createTeam.php"></input>
            </form>
        </div>
    </div>
</body>

</html>

