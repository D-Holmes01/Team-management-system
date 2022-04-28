<?php
session_start();
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Calendar</title>

    <!-- links to the css file for the webpage and the calendar -->
    <link href='fullcalendar/main.css' rel='stylesheet' />
    <link href='style2.css' rel='stylesheet' />

    <!-- scripts used to load the calendar -->
    <script src='fullcalendar/main.js'></script>
    <script src='captainCalendar.js'></script>
  </head>
  <!-- nav bar -->
  <nav class="navtop">
      <div>
         <!-- Nav title and links, admin link hidden due to being the present page -->
         <h1>Calendar</h1>
         <!-- Show admin link for users with admin priveldges-->
         <?php if ($_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 4 || $_SESSION['userRole'] == 5) {
            echo '<a href="admin.php"><i class="fa-solid fa-screwdriver-wrench"></i>Admin</a>';
         }
         ?>
         <a href="../profile.php"><i class="fas fa-user-circle"></i>Profile</a>
         <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
         <!-- Show calendar only if the user role for the logged in user has been set -->
         <?php if (isset($_SESSION['userRole'])){
           echo '<a href="calendar.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>';
         }
         ?>
         <!-- Show MyEvents link for players -->
         <?php if ($_SESSION['userRole'] == 1) {
            echo '<a href="../myEvents.php"><i class="fa-solid fa-calendar-xmark"></i>My Events</a>';
         }
         ?>
      </div>
   </nav>
  <body>
    <div id='calendar'></div>

    <!-- form used to display the available options -->
    <div id='optionFormContainer'>
      <form id="optionForm" action="teamSelection.php" method="get">

        <!-- button used for team selection -->
        <input type="button" value="Team Selection" id="teamSelectionBtn">

        <input type="hidden" value="" id="ev" name="matchID">

        <!-- button used to close the form -->
        <input type="button" value="Close" id="closeBtn">
      </form>
    </div>
  </body>
</html>
