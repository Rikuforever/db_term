<? include "header.php" ?>
<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);
?>

    <!-- Add Skin -->
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fas fa-user-plus"></i> Add Skin </b></h5>
    </header>
    <script>
        function value_check(){
            var form = document.skin_add_form;
            if(!form.skin_name.value){
                alert("Please fill in name.");
                form.skin_name.focus();
                return false;
            } else if(form.hero_name.value == ""){
                alert("Please select hero.");
                form.hero_name.focus();
                return false;
            } else if(form.rarity_name.value == ""){
                alert("Please select rarity.");
                form.rarity_name.focus();
                return false;
            }

            return true;
        }
    </script>
    <div class="w3-panel">
        <form name="skin_add_form" method="post" onsubmit="return value_check()" action="skin_insert.php">
            <div class="form-group col-md-5">
                <label for="skin_name">Name</label>
                <input type="text" class="form-control" name="skin_name" id="skin_name" placeholder="Name" minlength="1" maxlength="50"/>
            </div>
            <div class="form-group col-md-5">
                <label for="hero_name">Hero</label>
                <select class="custom-select" name="hero_name" id="hero_name">
                    <option disabled selected value="">Select hero</option>
                    <?php
                    $query = "SELECT hero_name FROM Hero";
                    $ret = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_row($ret)){
                        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label for="rarity_name">Hero</label>
                <select class="custom-select" name="rarity_name" id="rarity_name">
                    <option disabled selected value="">Select rarity</option>
                    <?php
                    $query = "SELECT rarity_name FROM Rarity";
                    $ret = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_row($ret)){
                        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>

    <!-- Manage Players -->
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fas fa-user-edit"></i> Manage Skins </b></h5>
    </header>
    <div class="w3-panel">
        <div class="w3-row-padding" style="margin:0 -16px">
            <table class="table table-sm table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col" style="width : 5%">#</th>
                    <th scope="col" style="width : 25%">Hero</th>
                    <th scope="col" style="width : 25%">Rarity</th>
                    <th scope="col" style="width : 25%">Name</th>
                    <th scope="col" style="width : 10%"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM Skin";
                $ret = mysqli_query($conn, $query);
                while($row = mysqli_fetch_row($ret)){
                    echo '
                        <tr>
                            <th scope="row">'.$row[0].'</th>
                            <td>'.$row[1].'</td>
                            <td>'.$row[2].'</td>
                            <td>'.$row[3].'</td>
                            <td>
                                <a class="btn btn-danger" href="skin_delete.php?id='.$row[0].'">Delete</a>
                            </td>
                        </tr>
                    ';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>


<? include "footer.php"; ?>