<?php

/*
This file contains database configuration assuming you are running mysql using user
"root" and password ""
*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'project_work');

// Try connecting to the Database
$conn = mysqli_connect("localhost", "root", "", "project_work");

//Check the connection
if ($conn == false) {
    die('Error: Cannot connect');
}





?>
