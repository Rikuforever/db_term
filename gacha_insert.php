<?php

include "config.php";
include "util.php";

$player_id = "player1";

// get credit
$query = 'SELECT player_credit FROM Player WHERE player_id="'.$player_id.'"';
$ret = mysqli_query($conn,$query);



?>