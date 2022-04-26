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
            <a href="home.php"><i class="fa-solid fa-house"></i>Home</a>
            <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>
    <!-- page content -->
    <div class="content">
        <div>
            <!-- links to different admin pages -->
            <h2>Admin pages</h2>
            <h3>Admin areas</h3>
            <li><a href="userAdmin.php"><i class="fa-solid fa-user-pen"></i>Users</a></li>
            <li><a href="teamAdmin.php"><i class="fa-solid fa-people-group"></i>Squads</a></li>
            <li><a href="deleteAdmin.php"><i class="fa-solid fa-delete-left"></i>Remove Data</a></li>
        </div>
    </div>
</body>

</html>
