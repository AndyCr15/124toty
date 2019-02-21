<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'header.php';
    include 'functions.php';

//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);
    
    ?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

            $source = '?source=viewobservations';
            include 'checksource.php';
        ?>


            <div class="container">

                <h1>Partner Observation</h1>

                <div id="error">
                    <? echo $error.$successMessage; ?>
                </div>

                <form method="post" action="processobservation.php<?php echo $source ?>">
                    <div class="form-group">
                        <label for="partner"><h4>Partner Being Checked</h4></label>
                        <select class="form-control" id="partner" name="partner">
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
                        <label for="area"><h4>Area of Check</h4></label>
                        <select class="form-control" id="area" name="area">
                            <!--<option value="nill">Select...</option>-->
                            <option value="checkouts">Checkouts</option>
                            <option value="counters">Counters</option>
                            <option value="floor">Shop Floor</option>
                        </select>
                    </div>

                    <div id="criteria"></div>

                    <div class="form-group">
                    <label for="checks"><h4>Check The Following</h4></label><br>
                        <input type="checkbox" id="uniform" name="uniform" value="uniform" class="vertAlign"> Smartly dressed in correct uniform<br>
                        <input type="checkbox" id="ready" name="ready" value="ready" class="vertAlign"> Have their heads up and ready to help<br>
                        <input type="checkbox" id="greeting" name="greeting" value="greeting" class="vertAlign"> Give a warm greeting<br>
                        <input type="checkbox" id="smile" name="smile" value="smile" class="vertAlign"> Smile and make eye contact<br>
                        <input type="checkbox" id="listening" name="listening" value="listening" class="vertAlign"> Showing they actively listening<br>
                        <input type="checkbox" id="personal" name="personal" value="personal" class="vertAlign"> Making interactions personal<br>
                        <input type="checkbox" id="information" name="information" value="information" class="vertAlign"> Providing the right level of information<br>
                        <input type="checkbox" id="knowledge" name="knowledge" value="knowledge" class="vertAlign"> Sharing great product knowledge<br>
                        <input type="checkbox" id="display" name="display" value="display" class="vertAlign"> Having a vibrant and enticing display<br>
                        <input type="checkbox" id="thanks" name="thanks" value="thanks" class="vertAlign"> Giving a genuine thank you<br>
                        <input type="checkbox" id="goodbye" name="goodbye" value="goodbye" class="vertAlign"> Warmly saying goodbye<br>
                    </div>


                    <div id="resultText" class="form-group">
                        <label for="result"><h4>Overall Result</h4></label>
                        <select class="form-control" id="result" name="result">
                                <option value="pass">Pass</option>
                                <option value="fail">Fail</option>
                        </select>    
                    </div>

                    <div id="discussionText" class="form-group">
                        <label for="discussion"><h4>Summary of discussion</h4></label>
                        <textarea class="form-control" id="discussion" name="discussion" rows="3"></textarea>
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

                    <button type="submit" class="btn btn-primary">Add Observation</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>

<!--<script>
// this script is to change to area labled 'criteria' to explanatory text based on the area chosen
    /* event listener */
    document.getElementsByName("area")[0].addEventListener('change', doThing);

    /* function */
    function doThing(){               
        var markup = 'Select an area for the check';
        var markup2 = '';
        var markup3 = '';
        if(this.value == 'checkouts'){
            markup = `
            <h6>Partner is neat and well groomed<br>Area visibly clear of carrier bags<br>Genuine greeting, smile and eye contact<br>Acknowledge waiting customers<br>Offers bag for like (mainline only)<br>Offers to pack<br>Asks for myWaitrose Card<br>Clearly and politely states the cost<br>Positive closing comment with smile<br>Gives green token<br>Waits for customer to leave before serving next</h6>
            `;
        }

        if(this.value == 'counters'){
            markup = `
            <h6>Partner is neat and well groomed<br>Genuine greeting, smile and eye contact<br>Acknowledge waiting customers<br>Offers product knowledge and relevant service information<br>Offers further help<br>Positive closing comment with smile</h6>
            `;
        }

        if(this.value == 'floor'){
            markup = `
            <h6>Partner is neat and well groomed<br>Genuine greeting, smile and eye contact<br>Escot to product (Optional)<br>Hands product to customer (Optional)<br>Asks customer to continue shopping while product is found/checked (As appropriate)<br>Offers further help</h6>
            `;
        }

        // place the explanation into the criteria area
        document.getElementById("criteria").innerHTML = markup;

    }
    </script>-->
        
<!--<script>
// only show the discussion box if they have failed
        document.getElementsByName("result")[0].addEventListener('change', addDiscussion);

            /* function */
            function addDiscussion(){
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
    
</script>-->

<script type="text/javascript">
                    $("form").submit(function(e) {

                        var error = "";

                        if ($("#area").val() == 'nill') {

                            error += "Please select and area for the observation.<br>"

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
