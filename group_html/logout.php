<?php
//start session so that it can be destroyed
session_start();
session_destroy();
// Redirect to the login page:
header('Location: index.html');
