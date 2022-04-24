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

    else
    {
        $sqlPositions = "SELECT positionID, position FROM position";
        $result = $con->query($sqlPositions);

        if ($result->num_rows > 0)
        {
            $positionsArray = array();
            $i = 0;

            while($row = $result->fetch_assoc())
            {
                $position = $row["position"];
                $positionID = $row["positionID"];

                $positionsArray[$i] = $positionID;
                $i = $i + 1;
            }
        }

        if (isset($_GET['matchID']))
        {

            $matchID = $_GET['matchID'];

            if ($positionsArray)
            {

                foreach ($positionsArray as $positionID)
                {
                    
                    if (isset($_GET[$positionID]))
                    {
                        $user = $_GET[$positionID];
                        $sqlCheck = "SELECT userID, matchID, position FROM matchteam WHERE position='$positionID' AND matchID='$matchID';";
                        $result = $con->query($sqlCheck);

                        if ($result->num_rows > 0)
                        {
                            $sql = "UPDATE matchteam SET userID='$user' WHERE position='$positionID' AND matchID='$matchID';";
                        }

                        else
                        {
                            $sql = "INSERT INTO `unn_w19003579`.`matchteam` (`matchTeamID`, `userID`, `matchID`, `position`) VALUES (NULL, '$user', '$matchID', '$positionID');";
                        }

                        if (mysqli_query($con, $sql))
                        {
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                        }

                        else
                        {
                            echo "ERROR: Could not execute $sql. " . mysqli_error($con);
                        }

                    }
                }

            }

            else
            {
                echo "Cannot load list of positions";
            }

        }

        else
        {
            echo "Match ID has not been set";
        }

        
    }

?>