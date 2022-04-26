<?php

session_start();

//this file is used to connect to the database
require_once('connect.php');


//if the userID is set
if ($userID != NULL)
{

    try
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

    catch (Exception $e)
    {
        throw new Exception("Error: " . $e->getMessage(), 0, $e);
    }

    
        
}

//otherwise display an error saying the user is not logged in
else
{
    echo "User not logged in";
}
    

?>