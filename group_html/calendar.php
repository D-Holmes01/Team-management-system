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

      if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == TRUE))
      {

        if ($_SESSION['userRole'] == '1' || $_SESSION['userRole'] == '2')
        {
            //hardcode
            header("Location: http://unn-w19003579.newnumyspace.co.uk/group/playerCalendar.php");
        }

        if ($_SESSION['userRole'] == '3' || $_SESSION['userRole'] == '4' || $_SESSION['userRole'] == '5')
        {
            //hardcode
            header("Location: http://unn-w19003579.newnumyspace.co.uk/group/adminCalendar.php");
        }

        else
        {
            echo "User Account Type cannot be identified";
        }

      }

      else
      {
          echo "You must be logged in to access this page";
      }

        

      ?>
  </body>
</html>