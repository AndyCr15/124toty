<?php include 'session.php'; 

//set cookie to enable autologin
setcookie("id", $userData['employee'], time() + 60*60*24*365);
?>

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

            include 'navlogout.php';

        ?>

            <div class="container">

            <div class="row indexborder">

                <h4 class="col-12">Notifications</h4>
                <?php

                include 'checknotifications.php';

                if(sizeof($notifications) > 0) {
                    for($x=0; $x<sizeof($notifications); $x++){
                        // loop through all notifications
                        echo '<div class="topBottom click alert alert-'.$notiLevel[$x].' col-12" role="alert">';
                        echo $notifications[$x]; 
                        echo '</div>';
                    }
                } else {
                    //no notifications
                    echo '<div class="topBottom alert alert-success col-12" role="alert">';
                    echo 'No Notifications'; 
                    echo '</div>';
                }
                ?>
            </div>

            <div class="row indexborder">

                <h4 class="col-12">Partner Search</h4>

                <div id="error">
                    <? echo $error.$successMessage; ?>
                </div>

                <form action="viewpartners.php">
                    <div class="form-group row topBottom">
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="search" name="search">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" id="submit" class="btn btn-light">Search</button>
                        </div>


                    </div>
                </form>

            </div>

            <!-- display the current TOTY league table -->
            <div class="row indexborder">

                <h4 class="col-12">Current TOTY Table</h4>

                <div class="col-12 topBottom">

                    <?php include 'leaguetable.php'; ?>

                </div>
            </div>

            

            <?php
                
                if(canCheck($_SESSION['userData']['employee'])) {

                ?>

            <div class="row indexborder">

                <h4 class="col-12">Main Menu</h4>

                <div class="topBottom col-12">

                    <a href="record.php" class="btn btn-light btn-block btn-lg" role="button">Record</a>

                </div>

                <div class="topBottom col-12">

                    <a href="reports.php" class="btn btn-light btn-block btn-lg" role="button">Reports</a>

                </div>

                <?php

                }

                ?>
                
                <div class="topBottom col-12">

                    <a href="duty.php" class="btn btn-light btn-block btn-lg" role="button">Duty</a>

                </div>
                
                <?php

                if($_SESSION['userData']['level'] < 10) {

                ?>

                <div class="topBottom col-12">

                    <a href="admin.php" class="btn btn-light btn-block btn-lg" role="button">Admin</a>

                </div>
                </div>
                <?php

                }
            
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
