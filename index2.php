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

                ?>

                <div class="topBottom col-12">

                    <a href="admin.php" class="btn btn-light btn-block btn-lg" role="button">Admin</a>

                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2">
                    My Phone:
                </div>

                <div class="col-sm-10">
                <select class="form-control" id="phone" name="phone">
                    <?php
                    $phoneQuery = "SELECT * FROM `phones`ORDER BY `id`";
                    $phoneResult = mysqli_query($link, $phoneQuery);
                    if (!$phoneResult) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }

                    while($phoneRow = mysqli_fetch_array($phoneResult)){
                        $selected = '';
                        if($_SESSION['userData']['employee'] == $phoneRow['manager']){
                            $selected =  'selected="selected"';
                        }
                        echo '<option value="'.$phoneRow['id'].'" '.$selected.'>'.$phoneRow['id'].'</option>'; 
                    }

                    ?>
                    </select>

                </div>
            </div>
            <?php
            
        include 'footer.php';

    ?>

    <script>
            /* event listener */
            var phone = document.getElementsByName("phone")[0];
            phone.addEventListener('change', doThing);

            /* function */
            function doThing(){

                location.href = 'processsinglephone.php?id=<?php // need the value from the drop down ?>&manager=<?php echo $_SESSION['userData']['employee'] ?>';
                
            }
        </script>

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
