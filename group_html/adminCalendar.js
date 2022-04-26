//function for closing the add event form
function closeForm()
{
    form.style.display = 'none';
}

//function for closing the options form
function closeOptionForm()
{
    optionForm.style.display = 'none';
}

//function for changing the input form based on the selected event type
function changeFormInput()
{
    var eventTypeValue = document.getElementById('eventType').value;
    var eventName = document.getElementById('eventName');
    var eventNameLabel = document.getElementById('eventNameLabel');

    //if a match is chosen as the event type
    if (eventTypeValue == "match")
    {
        //event name input box and label are hidden
        eventName.style.display = 'none';
        eventNameLabel.style.display = 'none';

        //the value of eventname is set to Match
        eventName.value = 'Match';
    }

    //if training is chosen as the event type
    if (eventTypeValue == 'training')
    {
        //event name input box and label are hidden
        eventName.style.display = 'none';
        eventNameLabel.style.display = 'none';

        //the value of eventname is set to training
        eventName.value = 'Training';
    }

    //if other is chosen as the event type
    if (eventTypeValue == 'other')
    {
        //event name input box and label are displayed
        eventName.style.display = 'block';
        eventNameLabel.style.display = 'block';

        //the value of eventname is set to an empty string
        eventName.value = '';
    }
    
}

document.addEventListener('DOMContentLoaded', function() 
{

    //function for deleting an event
    function deleteEvent()
    {
        //hardcode
        var link = "http://unn-w19003579.newnumyspace.co.uk/group/calendarFunctions/deleteEvent.php?eventID=" + eventID;
        window.location.href = link;
    }

    //function for editing an event
    function editEvent()
    {
        //hardcode
        var link = "http://unn-w19003579.newnumyspace.co.uk/group/calendarFunctions/editEvent.php?eventID=" + eventID;
        window.location.href = link;
    }

    //function for viewing the attendance list
    function viewAttendanceList()
    {
        //hardcode
        var link = "http://unn-w19003579.newnumyspace.co.uk/group/calendarFunctions/viewAttendanceList.php?eventID=" + eventID;
        window.location.href = link;
    }

    //linking the html elements to variables
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

    //binding event listeners to the buttons and the respective functions
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
        //link used to load events
        events: 'http://unn-w19003579.newnumyspace.co.uk/group/events.php',
        height: "auto",

        //for creation of custom buttons
        customButtons:
        {
            //creating the addEvvent button
            addEvent: 
            {
                text: "Add Event",
                
                //function that is run when button is clicked
                click: function()
                {
                    //hide the add event form if it is shown
                    if (form.style.display == 'block')
                    {
                        form.style.display = 'none';
                    }
                    
                    //otherwise hide the form
                    else
                    {
                        form.style.display = 'block';
                    }
                }
            }
        },

        //for creating the text on the header
        headerToolbar: 
        {
            left: 'addEvent',  
            center: 'title'
        },

        //creating the today button
        buttonText: {today: "Today"},

        //function that is run when an event is clicked
        eventClick: function(info)
        {

            //the ID of the event is stored so that it can be used for editing/deleting an event
            var eventObj = info.event;
            optionForm.style.display = 'block';
            eventID = eventObj.id;
        }

    });

    //displays the calendar
    calendar.render();

});