<?php

include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$red_player1 = "player1";   $red_player1_hero = "Genji";    $red_player1_kill = 3;  $red_player1_death = 1;
$red_player2 = "player2";   $red_player2_hero = "Genji";    $red_player2_kill = 3;  $red_player2_death = 1;
$red_player3 = "player3";   $red_player3_hero = "Genji";    $red_player3_kill = 3;  $red_player3_death = 1;
$red_player4 = "player4";   $red_player4_hero = "Genji";    $red_player4_kill = 3;  $red_player4_death = 1;
$red_player5 = "player5";   $red_player5_hero = "Genji";    $red_player5_kill = 3;  $red_player5_death = 1;
$red_player6 = "player6";   $red_player6_hero = "Genji";    $red_player6_kill = 3;  $red_player6_death = 1;

$blue_player1 = "player7";  $blue_player1_hero = "Genji";   $blue_player1_kill = 3; $blue_player1_death = 1;
$blue_player2 = "player8";  $blue_player2_hero = "Genji";   $blue_player2_kill = 3; $blue_player2_death = 1;
$blue_player3 = "player9";  $blue_player3_hero = "Genji";   $blue_player3_kill = 3; $blue_player3_death = 1;
$blue_player4 = "player10"; $blue_player4_hero = "Genji";   $blue_player4_kill = 3; $blue_player4_death = 1;
$blue_player5 = "player11"; $blue_player5_hero = "Genji";   $blue_player5_kill = 3; $blue_player5_death = 1;
$blue_player6 = "player12"; $blue_player6_hero = "Genji";   $blue_player6_kill = 3; $blue_player6_death = 1;

$result = "Red";

// get new battle id
$query = 'INSERT INTO Battle (battle_win) VALUES ("'.$result.'")';
$res = mysqli_query($conn, $query);
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
$res = mysqli_query($conn, $query);

if($res){
    s_msg("Add complete!");
}
else{
    s_msg("[SQL Error] unsuccessful insertion");
}

echo "<meta http-equiv='refresh' content='0;url=battle_list.php'>";

?>