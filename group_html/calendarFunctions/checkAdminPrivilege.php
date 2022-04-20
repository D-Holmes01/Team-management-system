<?php

    //hardcode
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['userRole'] = 2;

    $adminStatus = FALSE;

    if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == TRUE))
    {

        if ($_SESSION['userRole'] == '1' || $_SESSION['userRole'] == '2')
        {
            $status = FALSE;
        }

        else if ($_SESSION['userRole'] == '3' || $_SESSION['userRole'] == '4' || $_SESSION['userRole'] == '5')
        {
            $status = TRUE;
        }

        else
        {
            $status = FALSE;
        }

    }

    else
    {
        $status = FALSE;
    }

    return $status;
        

?>