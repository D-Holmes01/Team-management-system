function closeOptionForm()
{
    optionForm.style.display = 'none';
}


document.addEventListener('DOMContentLoaded', function() 
{

    //hardcode
    $squad = 8;

    function teamSelection()
    {
        //change to POST instead of GET
        //hardcode
        var link = "http://unn-w19003579.newnumyspace.co.uk/group/calendarFunctions/teamSelection.php?eventID=" + eventID ;
        window.location.href = link;
    }

    var calendarEl = document.getElementById('calendar');
    const optionForm = document.getElementById('optionForm');
    const closeBtn = document.getElementById('closeBtn');
    const teamSelectionBtn = document.getElementById('teamSelectionBtn');
    var eventID;


    closeBtn.addEventListener('click', closeOptionForm);
    teamSelectionBtn.addEventListener('click', teamSelection);
        

    var calendar = new FullCalendar.Calendar(calendarEl, 
    {
        initialView: 'dayGridMonth',
        //hardcode
        events: 'http://unn-w19003579.newnumyspace.co.uk/group/events.php?squad=' + $squad + "&eventType='Match'",
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