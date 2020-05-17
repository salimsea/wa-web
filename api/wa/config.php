<?php
// database
$db_server = "localhost";
$db_user = "root";
$db_password = ""; // real pass
$db_name = "db";

// date & time
$date = date("Y-m-d");
$time = date("H:i:s");

define('DB_SERVER', $db_server);
define('DB_USERNAME', $db_user);
define('DB_PASSWORD', $db_password);
define('DB_DATABASE', $db_name);
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if (mysqli_connect_error()) {
	die("Database error!");
}

