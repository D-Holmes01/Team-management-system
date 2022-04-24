<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Team Selection</title>
    <link href='../style2.css' rel='stylesheet' />
  </head>
  <body>
      <div id="teamSelectionForm">
          <form action="updateTeam.php" method="get" autocomplete="off">
              <table>
                <tr><th>Position</th><th>Player</th></tr>
                <?php

                //hardcode
                $_SESSION['loggedin'] = true;
                $_SESSION['userRole'] = 2;

                if ((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == TRUE))
                {
                    if ($_SESSION['userRole'] == '2')
                    {
                        $DATABASE_HOST = 'localhost';
                        $DATABASE_USER = 'unn_w19003579';
                        $DATABASE_PASS = 'Group123.';
                        $DATABASE_NAME = 'unn_w19003579';

                        $eventID = $_GET['eventID'];

                        require_once("checkSquad.php");
                        // $_SESSION['squad'] = '8';
                        // $squad = $_SESSION['squad'];

                        // Try and connect using the info above.
                        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

                        if ( mysqli_connect_errno() ) 
                        {
                            // If there is an error with the connection, stop the script and display the error.
                            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
                        }

                        if ($con->connect_error) 
                        {
                            die("Connection failed: " . $con->connect_error);
                        }

                        else
                        {
                            echo "<input type='hidden' name='matchID' id='matchID' value='$eventID'></input>";
                            
                            $sqlPositions = "SELECT position, positionID FROM position";
                            $result = $con->query($sqlPositions);

                            if ($result->num_rows > 0)
                            {

                                while($row = $result->fetch_assoc())
                                {
                                    $position = $row["position"];
                                    $positionID = $row["positionID"];

                                    $sqlPlayers = "SELECT userFName, userSName, userPosition, user.userID, userRole, squadID FROM user JOIN eventplayer on (user.userID = eventplayer.userID) JOIN squadmember on (squadmember.userID = user.userID) WHERE squadID = '$squad' AND eventplayer.eventID = '$eventID' AND userRole = '1' OR userRole = '2' GROUP BY userID";
                                    $result2 = $con->query($sqlPlayers);

                                    if ($result2->num_rows > 0)
                                    {
                                        echo "<tr><td>" . $position . "</td><td> <select name='$positionID' class='selectTeamMember' id='selectTeamMember'><option hidden disabled selected value>Select a player</option>";

                                        while($row2 = $result2->fetch_assoc())
                                        {
                                            $userFName = $row2["userFName"];
                                            $userSName = $row2["userSName"];
                                            $userID = $row2["userID"];
                                            $userPosition = $row2["userPosition"];

                                            $sql3 = "SELECT userID, matchID, position FROM matchteam WHERE userID='$userID' AND matchID = '$eventID' AND position='$positionID'; ";
                                            $result3 = $con->query($sql3);

                                            if(($result3->num_rows > 0) & ($userPosition == $positionID))
                                            {
                                                echo "<option selected value=' " . $userID . "'>" . $userFName . " " . $userSName . " (Preferred Position)</option>";
                                            }
                                            
                                            else if ($result3->num_rows > 0)
                                            {
                                                echo "<option selected value=' " . $userID . "'>" . $userFName . " " . $userSName . "</option>";
                                            }

                                            else if ($userPosition == $positionID)
                                            {
                                                echo "<option value=' " . $userID . "'>" . $userFName . " " . $userSName . " (Preferred Position)</option>";                      
                                            }

                                            else
                                            {
                                                echo "<option value=' " . $userID . "'>" . $userFName . " " . $userSName . "</option>";
                                            }

                                            
                                        }

                                        echo "</select> </td></tr>";
                                        
                                    }

                                    else
                                    {
                                        echo "<tr><td>" . $position . "</td><td>No players available for this position</td></tr>";
                                    }


                                    
                                }


                            }

                            else
                            {
                                echo "Position table is empty";
                            }

                            echo "<button type='submit' id='submitBtn'> Update team </button>";
                            echo "<button type='button' id='returnBtn'> Return to events list </button>";

                        }

                    }

                    else
                    {
                        echo "You do not have permission to access this page";
                    }
                }

                else
                {
                    echo "You must be logged in to access this page";
                }

                ?>

                <script>
                    
                    var returnBtn = document.getElementById('returnBtn');
                    var submitBtn = document.getElementById('submitBtn');

                    returnBtn.addEventListener('click', function()
                    {
                        //hardcode
                        document.location.href = "http://unn-w19003579.newnumyspace.co.uk/group/captainCalendar.php";
                    });

                    //submitBtn.addEventListener('click', submit);
                    //var duplicates = [];


                    //let select = document.querySelectorAll('select');
                    //select.onchange = handleChange(this);

                    /* function handleChange(e)
                    {
                        var value = e.value;
                        console.log(value);
                    } */


                </script>

              </table>
          </form>
      </div>
  </body>
</html>