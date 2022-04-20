<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Calendar</title>
    <link href='fullcalendar/main.css' rel='stylesheet' />
    <link href='style2.css' rel='stylesheet' />
    <script src='fullcalendar/main.js'></script>
    <script src='adminCalendar.js'></script>
  </head>
  <body>
    <div id='calendar'></div>

    <div id='formcontainer'>
      <form id="form" action="calendarFunctions/addEvent.php" method="get" autocomplete="off">

        <label for="eventType">Event Type: </label><br><br>
        <select name="eventType" id="eventType" onchange="changeFormInput" required>
          <option value="training" selected>Training</option>
          <option value="match">Match</option>
          <option value="other">Other</option>
        </select><br>

        <label for="eventName" id="eventNameLabel">Event Name: </label><br>
        <input type="text" id="eventName" name="eventName" required><br>
        <label for="datetime">Date and Time: </label><br>
        <input type="datetime-local" id="datetime" name="datetime" required><br>

        <label for="squad">Squad: </label><br><br>
        <select name="squad" id="squad" required>
          <?php require_once 'calendarFunctions/showSquadsList.php';?>
        </select><br><br>

        <input type="submit" value="Add Event">
        <input type="button" value="Close" id="closeBtn">

      </form>
    </div>

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