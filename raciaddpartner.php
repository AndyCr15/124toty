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

                <form method="post" action="processaddracipartner.php<?php echo $source ?>">

                    <div class="form-group">
                        <label for="taskid"><h4>To Which RACI</h4></label>
                        <select class="form-control" id="taskid" name="taskid">
                            
                            
                        <!-- populate the drop down list with Partners allowed to do rotation spot checks -->
                        <?php
                        
                        $query = "SELECT * FROM `racitask` ORDER BY `task`";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            echo '<option value="'.$row['id'].'">'.$row['task'].'</option>';                       
                            
                        }
                    
                        ?>

                        </select>
                    </div>

                    <!--  Text box to enter the actual task into -->
                    <div id="subtask" class="form-group">
                        <label for="subtask"><h4>Task To Add</h4></label>
                        <textarea class="form-control" id="subtask" name="subtask" rows="1"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="employee"><h4>Partner Responsible</h4></label>
                        <select class="form-control" id="employee" name="employee">
                        
                            
                        <!-- populate the drop down list with Partners allowed to do rotation spot checks -->
                        <?php
                    
                        $query = "SELECT * FROM `partners` WHERE `active` = '1' ORDER BY `firstname`";
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

                    <div class="form-group">
                        <label for="frequency"><h4>Frequency</h4></label>
                        <select class="form-control" id="frequency" name="frequency">
                            <option value="ongoing">Ongoing</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="quarterly">Quarterly</option>
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
