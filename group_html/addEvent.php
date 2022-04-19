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

$eventname = $_GET['eventName'];
$datetime = $_GET['datetime'];
$captain = $_GET['captain'];


if (!isset($eventname))
{
    echo("event name empty");
}

if (!isset($datetime))
{
    echo("datetime empty");
}

if (!isset($captain))
{
    $captain = '0';
}

if (isset($datetime) && isset($eventname))
{
    $myDate = trim($datetime);
    $newDate = new DateTime($myDate);
    $myDate = $newDate->format('Y-m-d H:i:s');

    $sql = "INSERT INTO `unn_w19003579`.`event` (`eventID`, `eventDateTime`, `eventType`, `eventCaptain`) VALUES (NULL, '$myDate', '$eventname', '$captain');";
    
    if (mysqli_query($con, $sql))
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    else
    {
        echo "ERROR: Could not execute $sql. " . mysqli_error($con);
    }
    
}

$con->close();

?>