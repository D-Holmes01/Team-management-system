<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Attendance List</title>
    <link href='style2.css' rel='stylesheet' />
  </head>
  <body>
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

        $sql = "SELECT userFName, userSName, eventDateTime, eventType, eventCaptain FROM eventplayer JOIN event on (eventplayer.eventID = event.eventID) JOIN user on (eventplayer.userID = user.userID) WHERE eventplayer.eventID = '$eventID' ";
        $result = $con->query($sql);
        $result2 = $con->query($sql);
        
        if ($result->num_rows > 0)
        {

            $headers = $result2->fetch_assoc();

            $eventname = $headers["eventType"];
            $datetime = $headers["eventDateTime"];

            echo "<div id='tableTitle'> Attendance list for: " . $eventname . " on " . $datetime . "</div><br>";

            echo "<table><tr><th>First Name</th><th>Surname</th></tr>";

            while($row = $result->fetch_assoc())
            {
                $firstname = $row["userFName"];
                $lastname = $row["userSName"];
        
                echo "<tr><td>" . $firstname . "</td><td>" . $lastname . "</td></tr>";
            }

            echo "</table>";

        }

        else
        {
            //echo "ERROR: Could not execute $sql. " . mysqli_error($con);
            echo "Attendance list empty";
        }
        
    }

    $con->close();

    ?>

    <!-- add return button -->

  </body>
</html>