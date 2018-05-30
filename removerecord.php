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
    
    $limit = 10;
    ?>

</head>

<body>

    <div class="bg">

        <?php
        
        include ('navback.php');
        
        ?>

            <div class="container">

                <div class="alert alert-danger" role="alert">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                  <strong>Danger!</strong> Any record you tap will be deleted.
                </div>
                
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
                        <div class="topBottom col-6 click">
                            <div class="blueBackground">
                                    <a href="removerecord.php?team=Blue" aria-pressed="true">Blue</a>
                            </div>
                        </div>
                        <div class="topBottom col-6 click">
                            <div class="greenBackground">
                                    <a href="removerecord.php?team=Green" aria-pressed="true">Green</a>
                            </div>
                        </div>
                        <div class="topBottom col-6 click">
                            <div class="redBackground">
                                    <a href="removerecord.php?team=Red" aria-pressed="true">Red</a>
                            </div>
                        </div>
                        <div class="topBottom col-6 click">
                            <div class="yellowBackground">
                                    <a href="removerecord.php?team=Yellow" aria-pressed="true">Yellow</a>
                            </div>
                        </div>

                        <?php
                    }
                    
                    echo '<h1>Removing Records Made by Team '.$team.'</h1>';
                    
                    echo '<div class="col-12">';
                    echo '<h4>Rotation Checks</h4>';
                    echo '</div>';
                    
                    $query = "SELECT * FROM `rotationchecks` ORDER BY id DESC";
                    $result = mysqli_query($link, $query);
                    
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    $count = 0;
                    while($row = mysqli_fetch_array($result)) {
                        
                        //show rotation check with a remove button
                        if($team == checkTeam($row['manager']) && ($count < $limit)){
                            
                            $count++;
                            
                            echo '<div class="col-12 col-sm-6 col-lg-4">';
                            echo '<div class="'.strtolower(checkTeam($row['partner'])).'Background click">'; ?>
                            <a href="processrotationcheck.php?remove=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure? This will delete this record.')">
                            <?php
                            echo '<strong>'.checkPartnerName($row['partner']).'</strong> : '.strtoupper($row['result']);
                            echo '<br>Checked by: '.checkPartnerName($row['manager']).' - '.showDate($row['time']);
                            echo '</a>'; 
                            echo '</div>'; 
                            echo '</div>'; 
                        }
                    }

                    echo '<div class="col-12">';
                    echo '<h4>Question Checks</h4>';
                    echo '</div>';
                    
                    $query = "SELECT * FROM `questionchecks` ORDER BY id DESC";
                    $result = mysqli_query($link, $query);
                    
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    $count = 0;
                    while($row = mysqli_fetch_array($result)) {
                        
                        //show question check with a remove button
                        if($team == checkTeam($row['manager']) && ($count < $limit)){
                            
                            $count++;
                            
                            echo '<div class="col-12 col-sm-6 col-lg-4">';
                            echo '<div class="'.strtolower(checkTeam($row['partner'])).'Background click">'; ?>
                            <a href="processquestioncheck.php?remove=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure? This will delete this record.')">
                            <?php
                            echo '<strong>'.checkPartnerName($row['partner']).'</strong> : '.strtoupper($row['result']);
                            echo '<br>Checked by: '.checkPartnerName($row['manager']).' - '.showDate($row['time']);
                            echo '</a>'; 
                            echo '</div>'; 
                            echo '</div>'; 
                        }
                    }
                    
                    echo '<div class="col-12">';
                    echo '<h4>Uniform Checks</h4>';
                    echo '</div>';

                    $query = "SELECT * FROM `uniformchecks` ORDER BY id DESC";
                    $result = mysqli_query($link, $query);
                    
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    $count = 0;
                    while($row = mysqli_fetch_array($result)) {

                        //show rotation check with a remove button
                        if($team == checkTeam($row['manager']) && ($count < $limit)){
                            
                            $count++;
                            
                            echo '<div class="col-12 col-sm-6 col-lg-4">';
                            echo '<div class="'.strtolower(checkTeam($row['partner'])).'Background click">'; ?>
    <a href="processuniformcheck.php?remove=<?php 
                            echo $row['id']; ?>" onclick="return confirm('Are you sure? This will delete this record.')">
                            <?php
                            echo '<strong>'.checkPartnerName($row['partner']).'</strong> : '.strtoupper($row['result']);
                            echo '<br>Checked by: '.checkPartnerName($row['manager']).' - '.showDate($row['time']);
                            echo '</a>'; 
                            echo '</div>'; 
                            echo '</div>';
                        }

                    }
                    
                    echo '<div class="col-12">';
                    echo '<h4>Partner Searches</h4>';
                    echo '</div>';

                    $query = "SELECT * FROM `bagchecks` ORDER BY id DESC";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    $count = 0;
                    while($row = mysqli_fetch_array($result)) {

                        //show rotation check with a remove button
                        if($team == checkTeam($row['manager']) && ($count < $limit)){
                            
                            $count++;
                            
                            echo '<div class="col-12 col-sm-6 col-lg-4">';
                            echo '<div class="'.strtolower(checkTeam($row['partner'])).'Background click">'; ?>
                            <a href="processbagcheck.php?remove=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure? This will delete this record.')">
                            <?php
                            echo '<strong>'.checkPartnerName($row['partner']).'</strong> : '.strtoupper($row['result']);
                            echo '<br>Checked by: '.checkPartnerName($row['manager']).' - '.showDate($row['time']);
                            echo '</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                        
                    }
                    
                    echo '<div class="col-12">';
                    echo '<h4>Diary Notes</h4>';
                    echo '</div>';

                    $query = "SELECT * FROM `diarynotes` ORDER BY id DESC";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    $count = 0;
                    while($row = mysqli_fetch_array($result)) {

                        //show rotation check with a remove button
                        if($team == checkTeam($row['manager']) && ($count < $limit)){
                            $count++;
                            echo '<div class="col-12 col-sm-6 col-lg-4">';
                            echo '<div class="'.strtolower(checkTeam($row['partner'])).'Background click">'; ?>
                            <a href="processdiarynote.php?remove=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure? This will delete this record.')">
                            <?php
                            echo '<strong>'.checkPartnerName($row['partner']).'</strong> : '.substr($row['discussion'],0,40).'...';
                            echo '<br>Given by: '.checkPartnerName($row['manager']).' - '.showDate($row['time']);
                            echo '<br></a>';
                            echo '</div>';
                            echo '</div>';
                        }
                        
                    }
                
            ?>

                </div>
            </div>
            <?php
                
            include 'footer.php';

        ?>
    </div>
</body>

</html>
