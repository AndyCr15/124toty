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
                            <option value="nill">Select...</option>
                            <option value="checkouts">Checkouts</option>
                            <option value="counters">Counters</option>
                            <option value="floor">Shop Floor</option>
                        </select>
                    </div>

                    <div id="criteria"></div>

                    <div id="resultText" class="form-group">
                        
                    </div>
                    <div id="discussionText" class="form-group"></div>
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

<script>
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

                document.getElementById("criteria").innerHTML = markup;
                
                if(this.value != 'nill'){
                    markup2 = `
                        <label for="discussion"><h4>Summary of discussion</h4></label>
                        <textarea class="form-control" id="discussion" name="discussion" rows="3"></textarea>
                        `;
                        markup3 = `
                        <label for="result"><h4>Result</h4></label>
                        <div id="criteria"></div>
                        <select class="form-control" id="result" name="result">
                                <option value="pass">Pass</option>
                                <option value="fail">Fail</option>
                        </select>
                        `;
                        }

                        document.getElementById("discussionText").innerHTML = markup2;
                        document.getElementById("resultText").innerHTML = markup3;
            }

            
        </script>

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
