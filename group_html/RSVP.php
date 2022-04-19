<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Edit Event Form</title>
    <link href='style2.css' rel='stylesheet' />
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
    $userID = $_GET['userID'];

    if (!isset($eventID))
    {
        echo("event id empty");
    }

    if (!isset($userID))
    {
        echo("user id empty");
    }

    else
    {

        $sql = "INSERT INTO `unn_w19003579`.`eventplayer` (`eventPlayerID`, `eventID`, `userID`) VALUES (NULL, '$eventID', '$userID');";
        
        if (mysqli_query($con, $sql))
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        else
        {
            echo "ERROR: Could not execute $sql. " . mysqli_error($con);
        }
        
    }

    $con->close();

    ?>

  <body>
  </body>

</html>