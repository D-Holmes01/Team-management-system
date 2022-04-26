<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
// get database connection
$con = getConnection();

//connect to database
function getConnection()
{
    //try to connect to the database
    try {
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'unn_w19003579';
        $DATABASE_PASS = 'Group123.';
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
