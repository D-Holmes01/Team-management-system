<html lang="en">
  <meta charset="UTF-8">
     <link href="css/home.css" rel="stylesheet" type="text/css">

     <?php
include('connect.php');

$_SESSION['userID']= 25;
$time = time();
mysqli_query($con,"INSERT INTO `threads`(`title`, `message`, `author`, `replies`, `posted`) VALUES ('".$_POST['title']."','".$_POST['message']."','".$_SESSION['userID']."','0','$time')");


header("Location: messageboard.php");
die();

?>