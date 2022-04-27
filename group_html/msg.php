<!DOCTYPE html>
<!-- Basic html tags to ensurfe file is read properly -->
<html>

<head>
  <!-- web page setup, setting charset, title and stylesheets -->
  <meta charset="utf-8">
  <title>Admin</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/all.css">
</head>

<!-- allignment class -->
<body class="loggedin">
  <!-- nav bar -->
  <nav class="navtop">
      <div>
         <!-- Nav title and links, admin link hidden due to being the present page -->
         <h1>Messageboard</h1>
 </div>
   </nav>
  <!-- page content -->
  <div class="content">
    <div>
      <!-- php connection to database page -->
     
     <?php
     include "connect.php";

     $sql = mysqli_query(
         $con,
         "SELECT * FROM threads WHERE id = '" . $_GET["id"] . "'"
     );

     // echoing the following statement onto the webpage to allow for debugging in PHPMYADMIN - made not visible however crucuial in testing and debugging the statment as follows
     // echo"SELECT * FROM threads WHERE id = '".$_GET['id']."'";

     // Now we are getting our results and making them an array
     while ($r = mysqli_fetch_array($sql)) {
         // Here is the thread/message title of the selected thread.
         echo "<h3>$r[title]</h3>";
         echo "<p>$r[message]</p>";
         // Everything within the two curly brackets can read from the database using $r[]
         // We need to convert the UNIX Timestamp entered into the database for when a thread...
         // ... is posted into a readable date, using date().
         $posted = date("jS M Y h:i", $r["posted"]);

         // Now this shows the thread with a horizontal rule after it.
         echo "<h4>$r[author] : $posted</h4><hr>";

         // End of Array
     }
     echo "<h3>Reply to this message...</h3>";

     // Here we will get it to show the replies
     // This query selects the replies from the database where the thread ID matches the thread $_GET value.
     $sql = mysqli_query(
         $con,
         "SELECT * FROM replies WHERE thread = '" . $_GET["id"] . "'"
     );

     // Now we are getting our results and making them an array
     while ($r = mysqli_fetch_array($sql)) {
         // Everything within the two curly brackets can read from the database using $r[]
         // We need to convert the UNIX Timestamp entered into the database for when a thread...
         // ... is posted into a readable date, using date().
         $posted = date("jS M Y h:i", $r[posted]);

         // Now this shows the thread with a horizontal rule after it.
         echo "$r[message]<h4>Posted by $r[author] on $posted</h4><hr>";

         // End of Array
     }
     ?>
     <!-- Form to initiate a POST for a 'replys' page linking to 'newreply.php'  -->
<form action="newreply.php" method="POST">
Your Name: <input type="text" name="author">
<input type="hidden" value="<?php echo $_POST[id]; ?> " name="thread"><br>
Message:<br><textarea cols="60" rows="5" name="message"></textarea><br>
<input type="submit" value="Post Reply">
</form>
<br>
<a href='messageboard.php'>Go Back...</a>"
</div>
</div>
</body>
</html>



