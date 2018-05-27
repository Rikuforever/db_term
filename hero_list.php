<? include "header.php" ?>
<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);
$query = "SELECT * FROM Hero";
?>

    <!-- Add hero -->
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fas fa-user-plus"></i> Add hero </b></h5>
    </header>
    <script>
        function value_check(){
            var form = document.hero_add_form;
            if(!form.hero_name.value){
                alert("Please fill in name.");
                form.hero_name.focus();
                return false;
            } else if(form.hero_role.value == "NULL"){
                alert("Please select role.");
                form.hero_role.focus();
                return false;
            }

            return true;
        }
    </script>
    <div class="w3-panel">
        <form name="hero_add_form" method="post" onsubmit="return value_check()" action="hero_insert.php">
            <div class="form-group col-md-5">
                <label for="hero_name">Hero name</label>
                <input type="text" class="form-control" name="hero_name" id="hero_name" placeholder="Hero name" maxlength="50"/>
            </div>
            <div class="form-group col-md-5">
                <label for="hero_role">Hero role</label>
                <select name="hero_role" class="custom-select">
                    <option selected value="NULL">Select role</option>
                    <option value="OFFENSE">OFFENSE</option>
                    <option value="DEFENSE">DEFENSE</option>
                    <option value="TANK">TANK</option>
                    <option value="SUPPORT">SUPPORT</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>

    <!-- Manage heros -->
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fas fa-user-edit"></i> Manage Heros </b></h5>
    </header>
    <div class="w3-panel">
        <div class="w3-row-padding" style="margin:0 -16px">
            <table class="table table-sm table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col" style="width : 5%">#</th>
                    <th scope="col" style="width : 25%">Name</th>
                    <th scope="col" style="width : 25%">Role</th>
                    <th scope="col" style="width : 10%"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $ret = mysqli_query($conn, $query);
                $index = 1;
                while($row = mysqli_fetch_row($ret)){
                    echo '
                        <tr>
                            <th scope="row">'.$index.'</th>
                            <td>'.$row[0].'</td>
                            <td>'.$row[1].'</td>
                            <td>
                                <a class="btn btn-danger" href="hero_delete.php?name='.$row[0].'">Delete</a>
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