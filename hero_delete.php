<?php

include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$hero_name = $_GET['name'];

$hero_name = check_injection($hero_name);

// check id
$query = 'SELECT hero_name FROM Hero WHERE hero_name="'.$hero_name.'"';
$res = mysqli_query($conn,$query);
$num = mysqli_num_rows($res);

if(!$num){   // have duplicates
    msg("No matching name!");
} else {
    // add player
    $query = 'DELETE FROM Hero WHERE hero_name="'.$hero_name.'"';
    $res = mysqli_query($conn,$query);

    if($res){
        s_msg("Delete complete!");
    }
    else{
        s_msg("[SQL Error] unsuccessful insertion");
    }
}

echo "<meta http-equiv='refresh' content='0;url=hero_list.php'>";
?>