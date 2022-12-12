<?php
require_once('config.php');
$mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if (mysqli_connect_errno())
{
    printf("ErrorConnect to Base. Code Error: %s\n", mysqli_connect_error());
    exit;
}
$mysqli->set_charset("utf8");
?>