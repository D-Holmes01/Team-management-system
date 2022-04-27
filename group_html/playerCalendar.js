//function for closing the form
function closeOptionForm()
{
    optionForm.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() 
{


    //linking the html elements to variables
    var calendarEl = document.getElementById('calendar');
    const optionForm = document.getElementById('optionForm');
    var squadID = document.getElementById('squadID').value;
    const closeBtn = document.getElementById('closeBtn');
    var eventIDInput = document.getElementById('eventID');
    var eventID;

    //binding event listeners to the close button and the respective function
    closeBtn.addEventListener('click', closeOptionForm);        

    var calendar = new FullCalendar.Calendar(calendarEl, 
    {
        initialView: 'dayGridMonth',
        //hardcode
        //link to load events that belong the current user's squad
        events: 'http://unn-w19003579.newnumyspace.co.uk/group/events.php?squad=' + squadID,
        height: "auto",

        //for creating the text on the header
        headerToolbar: 
        {
            left: '',
            center: 'title'
        },

        //creating the today button
        buttonText: {today: "Today"},

        //function that is run when an event is clicked
        eventClick: function(info)
        {
            //the ID of the event is stored so that it can be used for RSVP'ing
            var eventObj = info.event;
            optionForm.style.display = 'block';
            eventID = eventObj.id;
            eventIDInput.value = eventID;
        }

    });

    //displays the calendar
    calendar.render();

});