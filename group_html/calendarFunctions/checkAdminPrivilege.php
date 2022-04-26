<?php

    session_start();

    //sets adminStatus to false initially
    $adminStatus = FALSE;

    //if the user is logged on perform the following
    if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == TRUE))
    {

        //set the adminStatus to false if the user is a player or captain
        if ($_SESSION['userRole'] == '1' || $_SESSION['userRole'] == '2')
        {
            $adminStatus = FALSE;
        }

        //otherwise set adminStatus to true
        else if ($_SESSION['userRole'] == '3' || $_SESSION['userRole'] == '4' || $_SESSION['userRole'] == '5')
        {
            $adminStatus = TRUE;
        }

        //sets adminStatus to false if the userRole cannot be found
        else
        {
            $adminStatus = FALSE;
        }

    }

    //sets adminStatus to false if the user is not logged on
    else
    {
        $adminStatus = FALSE;
    }

    return $adminStatus;
        

?>