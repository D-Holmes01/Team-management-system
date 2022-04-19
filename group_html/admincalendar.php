<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Calendar</title>
    <link href='fullcalendar/main.css' rel='stylesheet' />
    <link href='style2.css' rel='stylesheet' />
    <script src='fullcalendar/main.js'></script>
    <script>

      function closeForm()
      {
        form.style.display = 'none';
      }

      function closeOptionForm()
      {
        optionForm.style.display = 'none';
      }

      function changeFormInput()
      {
        var eventTypeValue = document.getElementById('eventType').value;
        var eventName = document.getElementById('eventName');
        var eventNameLabel = document.getElementById('eventNameLabel');
        var captain = document.getElementById('captain');
        var captainLabel = document.getElementById('captainLabel');

        if (eventTypeValue == "match")
        {
          eventName.style.display = 'none';
          eventNameLabel.style.display = 'none';
          eventName.value = 'Match';
          captain.style.display = 'block';
          captainLabel.style.display = 'block';
        }

        if (eventTypeValue == 'training')
        {
          eventName.style.display = 'none';
          eventNameLabel.style.display = 'none';
          eventName.value = 'Training';
          captain.style.display = 'none';
          captainLabel.style.display = 'none';
        }

        if (eventTypeValue == 'other')
        {
          eventName.style.display = 'block';
          eventNameLabel.style.display = 'block';
          eventName.value = '';
          captain.style.display = 'none';
          captainLabel.style.display = 'none';
        }
      }


      document.addEventListener('DOMContentLoaded', function() 
      {

        function deleteEvent()
        {
          //hardcode
          var link = "http://unn-w19003579.newnumyspace.co.uk/group/deleteEvent.php?eventID=" + eventID;
          window.location.href = link;
        }

        function editEvent()
        {
          //hardcode
          var link = "http://unn-w19003579.newnumyspace.co.uk/group/editEvent.php?eventID=" + eventID;
          window.location.href = link;
        }

        function viewAttendanceList()
        {
          //hardcode
          var link = "http://unn-w19003579.newnumyspace.co.uk/group/viewAttendanceList.php?eventID=" + eventID;
          window.location.href = link;
        }

        var calendarEl = document.getElementById('calendar');
        const form = document.getElementById('form');
        const optionForm = document.getElementById('optionForm');
        const closeBtn = document.getElementById('closeBtn');
        const closeBtn2 = document.getElementById('closeBtn2');
        const deleteBtn = document.getElementById('deleteBtn');
        const editBtn = document.getElementById('editBtn');
        const attendanceBtn = document.getElementById('attendanceBtn');
        const eventType = document.getElementById('eventType');
        var eventID;


        closeBtn.addEventListener('click', closeForm);
        closeBtn2.addEventListener('click', closeOptionForm);
        deleteBtn.addEventListener('click', deleteEvent);
        editBtn.addEventListener('click', editEvent);
        attendanceBtn.addEventListener('click', viewAttendanceList);
        eventType.addEventListener('change', changeFormInput);
        

        var calendar = new FullCalendar.Calendar(calendarEl, 
        {
          initialView: 'dayGridMonth',
          //hardcode
          events: 'http://unn-w19003579.newnumyspace.co.uk/group/events.php',
          height: "auto",

          customButtons:
          {
              addEvent: 
              {
                text: "Add Event",
                click: function()
                {
                    if (form.style.display == 'block')
                    {
                        form.style.display = 'none';
                    }
                    
                    else
                    {
                        form.style.display = 'block';
                    }
                }
              }
          },
          
          headerToolbar: 
          {
            left: 'addEvent',  
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

    <div id='formcontainer'>
      <form id="form" action="addEvent.php" method="get" autocomplete="off">

        <label for="eventType">Event Type: </label><br><br>
        <select name="eventType" id="eventType" onchange="changeFormInput" required>
          <option value="training">Training</option>
          <option value="match">Match</option>
          <option value="other" selected>Other</option>
        </select><br>

        <label for="eventname" id="eventNameLabel">Event Name: </label><br>
        <input type="text" id="eventName" name="eventName" required><br>
        <label for="datetime">Date and Time: </label><br>
        <input type="datetime-local" id="datetime" name="datetime" required><br>

        <!-- fix hardcoded data -->
        <label for="captain" id="captainLabel">Captain: </label><br><br>
        <select name="captain" id="captain">
          <option value="0" hidden></option>
          <option value="22">22</option>
          <option value="25">25</option>
        </select><br><br>

        <!-- fix hardcoded data -->
        <label for="squad">Squad: </label><br><br>
        <select name="Squad" id="Squad" required>
          <option value="1">First squad</option>
          <option value="2">Second squad</option>
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