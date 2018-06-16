<?php

// specify the date range for 'this week'
if(date("l") == 'Sunday'){
    // it's Sunday so 'last Sunday' would report last week, this makes it today
    $startDate = date('Y-m-d', strtotime("Today"));
} else {
    $startDate = date('Y-m-d', strtotime("last Sunday"));
}
$endDate = date('Y-m-d', strtotime("next Sunday"));

debug_to_console('This week begins :'.$startDate);
debug_to_console('This week ends :'.$endDate);
?>
