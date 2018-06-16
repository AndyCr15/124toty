<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include 'connection.php';
    include 'functions.php';

    include 'checkmanager.php';
    include 'header.php';
    
    ?>

</head>

<body>
    <div class="bg">

        <?php
        
            include 'navback.php';

        ?>

            <div class="container">

                <h1>All Questions</h1>

                <div class="row">
                    <?php
                    
                        $count = 0;

                        $query = "SELECT * FROM `categories` ORDER BY `category`";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            // loop through each category showing questions and answers
                            echo '<div class="col-12">';
                            echo '<h4 class="col-12">'.$row['category'].'</h4>';
                            $questionQuery = "SELECT * FROM `questions` WHERE `category`='".$row['category']."'";
                            $questionResult = mysqli_query($link, $questionQuery);
                            if (!$questionResult) {
                                printf("Error: %s\n", mysqli_error($link));
                                exit();
                            }
                            
                            while($questionRow = mysqli_fetch_array($questionResult)){

                                echo '<div class="col-12 alert alert-warning" role="alert">Q: '.$questionRow['question'].'</div>';
                                echo '<div class="col-12 alert alert-success" role="alert">A: '.$questionRow['answer'].'</div>';
                                $successRate = questionCorrect($questionRow['id']);
                                if($successRate == 'na'){
                                    echo '<h6>Not yet been asked</h6>';
                                } else {
                                    echo '<h6>'.$successRate.'% Success Rate</h6>';
                                }
                                $count ++;

                            }

                            echo '</div>';

                        }
                    

                        echo '<div class="col-12">';
                        echo '<h4 class="col-12">'.$count.' total questions.</h4>';
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
