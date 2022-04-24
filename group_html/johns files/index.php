

<form action="newthread.php" method="POST">
Your Name: <input type="text" name="author"><br>
Thread Title: <input type="text" name="title"><br>
Thread:<br><textarea cols="60" rows="5" name="message"></textarea><br>
<input type="submit" value="Post Thread">
</form>
<hr>
<?php
include('connect.php');
// Selecting everything from the threads section in the database and ordering them newest to oldest.
$sql = mysql_query("SELECT * FROM threads ORDER BY posted DESC");

// get our results and making them an array
while($r = mysql_fetch_array($sql)) {

// Everything within the two curly brackets can read from the database using $r[]
// convert the UNIX Timestamp entered into the database is posted into a readable date, using date().
$posted = date("jS M Y h:i",$r[posted]);

// Now we will show the available threads
echo "<h3><a href='msg.php?id=$r[id]'>$r[title]</a> ($r[replies])</h3><h4>Posted by $r[author] on $posted</h4>";

// End of Array
}
?>