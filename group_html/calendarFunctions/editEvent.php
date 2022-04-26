<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Edit Event Form</title>
    <link href='style2.css' rel='stylesheet' />
  </head>

    <?php

    //used to connect to the database
    require_once('connect.php');

    //gets the eventID from the GET array
    $eventID = $_GET['eventID'];

    //displays an error emssage if the eventID is not set
    if (!isset($eventID))
    {
        echo("event id empty");
    }

    //otherwise performs the following functions
    else if (isset($eventID))
    {

      //sql query for getting the event based on the eventID
      $sql = "SELECT eventID, eventDateTime, eventType FROM `unn_w19003579`.`event` WHERE `event`.`eventID` = $eventID";
      $result = $con->query($sql);
      
      //takes place if the result set is not empty
      if ($result->num_rows > 0)
      {

        //gets the details for the event into an array
        while($row = $result->fetch_assoc())
        {
          $eventdate = $row["eventDateTime"];
          $eventname = $row["eventType"];
        }
        
      }

      //shows an error message if the sql cannot be run
      else
      {
        echo "ERROR: Could not execute $sql. " . mysqli_error($con);
      }
        
    }

    //ends connection with the database
    $con->close();

    ?>

  <body>
      <div id="editFormContainer">
        
        <!-- displays the form for editing the event and prepopulates it with data from the database -->
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
    
    //gets the return button and adds an event listener to it so a function is performed when it is clicked
    const returnBtn = document.getElementById("returnBtn");
    returnBtn.addEventListener('click', goBack);

    //the function returns the user to the calendar
    function goBack()
    {
      //hardcode
      window.location.href = "http://unn-w19003579.newnumyspace.co.uk/group/admincalendar.php";
    }

  </script>

</html>