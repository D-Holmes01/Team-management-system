<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>My Events</title>
    <link href='style.css' rel='stylesheet' />
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

    //hardcode
    $userID = '25';


    if (!isset($userID))
    {
        echo("user id empty");
    }

    else
    {

        $sql = "SELECT eventDateTime, eventType, event.eventID FROM eventplayer JOIN event on (eventplayer.eventID = event.eventID) JOIN user on (eventplayer.userID = user.userID) WHERE user.userID = '$userID' ORDER BY event.eventDateTime ASC";
        $result = $con->query($sql);
        
        if ($result->num_rows > 0)
        {

            echo "<div id='tableTitle'> My Events </div><br>";

            echo "<table><tr><th>Event</th><th>Date and Time</th><th>Change Availability</th></tr>";

            while($row = $result->fetch_assoc())
            {
                $datetime = $row["eventDateTime"];
                $eventName = $row["eventType"];
                $eventID = $row["eventID"];
        
                echo "<tr><td>" . $eventName . "</td><td>" . $datetime . "</td><td><button type='submit' form='unavailableForm' id='unavailableButton' onClick='changeAvailability($eventID)'>Mark as Unavailable</button></td></tr>";
            }

            echo "</table>";


        }

        else
        {
            //echo "ERROR: Could not execute $sql. " . mysqli_error($con);
            echo "Event list empty";
        }
        
    }

    $con->close();

    ?>

    

    <!-- add return button -->

    <div id='unavailableFormContainer'>
        <!-- hardcode -->
      <form id="unavailableForm" autocomplete="off" action="changeAvailability.php" method="post">
        <input type="hidden" id="eventID" name="eventID">
        <input type="hidden" id="userID" name="userID" value="<?php echo $userID ?>">
      </form>
    </div>

    <script>

        var eventID = document.getElementById('eventID');

        function changeAvailability(x)
        {
            eventID.value = x;
        }


    </script>

  </body>
</html>