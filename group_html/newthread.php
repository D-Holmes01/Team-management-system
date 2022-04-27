<!doctype html>
  <meta charset="UTF-8">
     <link href="css/home.css" rel="stylesheet" type="text/css">

     <?php
     include "connect.php";

     $_SESSION["userID"] = 25;
     $time = time();
     //query to insert a new record into the thread table
     mysqli_query(
         $con,
         "INSERT INTO `threads`(`title`, `message`, `author`, `replies`, `posted`) VALUES ('" .
             $_POST["title"] .
             "','" .
             $_POST["message"] .
             "','" .
             $_SESSION["userID"] .
             "','0','$time')"
     );
//redirect to the orginal messageboard system page
     header("Location: messageboard.php");
     die();


?>
</html>