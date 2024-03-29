<? include "header.php" ?>
<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);
?>

    <!-- Edit Rarity -->
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fas fa-edit"></i> Edit Rarity </b></h5>
    </header>
    <script>
        function value_check(){
            var form = document.rarity_edit_form;
            if(form.rarity_name.value == ""){
                alert("Choose name.");
                form.rarity_name.focus();
                return false;
            } else if(!form.rarity_price.value){
                alert("Please set price.");
                form.rarity_price.focus();
                return false;
            } else if(!form.rarity_duplicate.value){
                alert("Please set return price.");
                form.rarity_duplicate.focus();
                return false;
            } else if(!form.rarity_gachavalue.value){
                alert("Please set gacha value.");
                form.rarity_gachavalue.focus();
                return false;
            }

            return true;
        }
    </script>
    <div class="w3-panel">
        <form name="rarity_edit_form" method="post" onsubmit="return value_check()" action="rarity_update.php">
            <div class="form-group col-md-5">
                <label for="rarity_name">Name</label>
                <select class="custom-select" name="rarity_name" id="rarity_name">
                    <option disabled selected value="">Rarity name</option>
                    <?php
                    $query = 'SELECT rarity_name FROM Rarity';
                    $ret = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_row($ret)){
                        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label for="rarity_price">Price</label>
                <input type="number" class="form-control" name="rarity_price" id="rarity_price" placeholder="Price" min="1"/>
            </div>
            <div class="form-group col-md-5">
                <label for="rarity_duplicate">Return Price</label>
                <input type="number" class="form-control" name="rarity_duplicate" id="rarity_duplicate" placeholder="Return Price" min="0"/>
            </div>
            <div class="form-group col-md-5">
                <label for="rarity_gachavalue">Gacha Value</label>
                <input type="number" class="form-control" name="rarity_gachavalue" id="rarity_gachavalue" placeholder="Gacha Value" min="1"/>
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>

    <!-- Manage Rarity -->
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fas fa-edit"></i> Manage Rarity </b></h5>
    </header>
    <div class="w3-panel">
        <div class="w3-row-padding" style="margin:0 -16px">
            <table class="table table-sm table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col" style="width : 30%">Name</th>
                    <th scope="col" style="width : 20%">Price</th>
                    <th scope="col" style="width : 20%">Return Price</th>
                    <th scope="col" style="width : 20%">Gacha Vaule</th>
                    <th scope="col" style="width : 10%"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM Rarity";
                $ret = mysqli_query($conn, $query);
                while($row = mysqli_fetch_row($ret)){
                    echo '
                        <tr>
                            <th scope="row">'.$row[0].'</th>
                            <td>'.$row[1].'</td>
                            <td>'.$row[2].'</td>
                            <td>'.$row[3].'</td>
                        </tr>
                    ';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>


<? include "footer.php"; ?>