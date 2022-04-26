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
  </head>
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