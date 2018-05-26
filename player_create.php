<?php
include "config.php";
include "util.php";

$player_name = "b";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);
$query = "INSERT INTO Player (player_name) VALUES ('$player_name')";
$res = mysqli_query($conn,$query);

if($res){
    echo "
        <script>
            history.go(-1);
        </script>
    ";
}
else{
    s_msg("unsuccessful insertion");
}

?>