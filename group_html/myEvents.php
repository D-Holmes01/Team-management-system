<?php
session_start();
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>My Events</title>
    <link href='style2.css' rel='stylesheet' />
  </head>
  <!-- nav bar -->
  <nav class="navtop">
      <div>
         <!-- Nav title and links, admin link hidden due to being the present page -->
         <h1>Website Title</h1>
         <!-- Show admin link for users with admin priveldges-->
         <?php if ($_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 4 || $_SESSION['userRole'] == 5) {
            echo '<a href="admin.php"><i class="fa-solid fa-screwdriver-wrench"></i>Admin</a>';
         }
         ?>
         <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
         <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
         <a href="calendar.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>
         <!-- Show MyEvents link for players -->
         <?php if ($_SESSION['userRole'] == 1) {
            echo '<a href="myEvents.php"><i class="fa-solid fa-calendar-xmark"></i>My Events</a>';
         }
         ?>
      </div>
   </nav>
  <body>
    <?php

    //used to connect to the database
    require_once('calendarFunctions/connect.php');

    $userID = $_SESSION['userID'];

    //displays an error message if the userID is not present
    if (!isset($userID))
    {
        echo("user id empty");
    }

    else
    {

      //sql query for showing events based on the user ID
      $sql = "SELECT eventDateTime, eventType, event.eventID FROM eventplayer JOIN event on (eventplayer.eventID = event.eventID) JOIN user on (eventplayer.userID = user.userID) WHERE user.userID = '$userID' ORDER BY event.eventDateTime ASC";
      $result = $con->query($sql);
      
      //if the result is not an empty set
      if ($result->num_rows > 0)
      {

        //display the title
        echo "<div id='tableTitleMV'> My Events </div><br>";

        //display the headers for the table
        echo "<table><tr id='tableHeaderMV'><th>Event</th><th>Date and Time</th><th>Change Availability</th></tr>";

        //display the events
        while($row = $result->fetch_assoc())
        {
          //getting the event details
          $datetime = $row["eventDateTime"];
          $eventName = $row["eventType"];
          $eventID = $row["eventID"];
        
          //display the event details along with a button that allows the user to change their availability
          echo "<tr id='MVrows'><td>" . $eventName . "</td><td>" . $datetime . "</td><td><button type='submit' form='unavailableForm' id='unavailableButton' onClick='changeAvailability($eventID)'>Mark as Unavailable</button></td></tr>";
        
        }

        echo "</table>";


      }

      //displays an error message if the event list is empty
      else
      {
        echo "Event list empty";
      }
        
    }

    //ends the connection to the database
    $con->close();

    ?>

    
    <div id='unavailableFormContainer'>
        <!-- hidden form used to pass details for when the change availability button is pressed  -->
      <form id="unavailableForm" autocomplete="off" action="calendarFunctions/changeAvailability.php" method="post">
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