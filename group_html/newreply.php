<html lang="en">
  <meta charset="UTF-8">
     <link href="css/home.css" rel="stylesheet" type="text/css">

     <?php
include('connect.php');

$_SESSION['userID']= 25;
$time = time();

mysqli_query($con,"INSERT INTO 'replies' VALUES(NULL,".$_POST['thread'].",".$_POST['message'].",".$_POST['author'].",'$time')");

mysqli_query($con,"UPDATE 'threads' SET 'replies' = replies + 1 WHERE id = ".$_POST['thread']."");

echo "Reply Posted.<br><a href='msg.php?id=".$_POST['thread'].">Return</a>";
?>