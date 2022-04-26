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
    <script src='adminCalendar.js'></script>
    <?php session_start(); ?>
    
  </head>
  <!-- nav bar -->
  <nav class="navtop">
      <div>
         <!-- Nav title and links, admin link hidden due to being the present page -->
         <h1>Website Title</h1>
         <!-- Show admin link for users with admin priveldges-->
         <?php if ($_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 4 || $_SESSION['userRole'] == 5) {
            echo '<a href="admin.php"><i class="fa-solid fa-screwdriver-wrench"></i>Admin</a>';
         }
         ?>
         <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
         <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
         <a href="calendar.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>
         <!-- Show MyEvents link for players -->
         <?php if ($_SESSION['userRole'] == 1) {
            echo '<a href="myEvents.php"><i class="fa-solid fa-calendar-xmark"></i>My Events</a>';
         }
         ?>
      </div>
   </nav>
  <body>
    <div id='calendar'></div>

    <!-- form used for adding an event -->
    <div id='formcontainer'>
      <form id="form" action="calendarFunctions/addEvent.php" method="get" autocomplete="off">
        <label for="eventType">Event Type: </label><br><br>

        <!-- select input for choosing the event type -->
        <select name="eventType" id="eventType" onchange="changeFormInput" required>
          <option value="training" selected>Training</option>
          <option value="match">Match</option>
          <option value="other">Other</option>
        </select><br>

        <!-- input for the event name -->
        <label for="eventName" id="eventNameLabel">Event Name: </label><br>
        <input type="text" id="eventName" name="eventName" required><br>

        <!-- input for date and time -->
        <label for="datetime">Date and Time: </label><br>
        <input type="datetime-local" id="datetime" name="datetime" required><br>

        <!-- input for choosing which squad the event belongs to -->
        <label for="squad">Squad: </label><br><br>
        <select name="squad" id="squad" required>

          <!-- function used to show the available squads from the database -->
          <?php require_once 'calendarFunctions/showSquadsList.php';?>

        </select><br><br>

        <!-- submit button -->
        <input type="submit" value="Add Event">
        <input type="button" value="Close" id="closeBtn">

      </form>
    </div>

    <!-- form that allows the user to edit/delete an event, view attendance or close the form -->
    <div id='optionFormContainer'>
      <form id="optionForm">
        <input type="button" value="Edit Event" id="editBtn">
        <input type="button" value="Delete Event" id="deleteBtn">
        <input type="button" value="View Attendance" id="attendanceBtn">
        <input type="button" value="Close" id="closeBtn2">
      </form>
    </div>
  </body>
</html>