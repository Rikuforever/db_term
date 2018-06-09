
<?php

include "config.php";
include "util.php";

$commit = false;
$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$red_player1 = $_POST['red_player1'];   $red_player1_hero = $_POST['red_player1_hero'];    $red_player1_kill = $_POST['red_player1_kill'];  $red_player1_death = $_POST['red_player1_death'];
$red_player2 = $_POST['red_player2'];   $red_player2_hero = $_POST['red_player2_hero'];    $red_player2_kill = $_POST['red_player2_kill'];  $red_player2_death = $_POST['red_player2_death'];
$red_player3 = $_POST['red_player3'];   $red_player3_hero = $_POST['red_player3_hero'];    $red_player3_kill = $_POST['red_player3_kill'];  $red_player3_death = $_POST['red_player3_death'];
$red_player4 = $_POST['red_player4'];   $red_player4_hero = $_POST['red_player4_hero'];    $red_player4_kill = $_POST['red_player4_kill'];  $red_player4_death = $_POST['red_player4_death'];
$red_player5 = $_POST['red_player5'];   $red_player5_hero = $_POST['red_player5_hero'];    $red_player5_kill = $_POST['red_player5_kill'];  $red_player5_death = $_POST['red_player5_death'];
$red_player6 = $_POST['red_player6'];   $red_player6_hero = $_POST['red_player6_hero'];    $red_player6_kill = $_POST['red_player6_kill'];  $red_player6_death = $_POST['red_player6_death'];

$blue_player1 = $_POST['blue_player1'];   $blue_player1_hero = $_POST['blue_player1_hero'];    $blue_player1_kill = $_POST['blue_player1_kill'];  $blue_player1_death = $_POST['blue_player1_death'];
$blue_player2 = $_POST['blue_player2'];   $blue_player2_hero = $_POST['blue_player2_hero'];    $blue_player2_kill = $_POST['blue_player2_kill'];  $blue_player2_death = $_POST['blue_player2_death'];
$blue_player3 = $_POST['blue_player3'];   $blue_player3_hero = $_POST['blue_player3_hero'];    $blue_player3_kill = $_POST['blue_player3_kill'];  $blue_player3_death = $_POST['blue_player3_death'];
$blue_player4 = $_POST['blue_player4'];   $blue_player4_hero = $_POST['blue_player4_hero'];    $blue_player4_kill = $_POST['blue_player4_kill'];  $blue_player4_death = $_POST['blue_player4_death'];
$blue_player5 = $_POST['blue_player5'];   $blue_player5_hero = $_POST['blue_player5_hero'];    $blue_player5_kill = $_POST['blue_player5_kill'];  $blue_player5_death = $_POST['blue_player5_death'];
$blue_player6 = $_POST['blue_player6'];   $blue_player6_hero = $_POST['blue_player6_hero'];    $blue_player6_kill = $_POST['blue_player6_kill'];  $blue_player6_death = $_POST['blue_player6_death'];

$result = $_POST['battle_win'];

// [TRANSACTION] Setup
mysqli_query($conn, "set autocommit = 0");
mysqli_query($conn, "set session transaction isolation level serializable");  // [TRANSACTION] Isolation Level : SERIALIZABLE
mysqli_query($conn, "begin");

// get new battle id
$query = 'INSERT INTO Battle (battle_win) VALUES ("'.$result.'")';
$res1 = mysqli_query($conn, $query);

// [TRANSACTION] Check insertion
if($res1){
    $battle_id = mysqli_insert_id($conn);

    // insert battle details
    $query = '
      INSERT INTO Battle_Detail (battle_id, player_id, detail_team, hero_name, detail_kill, detail_death)
      VALUES
        ('.$battle_id.',"'.$red_player1.'","Red","'.$red_player1_hero.'",'.$red_player1_kill.','.$red_player1_death.'),
        ('.$battle_id.',"'.$red_player2.'","Red","'.$red_player2_hero.'",'.$red_player2_kill.','.$red_player2_death.'),
        ('.$battle_id.',"'.$red_player3.'","Red","'.$red_player3_hero.'",'.$red_player3_kill.','.$red_player3_death.'),
        ('.$battle_id.',"'.$red_player4.'","Red","'.$red_player4_hero.'",'.$red_player4_kill.','.$red_player4_death.'),
        ('.$battle_id.',"'.$red_player5.'","Red","'.$red_player5_hero.'",'.$red_player5_kill.','.$red_player5_death.'),
        ('.$battle_id.',"'.$red_player6.'","Red","'.$red_player6_hero.'",'.$red_player6_kill.','.$red_player6_death.'),
        ('.$battle_id.',"'.$blue_player1.'","Blue","'.$blue_player1_hero.'",'.$blue_player1_kill.','.$blue_player1_death.'),
        ('.$battle_id.',"'.$blue_player2.'","Blue","'.$blue_player2_hero.'",'.$blue_player2_kill.','.$blue_player2_death.'),
        ('.$battle_id.',"'.$blue_player3.'","Blue","'.$blue_player3_hero.'",'.$blue_player3_kill.','.$blue_player3_death.'),
        ('.$battle_id.',"'.$blue_player4.'","Blue","'.$blue_player4_hero.'",'.$blue_player4_kill.','.$blue_player4_death.'),
        ('.$battle_id.',"'.$blue_player5.'","Blue","'.$blue_player5_hero.'",'.$blue_player5_kill.','.$blue_player5_death.'),
        ('.$battle_id.',"'.$blue_player6.'","Blue","'.$blue_player6_hero.'",'.$blue_player6_kill.','.$blue_player6_death.')
    ';
    $res2 = mysqli_query($conn, $query);

    // [TRANSACTION] Check insertion
    if($res2){
        mysqli_query($conn,"commit");   // [TRANSACTION] Success
        msg("Add complete!");
        $commit = true;
    } else {
        mysqli_query($conn,"rollback"); // [TRANSACTION] Failed creating details
        s_msg("[SQL Error] unsuccessful insertion");
        $commit = false;
    }
} else{
    mysqli_query($conn,"rollback");     // [TRANSACTION] Failed creating battle_id
    s_msg("[SQL Error] unsuccessful insertion");
    $commit = false;
}


// [TRANSACTION] Dispose
mysqli_query($conn, "set autocommit = 1");

// [TRANSACTION] Output
if($commit){
    echo "<meta http-equiv='refresh' content='0;url=battle_list.php'>";
} else {
    echo "<meta http-equiv='refresh' content='0;url=battle_input.php'>";
}


?>

