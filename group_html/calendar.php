<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Calendar</title>
    <link href='style2.css' rel='stylesheet' />
  </head>
  <body>
      <?php

        //hardcode
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['userRole'] = 1;

      //takes place if the user is logged in
      if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == TRUE))
      {

        //link the user to the playerCalendar page if the userRole is player
        if ($_SESSION['userRole'] == '1')
        {
            header("Location: http://unn-w19003579.newnumyspace.co.uk/group/playerCalendar.php");
        }

        //link the user to the captainCalendar page if the userRole is captain
        if ($_SESSION['userRole'] == '2')
        {
          header("Location: http://unn-w19003579.newnumyspace.co.uk/group/captainCalendar.php");
        }

        //link the user to the adminCalendar page if the userRole is coach, admin or head coach
        if ($_SESSION['userRole'] == '3' || $_SESSION['userRole'] == '4' || $_SESSION['userRole'] == '5')
        {
            header("Location: http://unn-w19003579.newnumyspace.co.uk/group/adminCalendar.php");
        }

        //displays an error if $_SESSION['userRole'] is none of the above options
        else
        {
            echo "User Account Type cannot be identified";
        }

      }

      //displays an error message if the user is not logged in
      else
      {
          echo "You must be logged in to access this page";
      }

        

      ?>
  </body>
</html>