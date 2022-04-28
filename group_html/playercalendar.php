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
    <script src='playerCalendar.js'></script>
    <?php
    //session_start();
    require('calendarFunctions/checkSquad.php');
    ?>


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
         <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
         <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
         <!-- Show calendar only if the user role for the logged in user has been set -->
         <?php if (isset($_SESSION['userRole'])){
           echo '<a href="calendar.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>';
         }
         ?>
         <!-- Show MyEvents link for players -->
         <?php if ($_SESSION['userRole'] == 1) {
            echo '<a href="myEvents.php"><i class="fa-solid fa-calendar-xmark"></i>My Events</a>';
         }
         ?>
      </div>
   </nav>
  <body>
    <div id='calendar'></div>

    <!-- form used to display the available options -->
    <div id='optionFormContainer'>
      <form id="optionForm" action='calendarFunctions/RSVP.php' method="get">

        <!-- button for RSVP'ing -->
        <input type="submit" value="RSVP" id="RSVPBtn">

        <!-- the userID and squadID are passed from the session array through a hidden input  -->
        <input type="hidden" value="<?php echo $_SESSION['userID'] ?>" name="userID" id="userID">
        <input type="hidden" value="<?php echo $_SESSION['squadID'] ?>" name="squadID" id="squadID">
        <input type="hidden" value="" name="eventID" id="eventID">

        <!-- button for closing the form -->
        <input type="button" value="Close" id="closeBtn">

      </form>

    </div>
  </body>
</html>