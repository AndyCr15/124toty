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
    
    $pointcheckLimit = 10;
    $paperworkLimit = 5;
    $reducingLimit = 10;
    $rotationLimit = 5;

    ?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

            $source = '?source=viewrotationchecks';
            include 'checksource.php';
        ?>


            <div class="container">

                <h1>Partner Check</h1>

                <h6>You are limited to how many checks of a certain type you can do.  The limits are -<br><br>
                3 Point Checks - <?php echo $pointcheckLimit ?><br>
                Paperwork - <?php echo $paperworkLimit ?><br>
                Reducing - <?php echo $reducingLimit ?><br>
                Rotation - <?php echo $rotationLimit ?><br>
                <br>
                Points are awarded on your total checks.</h6>

                <div id="error">
                    <? echo $error.$successMessage; ?>
                </div>

                <form method="post" action="processrotationcheck.php<?php echo $source ?>">
                    <div class="form-group">

                        <label for="partner"><h4>Check Type</h4></label>
                        <select class="form-control" id="type" name="type">
                        <option selected value="tbd">Choose a type...</option>
                        <!-- populate the drop down list types -->
                        <?php
                    
                        $typequery = "SELECT * FROM `checktype` ORDER BY `type`";
                        $typeresult = mysqli_query($link, $typequery);
                        if (!$typeresult) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($typerow = mysqli_fetch_array($typeresult)){

                            $count = countCheckType($typerow['type'], $_SESSION['userData']['employee']);

                            debug_to_console($count);

                            // start with blank, but if count exceeds the limit the change the string so it disables the option
                            $disabled = "";
                            // get the limit for this type of check
                            switch($typerow['type']) {
                                case 'Rotation':
                                    $thisLimit = $rotationLimit;
                                    break;
                                case 'Reducing':
                                    $thisLimit = $reducingLimit;
                                    break;
                                case '3 Point Check':
                                    $thisLimit = $pointcheckLimit;
                                    break;
                                case 'Paperwork':
                                    $thisLimit = $paperworkLimit;
                                    break;
                            }
                            if($count >= $thisLimit){
                                $disabled = ' disabled';
                            }

                            echo '<option value="'.$typerow['type'].'"'.$disabled.'>'.$typerow['type'].'</option>';

                        }

                        ?>

                        </select>
                        

                        <label for="partner"><h4>Partner Being Checked</h4></label>
                        <select class="form-control" id="partner" name="partner">
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
                    <div class="form-group">
                        <label for="area"><h4>Area they are working</h4></label>
                        <select class="form-control" id="area" name="area">
                        <!-- populate the drop down list with areas from table -->
                        <?php
                    
                    $query = "SELECT * FROM `areas` ORDER BY `name`";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

                        }
                    
                    
                    ?>
                        </select>


                    </div>
                    <div class="form-group">
                        <label for="result"><h4>Result</h4></label>
                        <select class="form-control" id="result" name="result">
                                <option value="pass">Pass</option>
                                <option value="fail">Fail</option>
                        </select>
                    </div>
                    <div id="discussionText" class="form-group">
                        <!-- <label for="discussion"><h4>Summary of discussion</h4></label>
                        <textarea class="form-control" id="discussion" name="discussion" rows="3"></textarea> -->
                    </div>
                    <div class="form-group">
                        <label for="manager"><h4>Partner Completing Check</h4></label>
                        <select class="form-control" id="manager" name="manager">
                        

                        <!-- populate the drop down list with Partners allowed to do rotation spot checks -->
                        <?php
                    
                        $query = "SELECT * FROM `partners` WHERE `canrotationcheck` = '1' ORDER BY `firstname`";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            // if the option is the logged in user, preselect it
                            if($row['employee'] == $_SESSION['userData']['employee']){
                                
                                echo '<option value="'.$row['employee'].'" selected="selected">'.$row['firstname'].' '.$row['surname'].'</option>';
                                
                            } else {
                            
                            echo '<option value="'.$row['employee'].'">'.$row['firstname'].' '.$row['surname'].'</option>';
                                
                            }
                        }
                    
                        ?>
                        </select>


                    </div>

                    <button type="submit" class="btn btn-primary">Add Partner Check</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>

        <script>
            /* event listener */
            document.getElementsByName("result")[0].addEventListener('change', doThing);

            /* function */
            function doThing(){                
                var markup = '';
                if(this.value == 'pass'){
                    markup = ``;
                } else {
                    markup = `
                    <label for="discussion"><h4>Summary of discussion</h4></label>
                    <textarea class="form-control" id="discussion" name="discussion" rows="3"></textarea>
                    `;
                }

                document.getElementById("discussionText").innerHTML = markup;
                
            }
        </script>

<script type="text/javascript">
    $("form").submit(function(e) {

        var error = "";

        if ($("#type").val() == "tbd") {

            error += "Please select a type of check.<br>";

        }

        if ($("#partner").val() == "tbd") {

            error += "Please select a Partner.<br>";

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
