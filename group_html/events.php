<?php

header('Content-Type: application/json; charset=utf-8');

//used to connect to the database
require_once('calendarFunctions/connect.php');

//if the squad is available from the $GET array perform the following
if (isset($_GET['squad']))
{
    $squad = $_GET['squad'];

    //if the eventType is passed through the $GET array
    if (isset($_GET['eventType']))
    {
        //get events belonging to the specified squad and where the eventType is Match
        $sql = "SELECT eventID, eventDateTime, eventType from event WHERE squadID = '$squad' AND eventType = 'Match';";
    }

    //if the eventType is not passed through the $GET array
    if (!isset($_GET['eventType']))
    {
        //get events belonging to the specified squad
        $sql = "SELECT eventID, eventDateTime, eventType from event WHERE squadID = '$squad'; ";
    }

    //run the sql query
    $result = $con->query($sql);
    
    // if the result set is not empty
    if ($result->num_rows > 0)
    {
        //get the results and the details
        while($row = $result->fetch_assoc())
        {
            $eventid = $row["eventID"];
            $eventdate = $row["eventDateTime"];
            $eventname = $row["eventType"];
        
            //create an array containing the events
            $events[] = array('title'=>$eventname, 'start'=>$eventdate, 'id'=>$eventid);
        }
        
        //display the events in json format
        echo $jsonformat = json_encode($events);

    }

    //otherwise display a message saying the events list is empty
    else
    {
        echo "Events list is empty";
    }
    
}

//if the squad is not passed through the $GET array
else
{
    //sql to show all events
    $sql = "SELECT eventID, eventDateTime, eventType from event; ";

    $result = $con->query($sql);
    
    //if the result set is not empty
    if ($result->num_rows > 0)
    {
        //load each event
        while($row = $result->fetch_assoc())
        {
            $eventid = $row["eventID"];
            $eventdate = $row["eventDateTime"];
            $eventname = $row["eventType"];
        
            //load the events into an array
            $events[] = array('title'=>$eventname, 'start'=>$eventdate, 'id'=>$eventid);
        }
        
        //display the events in json format
        echo $jsonformat = json_encode($events);

    }
}


//end the connection to the database
$con->close();

?>