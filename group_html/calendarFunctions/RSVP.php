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

    //sets the eventID and userID based on data from the $GET array
    $eventID = $_GET['eventID'];
    $userID = $_GET['userID'];

    //displays an error message if the eventID is not set
    if (!isset($eventID))
    {
        echo("event id empty");
    }

    //displays an error message if the userID is not set
    if (!isset($userID))
    {
        echo("user id empty");
    }

    //otherwise performs the following functions
    else
    {

      //sql query for inserting a user into the eventplayer database, which is used for managing the RSVP's
      $sql = "INSERT INTO `unn_w19003579`.`eventplayer` (`eventPlayerID`, `eventID`, `userID`) VALUES (NULL, '$eventID', '$userID');";
      
      //returns the user to the previous page if the sql was successfull
      if (mysqli_query($con, $sql))
      {
          header('Location: ' . $_SERVER['HTTP_REFERER']);
      }

      //otherwise an error message id displayed
      else
      {
          echo "ERROR: Could not execute $sql. " . mysqli_error($con);
      }
        
    }

    //ends the connection with the database
    $con->close();

    ?>

  <body>
  </body>

</html>