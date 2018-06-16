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
                    <h4 class="col-12">Record</h4>

                    <?php
        
            if($_SESSION['userData']['admin'] == 1) {
                ?>

                        <div class="topBottom col-sm-6 col-lg-4">

                            <a href="addactivity.php" class="btn btn-light btn-block btn-lg" role="button">Add Activity</a>

                        </div>

                        <?php
            }
                
            if($_SESSION['userData']['canrotationcheck'] == 1) {
            ?>

            <div class="topBottom col-sm-6 col-lg-4">

                <a href="addrotationcheck.php" class="btn btn-light btn-block btn-lg" role="button">Partner Check</a>

            </div>

            <div class="topBottom col-sm-6 col-lg-4">

                <a href="addobservation.php" class="btn btn-light btn-block btn-lg" role="button">Observation</a>

            </div>

            <div class="topBottom col-sm-6 col-lg-4">

            <a href="questioncategory.php" class="btn btn-light btn-block btn-lg" role="button">Ask Question</a>

            </div>

            <?php
            }
                    
            if($_SESSION['userData']['canbagcheck'] == 1) {
            ?>

            <div class="topBottom col-sm-6 col-lg-4">

                <a href="addbagcheck.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Partner Search</a>

            </div>

            <?php
            }
                    
            if($_SESSION['userData']['canuniformcheck'] == 1) {
            ?>

            <div class="topBottom col-sm-6 col-lg-4">

                <a href="adduniformcheck.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Uniform Check</a>

            </div>

            <?php
            }
                    
            if($_SESSION['userData']['level'] < 10) {
            ?>

                <div class="topBottom col-sm-6 col-lg-4">

                    <a href="adddiarynote.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Diary Note</a>

                </div>

                <?php
            }

            if(canCheck($_SESSION['userData']['employee']) && trackerActive()) {
                ?>
    
                    <div class="topBottom col-sm-6 col-lg-4">
    
                        <a href="yourvoice.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true"><?php echo trackerName() ?></a>
    
                    </div>
    
                    <?php
                }

                    ?>
                </div>

            <?php
                
            include 'footer.php';

        ?>

                <script type="text/javascript">
                    $("form").submit(function(e) {

                        var error = "";

                        if ($("#search").val() == "") {

                            error += "Please enter a name or employee number to search.<br>"

                        }

                        if (error != "") {

                            $("#error").html('<div class="alert alert-danger" role="alert">' + error + '</div>');

                            return false;

                        } else {

                            return true;

                        }
                    })

                </script>

    </div>

</body>

</html>
