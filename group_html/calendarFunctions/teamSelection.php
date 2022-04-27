<?php
require_once('checkSquad.php');
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Team Selection</title>
    <link href='../style2.css' rel='stylesheet' />
  </head>
  <body>
  <script>

    document.addEventListener('DOMContentLoaded', function() 
    {

        //link the html elements to variables
        var returnBtn = document.getElementById('returnBtnTS');
        var submitBtn = document.getElementById('submitBtnTS');

        //add an event listener for the return button
        returnBtn.addEventListener('click', function()
        {
            //returns the user to the calendar
            document.location.href = "http://unn-w19003579.newnumyspace.co.uk/group/captainCalendar.php";
        });

    });
        

    </script>
      <div id="teamSelectionForm">
          <form action="updateTeam.php" method="get" autocomplete="off">
              <table>
                <tr><th id='positionHeader'>Position</th><th id='playerHeader'>Player</th></tr>
                <?php

                //perform the functions if the user is logged in
                if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == TRUE))
                {

                    //performs the functions if the user role is captain
                    if ($_SESSION['userRole'] == '2')
                    {

                        //used to connect to database
                        require_once('connect.php');

                        //hidden input used to pass eventID
                        $evID = $_GET['eventID'];
                        echo "<input type='hidden' name='matchID' id='matchID' value='$evID'></input>";

                        $eventID = $_GET['eventID'];
                        $squad = $_SESSION['squadID'];

                        //sql for displaying positions
                        $sqlPositions = "SELECT position, positionID FROM position";
                        $result = $con->query($sqlPositions);

                        //if the result set is not empty
                        if ($result->num_rows > 0)
                        {
                            //get the positions
                            while($row = $result->fetch_assoc())
                            {
                                //get the details of each position
                                $position = $row["position"];
                                $positionID = $row["positionID"];

                                //sql for select users based on squad and if they RSVP'd
                                $sqlPlayers = "SELECT userFName, userSName, userPosition, user.userID, userRole, squadID FROM user JOIN eventplayer on (user.userID = eventplayer.userID) JOIN squadmember on (squadmember.userID = user.userID) WHERE squadID = '$squad' AND eventplayer.eventID = '$eventID' AND userRole = '1' OR userRole = '2' GROUP BY userID";
                                $result2 = $con->query($sqlPlayers);

                                //if the result set is not empty
                                if ($result2->num_rows > 0)
                                {
                                    //display each position and a select input for each position containing the positionID
                                    echo "<tr><td id='positionTS'>" . $position . "</td><td id='positionTS'> <select name='$positionID' class='selectTeamMember' id='selectTeamMember'><option hidden disabled selected value>Select a player</option>";

                                    //for each player that has RSVP'd
                                    while($row2 = $result2->fetch_assoc())
                                    {
                                        //stores the details of the player
                                        $userFName = $row2["userFName"];
                                        $userSName = $row2["userSName"];
                                        $userID = $row2["userID"];
                                        $userPosition = $row2["userPosition"];

                                        //sql query for selecting players that are already selected for the match
                                        $sql3 = "SELECT userID, matchID, position FROM matchteam WHERE userID='$userID' AND matchID = '$eventID' AND position='$positionID'; ";
                                        $result3 = $con->query($sql3);

                                        //if the user has already been selected to the match team in their preferred position, show them in their selected position
                                        if(($result3->num_rows > 0) & ($userPosition == $positionID))
                                        {
                                            echo "<option selected value=' " . $userID . "'>" . $userFName . " " . $userSName . " (Preferred Position)</option>";
                                        }
                
                                        //if the user has already been selected to the match team show them in their selected position
                                        else if ($result3->num_rows > 0)
                                        {
                                            echo "<option selected value=' " . $userID . "'>" . $userFName . " " . $userSName . "</option>";
                                        }

                                        //if the user has not been selected to the match team and the selected position is their preferred one
                                        else if ($userPosition == $positionID)
                                        {
                                            echo "<option value=' " . $userID . "'>" . $userFName . " " . $userSName . " (Preferred Position)</option>";                      
                                        }

                                        //if the user has not been selected to the match team and the selected position is not their preferred one
                                        else
                                        {
                                            echo "<option value=' " . $userID . "'>" . $userFName . " " . $userSName . "</option>";
                                        }

                                            
                                    }

                                    echo "</select> </td></tr>";
                                        
                                }

                                //error message to display if no players are available for selection
                                else
                                {
                                    echo "<tr><td>" . $position . "</td><td>No players available for this position</td></tr>";
                                }

                                    
                            }


                        }

                        //error message to display if positions cannot be loaded
                        else
                        {
                            echo "Position table is empty";
                        }

                        //buttons for submitting the form and returning to the previous page
                        echo "<button type='submit' id='submitBtnTS'> Update team </button>";
                        echo "<button type='button' id='returnBtnTS'> Return to events list </button>";
                        

                    }

                //error message to display if the user does not have permission to access the page
                else
                {
                    echo "You do not have permission to access this page";
                }

            }

            //error message to display if the user is not logged in
            else
            {
                echo "You must be logged in to access this page";
            }

            
            ?>
    

              </table>
          </form>
      </div>
  </body>
</html>