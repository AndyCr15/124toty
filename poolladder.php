<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'functions.php';
    include 'header.php';

    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    
    ?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

        ?>


            <div class="container">

                <h1>Pool Ladder</h1>

                <div id="error">
                    <? echo $error.$successMessage; ?>
                </div>

                <h6>Current Table</h6>

                <?php

                $query = "SELECT * FROM `poolladder` ORDER BY `rating` DESC";
                $result = mysqli_query($link, $query);
                if (!$result) {
                    printf("Error: %s\n", mysqli_error($link));
                    exit();
                }

                $pos = 0;

                while($row = mysqli_fetch_array($result)){

                    $pos += 1;

                    echo '<div class="col-sm-12 col-lg-12">';
                    echo '<div class="'.strtolower(checkTeam($row['employee'])).'Background click">';
                    echo $pos.''.ordinal_suffix($pos).' '.checkPartnerName($row['employee']).' Rating - '.$row['rating'];
                    echo '</div>';
                    echo '</div>';

                }

                ?>

                <h6>Recent Matches</h6>

                 <?php

                $query = "SELECT * FROM `poolmatches` ORDER BY `time` DESC LIMIT 6";
                $result = mysqli_query($link, $query);
                if (!$result) {
                    printf("Error: %s\n", mysqli_error($link));
                    exit();
                }
                while($row = mysqli_fetch_array($result)){

                    echo '<div class="col-sm-12 col-lg-12">';
                    echo '<div class="'.strtolower(checkTeam($row['winner'])).'Background click">';
                    echo (showDate($row['time'])." - ".checkPartnerName($row['winner'])." beat ".checkPartnerName($row['loser']));
                    echo '</div>';
                    echo '</div>';

                }

                ?>

                <!-- to submit games -->
                <form method="post" action="processpoolladder.php<?php echo $source ?>">
                    <div class="form-group">

                        <label for="partner"><h4>Winning Partner </h4></label>
                        <select class="form-control" id="winner" name="winner">
                        <option selected value="tbd">Choose a partner...</option>
                        <!-- populate the drop down list with Partners allowed to do rotation spot checks -->
                        <?php
                    
                        $query = "SELECT * FROM `partners` WHERE `active`='1' ORDER BY `firstname`";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            include 'selectfromallpartners.php';

                        }

                        ?>
                        </select>

                        <label for="partner"><h4>Losing Partner </h4></label>
                        <select class="form-control" id="loser" name="loser">
                        <option selected value="tbd">Choose a partner...</option>
                        <!-- populate the drop down list with Partners allowed to do rotation spot checks -->
                        <?php
                    
                        $query = "SELECT * FROM `partners` WHERE `active`='1' ORDER BY `firstname`";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            include 'selectfromallpartners.php';

                        }
                    
                        ?>
                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">Add Match</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>

<script type="text/javascript">
    $("form").submit(function(e) {

        var error = "";

        if ($("#winner").val() == "tbd") {

            error += "Please select a winner.<br>";

        }

        if ($("#loser").val() == "tbd") {

            error += "Please select a loser.<br>";

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
