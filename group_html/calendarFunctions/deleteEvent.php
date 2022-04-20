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

$eventID = $_GET['eventID'];


if (!isset($eventID))
{
    echo("event id empty");
}

else if (isset($eventID))
{

    $sql = "DELETE FROM `unn_w19003579`.`event` WHERE `event`.`eventID` = $eventID";
    
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