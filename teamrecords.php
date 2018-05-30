<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once 'connection.php';
    include 'functions.php';
    include 'header.php';
    include 'checkmanager.php';
    
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
                    
                    
                    if(isset($_GET['team'])){
                        $team = $_GET['team'];
                    }
                    
                    // if level 7 or above, put buttons to choose team, relead the page with relavent team in the $_GET
                    if($_SESSION['userData']['level'] < 8) {
                        ?>
                        <div class="topBottom col-sm-3 click">
                            <div class="blueBackground">
                                    <a href="teamrecords.php?team=Blue" aria-pressed="true">Blue</a>
                            </div>
                        </div>
                        <div class="topBottom col-sm-3 click">
                            <div class="greenBackground">
                                    <a href="teamrecords.php?team=Green" aria-pressed="true">Green</a>
                            </div>
                        </div>
                        <div class="topBottom col-sm-3 click">
                            <div class="redBackground">
                                    <a href="teamrecords.php?team=Red" aria-pressed="true">Red</a>
                            </div>
                        </div>
                        <div class="topBottom col-sm-3 click">
                            <div class="yellowBackground">
                                    <a href="teamrecords.php?team=Yellow" aria-pressed="true">Yellow</a>
                            </div>
                        </div>
                </div>

                    <?php
                    }
                    
                    $daysToCheck = 30;
                    $recordsFilter = 2;

                    if(isset($_GET['days'])){
                        $daysToCheck = $_GET['days'];
                    }

                    if(isset($_GET['records'])){
                        $recordsFilter = $_GET['records'];
                    }

                    $d=strtotime("-".$daysToCheck." Days");
                    $rangeDate = date("Y-m-d h:i:sa", $d);
                    debug_to_console ($rangeDate);


                    echo '<h1>'.$team.' Team Record</h1>';
                    
                    echo '<div class="row">';
                    echo '<div class="col-12">';
                    echo '<h6>Showing Partners with more than '.$recordsFilter.' records in the last '.$daysToCheck.' days</h6>';
                    echo '</div>';

                    

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
                    
                    // loop through Partners of this team
                    while($row = mysqli_fetch_array($result)) {

                        $employee = $row['employee'];
                        $count = 0;

                        // need to add date checking for last 30 days

                        $rotationquery = "SELECT * FROM `rotationchecks` WHERE (`partner`='".$employee."' AND `result`='fail' AND `time`>'".$rangeDate."')";
                        $rotationresult = mysqli_query($link, $rotationquery);
                        $rotationfails = mysqli_num_rows($rotationresult);
                        
                        $observationquery = "SELECT * FROM `observations` WHERE (`partner`='".$employee."' AND `result`='fail' AND `time`>'".$rangeDate."')";
                        $observationresult = mysqli_query($link, $observationquery);
                        $observationfails = mysqli_num_rows($observationresult);

                        $questionquery = "SELECT * FROM `questionchecks` WHERE (`partner`='".$employee."' AND `result`='fail' AND `time`>'".$rangeDate."')";
                        $questionresult = mysqli_query($link, $questionquery);
                        $questionfails = mysqli_num_rows($questionresult);

                        $uniformquery = "SELECT * FROM `uniformchecks` WHERE (`partner`='".$employee."' AND `result`='fail' AND `time`>'".$rangeDate."')";
                        $uniformresult = mysqli_query($link, $uniformquery);
                        $uniformfails = mysqli_num_rows($uniformresult);

                        $bagcheckquery = "SELECT * FROM `bagchecks` WHERE (`partner`='".$employee."' AND `result`='fail' AND `time`>'".$rangeDate."')";
                        $bagcheckresult = mysqli_query($link, $bagcheckquery);
                        $bagcheckfails = mysqli_num_rows($bagcheckresult);

                        $diarynotequery = "SELECT * FROM `diarynotes` WHERE (`partner`='".$employee."' AND `time`>'".$rangeDate."')";
                        $diarynoteresult = mysqli_query($link, $diarynotequery);
                        $diarynotefails = mysqli_num_rows($diarynoteresult);

                        //intentionally haven't included questions
                        $totalrecords = $rotationfails + $observationfails + $uniformfails + $bagcheckfails + $diarynotefails;

                        //used to check the count is working, currently set to Adam Daulby
                        if ($employee == '82903999'){
                            debug_to_console($rotationfails);
                            debug_to_console($observationfails);
                            debug_to_console($questionfails);
                            debug_to_console($uniformfails);
                            debug_to_console($bagcheckfails);
                            debug_to_console($diarynotefails);
                        }

                        // only show if it's higher than the set filter amount
                        if($totalrecords > $recordsFilter) {
                            showEmployee($employee, $totalrecords);
                        }
                        
                    }
                    
                    echo '</div>'; 

                    echo '<div class="row">';

                    if($daysToCheck != 30) {
                        echo '<div class="col-sm-4">';
                        echo '<div class="lightGreenBox click">';
                        echo '<a href="teamrecords.php?team='.$team.'&days=30&records=2">Show 30 Days (3 or more)</a>';
                        echo '</div>';
                        echo '</div>';
                    }

                    if($daysToCheck != 90) {
                        echo '<div class="col-sm-4">';
                        echo '<div class="lightGreenBox click">';
                        echo '<a href="teamrecords.php?team='.$team.'&days=90&records=3">Show 90 Days (5 or more)</a>';
                        echo '</div>';
                        echo '</div>';
                    }

                    if($daysToCheck != 182) {
                        echo '<div class="col-sm-4">';
                        echo '<div class="lightGreenBox click">';
                        echo '<a href="teamrecords.php?team='.$team.'&days=182&records=5">Show 6 Months (7 or more)</a>';
                        echo '</div>';
                        echo '</div>';
                    }

                    if($daysToCheck != 365) {
                        echo '<div class="col-sm-4">';
                        echo '<div class="lightGreenBox click">';
                        echo '<a href="teamrecords.php?team='.$team.'&days=365&records=8">Show 12 Months (10 or more)</a>';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</div>';
                    
                    ?>

                </div>
            </div>
            <?php
                
            include 'footer.php';

        ?>
    </div>
</body>

</html>
