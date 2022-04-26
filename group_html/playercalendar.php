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
  </head>
  <body>
    <div id='calendar'></div>

    <!-- form used to display the available options -->
    <div id='optionFormContainer'>
      <form id="optionForm">

        <!-- button for RSVP'ing -->
        <input type="button" value="RSVP" id="RSVPBtn">

        <!-- button for closing the form -->
        <input type="button" value="Close" id="closeBtn">
      </form>
    </div>
  </body>
</html>