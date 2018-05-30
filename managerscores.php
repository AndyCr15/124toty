<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include_once 'RotationUser.php';
    include 'connection.php';
    include 'functions.php';
    include 'checkloggedin.php';
    include 'header.php';
    
    ?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

        $limit = 6;

        $time = 'month';
        if(isset($_GET['time'])){
            $time = $_GET['time'];
        }
        
        // set start and end dates depending on the get info
        debug_to_console($time);
        switch ($time){
            case 'week':
                include 'thisweek.php';
                break;
            case 'month':
                include 'thismonth.php';
                break;
            case 'all':
                $startDate = '2018-03-23';
                // any date after today
                $endDate = date('Y-m-d', strtotime("next Sunday"));
                break;
        }
        

        ?>


            <div class="container">

                <h1><a href="viewrotationchecks.php">Partner Checks</a></h1>
                <div class="row">
                    <?php
                
                    $managers = array();

                    $query = "SELECT * FROM `rotationchecks`";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    while($row = mysqli_fetch_array($result)){

                        if(check_in_date_range($startDate, $endDate, $row['time'])){

                            $managers[] = $row['manager'];

                        }

                    }

                    $count = array_count_values($managers);

                    $keys = array_keys($count);
                    $values = array_values($count);
                    
                    array_multisort($values, SORT_DESC, $keys);

                    for ($x = 0; ($x < sizeof($count) && $x < $limit); $x++) {

                        $employee = $keys[$x];
                        $number = $values[$x];

                        showScore($employee, $number);
                    }

                    ?>

                </div>

                <h1><a href="viewobservations.php">Observations</a></h1>
                <div class="row">
                    <?php
                
                    $managers = array();

                    $query = "SELECT * FROM `observations`";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    while($row = mysqli_fetch_array($result)){

                        if(check_in_date_range($startDate, $endDate, $row['time'])){

                            $managers[] = $row['manager'];

                        }

                    }

                    $count = array_count_values($managers);

                    $keys = array_keys($count);
                    $values = array_values($count);
                    
                    array_multisort($values, SORT_DESC, $keys);

                    for ($x = 0; ($x < sizeof($count) && $x < $limit); $x++) {

                        $employee = $keys[$x];
                        $number = $values[$x];

                        showScore($employee, $number);
                    }

                    ?>

                </div>

                <h1><a href="viewobservations.php">Questions</a></h1>
                <div class="row">
                    <?php
                
                    $managers = array();

                    $query = "SELECT * FROM `questionchecks`";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    while($row = mysqli_fetch_array($result)){

                        if(check_in_date_range($startDate, $endDate, $row['time'])){

                            $managers[] = $row['manager'];

                        }

                    }

                    $count = array_count_values($managers);

                    $keys = array_keys($count);
                    $values = array_values($count);
                    
                    array_multisort($values, SORT_DESC, $keys);

                    for ($x = 0; ($x < sizeof($count) && $x < $limit); $x++) {

                        $employee = $keys[$x];
                        $number = $values[$x];

                        showScore($employee, $number);
                    }

                    ?>

                </div>

                <h1><a href="viewobservations.php">Food Safety Checks</a></h1>
                <div class="row">
                    <?php
                
                    $managers = array();

                    $query = "SELECT * FROM `foodsafetychecks`";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    while($row = mysqli_fetch_array($result)){

                        if(check_in_date_range($startDate, $endDate, $row['time'])){

                            $managers[] = $row['manager'];

                        }

                    }

                    $count = array_count_values($managers);

                    $keys = array_keys($count);
                    $values = array_values($count);
                    
                    array_multisort($values, SORT_DESC, $keys);

                    for ($x = 0; ($x < sizeof($count) && $x < $limit); $x++) {

                        $employee = $keys[$x];
                        $number = $values[$x];

                        showScore($employee, $number);
                    }

                    ?>

                </div>

                <h1><a href="viewbagchecks.php">Partner Searches</a></h1>
                <div class="row">
                    <?php
                
                    $managers = array();

                    $query = "SELECT * FROM `bagchecks`";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    while($row = mysqli_fetch_array($result)){

                        if(check_in_date_range($startDate, $endDate, $row['time'])){

                            $managers[] = $row['manager'];

                        }

                    }

                    $count = array_count_values($managers);

                    $keys = array_keys($count);
                    $values = array_values($count);
                    
                    array_multisort($values, SORT_DESC, $keys);

                    for ($x = 0; ($x < sizeof($count) && $x < $limit); $x++) {

                        $employee = $keys[$x];
                        $number = $values[$x];

                        showScore($employee, $number);
                    }

                    ?>

                </div>

                <h1><a href="viewuniformchecks.php">Uniform Checks</a></h1>
                <div class="row">
                    <?php
                
                    $managers = array();

                    $query = "SELECT * FROM `uniformchecks`";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    while($row = mysqli_fetch_array($result)){

                        if(check_in_date_range($startDate, $endDate, $row['time'])){

                            $managers[] = $row['manager'];

                        }

                    }

                    $count = array_count_values($managers);

                    $keys = array_keys($count);
                    $values = array_values($count);
                    
                    array_multisort($values, SORT_DESC, $keys);

                    for ($x = 0; ($x < sizeof($count) && $x < $limit); $x++) {

                        $employee = $keys[$x];
                        $number = $values[$x];

                        showScore($employee, $number);
                    }

                    ?>

                </div>

                <?php

                echo '<div class="row">';

                if($time != 'week') {
                    echo '<div class="col-sm-6">';
                    echo '<div class="lightGreenBox click">';
                    echo '<a href="managerscores.php?time=week">See This Week</a>';
                    echo '</div>';
                    echo '</div>';
                }

                if($time != 'month') {
                    echo '<div class="col-sm-6">';
                    echo '<div class="lightGreenBox click">';
                    echo '<a href="managerscores.php?time=month">See This Month</a>';
                    echo '</div>';
                    echo '</div>';
                }

                if($time != 'all') {
                    echo '<div class="col-sm-6">';
                    echo '<div class="lightGreenBox click">';
                    echo '<a href="managerscores.php?time=all">See All Time</a>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '</div>';

                ?>

            </div>

            <?php
            
            include ('footer.php');

        ?>
    </div>
</body>

</html>
