<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    //include_once 'RotationUser.php';
    include 'connection.php';

    include 'checkloggedin.php';
    include 'header.php';
    
    if(isset($_GET['type'])){
        $db = $_GET['type'];
        // switch statement to set the title and database name
        switch($db) {
                
            case 'rotationchecks':
                $title = 'Partner Checks';
                break;
            case 'questionchecks':
                $title = 'Question Checks';
                break;
            case 'bagchecks':
                $title = 'Partner Searches';
                break;
            case 'uniformchecks':
                $title = 'Uniform Checks';
                break;
            case 'diarynotes':
                $title = 'Diary Notes';
                break;
            case 'foodsafetychecks':
                $title = 'Food Safety Checks';
                break;
            case 'observations':
                $title = 'Observations';
                break;
                
        } 
        
                }
    
    ?>

</head>

<body>
    <div class="bg">

        <?php
        
            include 'functions.php';
            include 'navback.php';

        ?>

            <div class="container">
                <?php
                
                echo '<h1>All '.$title.'</h1>';

                echo '<div class="row">';
                    
                    
                        $query = "SELECT * FROM `".$db."` ORDER BY `id` DESC";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            switch($db) {
                
                                case 'rotationchecks':
                                    showRotationCheck($row);
                                    break;
                                case 'questionchecks':
                                    showRotationCheck($row);
                                    break;
                                case 'bagchecks':
                                    showBagCheck($row);
                                    break;
                                case 'uniformchecks':
                                    showBagCheck($row);
                                    break;
                                case 'diarynotes':
                                    showDiaryNote($row);
                                    break;
                                case 'foodsafetychecks':
                                    showFoodSafetyCheck($row);
                                    break;
                                case 'observations':
                                    showBagCheck($row);
                                    break;

                            } 
                        }
                    
                    ?>

            </div>

    </div>

    <?php
            
            include ('footer.php');

        ?>
        </div>
</body>

</html>
