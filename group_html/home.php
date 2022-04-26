<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";
?>

<!DOCTYPE html>
<html>

<head>
   <!-- web page setup, setting charset, title and stylesheets -->
   <meta charset="utf-8">
   <title>Admin</title>
   <link href="style.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/all.css">
</head>
<!-- body of webpage, class loggedin so that for different css -->

<body class="loggedin">
   <!-- nav bar -->
   <nav class="navtop">
      <div>
         <!-- Nav title and links, admin link hidden due to being the present page -->
         <h1>Website Title</h1>
         <!-- Show admin link for users with admin priveldges-->
         <?php if ($_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 4 || $_SESSION['userRole'] == 5) {
            echo '<a href="admin.php"><i class="fa-solid fa-screwdriver-wrench"></i>Admin</a>';
         }
         ?>
         <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
         <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
         <a href="calendar.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>
         <!-- Show MyEvents link for players -->
         <?php if ($_SESSION['userRole'] == 1) {
            echo '<a href="myEvents.php"><i class="fa-solid fa-calendar-xmark"></i>My Events</a>';
         }
         ?>
      </div>
   </nav>
   <!-- page content -->
   <div class="content">
      <h2>Home Page</h2>
      <!-- Show users name -->
      <p>Welcome back, <?= $_SESSION['name'] ?>!</p>
   </div>
   <div class="forum">
      <p> Message Board </p>
      <div>
         <img class="profile" src="img/profile1.jpg" width="50" />
         <div class="comment-box">
            <?php
            //create_cat.php
            include 'connect.php';


            echo '<tr>';
            echo '<td class="leftpart">';
            echo '<h3><a href="category.php?id=">Category name</a></h3> Category ';
            echo '</td>';
            echo '<td class="rightpart">';
            echo '<a href="topic.php?id=">message subject</a> at 10-10';
            echo '</td>';
            echo '</tr>';

            ?>
            <form method="post" action="">
               Category name: <input type="text" name="cat_name" />
               Category description: <textarea name="cat_description" /></textarea>
               <input type="submit" value="Add category" />
            </form>
            <?php
            $cat_ID = filter_has_var(INPUT_GET, 'cat_ID') ? $_GET['cat_ID'] : null;
            $cat_Name = filter_has_var(INPUT_GET, 'cat_Name') ? $_GET['cat_Name'] : null;
            $cat_Description = filter_has_var(INPUT_GET, 'cat_description') ? $_GET['cat_description'] : null;

            echo "$cat_Name";
            echo "$cat_Description";

            $sql = "SELECT
                              cat_id,
                              cat_name,
                              cat_description,
                          FROM
                              categories";

            $result = mysqli_query($con, $sql);

            if (!$result) {
               echo 'The categories could not be displayed, please try again later.';
            } else {
               if (mysqli_num_rows($result) == 0) {
                  echo 'No categories defined yet.';
               } else {
                  //prepare the table
                  echo '<table border="1">
                                <tr>
                                  <th>Category</th>
                                  <th>Last topic</th>
                                </tr>';

                  while ($row = mysqli_fetch_assoc($result)) {
                     echo '<tr>';
                     echo '<td class="leftpart">';
                     echo '<h3><a href="category.php?id">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                     echo '</td>';
                     echo '<td class="rightpart">';
                     echo '<a href="message.php?id=">Topic subject</a> at 10-10';
                     echo '</td>';
                     echo '</tr>';
                  }
               }
            }


            ?>
         </div>
      </div>
      <div>
         <img class="profile" src="img/profile2.jpg" width="50" />
         <div class="comment-box"></div>
      </div>
      <div>
         <img class="profile" src="img/profile3.jpg" width="50" />
         <div class="comment-box"></div>
      </div>
      <div>
         <img class="profile" src="img/profile1.jpg" width="50" />
         <div class="comment-box"></div>
      </div>
      <div>
         <div class="load-more">
            <span class="indicator">Load more..</span>
         </div>
      </div>
   </div>
   <br><br><br><br>
   <footer>
      <div class="footer-basic">
         <p class="copyright"> © A rugby club prototype</p>
   </footer>
   </div>
</body>

</html>
