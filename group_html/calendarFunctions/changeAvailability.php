<?php

session_start();

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

    try
    {
        //sql for deleting a player from the eventplayer table
        //prepared statement used for security
        $sql = "DELETE FROM `unn_w19003579`.`eventplayer` WHERE `eventID` = ? AND `userID` = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ii", $eventID, $userID);
        
        //returns the user to the previous page if the sql was successful
        if ($stmt->execute())
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        //show an error message otherwise
        else
        {
            echo "ERROR: Could not execute $sql. " . mysqli_error($con);
        }
        }

    catch (Exception $e)
    {
        throw new Exception("Error: " . $e->getMessage(), 0, $e);
    }


    
    
}

//end the connection to the database
$con->close();

?>