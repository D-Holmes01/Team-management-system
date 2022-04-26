<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";
?>

<?php

    //used to connect to the database
    require_once('connect.php');

    //sql query for getting list of positions
    $sqlPositions = "SELECT positionID, position FROM position";
    $result = $con->query($sqlPositions);

    //if the result set is not empty perform the following functions
    if ($result->num_rows > 0)
    {
        //creates a new array
        $positionsArray = array();
        $i = 0;

        //adds each position and the position id to the newly created array
        while($row = $result->fetch_assoc())
        {
            $position = $row["position"];
            $positionID = $row["positionID"];

            $positionsArray[$i] = $positionID;
            $i = $i + 1;
        }
    }

    //if the matchID is set in the $GET array
    if (isset($_GET['matchID']))
    {

        //stores the matchID 
        $matchID = $_GET['matchID'];

        //the following is performed if the positions have been loaded succesfully
        if ($positionsArray)
        {

            //loops through the positions from the array
            foreach ($positionsArray as $positionID)
            {
                
                if (isset($_GET[$positionID]))
                {
                    //sql query used to check if the current position is filled out for the match
                    $user = $_GET[$positionID];
                    $sqlCheck = "SELECT userID, matchID, position FROM matchteam WHERE position='$positionID' AND matchID='$matchID';";
                    $result = $con->query($sqlCheck);

                    //updates the matchteam table using the positionID and matchID if the result set is not empty
                    if ($result->num_rows > 0)
                    {
                        $sql = "UPDATE matchteam SET userID='$user' WHERE position='$positionID' AND matchID='$matchID';";
                    }

                    //otherwise a row is inserted if the position does not have a player specified to it
                    else
                    {
                        $sql = "INSERT INTO `unn_w19003579`.`matchteam` (`matchTeamID`, `userID`, `matchID`, `position`) VALUES (NULL, '$user', '$matchID', '$positionID');";
                    }

                    //redirects the user to the previous page if the sql was successful
                    if (mysqli_query($con, $sql))
                    {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }

                    //otherwise an error message is displayed
                    else
                    {
                        echo "ERROR: Could not execute $sql. " . mysqli_error($con);
                    }

                }
            }

        }

        //an error message is displayed if the list of positions cannot be loaded
        else
        {
            echo "Cannot load list of positions";
        }

    }

    //an error message is displayed if the matchID/eventID has not been set
    else
    {
        echo "Match ID has not been set";
    }

        

?>