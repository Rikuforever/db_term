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
    // [TRANSACTION] Setup
    mysqli_query($conn, "set autocommit = 0");
    mysqli_query($conn, "set session transaction isolation level read committed");  // [TRANSACTION] Isolation Level : READ COMMITTED
    mysqli_query($conn, "begin");

    // delete hero
    $query = 'DELETE FROM Hero WHERE hero_name="'.$hero_name.'"';
    $res = mysqli_query($conn,$query);

    // [TRANSACTION] Check
    if($res){
        mysqli_query($conn,"commit");   // [TRANSACTION] Success
        msg("Delete complete!");
    }
    else{
        mysqli_query($conn,"rollback"); // [TRANSACTION] Fail
        s_msg("[SQL Error] unsuccessful deletion");
    }

    // [TRANSACTION] Dispose
    mysqli_query($conn, "set autocommit = 1");
}

echo "<meta http-equiv='refresh' content='0;url=hero_list.php'>";
?>