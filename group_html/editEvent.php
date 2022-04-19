<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Edit Event Form</title>
    <link href='style.css' rel='stylesheet' />
  </head>

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

        $sql = "SELECT eventID, eventDateTime, eventType FROM `unn_w19003579`.`event` WHERE `event`.`eventID` = $eventID";
        $result = $con->query($sql);
        
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $eventdate = $row["eventDateTime"];
                $eventname = $row["eventType"];
            }
        }

        else
        {
            echo "ERROR: Could not execute $sql. " . mysqli_error($con);
        }
        
    }

    $con->close();

    ?>

  <body>
      <div id="editFormContainer">
        <form id="editForm" action="updateEvent.php" method="get">
            <input type="hidden" id="eventID" name="eventID" value="<?php echo $eventID; ?>" readonly><br>
            <label for="eventname">Event Name: </label><br>
            <input type="text" id="eventname" name="eventname" value="<?php echo $eventname; ?>" required><br>
            <label for="datetime">Date and Time: </label><br>
            <input type="datetime-local" id="datetime" name="datetime" value="<?php echo $eventdate; ?>" required><br>
            <input type="submit" value="Update Event">
            <input type="button" value="Return to calendar" id="returnBtn">
        </form>
      </div>
  </body>

  <script>
      const returnBtn = document.getElementById("returnBtn");
      returnBtn.addEventListener('click', goBack);

      function goBack()
      {
        //hardcode
        window.location.href = "http://unn-w19003579.newnumyspace.co.uk/group/admincalendar.php";
      }

  </script>

</html>