<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'unn_w19003579';
$DATABASE_PASS = 'Group123.';
$DATABASE_NAME = 'unn_w19003579';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

//hardcode
$_SESSION['userID'] = '26';
$userID = $_SESSION['userID'];

if ( mysqli_connect_errno() ) 
{
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ($con->connect_error) 
{
    die("Connection failed: " . $con->connect_error);
}

else
{

    if ($userID != NULL)
    {
        $sql = "SELECT squadID FROM squadmember WHERE userID = '$userID'; ";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $squad = $row["squadID"];
        $_SESSION['squadID'] = $squad;
        
    }

    else
    {
        echo "User not logged in";
    }
    
}

?>