<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    
    include_once 'connection.php';
    include 'functions.php';
    include 'header.php';
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    ?>

</head>

<body>

    <div class="bg">

        <?php
        
        include ('navback.php');
        
        ?>

        <div class="container">
            
            <div class="row">
                
                <?php
                $employee = $_SESSION['userData']['employee'];
                $team = checkTeam($employee);

                if(isset($_GET["team"])){
                    $team = mysqli_real_escape_string($link, $_GET["team"]);
                }

                ?>
                    <div class="topBottom col-6 click">
                        <div class="blueBackground">
                                <a href="partneremailsreport.php?team=Blue" aria-pressed="true">Blue</a>
                        </div>
                    </div>
                    <div class="topBottom col-6 click">
                        <div class="greenBackground">
                                <a href="partneremailsreport.php?team=Green" aria-pressed="true">Green</a>
                        </div>
                    </div>
                    <div class="topBottom col-6 click">
                        <div class="redBackground">
                                <a href="partneremailsreport.php?team=Red" aria-pressed="true">Red</a>
                        </div>
                    </div>
                    <div class="topBottom col-6 click">
                        <div class="yellowBackground">
                                <a href="partneremailsreport.php?team=Yellow" aria-pressed="true">Yellow</a>
                        </div>
                    </div>
                    
                    <?php
                
                $query = "SELECT * FROM `partners` WHERE (`active`='1' AND `team`='".$team."') ORDER BY `firstname` ASC";
                // if BM or DM come to this page, all Partners are listed
                if($team=='Brown' || $team=='Purple'){
                    $query = "SELECT * FROM `partners` WHERE `active`='1' ORDER BY `firstname` ASC";
                }
                $result = mysqli_query($link, $query);
                
                if (!$result) {
                    printf("Error: %s\n", mysqli_error($link));
                    exit();
                }
                
                $count = 0;
                $total = 0;

                while($row = mysqli_fetch_array($result)) {

                    $back = 'white';
                    $total++;

                    if($row['email'] != '') {
                        $back = strtolower($row['team']);
                        $count++;
                    }

                    echo '<div class="col-sm-6 col-lg-4">';
                    echo '<div class="'.$back.'Background click">';
                    echo '<a href="partnerdetails.php?employeenumber='.$row['employee'].'">';
                    echo $row['firstname'].' '.$row['surname'].' ('.$row['employee'].')';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';

                }
                echo '</div>';
                $percentage = ($count / $total) * 100;
                
                echo '<div class="row">';
                echo '<div class="col-12">';
                echo '<h4>'.$count.' Partners have emails of '.$total.' - '.round($percentage).'%</h4>';
                echo '</div>';
                echo '</div>';

                ?>
            </div>
        </div>

        <?php
        
        include ('footer.php');

        ?>
    </div>


</body>

</html>
