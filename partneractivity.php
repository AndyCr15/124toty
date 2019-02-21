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

        $month = date('n');
        $year = date('Y');
        
        if(isset($_GET['month'])){
            $month = $_GET['month'];
        }
        if(isset($_GET['year'])){
            $year = $_GET['year'];
        }

        ?>

        <div class="container">

            <?php

            showPartnerActivity($month, $year);

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

    function showPartnerActivity($month, $year){
        
        include 'connection.php';

        $teams = array("Blue", "Green", "Red", "Yellow");

        echo '<h1>Partner Activity For '.monthText($month).'</h1>';

        echo '<h6>This report shows how many checks, questions, observations each Partner has undertaken, listed in reverse order.</h6>';

        // get array with employee number and activity
        $countquery = "SELECT employee,COUNT(*) as count FROM partner_team_month_score
            WHERE MONTH = ".$month." AND YEAR = 2018
            GROUP BY employee ORDER BY count ASC";

        $countresult = mysqli_query($link, $countquery);
        while($data = mysqli_fetch_assoc($countresult)){
            $activityCount[$data['employee']] = $data['count'];
        }

        foreach ($teams as $team) {
        
            echo '<h4>'.$team.'</h4>';
            echo '<div class="row">';
            $query = "SELECT
                    e.employee,
                    e.firstname,
                    e.surname,
                    (SELECT
                    COUNT(*)
                    FROM partner_team_month_score s
                    WHERE s.employee = e.employee
                    AND s.year = ".$year."
                    AND s.month = ".$month.")
                    AS ScoreCount
                FROM partners e
                WHERE e.active = 1
                AND e.team = '".$team."'
                AND e.level = 10
                ORDER BY ScoreCount ASC";

            $result = mysqli_query($link, $query);
            if (!$result) {
                printf("Error: %s\n", mysqli_error($link));
                exit();
            }
            
            while($row = mysqli_fetch_array($result)){

                showPartnerAndCount($row['employee'],$row['ScoreCount']);
                
            }
            
            echo '</div>';
        }
        echo '<br>';

        echo '<h6>Change Month</h6>';
        // links for other months here
        // ** TO DO ** I need a way of it passing one year to the next
        $first = checkFirstMonth();
        $current = date("n");
        echo '<div class="row">';

        for ($x = $current; $x >= $first; $x--) {
            // only show if it's not the month current being shown
            if($x != $month){
                echo '<div class="col-sm-4">';
                echo '<div class="lightGreenBox click">';
                echo '<a href="partneractivity.php?month='.$x.'">'.monthText($x).'</a>';
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
