<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";
?>

<?php

//this file is used to connect to the database
require_once('connect.php');

//hardcode
$_SESSION['userID'] = '26';
$userID = $_SESSION['userID'];

//if the userID is set
if ($userID != NULL)
{

    //sql query for getting the squad id based on the userID
    $sql = "SELECT squadID FROM squadmember WHERE userID = '$userID'; ";

    //used to run the query and get the results
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    //stores the squadID into the _SESSION array
    $squad = $row["squadID"];
    $_SESSION['squadID'] = $squad;
        
}

//otherwise display an error saying the user is not logged in
else
{
    echo "User not logged in";
}
    

?>