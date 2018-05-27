<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$player_id = $_POST['player_id'];
$player_name = $_POST['player_name'];

check_injection($player_id);
check_injection($player_name);

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
        echo "<meta http-equiv='refresh' content='0;url=player_list.php'>";
    }
    else{
        s_msg("unsuccessful insertion");
        echo "<meta http-equiv='refresh' content='0;url=player_list.php'>";
    }
}

?>