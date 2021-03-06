<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    //include_once 'RotationUser.php';
    
    include 'functions.php';
    include 'checkloggedin.php';
    include 'header.php';
    
    ?>

</head>

<body>
    <div class="bg">

        <?php
            
        include 'navback.php';

        $month = date("n");
        $year = 2019;

        if(isset($_GET['month'])){
            $month = $_GET['month'];
        }
        if(isset($_GET['year'])){
            $year = $_GET['year'];
        }

        debug_to_console($year);

        ?>

        <div class="container">

            <?php

            showPOTM($month, $year);

            ?>

        </div>

    <?php

    function checkFirstMonth(){
        include 'connection.php';
        $query = "SELECT * FROM partner_team_month_score ORDER BY -month DESC LIMIT 1";
        $result = mysqli_query($link, $query);
        if (!$result) {
            printf("Error: %s\n", mysqli_error($link));
            exit();
        }
        $row = mysqli_fetch_array($result);

        return $row['month'];
    }

    function showPOTM($month, $year){
        
        include 'connection.php';

        $teams = array("Blue", "Green", "Red", "Yellow");

        echo '<h1>Partner Of The Month '.monthText($month).' '.$year.'</h1>';

        foreach ($teams as $team) {
        
            echo '<h4>'.$team.'</h4>';
            echo '<div class="row">';
            $query = "SELECT employee, Team, SUM(score) AS count FROM partner_team_month_score
            WHERE MONTH = ".$month." AND YEAR = ".$year." AND team='".strtolower($team)."'
            GROUP BY employee, team
            ORDER BY 3 DESC LIMIT 6";
            $result = mysqli_query($link, $query);
            if (!$result) {
                printf("Error: %s\n", mysqli_error($link));
                exit();
            }
            
            while($row = mysqli_fetch_array($result)){
        
                showPartnerAndCount($row['employee'],$row['count']);
        
            }
            echo '</div>';
        }
        echo '<br>';

        echo '<h6>Change Month</h6>';
        // links for other months here
        $first = checkFirstMonth();
        $current = date("n");
        echo '<div class="row">';

        for ($x = 1; $x <= 12; $x++) {
            // only show if it's not the month current being shown
            if($x != $month){
                echo '<div class="col-sm-4">';
                echo '<div class="lightGreenBox click">';
                echo '<a href="partnerofthemonth.php?month='.$x.'&year='.$year.'">'.monthText($x).'</a>';
                echo '</div>';
                echo '</div>';
            }
            
        }
        echo '</div>';

        echo '<br>';

        echo '<h6>Change Year</h6>';
        // links for other years here

        $years = array(2018, 2019);

        foreach ($years as $thisYear) {
            // only show if it's not the month current being shown

            debug_to_console($thisYear);

            if($thisYear != $year){
                echo '<div class="col-sm-4">';
                echo '<div class="lightGreenBox click">';
                echo '<a href="partnerofthemonth.php?month='.$month.'&year='.$thisYear.'">'.$thisYear.'</a>';
                echo '</div>';
                echo '</div>';
            }
            
        }
        echo '</div>';

    }

    include ('footer.php');

    ?>
    </div>

</body>

</html>
