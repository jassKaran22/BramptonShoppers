<?php

//database configuration
define('DB_SERVER','loca.database.windows.net');
define('DB_USER','dbroot');
define('DB_PASS' ,'Admin123');
define('DB_NAME', 'shopping');

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL database hahahahah: " . mysqli_connect_error();
}

?>
