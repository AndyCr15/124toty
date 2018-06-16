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
    include 'header.php';
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
                <h4 class="col-12">Reference</h4>

                <div class="topBottom col-sm-6 col-lg-4">

                    <a href="http://jlp-trainingapp1.johnlewis.co.uk/jpdw/" target="_blank" class="btn btn-light btn-block btn-lg" role="button">Partner Dev Website</a>

                </div>

                <div class="topBottom col-sm-6 col-lg-4">

                    <a href="https://nextcontrols.com/WebGUIv2/externallogin.aspx" target="_blank" class="btn btn-light btn-block btn-lg" role="button">Next</a>

                </div>

                <div class="topBottom col-sm-6 col-lg-4">

                    <a href="https://sites.google.com/a/waitrose.co.uk/wr-business-protection-site/tools/pims" target="_blank" class="btn btn-light btn-block btn-lg" role="button">PIMS</a>

                </div>

                <?php
            
                if(isManager()) {
                ?>

                <div class="topBottom col-sm-6 col-lg-4">

                    <a href="https://sites.google.com/waitrose.co.uk/shoptradereporting/home?authuser=1" target="_blank" class="btn btn-light btn-block btn-lg" role="button">Shop Trade Reporting</a>

                </div>

                <?php

                }
                    
                include 'footer.php';

                ?>
            </div>
        </div>
    </div>

</body>

</html>
