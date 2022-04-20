<?php

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
    die("Connection failed: " . $con->connect_error);
}

$eventname = $_GET['eventname'];
$datetime = $_GET['datetime'];
$eventid = $_GET['eventID'];


if (!isset($eventname))
{
    echo("event name empty");
}

if (!isset($datetime))
{
    echo("datetime empty");
}

if (!isset($eventid))
{
    echo("eventid empty");
}

if (isset($datetime) && isset($eventname) && isset($eventid))
{
    $myDate = trim($datetime);
    $newDate = new DateTime($myDate);
    $myDate = $newDate->format('Y-m-d H:i:s');

    $sql = "UPDATE `unn_w19003579`.`event` SET `eventDateTime`='$myDate',`eventType`='$eventname' WHERE `eventID`='$eventid';";
    
    if (mysqli_query($con, $sql))
    {
        //hardcode
        $home = 'http://unn-w19003579.newnumyspace.co.uk/group/admincalendar.php';
        header('Location: ' . $home);
    }

    else
    {
        echo "ERROR: Could not execute $sql. " . mysqli_error($con);
    }
    
}

$con->close();

?>