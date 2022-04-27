<!DOCTYPE html>
<html>
   <head>
      <!-- web page setup, setting charset, title and stylesheets -->
      <meta charset="utf-8">
      <title>Admin</title>
      <link href="style.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/all.css">
   </head>
   <body class="loggedin">
      <!-- nav bar -->
      <nav class="navtop">
         <div>
            <!-- Nav title and links, admin link hidden due to being the present page -->
            <h1>Messageboard</h1>
            <!-- Show admin link for users with admin priveldges-->
            <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            <a href="calendar.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>
            <a href="messageboard.php"><i class="fa-solid fa-message-board"></i>Messageboard</a>
            <!-- Show MyEvents link for players -->
         </div>
      </nav>
      <!-- page content -->
      <div class="content">
      <div>
         <!-- header -->
         <h2>Create a new messaging thread</h2>
         <!-- required minlength is a form of validation on client side so forms can not be easily created, this makes it harder for users to quickly spam the page with new threads -->
         <form action="newthread.php" method="POST">
            Your Name: <input type="text" name="author" required minlength="2"><br>
            Message Title: <input type="text" name="title" required minlength="3"><br>
            Message:<br><textarea cols="60" rows="5" name="message" required minlength="6"></textarea><br>
            <input type="submit" value="Post Thread">
         </form>
      </div>
      <hr>
      <br>
      <h2>Published messageboard threads</h2>
      <br><br>
      <?php
         include "connect.php";
         // Selecting everything from the threads section in the database and ordering them newest to oldest.
         $sql = mysqli_query($con, "SELECT * FROM threads ORDER BY posted DESC");
         
         // get our results and making them an array
         while ($r = mysqli_fetch_array($sql)) {
             // Everything within the two curly brackets can read from the database using $r[]
             // convert the UNIX Timestamp entered into the database is posted into a readable date, using date().
             $posted = date("jS M Y h:i", $r["posted"]);
         
             // Now we will show the available threads
         
             echo "<div>
         <img class='profile' src='img/profile2.jpg' alt='one' width='50'/>
             <div class='comment-box'>
         <p><a href='msg.php?id=$r[id]'>$r[title]</a> ($r[replies])</h3><h4> $r[author] - $posted</p>
         </div>
         </div>
         <hr>";
             // End of Array
         }
         ?>
      <br><br><br><br>
      <footer>
         <div class="footer-basic">
            <p class="copyright"> © A rugby club prototype</p>
      </footer>
      </div>
   </body>
</html>