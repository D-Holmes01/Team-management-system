<?php

//this file is used to connect to the database
require_once('connect.php');

//get the eventID and userID from $_POST
//$_POST is used here so a user cannot be removed simply by entering their id into the address bar
$eventID = $_POST['eventID'];
$userID = $_POST['userID'];

//shows an error message if the event id is not set
if (!isset($eventID))
{
    echo("event id empty");
}

//shows an error message if the user id is not set
if (!isset($userID))
{
    echo("user id empty");
}

//otherwise perform the following
else
{

    //sql for deleting a player from the eventplayer table
    $sql = "DELETE FROM `unn_w19003579`.`eventplayer` WHERE `eventID` = '$eventID' AND `userID` = '$userID'";
    
    //returns the user to the previous page if the sql was successful
    if (mysqli_query($con, $sql))
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //show an error message otherwise
    else
    {
        echo "ERROR: Could not execute $sql. " . mysqli_error($con);
    }
    
}

//end the connection to the database
$con->close();

?>