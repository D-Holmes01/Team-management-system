//function for closing the form
function closeOptionForm()
{
    optionForm.style.display = 'none';
}


document.addEventListener('DOMContentLoaded', function() 
{

    //remove hard code
    var userID = '32';
    var squadID = '8';


    //function used to RSVP
    function RSVP()
    {
        //hardcode
        //link used to go to RSVP page along with eventID and the userID
        var link = "http://unn-w19003579.newnumyspace.co.uk/group/calendarFunctions/RSVP.php?eventID=" + eventID + "&userID="  + userID;
        window.location.href = link;
    }

    //linking the html elements to variables
    var calendarEl = document.getElementById('calendar');
    const optionForm = document.getElementById('optionForm');
    const closeBtn = document.getElementById('closeBtn');
    const RSVPBtn = document.getElementById('RSVPBtn');
    var eventID;

    //binding event listeners to the buttons and the respective functions
    closeBtn.addEventListener('click', closeOptionForm);
    RSVPBtn.addEventListener('click', RSVP);
        

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
        }

    });

    //displays the calendar
    calendar.render();

});