<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$skin_name = check_injection($_POST['skin_name']);
$hero_name = check_injection($_POST['hero_name']);
$rarity_name = check_injection($_POST['rarity_name']);


// add skin
$query = 'INSERT INTO Skin (skin_name, hero_name, rarity_name) VALUES ("'.$skin_name.'","'.$hero_name.'","'.$rarity_name.'")';
$res = mysqli_query($conn, $query);

if($res){
    s_msg("Add complete!");
}
else{
    s_msg("[SQL Error] unsuccessful insertion");
}

echo "<meta http-equiv='refresh' content='0;url=skin_list.php'>";

?>