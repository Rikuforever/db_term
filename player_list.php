<? include "header.php" ?>

<?php
include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);
$query = "SELECT * FROM Player";
?>

<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Credit</th>
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
                    <td>'.$row[2].'</td>
                </tr>
            ';
        }
    ?>
    </tbody>
</table>

<? include "footer.php"; ?>