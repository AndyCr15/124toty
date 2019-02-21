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

        $week = (date('W')-1);
        $year = date('Y');
        
        if(isset($_GET['week'])){
            $week = $_GET['week'];
        }
        if(isset($_GET['year'])){
            $year = $_GET['year'];
        }

        ?>

        <div class="container">

            <?php

            showPartnerActivity($week, $year);

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

    function showPartnerActivity($week, $year){
        
        include 'connection.php';

        echo '<h1>Rotation Check Count</h1>';

        echo '<h6>';
        echo date("d-M-Y", strtotime("1.1.2019 + ".($week)." weeks - 2 day"));
        echo '</h6>';

        echo '<div class="row">';
        echo '<div class="col-sm-6">';
        echo '<div class="lightGreenBox click">';
        echo '<a href="rotationcheckcount.php?week='.($week - 1).'">Previous Week</a>';
        echo '</div>';
        echo '</div>';

        echo '<div class="col-sm-6">';
        echo '<div class="lightGreenBox click">';
        echo '<a href="rotationcheckcount.php?week='.($week + 1).'">Next Week</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '<div class="row">';
        $query = "SELECT e.employee, 
                        e.firstname, 
                        e.surname, 
                        (SELECT Count(*) 
                        FROM   rotationchecks r 
                        WHERE  r.manager = e.employee
                                AND Year(r.time) = ".$year." 
                                AND Week(r.time, 2) = ".$week." 
                                AND r.type = 'Rotation') AS ScoreCount 
                FROM   partners e 
                WHERE  e.canrotationcheck = 1 
                        AND e.active = 1 
                ORDER  BY scorecount DESC ";

        $result = mysqli_query($link, $query);
        if (!$result) {
            printf("Error: %s\n", mysqli_error($link));
            exit();
        }
        
        while($row = mysqli_fetch_array($result)){

            showPartnerAndCount($row['employee'],$row['ScoreCount']);
            
        }

    }

    include ('footer.php');

    ?>
    </div>

</body>

</html>
