<?php
include('connect.php');

mysql_connect("mysql:host=localhost;dbname=unn_unn_w19003579", "unn_w19003579", "Group123.");
mysql_select_db("DATABASE");

$time = time();

mysql_query("INSERT INTO replies VALUES(NULL,'$_POST[thread]','$_POST[message]','$_POST[author]','$time')");

mysql_query("UPDATE threads SET replies = replies + 1 WHERE id = '$_POST[thread]'");

echo "Reply Posted.<br><a href='msg.php?id=$_POST[thread]'>Return</a>";
?>