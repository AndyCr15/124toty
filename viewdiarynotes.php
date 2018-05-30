<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include_once 'BagCheckUser.php';
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

                <h1>Most Recent Diary Notes</h1>

                <div class="row">
                    <?php
                    
                        $query = "SELECT * FROM `diarynotes` ORDER BY `id` DESC LIMIT 10";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            showDiaryNote($row);

                        }
                    
                    ?>

                        <div class="col-sm-6 col-lg-4">
                            <div class="btn btn-light btn-block btn-lg click">
                                <h5><a href="viewallchecks.php?type=diarynotes">See All</a></h5>
                            </div>
                        </div>

                </div>


                <?php
                    
                    $partnerResults = array();
                    
                        $query = "SELECT * FROM `partners`";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            $thisUser = new BagCheckUser($row);
                            
                            
                            
                            if(($thisUser->pass + $thisUser->fail)>0){
                             
                                array_push($partnerResults, $thisUser);
                            }

                        }
                    
                ?>



                    <h1>Last Months Stats</h1>

                    <div class="row">

                        <?php

                    include 'lastmonth.php';

                    showCheckStats ('diarynotes','Notes Issued', 'Notes Received', $startDate, $endDate);
                        
                    ?>
                    </div>

                    <h1>This Months Stats</h1>

                    <div class="row">

                        <?php

                    include 'thismonth.php';

                    showCheckStats ('diarynotes','Notes Issued', 'Notes Received', $startDate, $endDate);
                        
                    ?>
                    </div>
            </div>

            <?php
            
            include ('footer.php');

        ?>
    </div>
</body>

</html>
