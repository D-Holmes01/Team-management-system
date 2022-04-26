<?php

//used to ensure the user has the appropriate privileges
require_once('checkAdminPrivilege.php');

//takes place if the appropriate privileges are present
if ($adminStatus)
{
    //this file is used to connect to the database
    require_once('connect.php');

    //stores data from the $GET array
    $eventname = $_GET['eventname'];
    $datetime = $_GET['datetime'];
    $eventid = $_GET['eventID'];

    //displays an error message if the event name is not set
    if (!isset($eventname))
    {
        echo("event name empty");
    }

    //displays an error message if the date and time are not set
    if (!isset($datetime))
    {
        echo("datetime empty");
    }

    //displays an error message if the event id is not set
    if (!isset($eventid))
    {
        echo("eventid empty");
    }

    //this takes place if all three details are present
    //these three details are very important as if one is missing other functions would not be able to access the events properly
    if (isset($datetime) && isset($eventname) && isset($eventid))
    {

        //formatting is done to make sure the date and time are formatted in a way that allows them to be added to the database
        $myDate = trim($datetime);
        $newDate = new DateTime($myDate);
        $myDate = $newDate->format('Y-m-d H:i:s');

        //SQL query for getting the captain's ID based on the squad ID
        $sql = "UPDATE `unn_w19003579`.`event` SET `eventDateTime`='$myDate',`eventType`='$eventname' WHERE `eventID`='$eventid';";
        
        //the user is redirected to the calendar if the sql was successful
        if (mysqli_query($con, $sql))
        {
            //hardcode
            $home = 'http://unn-w19003579.newnumyspace.co.uk/group/adminCalendar.php';
            header('Location: ' . $home);
        }

        //otherwise an error message is displayed
        else
        {
            echo "ERROR: Could not execute $sql. " . mysqli_error($con);
        }
        
    }

    //ends the connection to the database
    $con->close();
}

//shows an error page if administrator privileges are not present
else
{
    require_once('adminError.html');
}



?>