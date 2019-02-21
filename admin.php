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

                    <h4 class="col-12">Admin</h4>
                    <?php
                    
                    if(isManager()) {
                    
                    ?>
                    <!--
                    <div class="topBottom col-sm-6 col-lg-4">

                        <a href="sendmail.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Email Team</a>

                    </div>
                    -->                      

                    <div class="topBottom col-sm-6 col-lg-4">

                        <a href="removerecordcheck.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Remove a Record</a>

                    </div>

                    <div class="topBottom col-sm-6 col-lg-4">

                        <a href="addquestion.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Add a Question</a>

                    </div>

                    <div class="topBottom col-sm-6 col-lg-4">

                        <a href="viewallquestions.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">View All Questions</a>

                    </div>

                    <div class="topBottom col-sm-6 col-lg-4">

                        <a href="addfoodsafetycheck.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Add a Food Safety Check</a>

                    </div>

                    <div class="topBottom col-sm-6 col-lg-4">

                        <a href="addfloormanagertask.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Add a Floor Manager Task</a>

                    </div>
                    
                    <div class="topBottom col-sm-6 col-lg-4">

                        <a href="addpartner.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Add a Partner</a>

                    </div>

                    <?php

                    }

                    //if it's an admin user, give the option of seeing the log page link
                    if($_SESSION['userData']['admin'] == 1) {
                    
                        ?>

                        <div class="topBottom col-sm-6 col-lg-4">

                            <a href="trackeradmin.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Tracker Admin</a>

                        </div>

                        <div class="topBottom col-sm-6 col-lg-4">

                            <a href="viewlog.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">View Log</a>

                        </div>
                        <?php

                    }

                    ?>

                    <div class="topBottom col-sm-6 col-lg-4">

                        <a href="logout.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Logout</a>

                    </div>
                </div>
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
