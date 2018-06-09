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
    // [TRANSACTION] Setup
    mysqli_query($conn, "set autocommit = 0");
    mysqli_query($conn, "set session transaction isolation level read committed");  // [TRANSACTION] Isolation Level : READ COMMITTED
    mysqli_query($conn, "begin");

    // delete skin
    $query = 'DELETE FROM Skin WHERE skin_id='.$skin_id;
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

echo "<meta http-equiv='refresh' content='0;url=skin_list.php'>";
?>