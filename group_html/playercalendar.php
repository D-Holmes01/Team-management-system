<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Calendar</title>
    <link href='fullcalendar/main.css' rel='stylesheet' />
    <link href='style.css' rel='stylesheet' />
    <script src='fullcalendar/main.js'></script>
    <script>


      function closeOptionForm()
      {
        optionForm.style.display = 'none';
      }


      document.addEventListener('DOMContentLoaded', function() 
      {

        //remove hard code
        var userID = '26';

        function RSVP()
        {
          //change to POST instead of GET
          //hardcode
          var link = "http://unn-w19003579.newnumyspace.co.uk/group/RSVP.php?eventID=" + eventID + "&userID="  + userID;
          window.location.href = link;
        }

        var calendarEl = document.getElementById('calendar');
        const optionForm = document.getElementById('optionForm');
        const closeBtn = document.getElementById('closeBtn');
        const RSVPBtn = document.getElementById('RSVPBtn');
        var eventID;


        closeBtn.addEventListener('click', closeOptionForm);
        RSVPBtn.addEventListener('click', RSVP);
        

        var calendar = new FullCalendar.Calendar(calendarEl, 
        {
          initialView: 'dayGridMonth',
          //hardcode
          events: 'http://unn-w19003579.newnumyspace.co.uk/group/events.php',
          height: "auto",

          
          headerToolbar: 
          {
            left: '',
            center: 'title'
          },

          buttonText: {today: "Today"},

          eventClick: function(info)
          {
            var eventObj = info.event;
            optionForm.style.display = 'block';
            eventID = eventObj.id;
          }

        });

        calendar.render();

      });

      

    </script>
  </head>
  <body>
    <div id='calendar'></div>

    <div id='optionFormContainer'>
      <form id="optionForm">
        <input type="button" value="RSVP" id="RSVPBtn">
        <input type="button" value="Close" id="closeBtn">
      </form>
    </div>
  </body>
</html>