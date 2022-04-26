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
  <body>
    <div id='calendar'></div>

    <!-- form used to display the available options -->
    <div id='optionFormContainer'>
      <form id="optionForm">

        <!-- button used for team selection -->
        <input type="button" value="Team Selection" id="teamSelectionBtn">

        <!-- button used to close the form -->
        <input type="button" value="Close" id="closeBtn">
      </form>
    </div>
  </body>
</html>