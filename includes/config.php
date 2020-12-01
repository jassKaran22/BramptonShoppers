<?php 
    $conn = getenv("MYSQLCONNSTR_localdb"); 

    $conarr2 = explode(";",$conn); 
    $conarr = array();
    foreach($conarr2 as $key=>$value){
        $k = substr($value,0,strpos($value,'='));
        $conarr[$k] = substr($value,strpos($value,'=')+1);
    }
    
    print_r($conarr); 
?>
