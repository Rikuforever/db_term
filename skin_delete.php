<?php

include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$skin_id = $_GET['id'];

// check id
$query = 'SELECT skin_id FROM Skin WHERE skin_id='.$skin_id;
$res = mysqli_query($conn,$query);
$num = mysqli_num_rows($res);

if(!$num){   // have duplicates
    msg("No matching skin!");
} else {
    // add player
    $query = 'DELETE FROM Skin WHERE skin_id='.$skin_id;
    $res = mysqli_query($conn,$query);

    if($res){
        s_msg("Delete complete!");
    }
    else{
        s_msg("[SQL Error] unsuccessful insertion");
    }
}

echo "<meta http-equiv='refresh' content='0;url=skin_list.php'>";
?>