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
                    <h4 class="col-12">Stats</h4>

                    <?php
                    
                    if($_SESSION['userData']['level'] < 10) {
                        
            ?>

                        <div class="topBottom col-sm-6 col-lg-4">

                            <a href="viewactivities.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Scoring Activities</a>

                        </div>
                        <?php
                    
                    }
            if($_SESSION['userData']['canrotationcheck'] == 1) {
            ?>

                            <div class="topBottom col-sm-6 col-lg-4">

                                <a href="viewrotationchecks.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Partner Check Stats</a>

                            </div>

                            <div class="topBottom col-sm-6 col-lg-4">

                                <a href="viewobservations.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Observation Stats</a>

                            </div>

                            <div class="topBottom col-sm-6 col-lg-4">

                                <a href="viewquestionchecks.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Question Stats</a>

                            </div>

                            <div class="topBottom col-sm-6 col-lg-4">
    
                                <a href="viewfoodsafetychecks.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Food Safety Checks</a>

                            </div>

                            <?php
            }
                    
            if($_SESSION['userData']['canbagcheck'] == 1) {
            ?>

                                <div class="topBottom col-sm-6 col-lg-4">

                                    <a href="viewbagchecks.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Partner Search Stats</a>

                                </div>

                                <?php
            }
                    
            if($_SESSION['userData']['canuniformcheck'] == 1) {
            ?>

            <div class="topBottom col-sm-6 col-lg-4">

                <a href="viewuniformchecks.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Uniform Check Stats</a>

            </div>

            <?php
            }

            if($_SESSION['userData']['level'] < 10) {
                ?>
    
                            <div class="topBottom col-sm-6 col-lg-4">
    
                                <a href="viewdiarynotes.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Diary Notes</a>
    
                            </div>

                            <div class="topBottom col-sm-6 col-lg-4">
    
                                <a href="managerscores.php" class="btn btn-light btn-block btn-lg " role="button" aria-pressed="true">Manager Scores</a>
    
                            </div>
    
                            <?php
                }

                ?>
                </div>

                <div class="row indexborder">
                    <h4 class="col-12">Teams</h4>

                    <?php

                    if(canCheck($_SESSION['userData']['employee'])) {
                        ?>

                        <div class="topBottom col-sm-6 col-lg-4">
            
                            <a href="partneremailsreport.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Team Emails Status</a>
            
                        </div>

                        <div class="topBottom col-sm-6 col-lg-4">
            
                            <a href="signedup.php?team=<?php echo $_SESSION['userData']['team'] ?>&db=hasphoto" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Partner Sign Up</a>

                        </div>

                        <?php
                    }
                    
                    if($_SESSION['userData']['level'] < 10) {
                    ?>

                        <div class="topBottom col-sm-6 col-lg-4">

                            <a href="teamrecords.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Team Records</a>

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
