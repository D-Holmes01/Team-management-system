<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Attendance List</title>
    <link href='../style2.css' rel='stylesheet' />
    <?php

    //used to use session values
    session_start();

    //this file is used to connect to the database
    require_once('connect.php');

    ?>
  </head>
  <!-- nav bar -->
  <nav class="navtop">
      <div>
         <!-- Nav title and links, admin link hidden due to being the present page -->
         <h1>Attendance List</h1>
         <!-- Show admin link for users with admin priveldges-->
         <?php if ($_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 4 || $_SESSION['userRole'] == 5) {
            echo '<a href="admin.php"><i class="fa-solid fa-screwdriver-wrench"></i>Admin</a>';
         }
         ?>
         <a href="../profile.php"><i class="fas fa-user-circle"></i>Profile</a>
         <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
         <a href="../calendar.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>
         <!-- Show MyEvents link for players -->
         <?php if ($_SESSION['userRole'] == 1) {
            echo '<a href="../myEvents.php"><i class="fa-solid fa-calendar-xmark"></i>My Events</a>';
         }
         ?>
      </div>
   </nav>
  <body>
    <?php

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
            echo "<div id='tableTitleAtt'> <span id='att'>Attendance list for: </span>" . $eventname . " on " . $datetime . "</div><br>";

            //the header for the table
            echo "<table><tr><th id='AttendanceTableHeader'>Name</th></tr>";

            //displays the names of the users that are attending
            while($row = $result->fetch_assoc())
            {
                $firstname = $row["userFName"];
                $lastname = $row["userSName"];
        
                echo "<tr id='AttendanceRows'><td>" . $firstname . " " . $lastname . "</td></tr>";
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

  </body>
</html>