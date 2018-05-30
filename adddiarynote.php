<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
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

        ?>


            <div class="container">

                <h1>Diary Note</h1>

                <div id="error">
                    <? echo $error.$successMessage; ?>
                </div>

                <form method="post" action="processdiarynote.php">
                    <div class="form-group">
                        <label for="partner"><h4>Partner Spoken With</h4></label>
                        <select class="form-control" id="partner" name="partner">
                        <!-- populate the drop down list with Partners -->
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
                        <label for="discussion"><h4>Summary of discussion</h4></label>
                        <div>
                            <h6>How has the Partner failed to meet the required standard?</h6>
                        </div>
                        <textarea class="form-control" id="discussion" name="discussion" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="agreement"><h4>Agreement</h4></label>
                        <div>
                            <h6>Discuss the agreed standard going forward.</h6>
                        </div>
                        <textarea class="form-control" id="agreement" name="agreement" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="manager"><h4>Partner Completing Diary Note</h4></label>
                        <select class="form-control" id="manager" name="manager">
                        
                            
                            <!-- populate the drop down list with Partners allowed to do rotation spot checks -->
                        <?php
                    
                        $query = "SELECT * FROM `partners` WHERE `canuniformcheck` = '1' ORDER BY `firstname`";
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

                    <button type="submit" class="btn btn-primary">Add Diary Note</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>



    </div>
</body>

</html>
