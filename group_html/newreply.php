<DOCTYPE html>
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

     <?php
include('connect.php');

$_SESSION['userID']= 25;
$time = time();

mysqli_query($con,"INSERT INTO 'replies' (`title`, `message`, `author`, `replies`, `posted`) VALUES (NULL,'".$_POST['thread']."','".$_POST['message']."','".$_POST['author']."','$time')");
  
echo"INSERT INTO replies VALUES(NULL,".$_POST['thread'].",".$_POST['message'].",".$_POST['author'].",'$time')";

mysqli_query($con,"UPDATE threads SET replies = replies + 1 WHERE id = ".$_POST['thread']."");

echo "Reply Posted.<br><a href='msg.php?id=".$_POST['thread'].">Return</a>";

?>

