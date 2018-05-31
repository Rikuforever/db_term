<? include "header.php"; ?>

<?php

include "config.php";
include "util.php";

$player_id = check_injection($_GET['id']);

if(!$player_id){
    msg("Invalid access.");
    exit();
}

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

// check player data
$query = 'SELECT player_id, player_name, player_credit FROM Player WHERE player_id="'.$player_id.'"';
$res = mysqli_query($conn, $query);
$num = mysqli_num_rows($res);

if(!$num){
    msg("No matching ID");
    exit();
}
?>

    <!-- Player Data -->
<?php
$row = mysqli_fetch_row($res);
?>
    <div class="w3-panel">
        <div class="jumbotron">
            <h1 class="display-4"><? echo $row[1]; ?></h1>
            <p class="lead">Write your message here.</p>
            <hr class="my-4">
            <p>ID : <? echo $row[0]; ?></p>
            <p>Credit : <? echo $row[2]; ?></p>
        </div>
    </div>


    <!-- Battle Statistic -->
<?php
$play_count = 0;
$win_count = 0; $lose_count = 0;
$kill_count = 0; $death_count = 0;

$query = 'SELECT detail_team, detail_kill, detail_death, battle_win FROM Battle_Detail NATURAL JOIN Battle WHERE player_id="'.$player_id.'"';
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_row($res)){
    $play_count++;
    if($row[0] == $row[3]){
        $win_count++;
    } else {
        $lose_count++;
    }
    $kill_count += $row[1];
    $death_count += $row[2];
}
?>
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fas fa-user-edit"></i> Battle Statistic </b></h5>
    </header>
    <div class="w3-panel">
        <div class="w3-row-padding" style="margin:0 -16px">
            <table class="table table-sm table-striped table-hover">
                <thead>
                <tr>
                    <th class="text-center" scope="col" style="width : 25%">Play Count</th>
                    <th class="text-center" scope="col" style="width : 25%">Win Rate</th>
                    <th class="text-center" scope="col" style="width : 25%">Average Kill</th>
                    <th class="text-center" scope="col" style="width : 25%">Average Death</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center"><? echo $play_count; ?></td>
                    <td class="text-center"><? echo ($win_count / $play_count) * 100; ?>%</td>
                    <td class="text-center"><? echo ($kill_count / $play_count); ?></td>
                    <td class="text-center"><? echo ($death_count / $play_count); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Hero Statistic -->
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fas fa-user-edit"></i> Hero Statistic </b></h5>
    </header>
    <div class="w3-panel">
        <div class="w3-row-padding" style="margin:0 -16px">
            <table class="table table-sm table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col" style="width : 10%">Hero</th>
                    <th scope="col" style="width : 10%">Role</th>
                    <th scope="col" style="width : 20%">Play Count</th>
                    <th scope="col" style="width : 20%">Win Rate</th>
                    <th scope="col" style="width : 20%">Average Kill</th>
                    <th scope="col" style="width : 20%">Average Death</th>
                </tr>
                </thead>
                <tbody>
<?php
$query = '
SELECT
  Hero.hero_name,
  hero_role,
  total_battle,
  total_kill,
  total_death
FROM
  Hero
  LEFT JOIN (
    SELECT
      hero_name,
      COUNT(battle_id) as total_battle,
      SUM(detail_kill) as total_kill,
      SUM(detail_death) as total_death
    FROM
      Battle_Detail NATURAL
      JOIN Battle
    WHERE
      detail_team = battle_win
      AND player_id = "'.$player_id.'"
    GROUP BY
      hero_name
  ) AS T ON Hero.hero_name = T.hero_name;
';
$res_win = mysqli_query($conn, $query);
mysqli_store_result($res_win);

$query = '
SELECT
  Hero.hero_name,
  hero_role,
  total_battle,
  total_kill,
  total_death
FROM
  Hero
  LEFT JOIN (
    SELECT
      hero_name,
      COUNT(battle_id) as total_battle,
      SUM(detail_kill) as total_kill,
      SUM(detail_death) as total_death
    FROM
      Battle_Detail NATURAL
      JOIN Battle
    WHERE
      detail_team != battle_win
      AND player_id = "'.$player_id.'"
    GROUP BY
      hero_name
  ) AS T ON Hero.hero_name = T.hero_name;
';
$res_lose = mysqli_query($conn, $query);
mysqli_store_result($res_lose);

while($row_win = mysqli_fetch_row($res_win)){
    $hero_name = $row_win[0];
    $hero_role = $row_win[1];
    $play_count = $row_win[2];
    $win_count = $row_win[2];
    $kill_count = $row_win[3];
    $death_count = $row_win[4];

    $row_lose = mysqli_fetch_row($res_lose);
    $play_count += $row_lose[2];
    $kill_count += $row_lose[3];
    $death_count += $row_lose[4];


    echo '<tr>';
    echo    '<td>'.$hero_name.'</td>';
    echo    '<td>'.$hero_role.'</td>';
    echo    '<td>'.$play_count.'</td>';
    echo    '<td>'.($win_count / ($win_count+$lose_count) * 100).'%</td>';
    echo    '<td>'.($kill_count / $play_count).'</td>';
    echo    '<td>'.($death_count / $play_count).'</td>';
    echo '</tr>';
}

mysqli_free_result($res_win);
mysqli_free_result($res_lose);
?>
                </tbody>
            </table>
        </div>
    </div>

<? include "footer.php"; ?>