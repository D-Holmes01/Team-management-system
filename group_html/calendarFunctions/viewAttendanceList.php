<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Attendance List</title>
    <link href='style2.css' rel='stylesheet' />
  </head>
  <body>
    <?php

    //this file is used to connect to the database
    require_once('connect.php');

    //sets the eventID from the $GET array
    $eventID = $_GET['eventID'];

    //displays an error if the eventID is not set
    if (!isset($eventID))
    {
        echo("event id empty");
    }

    //otherwise the following is performed
    else if (isset($eventID))
    {

        //sql query for getting the list of users attending a certain event
        $sql = "SELECT userFName, userSName, eventDateTime, eventType, eventCaptain FROM eventplayer JOIN event on (eventplayer.eventID = event.eventID) JOIN user on (eventplayer.userID = user.userID) WHERE eventplayer.eventID = '$eventID' ";
        $result = $con->query($sql);
        $result2 = $con->query($sql);
        
        //the following is performed if the result set is not null
        if ($result->num_rows > 0)
        {

            $headers = $result2->fetch_assoc();

            $eventname = $headers["eventType"];
            $datetime = $headers["eventDateTime"];

            //displays the event name and date/time
            echo "<div id='tableTitle'> Attendance list for: " . $eventname . " on " . $datetime . "</div><br>";

            //the headers for the table
            echo "<table><tr><th>First Name</th><th>Surname</th></tr>";

            //displays the names of the users that are attending
            while($row = $result->fetch_assoc())
            {
                $firstname = $row["userFName"];
                $lastname = $row["userSName"];
        
                echo "<tr><td>" . $firstname . "</td><td>" . $lastname . "</td></tr>";
            }

            echo "</table>";

        }

        //an error message is displayed if the attendance list is empty
        else
        {
            echo "Attendance list empty";
        }
        
    }

    //the connection to the database is ended
    $con->close();

    ?>

    <!-- add return button -->

  </body>
</html>