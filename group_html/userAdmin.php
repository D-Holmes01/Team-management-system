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
        <!-- select role div -->
        <div id="roleSelect">
            <!-- form that on submit will update user role to the selected role-->
            <form action="assignRole.php" method="post">
                <h2>Change user role</h2>
                <h3>Users:</h3>
                <!-- fill select with users -->
                <select name="users" id="users">
                    <?php $result = $con->query("SELECT * from user where user.userteam = " . $_SESSION['teamID'] . ";");
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
                <h3>Roles:</h3>
                <select name="role" id="role">
                    <option value="1">Player</option>
                    <option value="2">Captain</option>
                    <option value="3">Coach</option>
                    <option value="4">Admin</option>
                    <option value="5">Head Coach</option>
                </select>
                <input type="submit" id="assignRole"></input>
            </form>
        </div>
    </div>
</body>

</html>
