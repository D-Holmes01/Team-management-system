//function for closing the form
function closeOptionForm()
{
    optionForm.style.display = 'none';
}


document.addEventListener('DOMContentLoaded', function() 
{

    //hardcode
    $squad = 8;

    //function used for team selection
    function teamSelection()
    {
        //hardcode
        //link used to load team selection page with a specific eventID
        var link = "http://unn-w19003579.newnumyspace.co.uk/group/calendarFunctions/teamSelection.php?eventID=" + eventID ;
        window.location.href = link;
    }

    //linking the html elements to variables
    var calendarEl = document.getElementById('calendar');
    const optionForm = document.getElementById('optionForm');
    const closeBtn = document.getElementById('closeBtn');
    const teamSelectionBtn = document.getElementById('teamSelectionBtn');
    var eventIDInput = document.getElementById('matchIDT');
    var eventID;

    //binding event listeners to the buttons and the respective functions
    closeBtn.addEventListener('click', closeOptionForm);
    teamSelectionBtn.addEventListener('click', teamSelection);
        

    var calendar = new FullCalendar.Calendar(calendarEl, 
    {
        initialView: 'dayGridMonth',
        //hardcode
        //link used to load events that are of the type Match
        events: 'http://unn-w19003579.newnumyspace.co.uk/group/events.php?squad=' + $squad + "&eventType='Match'",
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
            //the ID of the event is stored so that it can be used for team selection
            var eventObj = info.event;
            optionForm.style.display = 'block';
            eventID = eventObj.id;
            eventIDInput.value = 'babu';

        }

    });

    //displays the calendar
    calendar.render();

});