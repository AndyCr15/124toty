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

    if(isset($_GET['employeenumber'])){
                        $employee = $_GET['employeenumber'];
                    }
        debug_to_console('Employee :'.$employee);
    
    ?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

        ?>


            <div class="container">

                <h1>Enter Partner Email Address</h1>

                    <h6>Check the Partner doesn't mind us contact them.  Assure them sending an email would not be a common thing, it's just an easier way to contact them.</h6>

                <div id="error">
                    <? echo $error.$successMessage; ?>
                </div>

                <form method="post" action="processcontactchange.php">
                    <div class="form-group">
                        <label for="partner"><h4>Which Partner</h4></label>
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

                            if($employee == $row['employee']) {
                            
                            echo '<option value="'.$row['employee'].'" selected="selected">'.$row['firstname'].' '.$row['surname'].'</option>';

                            } else {
                                
                                
                                echo '<option value="'.$row['employee'].'">'.$row['firstname'].' '.$row['surname'].'</option>';
                            }
                                
                        }
                    
                    
                    ?>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="email"><h4>Email Address</h4></label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <button type="submit" class="btn btn-primary">Add Partner Email Address</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>



    </div>
</body>

</html>
