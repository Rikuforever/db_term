<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$player_id = check_injection($_POST['player_id']);
$player_name = check_injection( $_POST['player_name']);

// check duplicates
$query = 'SELECT player_id FROM Player WHERE player_id="'.$player_id.'"';
$res = mysqli_query($conn,$query);
$num = mysqli_num_rows($res);

if($num){   // have duplicates
    msg("The ID is already taken!");
} else {
    // add player
    $query = 'INSERT INTO Player (player_id, player_name) VALUES ("'.$player_id.'","'.$player_name.'")';
    $res = mysqli_query($conn,$query);

    if($res){
        s_msg("Add complete!");
    }
    else{
        s_msg("[SQL Error] unsuccessful insertion");
    }
}

echo "<meta http-equiv='refresh' content='0;url=player_list.php'>";

?>