<? include "header.php"; ?>

<body>
    <h1>시즈하자</h1>
    <button class="btn btn-primary">시즈하자</button>
    <script scr="bootstrap/js/bootstrap.min.js"></script>
</body>

<?php

include "config.php";
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);
$query = "SELECT * FROM battles";
$res = mysqli_query($conn,$query);

$row = mysqli_fetch_row($res);

echo $row[0];

?>
