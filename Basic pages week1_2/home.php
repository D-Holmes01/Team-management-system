<!DOCTYPE html>
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
  <p> Message Board </p>
<div>
<img class="profile" src="img/profile1.jpg" width="50"/>
<div class="comment-box">

  <?php
//create_cat.php
include 'connect.php';

         
echo '<tr>';
    echo '<td class="leftpart">';
        echo '<h3><a href="category.php?id=">Event name</a></h3> Event captain goes here';
    echo '</td>';
    echo '<td class="rightpart">';                
            echo '<a href="topic.php?id=">Event time</a> ';
    echo '</td>';
echo '</tr>';

?>

<form method="post" action="">
    Event id: <input type="text" name="eventID" />
    Event type: <textarea name="eventType" /></textarea>
    <input type="submit" value="Add Event" />
 </form>



 <?php
        

$eventID = filter_has_var(INPUT_GET, 'eventID') ? $_GET['eventID'] : null;
$eventType = filter_has_var(INPUT_GET, 'eventType') ? $_GET['eventType'] : null;
$eventCaptain = filter_has_var(INPUT_GET, 'eventCaptain') ? $_GET['eventCaptain'] : null;
$eventDateTime = filter_has_var(INPUT_GET, 'eventDateTime') ? $_GET['eventDateTime'] : null;

 echo"$eventID";
 echo"$eventType";
 echo"eventCaptain";
 echo"eventDateTime";

$sql = "SELECT
            eventID,
            eventType,
            eventDateTime,
            eventCaptain,
        FROM
            event";
 
$result = mysql_query($sql);
 
if(!$result)
{
    echo 'The event could not be displayed, please try again later.';
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'No events defined yet.';
    }
    else
    {
        //prepare the table
        echo '<table border="1">
              <tr>
                <th>Event</th>
                <th>Last Event </th>
              </tr>'; 
             
        while($row = mysql_fetch_assoc($result))
        {               
            echo '<tr>';
                echo '<td class="leftpart">';
                    echo '<h3><a href="category.php?id">' . $row['eventType'] . '</a></h3>';
                echo '</td>';
                echo '<td class="rightpart">';
                            echo '<a href="topic.php?id=">Event subject</a> at 10-10';
                echo '</td>';
            echo '</tr>';
        }
    }
}
 

?>


</div>
</div>
<div>
<img class="profile" src="img/profile2.jpg" width="50"/>
    <div class="comment-box"></div>
</div>
<div>
<img class="profile" src="img/profile3.jpg" width="50"/>
    <div class="comment-box"></div>
</div>
<div>
<img class="profile" src="img/profile1.jpg" width="50"/>
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
