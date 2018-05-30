<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include_once 'UniformCheckUser.php';
    include 'connection.php';
    include 'functions.php';

    include 'checkloggedin.php';
    include 'header.php';
    
    ?>

</head>

<body>
    <div class="bg">

        <?php
        
            
            include 'navback.php';

        ?>


            <div class="container">

                <h1>Last 10 Uniform Checks</h1>

                <div class="row">
                    <?php
                    
                        $query = "SELECT * FROM `uniformchecks` ORDER BY `id` DESC LIMIT 10";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            showBagCheck($row);

                        }
                    
                    ?>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="btn btn-light btn-block btn-lg click">
                                <h5><a href="viewallchecks.php?type=uniformchecks">See All</a></h5>
                            </div>
                        </div>

                </div>


                <?php
                    
                    $partnerResults = array();
                    
                        $query = "SELECT * FROM `partners` WHERE `active`='1'";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            $thisUser = new UniformCheckUser($row);
                            
                            
                            
                            if(($thisUser->pass + $thisUser->fail)>0){
                             
                                array_push($partnerResults, $thisUser);
                            }

                        }
                    
                ?>

                    <h1>Lowest Percentages</h1>

                    <div class="row">

                        <?php
                
                    // sort with lowest % first
                    usort($partnerResults, 'my_comparison_low');
                    
                    for($x=0; $x<6 && $x < (sizeof($partnerResults)); $x++){
                        
                        echo '<div class="col-12 col-sm-6 col-lg-4">';
                        echo '<div class="'.strtolower(checkTeam($partnerResults[$x]->employee)).'Background">';
                        echo '<a href="partnerdetails.php?employeenumber='.$partnerResults[$x]->employee.'">';
                        echo $partnerResults[$x]->firstname.' '.$partnerResults[$x]->surname.' ('.$partnerResults[$x]->employee.') - <strong>'.$partnerResults[$x]->percentage.'%</strong>';
                        echo '</a>';
                        echo '</div>';
                        echo '</div>';
                        
                    }
                    
                    
                    ?>
                    </div>

                    <h1>Highest Percentages</h1>

                    <div class="row">

                        <?php
                
                    // sort with lowest % first
                    usort($partnerResults, 'my_comparison_high');
                    
                    for($x=0; $x<6 && $x < (sizeof($partnerResults)); $x++){
                        
                        echo '<div class="col-12 col-sm-6 col-lg-4">';
                        echo '<div class="'.strtolower(checkTeam($partnerResults[$x]->employee)).'Background">';
                        echo '<a href="partnerdetails.php?employeenumber='.$partnerResults[$x]->employee.'">';
                        echo $partnerResults[$x]->firstname.' '.$partnerResults[$x]->surname.' ('.$partnerResults[$x]->employee.') - <strong>'.$partnerResults[$x]->percentage.'%</strong> ('.$partnerResults[$x]->pass.')';
                        echo '</a>';
                        echo '</div>';
                        echo '</div>';
                        
                    }
                    
                    
                    ?>
                    </div>

                    <h6>As of 13/5 Uniform Checks only count if they are Fails.</h6>

                    <h1>Last Weeks Stats</h1>

                    <div class="row">

                        <?php

                    include 'lastweek.php';

                    showCheckStats ('uniformchecks','Checks Done', 'Checks Failed', $startDate, $endDate);
                        
                    ?>
                    </div>

                    <h1>This Weeks Stats</h1>

                    <div class="row">

                        <?php

                    include 'thisweek.php';

                    showCheckStats ('uniformchecks','Checks Done', 'Checks Failed', $startDate, $endDate);
                        
                    ?>
                    </div>
            </div>

            <?php
            
            include ('footer.php');

        ?>
    </div>
</body>

</html>
