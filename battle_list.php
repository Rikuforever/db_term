<? include "header.php" ?>
<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);
?>

<!-- List Battles -->
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fas fa-user-edit"></i> Battle Log </b></h5>
</header>
<div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
        <table class="table table-sm table-striped table-hover">
            <thead>
            <tr>
                <th scope="col" style="width : 5%">#</th>
                <th scope="col" colspan="6" style="width : 25%">Red</th>
                <th scope="col" colspan="6" style="width : 25%">Blue</th>
                <th scope="col" style="width : 10%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Get battle_id
            $query = "SELECT battle_id FROM Battle";
            $ret_battle = mysqli_query($conn, $query);
            while($row_battle = mysqli_fetch_row($ret_battle)){
                echo '
                        <tr>
                            <th scope="row">'.$row_battle[0].'</th>
                ';
                $query = "SELECT player_id FROM Battle_Detail WHERE battle_id=".$row_battle[0]." AND detail_team='Red'";
                $ret_detail_red = mysqli_query($conn, $query);
                for($index = 0; $index < 6; $index++){
                    if($row_detail_red = mysqli_fetch_row($ret_detail_red)){
                        echo '<td>'.$row_detail_red[0].'</td>';
                    } else {
                        echo '<td></td>';
                    }
                }
                $query = "SELECT player_id FROM Battle_Detail WHERE battle_id=".$row_battle[0]." AND detail_team='Blue'";
                $ret_detail_blue = mysqli_query($conn, $query);
                for($index = 0; $index < 6; $index++){
                    if($row_detail_blue = mysqli_fetch_row($ret_detail_blue)){
                        echo '<td>'.$row_detail_blue[0].'</td>';
                    } else {
                        echo '<td></td>';
                    }
                }
                echo '
                            <td>
                                <a class="btn btn-danger" href="hero_delete.php?name='.$row[0].'">Delete</a>
                            </td>
                ';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
