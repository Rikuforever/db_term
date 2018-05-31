<? include "header.php" ?>
<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);
?>

    <!-- Add Player -->
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fas fa-user-plus"></i> Add Player </b></h5>
</header>
<script>
    function value_check(){
        var form = document.player_add_form;
        if(!form.player_id.value){
            alert("Please fill in ID.");
            form.player_id.focus();
            return false;
        } else if(!form.player_name.value){
            alert("Please fill in Nickname.");
            form.player_name.focus();
            return false;
        }

        return true;
    }
</script>
<div class="w3-panel">
    <form name="player_add_form" method="post" onsubmit="return value_check()" action="player_insert.php">
        <div class="form-group col-md-5">
            <label for="player_id">Player ID</label>
            <input type="text" class="form-control" name="player_id" id="player_id" placeholder="Player ID" minlength="1" maxlength="50"/>
        </div>
        <div class="form-group col-md-5">
            <label for="player_name">Nickname</label>
            <input type="text" class="form-control" name="player_name" id="player_name" placeholder="Nickname" minlength="1" maxlength="50"/>
        </div>
        <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</div>

    <!-- Manage Players -->
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fas fa-user-edit"></i> Manage Players </b></h5>
</header>
<div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
        <table class="table table-sm table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" style="width : 5%">#</th>
                    <th scope="col" style="width : 25%">ID</th>
                    <th scope="col" style="width : 25%">Name</th>
                    <th scope="col" style="width : 25%">Credit</th>
                    <th scope="col" style="width : 10%"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM Player";
                $ret = mysqli_query($conn, $query);
                $index = 1;
                while($row = mysqli_fetch_row($ret)){
                    echo '
                        <tr>
                            <th scope="row">'.$index.'</th>
                            <td>'.$row[0].'</td>
                            <td>'.$row[1].'</td>
                            <td>'.$row[2].'</td>
                            <td>
                                <a class="btn btn-secondary" href="player_detail.php?id='.$row[0].'">Detail</a>
                                <a class="btn btn-danger" href="player_delete.php?id='.$row[0].'">Delete</a>
                            </td>
                        </tr>
                    ';
                    $index += 1;
                }
            ?>
            </tbody>
        </table>
    </div>
</div>


<? include "footer.php"; ?>