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
    
    ?>

</head>

<body>

    <div class="bg">

        <?php
        
        include ('navback.php');
        
        ?>

            <div class="container">
                
                <?php
                
                $employee = $_SESSION['userData']['employee'];
                $team = checkTeam($employee);
                
                
                if(isset($_GET['team'])){
                    $team = $_GET['team'];
                }

                if(isset($_GET['db'])){
                    $db = $_GET['db'];
                }

                switch($db) {
            
                    case 'hasphoto':
                        $title = 'with a Photo on the Wall';
                        break;
                    case 'hasfacebook':
                        $title = 'Signed Up To Facebook';
                        break;
                    case 'hasgoogle':
                        $title = 'Signed Up To Google';
                        break;
                }

                // if level 7 or above, put buttons to choose team, relead the page with relavent team in the $_GET
                //if($_SESSION['userData']['level'] < 8) {
                ?>
                <div class="row">
                    <div class="topBottom col-sm-3 click">
                        <div class="blueBackground">
                                <a href="signedup.php?team=Blue&db=<?php echo $db; ?>" aria-pressed="true">Blue</a>
                        </div>
                    </div>
                    <div class="topBottom col-sm-3 click">
                        <div class="greenBackground">
                                <a href="signedup.php?team=Green&db=<?php echo $db; ?>" aria-pressed="true">Green</a>
                        </div>
                    </div>
                    <div class="topBottom col-sm-3 click">
                        <div class="redBackground">
                                <a href="signedup.php?team=Red&db=<?php echo $db; ?>" aria-pressed="true">Red</a>
                        </div>
                    </div>
                    <div class="topBottom col-sm-3 click">
                        <div class="yellowBackground">
                                <a href="signedup.php?team=Yellow&db=<?php echo $db; ?>" aria-pressed="true">Yellow</a>
                        </div>
                    </div>
                </div>
                
                <?php

                    echo '<div class="row">';

                    if($db != 'hasphoto') {
                        echo '<div class="col-sm-6">';
                        echo '<div class="lightGreenBox click">';
                        echo '<a href="signedup.php?team='.$team.'&db=hasphoto">Check Wall Photos</a>';
                        echo '</div>';
                        echo '</div>';
                    }

                    if($db != 'hasfacebook') {
                        echo '<div class="col-sm-6">';
                        echo '<div class="lightGreenBox click">';
                        echo '<a href="signedup.php?team='.$team.'&db=hasfacebook">Check Facebook</a>';
                        echo '</div>';
                        echo '</div>';
                    }

                    if($db != 'hasgoogle') {
                        echo '<div class="col-sm-6">';
                        echo '<div class="lightGreenBox click">';
                        echo '<a href="signedup.php?team='.$team.'&db=hasgoogle">Check Google</a>';
                        echo '</div>';
                        echo '</div>';
                    }

                echo '</div>';

                //}
                
                echo '<h1>'.$team.' Team Members '.$title.'</h1>';
                
                echo '<div class="row">';
                echo '<div class="col-12">';
                echo '<h6>Tap a Partner to toggle them.  Coloured background means they\'re done</h6>';
                echo '</div>';
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

                echo '<div class="row">';

                    while($row = mysqli_fetch_array($result)) {
                            
                        // Partner will have a white background until they have completed Your Voice
                        // also set a variable to send to process if they are being added or removed
                        
                        $back = 'white';
                        $completed = 1;
                        $total++;
                        if($row[$db] == 1) {
                            $back = strtolower(checkTeam($row['employee']));
                            $completed = 0;
                            $count++;
                        }
                        
                        echo '<div class="col-sm-6 col-lg-4">';
                        echo '<div class="'.$back.'Background click">';
                        ?>
                        <a href="togglesignedup.php?employee=<?php echo $row['employee']; ?>&completed=<?php echo $completed; ?>&db=<?php echo $db; ?>&source=signedup">
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

                        if($row[$db] == 1) {
                            
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
            <?php
                
            include 'footer.php';

        ?>
    </div>
</body>

</html>
