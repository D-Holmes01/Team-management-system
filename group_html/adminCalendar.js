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

    if (eventTypeValue == "match")
    {
        eventName.style.display = 'none';
        eventNameLabel.style.display = 'none';
        eventName.value = 'Match';
    }

    if (eventTypeValue == 'training')
    {
        eventName.style.display = 'none';
        eventNameLabel.style.display = 'none';
        eventName.value = 'Training';
    }

    if (eventTypeValue == 'other')
    {
        eventName.style.display = 'block';
        eventNameLabel.style.display = 'block';
        eventName.value = '';
    }
    
}

document.addEventListener('DOMContentLoaded', function() 
{

    function deleteEvent()
    {
        //hardcode
        var link = "http://unn-w19003579.newnumyspace.co.uk/group/calendarFunctions/deleteEvent.php?eventID=" + eventID;
        window.location.href = link;
    }

    function editEvent()
    {
        //hardcode
        var link = "http://unn-w19003579.newnumyspace.co.uk/group/calendarFunctions/editEvent.php?eventID=" + eventID;
        window.location.href = link;
    }

    function viewAttendanceList()
    {
        //hardcode
        var link = "http://unn-w19003579.newnumyspace.co.uk/group/calendarFunctions/viewAttendanceList.php?eventID=" + eventID;
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