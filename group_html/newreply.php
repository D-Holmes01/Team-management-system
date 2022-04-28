<!DOCTYPE html>
  <!-- web page setup, setting charset, title and stylesheets -->
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/all.css">
  <title>Admin</title>

<body class="loggedin">
  <!-- nav bar -->
 <nav class="navtop">
      <div>
         <!-- Nav title and links, admin link hidden due to being the present page -->
         <h1>Messageboard</h1>
         <!-- Showing links for users with admin priveldges-->
         
         <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
         <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
         <!-- Show calendar only if the user role for the logged in user has been set -->
         <?php if (isset($_SESSION['userRole'])){
           echo '<a href="calendar.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>';
         }
         ?>
         <!-- Show MyEvents link for players -->
         <?php if ($_SESSION['userRole'] == 1) {
            echo '<a href="myEvents.php"><i class="fa-solid fa-calendar-xmark"></i>My Events</a>';
         }
         ?>
         <a href="messageboard.php"><i class="fa-solid fa-message-board"></i>Messageboard</a>
         
         
      </div>
   </nav>
<!-- connect to database via connect.php-->
     <?php
     include "connect.php";

     $_SESSION["userID"] = 25;
     $time = time();

     //Inserting form data into the replies table via SQL query using POST method

     mysqli_query(
         $con,
         "INSERT INTO 'replies' (`title`, `message`, `author`, `replies`, `posted`) VALUES (NULL,'" .
             $_POST["thread"] .
             "','" .
             $_POST["message"] .
             "','" .
             $_POST["author"] .
             "','$time')"
     );

//Echoing the insert form data onto a live comment to display what data has been inserted where, also helps to debug code faults
     echo "INSERT INTO replies VALUES(NULL," .
         $_POST["thread"] .
         "," .
         $_POST["message"] .
         "," .
         $_POST["author"] .
         ",'$time')";

         //updating the threads tables to count '+1' counting the ammount of replies per thread

     mysqli_query(
         $con,
         "UPDATE threads SET replies = replies + 1 WHERE id = " .
             $_POST["thread"] .
             ""
     );
//Echoing success when posting a reply
     echo "Reply Posted.<br><a href='msg.php?id=" .
         $_POST["thread"] .
         ">Return</a>";
     ?>

 ?>
</body>
</html>