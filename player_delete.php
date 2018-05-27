<?php

include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$player_id = $_GET['id'];

$player_id = check_injection($player_id);

// check id
$query = 'SELECT player_id FROM Player WHERE player_id="'.$player_id.'"';
$res = mysqli_query($conn,$query);
$num = mysqli_num_rows($res);

if(!$num){   // have duplicates
    msg("No matching ID!");
} else {
    // add player
    $query = 'DELETE FROM Player WHERE player_id="'.$player_id.'"';
    $res = mysqli_query($conn,$query);

    if($res){
        s_msg("Delete complete!");
    }
    else{
        s_msg("[SQL Error] unsuccessful insertion");
    }
}

echo "<meta http-equiv='refresh' content='0;url=player_list.php'>";
?>