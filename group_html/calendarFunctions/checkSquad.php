<?php

    session_start();

    //this file is used to connect to the database
    require_once('connect.php');

    $userID = $_SESSION['userID'];

    //if the userID is set
    if (isset($userID))
    {

        try
        {
            //sql query for getting the squad id based on the userID
            $sql = "SELECT squadID FROM squadmember WHERE userID = '$userID'; ";

            $result = $con->query($sql);
            $row = $result->fetch_assoc();

            if ($result->num_rows > 0)
            {
                $squad = $row["squadID"];
                $_SESSION["squadID"] = $squad;
            }

            else
            {
                echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
            }

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