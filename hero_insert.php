<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$hero_name = check_injection($_POST['hero_name']);
$hero_role = check_injection( $_POST['hero_role']);

// check duplicates
$query = 'SELECT hero_name FROM Hero WHERE hero_name="'.$hero_name.'"';
$res = mysqli_query($conn,$query);
$num = mysqli_num_rows($res);

if($num){   // have duplicates
    msg("The name is already taken!");
} else {
    // add player
    $query = 'INSERT INTO Hero (hero_name, hero_role) VALUES ("'.$hero_name.'","'.$hero_role.'")';
    $res = mysqli_query($conn,$query);

    if($res){
        s_msg("Add complete!");
    }
    else{
        s_msg("[SQL Error] unsuccessful insertion");
    }
}

echo "<meta http-equiv='refresh' content='0;url=hero_list.php'>";

?>