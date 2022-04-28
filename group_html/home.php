<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";
?>

<!DOCTYPE html>
<html>

<head>
   <!-- web page setup, setting charset, title and stylesheets -->
   <meta charset="utf-8">
   <title>Home</title>
   <link href="style.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/all.css">
</head>
<!-- body of webpage, class loggedin so that for different css -->

<body class="loggedin">
   <!-- nav bar -->
   <nav class="navtop">
      <div>
         <!-- Nav title and links, admin link hidden due to being the present page -->
         <h1>Home</h1>
         <!-- Show admin link for users with admin priveldges-->
         <?php if ($_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 4 || $_SESSION['userRole'] == 5) {
            echo '<a href="admin.php"><i class="fa-solid fa-screwdriver-wrench"></i>Admin</a>';
         }
         ?>
         <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
         
         <a href="calendar.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>
         <!-- Show MyEvents link for players -->
         <?php if ($_SESSION['userRole'] == 1) {
            echo '<a href="myEvents.php"><i class="fa-solid fa-calendar-xmark"></i>My Events</a>';
         }
         ?>
         <a href="messageboard.php"><i class="fa-solid fa-message-board"></i>Messageboard</a>
         <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </div>
   </nav>
   <!-- page content -->
   <div class="content">
      <h2>Home Page</h2>
      <!-- Show users name -->
      <p>Welcome back, <?= $_SESSION['name'] ?>!</p>
   </div>
</body>

</html>

