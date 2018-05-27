<? include "header.php" ?>
<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

// get players
$query = "SELECT player_id, player_name FROM Player";
$ret_player = mysqli_query($conn, $query);
// get heroes
$query = "SELECT hero_name FROM Hero";
$ret_hero = mysqli_query($conn, $query);

?>

<script>
    function value_check(){
        var form = document.battle_add_form;

        var arr_player = [
            form.red_player1.value,
            form.red_player2.value,
            form.red_player3.value,
            form.red_player4.value,
            form.red_player5.value,
            form.red_player6.value,
            form.blue_player1.value,
            form.blue_player2.value,
            form.blue_player3.value,
            form.blue_player4.value,
            form.blue_player5.value,
            form.blue_player6.value
        ];
        var arr_hero = [
            form.red_player1_hero.value,
            form.red_player2_hero.value,
            form.red_player3_hero.value,
            form.red_player4_hero.value,
            form.red_player5_hero.value,
            form.red_player6_hero.value,
            form.blue_player1_hero.value,
            form.blue_player2_hero.value,
            form.blue_player3_hero.value,
            form.blue_player4_hero.value,
            form.blue_player5_hero.value,
            form.blue_player6_hero.value
        ];
        var arr_kill = [
            form.red_player1_kill.value,
            form.red_player2_kill.value,
            form.red_player3_kill.value,
            form.red_player4_kill.value,
            form.red_player5_kill.value,
            form.red_player6_kill.value,
            form.blue_player1_kill.value,
            form.blue_player2_kill.value,
            form.blue_player3_kill.value,
            form.blue_player4_kill.value,
            form.blue_player5_kill.value,
            form.blue_player6_kill.value
        ];
        var arr_death = [
            form.red_player1_death.value,
            form.red_player2_death.value,
            form.red_player3_death.value,
            form.red_player4_death.value,
            form.red_player5_death.value,
            form.red_player6_death.value,
            form.blue_player1_death.value,
            form.blue_player2_death.value,
            form.blue_player3_death.value,
            form.blue_player4_death.value,
            form.blue_player5_death.value,
            form.blue_player6_death.value
        ];

        <!-- Check Empty Values -->
        for(var i = 0; i <= arr_player.length; i++){
            if(arr_player[i] == ""){
                alert("Player not selected.");
                return false;
            }
        }
        for(var i = 0; i <= arr_hero.length; i++){
            if(arr_hero[i] == ""){
                alert("Hero not selected.");
                return false;
            }
        }
        for(var i = 0; i <= arr_kill.length; i++){
            if(arr_kill[i] == ""){
                alert("Empty kill value.");
                return false;
            }
        }
        for(var i = 0; i <= arr_death.length; i++){
            if(arr_death[i] == ""){
                alert("Empty death value.");
                return false;
            }
        }
        if(form.battle_win.value == ""){
            alert("Choose winner.");
            return false;
        }

        <!-- Check Player Duplicates -->
        var counts = [];
        for(var i = 0; i <= arr_player.length; i++){
            if(counts[arr_player[i]] === undefined){
                counts[arr_player[i]] = 1;
            } else {
                alert("Must assign unique players.");
                return false;
            }
        }

        return true;
    }
</script>

<!-- Add Battle -->
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fas fa-plus"></i> Input Battle </b></h5>
</header>
<div class="w3-panel">
    <form name="battle_add_form" method="post" onsubmit="return value_check()" action="battle_insert.php">
        <!-- Team Red -->
        <div class="form-group">
            <label for="battle_red">Team Red</label>
            <?php
            $team = 'red';
            for($index = 1; $index <= 6; $index++){
                echo '<div class="input-group">';
                    $prefix = $team.'_player'.$index;
                    // Player (dropdown)
                    echo '<select class="custom-select" name="'.$prefix.'" id="'.$prefix.'">';
                        echo '<option disabled selected value="">Player</option>';
                        while($row = mysqli_fetch_row($ret_player)) {
                            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                        }
                        mysqli_data_seek($ret_player, 0);
                    echo '</select>';
                    // Hero (dropdown)
                    echo '<select class="custom-select" name="'.$prefix.'_hero" id="'.$prefix.'_hero">';
                        echo '<option disabled selected value="">Hero</option>';
                        while($row = mysqli_fetch_row($ret_hero)) {
                            echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
                        }
                        mysqli_data_seek($ret_hero, 0);
                    echo '</select>';
                    // Kill & Death (number)
                    echo '<input type="number" name="'.$prefix.'_kill" id="'.$prefix.'_kill" placeholder="Kill Count" min="0">';
                    echo '<input type="number" name="'.$prefix.'_death" id="'.$prefix.'_death" placeholder="Death Count" min="0">';
                echo '</div>';
            }
            ?>
        </div>
        <!-- Team Blue -->
        <div class="form-group">
            <label for="battle_blue">Team Blue</label>
            <?php
            $team = 'blue';
            for($index = 1; $index <= 6; $index++){
                echo '<div class="input-group">';
                $prefix = $team.'_player'.$index;
                // Player (dropdown)
                echo '<select class="custom-select" name="'.$prefix.'" id="'.$prefix.'">';
                echo '<option disabled selected value="">Player</option>';
                while($row = mysqli_fetch_row($ret_player)) {
                    echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                }
                mysqli_data_seek($ret_player, 0);
                echo '</select>';
                // Hero (dropdown)
                echo '<select class="custom-select" name="'.$prefix.'_hero" id="'.$prefix.'_hero">';
                echo '<option disabled selected value="">Hero</option>';
                while($row = mysqli_fetch_row($ret_hero)) {
                    echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
                }
                mysqli_data_seek($ret_hero, 0);
                echo '</select>';
                // Kill & Death (number)
                echo '<input type="number" name="'.$prefix.'_kill" id="'.$prefix.'_kill" placeholder="Kill Count" min="0">';
                echo '<input type="number" name="'.$prefix.'_death" id="'.$prefix.'_death" placeholder="Death Count" min="0">';
                echo '</div>';
            }
            ?>
        </div>
        <div class="input-group col-md-2">
            <select class="custom-select" name="battle_win" id="battle_win">
                <option disabled selected value="">Winner</option>
                <option value="Red">Red</option>
                <option value="Blue">Blue</option>
            </select>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
    </form>
</div>