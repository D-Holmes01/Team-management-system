<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// get database connection
$dbConn = getConnection();

if (isset($_REQUEST['role'])) {
    //Update role
    echo 'wagwan';
    //$userID = $_SESSION['userID'];
    //$userRole = $_GET['role'];
    //updateRole($dbConn, $userID, $userRole);
}

//connect to database
function getConnection()
{
    //try to connect to the database
    try {
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'unn_w19003579';
        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if (mysqli_connect_errno()) {
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        return $con;
    }
    //catch and return any errors
    catch (Exception $e) {
        throw new Exception("Connection error " . $e->getMessage(), 0, $e);
    }
}

//retreive new values and update the db
function updateRole($dbConn, $userID, $userRole)
{
    //validation
    if ($userID < 6) {
        try {
            //generate sql query and assign the value
            $updateSQL = "UPDATE User
                      SET userRole = \"$userRole\"
                      WHERE userID = $userID";
        }
        //catch and showcase ant errors
        catch (Exception $e) {
            echo "<p>Role not updated: " . $e->getMessage() . "</p>\n";
        }
    } else {
        echo "<p>data isn't valid</p>";
    }
}
