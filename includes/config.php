
<?php echo 'fdghfdjkghkfdjgkjdfhgkdjfhgkjfdhd';die;
// PHP Data Objects(PDO) Sample Code:
try { 
    $conn = new PDO("sqlsrv:server = tcp:loca.database.windows.net,1433; Database = shopping", "dbroot", "Admin123");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "dbroot", "pwd" => "Admin123", "Database" => "shopping", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:loca.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


?>
