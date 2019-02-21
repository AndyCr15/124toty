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
                    <h4 class="col-12">Branch RACI Menu</h4>

                    <div class="topBottom col-sm-6 col-lg-4">

                        <a href="racioverview.php" class="btn btn-light btn-block btn-lg" role="button">Overview</a>

                    </div>

                    <?php


            if($_SESSION['userData']['level'] < 10) {
            
            ?>

            <div class="topBottom col-sm-6 col-lg-4">

                <a href="raciaddtask.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Add Task</a>

            </div>

            <div class="topBottom col-sm-6 col-lg-4">

                <a href="raciaddpartner.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Add Partner</a>

            </div>

            <?php
            }
                
            include 'footer.php';

        ?>

    </div>

</body>

</html>
