<?php

session_start();

    //used to connect to the database
    require_once('connect.php');

    //sql query for getting the squads
    $sql = "SELECT squadName, squadID from squad";
    $result = $con->query($sql);

    //takes place if the result set is not empty
    if ($result->num_rows > 0)
    {

        //displays the squads as different options for a select input field
        while ($row = $result->fetch_assoc())
        {
            echo "<option value='" . $row['squadID'] . "'>" . $row['squadName'] . "</option>";
        }

    }

    //display an error message if the squad list cannot be loaded
    else
    {
        echo "Squad list empty";
    }

    //ends the connection with the database
    $con->close();

?>