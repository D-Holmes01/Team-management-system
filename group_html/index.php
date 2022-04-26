<html lang="en">
  <meta charset="UTF-8">
     <link href="css/home.css" rel="stylesheet" type="text/css">

  <header class="header">
    <h1 class="logo"><a href="home.html">A Rugby Club - Homepage</a></h1>
      <ul class="main-nav">
          <li><a href="about-us.html">About us</a></li>
          <li><a href="#">Example</a></li>
          <li><a href="#">Example</a></li>
      </ul>
  </header> 
<br><br><br><br>
<div class="forum">
  <p> Create my own thread </p>

<form action="newthread.php" method="POST">
Your Name: <input type="text" name="author"><br>
Thread Title: <input type="text" name="title"><br>
Thread:<br><textarea cols="60" rows="5" name="message"></textarea><br>
<input type="submit" value="Post Thread">
</form>
<hr>
<p> The available threads</p>
<?php
include('connect.php');
// Selecting everything from the threads section in the database and ordering them newest to oldest.
$sql = mysqli_query($con,"SELECT * FROM threads ORDER BY posted DESC");

// get our results and making them an array
while($r = mysqli_fetch_array($sql)) {

// Everything within the two curly brackets can read from the database using $r[]
// convert the UNIX Timestamp entered into the database is posted into a readable date, using date().
$posted = date("jS M Y h:i",$r['posted']);

// Now we will show the available threads

echo "<div>
<img class='profile' src='img/profile2.jpg' width='50'/>
    <div class='comment-box'>
<p><a href='msg.php?id=$r[id]'>$r[title]</a> ($r[replies])</h3><h4>Posted by $r[author] on $posted</p>
</div>
</div>";
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