<?php

include("core/init.inc.php");
header('Content-Type: text/plain');

print_r(read_csv("data/users.csv"));

?>