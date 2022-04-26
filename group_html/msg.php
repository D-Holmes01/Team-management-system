<html lang="en">
  <meta charset="UTF-8">
     <link href="css/home.css" rel="stylesheet" type="text/css">
     <?php
include('connect.php');

$sql = mysqli_query($con,"SELECT * FROM 'threads' WHERE 'id' = '$_GET[id]'");

// Now we are getting our results and making them an array
while(".$r = mysqli_fetch_array."($sql)) {

// Here is the thread title.
echo "<h2>$r[title]</h2>";

// Everything within the two curly brackets can read from the database using $r[]
// We need to convert the UNIX Timestamp entered into the database for when a thread...
// ... is posted into a readable date, using date().
$posted = date("jS M Y h:i",$r[posted]);

// Now this shows the thread with a horizontal rule after it.
echo "$r[message]<h4>Posted by $r[author] on $posted</h4><hr>";

// End of Array
}
echo "<h3>Replies...</h3>";

// Here we will get it to show the replies
// This query selects the replies from the database where the thread ID matches the thread $_GET value.
$sql = mysqli_query($con,"SELECT * FROM 'replies' WHERE 'thread' = '$_GET[id]'");

// Now we are getting our results and making them an array
while($r = mysqli_fetch_array($sql)) {

// Everything within the two curly brackets can read from the database using $r[]
// We need to convert the UNIX Timestamp entered into the database for when a thread...
// ... is posted into a readable date, using date().
$posted = date("jS M Y h:i",$r[posted]);

// Now this shows the thread with a horizontal rule after it.
echo "$r[message]<h4>Posted by $r[author] on $posted</h4><hr>";

// End of Array
}
?>
<form action="newreply.php" method="POST">
Your Name: <input type="text" name="author">
<input type="hidden" value="<?php echo $_GET[id]; ?>" name="thread"><br>
Message:<br><textarea cols="60" rows="5" name="message"></textarea><br>
<input type="submit" value="Post Reply">
</form>

<a href='index.php'>Go Back...</a>"



