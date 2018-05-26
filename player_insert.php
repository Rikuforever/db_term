<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$player_id = "rikuforever";
$player_name = "Riku";

check_injection($player_id);

// check duplicates
$query = 'SELECT player_id FROM Player WHERE player_id="'.$player_id.'"';
$res = mysqli_query($conn,$query);
$num = mysqli_num_rows($res);

if($num){   // have duplicates
    msg("이미 존재하는 ID 입니다!");
} else {
    // add player
    $query = 'INSERT INTO Player (player_id, player_name) VALUES ("'.$player_id.'","'.$player_name.'")';
    $res = mysqli_query($conn,$query);

    if($res){
        s_msg("추가 완료!");
    }
    else{
        msg("unsuccessful insertion");
    }
}

?>