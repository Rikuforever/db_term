<?php

include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$player_id = $_POST['player_id'];
$skin_id = $_POST['skin_id'];

$query = 'INSERT INTO Player_Skin(player_id, skin_id) VALUES ("'.$player_id.'", '.$skin_id.')';
$res = mysqli_query($conn,$query);
$num = mysqli_num_rows($res);

if($res){
    s_msg("Give complete!");
}
else{
    s_msg("[SQL Error] unsuccessful insertion");
}

echo "<meta http-equiv='refresh' content='0;url=battle_list.php'>";
?>