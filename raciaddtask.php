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

            $source = '?source=racioveriew';
            include 'checksource.php';
        ?>


            <div class="container">

                <h1>Add Item To Branch RACI</h1>

                <div id="error">
                    <? echo $error.$successMessage; ?>
                </div>

                <form method="post" action="processaddraci.php<?php echo $source ?>">

                    <div class="form-group">
                        <label for="wheel"><h4>Area of Shop Trade Wheel</h4></label>
                        <select class="form-control" id="wheel" name="wheel">
                            <option value="profit">Trade Profitably</option>
                            <option value="well">Trade Well</option>
                            <option value="properly">Trade Properly</option>
                            <option value="partners">Trade With Great Partners</option>
                        </select>
                    </div>

                    <!--  Text box to enter the actual task into -->
                    <div id="task" class="form-group">
                        <label for="task"><h4>RACI Item To Add</h4></label>
                        <textarea class="form-control" id="task" name="task" rows="1"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="manager"><h4>Manager Accountable</h4></label>
                        <select class="form-control" id="manager" name="manager">
                        
                            
                        <!-- populate the drop down list with Partners allowed to do rotation spot checks -->
                        <?php
                    
                        $query = "SELECT * FROM `partners` WHERE `level` < '10' ORDER BY `firstname`";
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

                    <button type="submit" class="btn btn-primary">Add RACI Task</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>

    </div>
</body>

</html>
