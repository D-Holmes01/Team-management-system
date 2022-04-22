<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Team Selection</title>
    <link href='style2.css' rel='stylesheet' />
  </head>
  <body>
      <div id="teamSelectionForm">
          <form action="" method="" autocomplete="off">
              <table>
                <tr><th>Position</th><th>Player</th></tr>
                <?php

                $DATABASE_HOST = 'localhost';
                $DATABASE_USER = 'unn_w19003579';
                $DATABASE_PASS = 'Group123.';
                $DATABASE_NAME = 'unn_w19003579';

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
                    $sqlPositions = "SELECT position, positionID FROM position";
                    $result = $con->query($sqlPositions);

                    if ($result->num_rows > 0)
                    {
                        while($row = $result->fetch_assoc())
                        {
                            $position = $row["position"];
                            $positionID = $row["positionID"];

                            //fix this to get users that have RSVP'd
                            $sqlPlayers = "SELECT userFName, userSName, userPosition, userID, userRole FROM user WHERE userRole = '1' OR userRole = '2'";
                            $result2 = $con->query($sqlPlayers);

                            if ($result2->num_rows > 0)
                            {

                                echo "<tr><td>" . $position . "</td><td> <select name='$position' id='selectTeamMember'><option hidden disabled selected value>Select a player</option>";

                                while($row2 = $result2->fetch_assoc())
                                {
                                    $userFName = $row2["userFName"];
                                    $userSName = $row2["userSName"];
                                    $userID = $row2["userID"];

                                    echo "<option value=' " . $userID . "'>" . $userFName . " " . $userSName . "</option>";
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
                }

                ?>

              </table>
          </form>
      </div>
  </body>
</html>