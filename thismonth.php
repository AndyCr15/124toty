<?php

// specify the date range for 'last week'
$startDate = strtotime("first day of this month");
$endDate = strtotime("last day of this month");
$startDate = date('Y-m-d', $startDate);
$endDate = date('Y-m-d', $endDate);

debug_to_console('This month begins :'.$startDate);
debug_to_console('This month ends :'.$endDate);
?>
