<?php
//call function which will connect to database and send to login if no one is logged in.
include "function.php";
?>

<!DOCTYPE html>
<html>

<head>
	<!-- web page setup, setting charset, title and stylesheets -->
	<meta charset="utf-8">
	<title>Profile</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/all.css">
</head>
<!-- body of webpage, class loggedin so that for different css -->

<body class="loggedin">
	<!-- nav bar -->
	<nav class="navtop">
      <div>
         <!-- Nav title and links, admin link hidden due to being the present page -->
         <h1>Profile</h1>
         <!-- Show admin link for users with admin priveldges-->
         <?php if ($_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 4 || $_SESSION['userRole'] == 5) {
            echo '<a href="admin.php"><i class="fa-solid fa-screwdriver-wrench"></i>Admin</a>';
         }
         ?>
         <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
         <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
         <!-- Show calendar only if the user role for the logged in user has been set -->
         <?php if (isset($_SESSION['userRole'])){
           echo '<a href="calendar.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>';
         }
         ?>
         <!-- Show MyEvents link for players -->
         <?php if ($_SESSION['userRole'] == 1) {
            echo '<a href="myEvents.php"><i class="fa-solid fa-calendar-xmark"></i>My Events</a>';
         }
         ?>
      </div>
   </nav>
	<!-- page content -->
	<div class="content">
		<div>
			<!-- header -->
			<h2>Account Details</h2>
			<!-- account details displayed within a form so that edit can be made. Values are loaded from the session data-->
			<form action="editAccount.php" method="post">
				<h3>First name</h3>
				<input id="Fname" name="Fname" type="text" value="<?= $_SESSION['name'] ?>">
				<h3>Second name</h3>
				<input id="Sname" name="Sname" type="text" value="<?= $_SESSION['surname'] ?>">
				<h3>Biography</h3>
				<input id="Bio" name="Bio" type="text" value="<?= $_SESSION['bio'] ?>">
				<h3>Position</h3>
				<select type="checkbox" name="Position" placeholder="Position" id="Position" content=<?= $_SESSION['position'] ?>>
					<option selected disabled><?= $_SESSION['position'] ?></option>
					<option value="null">Non-playing user</option>
					<option value="1">Loosehead</option>
					<option value="2">Hooker</option>
					<option value="3">Tighthead Prop</option>
					<option value="4">Loosehead Lock</option>
					<option value="5">Tighthead Lock</option>
					<option value="6">Blindside Flanker</option>
					<option value="7">Openside Flanker</option>
					<option value="8">Numer Eight</option>
					<option value="9">Scrumhalf</option>
					<option value="10">Flyhalf</option>
					<option value="11">Left Wing</option>
					<option value="12">Inside Centre</option>
					<option value="13">Outside Centre</option>
					<option value="14">Right Wing</option>
					<option value="15">Fullback</option>
				</select>
				<!-- submit will edit user details based on the form details -->
				<input type="submit" id="editUser"></input>
		</div>
		</form>
		<!-- delete user form -->
		<div id="deleteUser">
			<h2>Delete account</h2>
			<form action="deleteUser.php" method="post">
				<!-- hidden input to save userId and use form format -->
				<input type="hidden" name="userID" value=<?= $_SESSION['userID'] ?>>
				<!-- submit will run delete account code -->
				<input type="submit" value="Delete account" id="deleteUser"></input>
			</form>
		</div>
	</div>
</body>

</html>
