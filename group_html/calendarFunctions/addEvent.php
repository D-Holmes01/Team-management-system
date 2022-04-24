<?php

require_once('checkAdminPrivilege.php');

if ($adminStatus)
{

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
    $squadID = $_GET['squad'];

    if (!isset($eventname))
    {
        echo("event name empty");
    }

    if (!isset($datetime))
    {
        echo("datetime empty");
    }

    if (!isset($squadID))
    {
        echo("squad empty");
    }


    if (isset($datetime) && isset($eventname) && isset($squadID))
    {
        $myDate = trim($datetime);
        $newDate = new DateTime($myDate);
        $myDate = $newDate->format('Y-m-d H:i:s');

        $sqlGetCaptainID = "SELECT captainID FROM squad WHERE squadID = '$squadID';";
        $result = $con->query($sqlGetCaptainID);

        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $captainID = $row['captainID'];

            if (isset($captainID))
            {
                $sqlInsert = "INSERT INTO `unn_w19003579`.`event` (`eventID`, `eventDateTime`, `eventType`, `eventCaptain`, `squadID`) VALUES (NULL, '$myDate', '$eventname', '$captainID', '$squadID');";

                if (mysqli_query($con, $sqlInsert))
                {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }

                else
                {
                    echo "ERROR: Could not execute $sql. " . mysqli_error($con);
                }
            
            }

            else
            {
                echo "Squad does not have a captain";
            }
        }

        
    }

    $con->close();
}

else
{
    require_once('adminError.html');
}



?>