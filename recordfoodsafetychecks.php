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

    if(isset($_GET['id']) && ($_SESSION['userData']['employee'] > 0)){
        $id = $_GET['id'];

        // first get the id of the last check
        $query = "SELECT `id` FROM `foodsafetychecks` WHERE `questionid` = '".$id."' ORDER BY `id` DESC LIMIT 1";
        $result = mysqli_query($link, $query);
        
        if (!$result) {
            printf("Error: %s\n", mysqli_error($link));
            exit();
        }

        $row = mysqli_fetch_array($result);
        $lastCheckID = $row['id'];

        if (foodSafetyStatus($id) == 0) {
            // no results yet or from a previous day
            $newquery = "INSERT INTO `foodsafetychecks` (questionid, status, manager) VALUES ('".$id."','1','".$_SESSION['userData']['employee']."')";
            if ($link->query($newquery) === TRUE) {

                debug_to_console('New Food Safety Check added');
        
            } else {
        
                $error = "Error: " . $sql . "<br>" . $link->error;
        
            }
        
        } else if (foodSafetyStatus($id) == 1) {
            // we have results from today, so update the status of the recorded check

            $sql = "REPLACE INTO `foodsafetychecks` (id, questionid, status, manager)
            VALUES ('".$lastCheckID."','".$id."','2','".$_SESSION['userData']['employee']."')";

            if ($link->query($sql) === TRUE) {
                debug_to_console("Check updated successfully");
                
            } else {

                echo "Error: " . $sql . "<br>" . $link->error;

            }

        } else {
            // we're deleting the record of the check

            $sql = "DELETE FROM `foodsafetychecks` WHERE id = ".$lastCheckID;
            
            if ($link->query($sql) === TRUE) {
                echo "Food Safety Check removed successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $link->error;
            }

        }

            
    }

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
            echo '<div class="row">';
            echo '<h1>Food Safety Checks</h1>';
            echo '</div>';
            echo '<div class="row">';
            echo '<h6>Tap the task to say it\'s been assigned to someone and it turns grey.  Tap again to show completed.</h6>';
            echo '</div>';
            echo '<div class="row">';


            $query = "SELECT * FROM `foodsafetyquestions` ORDER BY `area` ASC";
            $result = mysqli_query($link, $query);
            
            if (!$result) {
                printf("Error: %s\n", mysqli_error($link));
                exit();
            }
            
            $lastArea = "";
            // loop through all tasks
            while($row = mysqli_fetch_array($result)) {
                
                if($lastArea != $row['area']){
                    // we've moved on to a new area, display a heading
                    echo '<h4 class="col-12">'.$row['area'].'</h4>';
                }

                $checkEmployee = whoCompletedFoodSafety($row['id']);
                $status = foodSafetyStatus($row['id']);
                $back = 'white';
                $footer = '';

                // I need to check the status for the last check, only if it's from today
                if($status == 1){
                    $back = 'grey';
                    $footer = checkPartnerFirstName($checkEmployee).' is dealing with this';
                }

                //if it's been completed, colour if the colour of the team that did it
                debug_to_console(whoCompletedFoodSafety($row['id']));
                if($status == 2){
                    $back = strtolower(checkTeam($checkEmployee));
                    $footer = 'Completed by '.checkPartnerFirstName($checkEmployee);
                }

                $display = $row['question'];

                // if the person viewing the list is the one that started the check or user is TM or above (or if it's not started yet)
                if(($status == 0) || ($checkEmployee == $employee) || ($_SESSION['userData']['level'] < 9)){
                    $display = '<a href="recordfoodsafetychecks.php?id='.$row['id'].'">'.$display.'</a>';
                }

                echo '<div class="col-sm-6">';
                echo '<div class="'.$back.'Background click">';
                echo $display;
                echo $footer;
                echo '</div>'; 
                echo '</div>'; 
                
                $lastArea = $row['area'];
            }
            
            echo '</div>';
            
            ?>

        </div>
        <?php
            
        include 'footer.php';

        ?>
    </div>
</body>

</html>
