<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Calendar</title>
    <link href='style2.css' rel='stylesheet' />
  </head>
  <body>
      <?php

      session_start();

      //takes place if the user is logged in
      if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == TRUE))
      {

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

        //otherwise the user is linked to the playerCalendar page
        else
        {
          header("Location: http://unn-w19003579.newnumyspace.co.uk/group/playerCalendar.php");
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