<?php

include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$rarity_name =  check_injection($_POST['rarity_name']);
$rarity_price = check_injection($_POST['rarity_price']);
$rarity_duplicate = check_injection($_POST['rarity_duplicate']);
$rarity_gachavalue = check_injection($_POST['rarity_gachavalue']);

// check name
$query = 'SELECT rarity_name FROM Rarity WHERE rarity_name="'.$rarity_name.'"';
$res = mysqli_query($conn,$query);
$num = mysqli_num_rows($res);

if(!$num){   // no matching name
    msg("No matching rarity name!");
} else {
    // [TRANSACTION] Setup
    mysqli_query($conn, "set autocommit = 0");
    mysqli_query($conn, "set session transaction isolation level read committed");  // [TRANSACTION] Isolation Level : READ COMMITTED
    mysqli_query($conn, "begin");

    // update rarity
    $query = '
      UPDATE Rarity 
      SET 
        rarity_price='.$rarity_price.', 
        rarity_duplicate='.$rarity_duplicate.',
        rarity_gachavalue='.$rarity_gachavalue.' 
      WHERE rarity_name="'.$rarity_name.'"
    ';
    $res = mysqli_query($conn,$query);

    // [TRANSACTION] Check
    if($res){
        mysqli_query($conn,"commit");   // [TRANSACTION] Success
        msg("Update complete!");
    }
    else{
        mysqli_query($conn,"rollback"); // [TRANSACTION] Fail
        s_msg("[SQL Error] unsuccessful update");
    }

    // [TRANSACTION] Dispose
    mysqli_query($conn, "set autocommit = 1");
}

echo "<meta http-equiv='refresh' content='0;url=rarity_list.php'>";

?>