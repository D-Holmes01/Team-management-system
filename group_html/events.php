<?php

header('Content-Type: application/json; charset=utf-8');

//Database details
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'unn_w19003579';
$DATABASE_PASS = 'Group123.';
$DATABASE_NAME = 'unn_w19003579';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) 
{
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ($con->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['squad']))
{
    $squad = $_GET['squad'];

    if (isset($_GET['eventType']))
    {
        $sql = "SELECT eventID, eventDateTime, eventType from event WHERE squadID = '$squad' AND eventType = 'Match';";
    }

    if (!isset($_GET['eventType']))
    {
        $sql = "SELECT eventID, eventDateTime, eventType from event WHERE squadID = '$squad'; ";
    }

    $result = $con->query($sql);
        
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $eventid = $row["eventID"];
            $eventdate = $row["eventDateTime"];
            $eventname = $row["eventType"];
        
            $events[] = array('title'=>$eventname, 'start'=>$eventdate, 'id'=>$eventid);
        }
        
        echo $jsonformat = json_encode($events);

    }

    else
    {
        echo "Events list is empty";
    }
    
}

else
{
    $sql = "SELECT eventID, eventDateTime, eventType from event; ";

    $result = $con->query($sql);
        
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $eventid = $row["eventID"];
            $eventdate = $row["eventDateTime"];
            $eventname = $row["eventType"];
        
            $events[] = array('title'=>$eventname, 'start'=>$eventdate, 'id'=>$eventid);
        }
        
        echo $jsonformat = json_encode($events);

    }
}



$con->close();

?>