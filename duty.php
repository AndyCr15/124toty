<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'functions.php';
    include 'header.php';

//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);


    include 'checkloggedin.php';
    
    ?>


</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

        ?>

            <div class="container">

                <div class="row indexborder">
                    <h4 class="col-12">Duty Menu</h4>

                    <?php
                
            if($_SESSION['userData']['canrotationcheck'] == 1) {
            ?>

            <div class="topBottom col-sm-6 col-lg-4">

                <a href="viewhandovers.php" class="btn btn-light btn-block btn-lg" role="button">Handovers</a>

            </div>

            <div class="topBottom col-sm-6 col-lg-4">

                <a href="bridgecover.php" class="btn btn-light btn-block btn-lg" role="button">Bridge Cover</a>

            </div>

            <?php
            }

            if($_SESSION['userData']['level'] < 10) {
            
            ?>
            
            <div class="topBottom col-sm-6 col-lg-4">

                <a href="viewdeadlines.php" class="btn btn-light btn-block btn-lg" role="button">Deadlines</a>

            </div>

            <?php
            }
            ?>

            <div class="topBottom col-sm-6 col-lg-4">

                <a href="viewstockwatch.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Stock Watch</a>

            </div>

            <div class="topBottom col-sm-6 col-lg-4">

                <a href="recordfoodsafetychecks.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Food Safety Checks</a>

            </div>

            <?php
                
            include 'footer.php';

        ?>

    </div>

</body>

</html>
