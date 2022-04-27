<?php

//session_start();

//this file is used to ensure that the current user is logged in and has a user role that allows for adding events
require_once('checkAdminPrivilege.php');

//if the user has admin status, perform the following 
if ($adminStatus)
{
    //this file is used to connect to the database
    require_once('connect.php');

    //the event details are gotten from $_GET
    $eventname = $_POST['eventName'];
    $datetime = $_POST['datetime'];
    $squadID = $_POST['squad'];

    //shows an error message if the event name is not set
    if (!isset($eventname))
    {
        echo("event name empty");
    }

    //shows an error message if the date and time are not set
    if (!isset($datetime))
    {
        echo("datetime empty");
    }

    //shows an error message if the squad ID is not set
    if (!isset($squadID))
    {
        echo("squad empty");
    }

    //this takes place if all three details are present
    //these three details are very important as if one is missing other functions would not be able to access the events properly
    if (isset($datetime) && isset($eventname) && isset($squadID))
    {

        try
        {
            //formatting is done to make sure the date and time are formatted in a way that allows them to be added to the database
            $myDate = trim($datetime);
            $newDate = new DateTime($myDate);
            $myDate = $newDate->format('Y-m-d H:i:s');

            //SQL query for getting the captain's ID based on the squad ID
            $sqlGetCaptainID = "SELECT captainID FROM squad WHERE squadID = '$squadID';";
            $result = $con->query($sqlGetCaptainID);

            //the following takes place if the query does not return an empty set
            if ($result->num_rows > 0)
            {
                //gets the details from the query
                $row = $result->fetch_assoc();
                $captainID = $row['captainID'];

                //the following takes place if getting the captainID was successful
                if (isset($captainID))
                {
                    //sql for inserting the event into the database
                    //prepared statement is used to make sure the data entered does not cause problems to the table
                    $sqlInsert = "INSERT INTO `unn_w19003579`.`event` (`eventID` ,`eventDateTime`, `eventType`, `eventCaptain`, `squadID`) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $con->prepare($sqlInsert);

                    //this variable is used to pass a null value as the eventID as the table uses autoincrement
                    $e = NULL;

                    $stmt->bind_param("issii", $e, $myDate, $eventname, $captainID, $squadID);
                    

                    //if the insert was successful, redirects the user to the calendar page
                    if ($stmt->execute())
                    {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }

                    //if not, shows an error message along with the details
                    else
                    {
                        echo "ERROR: Could not execute sql. " . mysqli_error($con);
                    }
                
                }

                //this takes place if the squad does not have a captain
                //this should not take place, but is a safety net
                else
                {
                    echo "Squad does not have a captain";
                }
            }
        }

        catch (Exception $e) 
        {
            throw new Exception("Error: " . $e->getMessage(), 0, $e);
        }
        
    }

    //closes the connection to the database
    $con->close();
}

//if the user does not have administrator privileges
else
{
    //shows an error page 
    require_once('adminError.html');
}



?>