<?php

include "util.php";

$input = "test''";

$input = check_injection($input);

echo $input;

?>