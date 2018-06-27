<?php

$startDate = strtotime("first day of last month");
$endDate = strtotime("last day of last month");
$startDate = date('Y-m-d', $startDate);
$endDate = date('Y-m-d', $endDate);

debug_to_console('Last month begins :'.$startDate);
debug_to_console('Last month ends :'.$endDate);
?>
