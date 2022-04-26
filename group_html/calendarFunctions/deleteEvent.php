<?php

//this file is used to make sure the current user has administrator privileges
require_once('checkAdminPrivilege.php');

//takes place if the user has the required privileges
if ($adminStatus)
{
    //this file is used to connect to the database
    require_once('connect.php');

    //sets the eventID based on data from the GET array
    $eventID = $_GET['eventID'];

    //displays an error message if the eventID is not set
    if (!isset($eventID))
    {
        echo("event id empty");
    }

    //takes place if the eventID is set
    else if (isset($eventID))
    {

        //sql query for deleting an event
        $sql = "DELETE FROM `unn_w19003579`.`event` WHERE `event`.`eventID` = $eventID";
        
        //returns the user to the previous page if the event was deleted without problems
        if (mysqli_query($con, $sql))
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        //otherwise display an error message along with the specific error
        else
        {
            echo "ERROR: Could not execute $sql. " . mysqli_error($con);
        }
        
    }

    //closes the connection to the database
    $con->close();

}

//display an error message if the user does not have the required privileges
else
{
    require_once('adminError.html');
}


?>