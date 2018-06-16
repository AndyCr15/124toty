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
    include 'checkloggedin.php';
    
    // this can be used for anything we're tracking Partners to complete. Just change the variable below
    $action = trackerName();
    $formURL = trackerLink();

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
                    //if($_SESSION['userData']['level'] < 8) {
                        ?>
                        <div class="topBottom col-6 click">
                            <div class="blueBackground">
                                    <a href="yourvoice.php?team=Blue" aria-pressed="true">Blue</a>
                            </div>
                        </div>
                        <div class="topBottom col-6 click">
                            <div class="greenBackground">
                                    <a href="yourvoice.php?team=Green" aria-pressed="true">Green</a>
                            </div>
                        </div>
                        <div class="topBottom col-6 click">
                            <div class="redBackground">
                                    <a href="yourvoice.php?team=Red" aria-pressed="true">Red</a>
                            </div>
                        </div>
                        <div class="topBottom col-6 click">
                            <div class="yellowBackground">
                                    <a href="yourvoice.php?team=Yellow" aria-pressed="true">Yellow</a>
                            </div>
                        </div>
                        
                        <?php
                    //}
                    
                    echo '<h1>'.$action.' Completed by Team '.$team.'</h1>';
                    
                    if($formURL != ''){
                        echo '<div class="row">';
                        echo '<div class="col-sm-6 offset-sm-3">';
                        echo '<h4 class="click"><a href="'.$formURL.'" target="_blank">Complete '.$action.' Here</a></h4>';
                        echo '</div>';
                    }

                    echo '<div class="col-12">';
                    echo '<h6>Tap a Partner to toggle them.  Coloured background means they\'ve completed '.$action.'.</h6>';
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
                    
                    $count = 0;
                    $total = 0;
                    
                    while($row = mysqli_fetch_array($result)) {
                            
                        // Partner will have a white background until they have completed Your Voice
                        // also set a variable to send to process if they are being added or removed
                        
                        $back = 'white';
                        $completed = 1;
                        $total++;
                        if($row['yourvoice'] == 1) {
                            $back = strtolower(checkTeam($row['employee']));
                            $completed = 0;
                            $count++;
                        }
                        
                        echo '<div class="col-sm-6 col-lg-4">';
                        echo '<div class="'.$back.'Background click">';
                        ?>
                        <a href="toggleyourvoice.php?employee=<?php echo $row['employee']; ?>&completed=<?php echo $completed; ?>">
                            <?php
                        echo checkPartnerName($row['employee']);
                        echo '</a></div>'; 
                        echo '</div>'; 
                        
                    }
                    
                    echo '</div>';

                    // if looking at Brown or Purple then show the overall branch position
                    if($team == 'Brown' || $team == 'Purple'){

                        $count = 0;
                        $total = 0;

                        $query = "SELECT * FROM `partners` WHERE `active`='1'";
                        $result = mysqli_query($link, $query);

                        while($row = mysqli_fetch_array($result)) {
                        
                            $total++;

                            if($row['yourvoice'] == 1) {
                                
                                $count++;

                            }

                        }

                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }



                    }

                    $percentage = ($count / $total) * 100;
                    
                    echo '<div class="row">';
                    echo '<div class="col-12">';
                    echo '<h4>'.$count.' completed of '.$total.' - '.round($percentage).'%</h4>';
                    echo '</div>';
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
