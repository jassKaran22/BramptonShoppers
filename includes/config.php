<?php
    $conn = getenv("MYSQLCONNSTR_localdb"); 

    $conarr2 = explode(";",$conn); 
    $conarr = array();
    foreach($conarr2 as $key=>$value){
        $k = substr($value,0,strpos($value,'='));
        $conarr[$k] = substr($value,strpos($value,'=')+1);
    }
    
    print_r($conarr); die;
    $dbserver = $conarr['Database'];
    $dbUser = $conarr['User Id'];
    $dbPaswrd = $conarr['Password'];

    define('DB_SERVER',$$dbserver);
    define('DB_USER',$dbUser);
    define('DB_PASS' ,$dbPaswrd);
    define('DB_NAME', 'shopping');

    $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    // Check connection
    if (mysqli_connect_errno())
    {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
