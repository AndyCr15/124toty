<?php

// This calculates the last Saturday and then 6 days previous for the start of last week

$endDate = strtotime("last Saturday");
$startDate = strtotime('-6 day', $endDate);
$startDate = date('Y-m-d', $startDate);
$endDate = date('Y-m-d', $endDate);

debug_to_console('Last week begins :'.$startDate);
debug_to_console('Last week ends :'.$endDate);
?>
