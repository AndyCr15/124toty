
<?php

include 'session.php';

include 'connection.php';
include 'functions.php';

    // count Partners in each team to find who has the fewest and who has the most

    $query = "SELECT * FROM `partners` WHERE (`team` = 'Blue' AND `active`=1)";
    $result = mysqli_query($link, $query);
    $blueCount=mysqli_num_rows($result);

    $query = "SELECT * FROM `partners` WHERE (`team` = 'Green' AND `active`=1)";
    $result = mysqli_query($link, $query);
    $greenCount=mysqli_num_rows($result);

    $query = "SELECT * FROM `partners` WHERE (`team` = 'Red' AND `active`=1)";
    $result = mysqli_query($link, $query);
    $redCount=mysqli_num_rows($result);

    $query = "SELECT * FROM `partners` WHERE (`team` = 'Yellow' AND `active`=1)";
    $result = mysqli_query($link, $query);
    $yellowCount=mysqli_num_rows($result);

    // find most, lets say 40, deduct from 40 what each team has, add them up and
    // that's what it's out off. The number off 40 (+2) is there chance of getting the partner

    $limit = max($blueCount, $greenCount, $redCount, $yellowCount);

    $blueCount = max($limit - $blueCount, 0) + 2;
    $greenCount = max($limit - $greenCount, 0) + 2;
    $redCount = max($limit - $redCount, 0) + 2;
    $yellowCount = max($limit - $yellowCount, 0) + 2;

    $total = $blueCount + $greenCount + $redCount + $yellowCount;

    debug_to_console('Blue:'.$blueCount);
    debug_to_console('Green:'.$greenCount);
    debug_to_console('Red:'.$redCount);
    debug_to_console('Yellow:'.$yellowCount);
    
    debug_to_console('Total:'.$total);
    $pick = rand(1,$total);
    debug_to_console($pick);

    $team = 'Yellow';
    switch ($pick) {
        case ($pick <= $blueCount):
            $team = 'Blue';
            break;
        case ($pick <= $blueCount + $greenCount):
            $team = 'Green';
            break;
        case ($pick <= $blueCount + $greenCount + $redCount):
            $team = 'Red';
            break;
    }
    debug_to_console($team);
    
    ?>