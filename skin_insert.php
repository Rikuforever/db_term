<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$skin_name = check_injection($_POST['skin_name']);
$hero_name = check_injection($_POST['hero_name']);
$rarity_name = check_injection($_POST['rarity_name']);

// [TRANSACTION] Setup
mysqli_query($conn, "set autocommit = 0");
mysqli_query($conn, "set session transaction isolation level read committed");  // [TRANSACTION] Isolation Level : READ COMMITTED
mysqli_query($conn, "begin");

// add skin
$query = 'INSERT INTO Skin (skin_name, hero_name, rarity_name) VALUES ("'.$skin_name.'","'.$hero_name.'","'.$rarity_name.'")';
$res = mysqli_query($conn, $query);

// [TRANSACTION] Check
if($res){
    mysqli_query($conn,"commit");   // [TRANSACTION] Success
    msg("Add complete!");
}
else{
    mysqli_query($conn,"rollback"); // [TRANSACTION] Fail
    s_msg("[SQL Error] unsuccessful insertion");
}

// [TRANSACTION] Dispose
mysqli_query($conn, "set autocommit = 1");

echo "<meta http-equiv='refresh' content='0;url=skin_list.php'>";

?>