<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'functions.php';
    include 'checkloggedin.php';
    include 'header.php';

//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);

    
    ?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

            $source = '?source=viewbagchecks';
            include 'checksource.php';
        ?>


            <div class="container">

                <h1>Bag Check</h1>

                <div id="error">
                    <? echo $error.$successMessage; ?>
                </div>

                <form method="post" action="processbagcheck.php<?php echo $source ?>">
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

                    <button type="submit" class="btn btn-primary">Add Bag Check</button>

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

    </div>
</body>

</html>
