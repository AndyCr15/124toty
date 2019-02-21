<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'functions.php';
    include 'checkloggedin.php';
    include 'header.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    ?>

</head>

<body>
    <div class="bg">

        <?php

        include 'navback.php';
        
        ?>


        <div class="container">

            <h1>Phones</h1>

            <form method="post" action="processphones.php">
                
                <?php

                // go through phones from the database and display who has them
                $phoneQuery = "SELECT * FROM `phones` ORDER BY `id`";
                $phoneResult = mysqli_query($link, $phoneQuery);
                if (!$phoneResult) {
                    printf("Error: %s\n", mysqli_error($link));
                    exit();
                }

                while($phoneRow = mysqli_fetch_array($phoneResult)){
                    
                    ?>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?php echo $phoneRow['id']; ?></label>
                        <div class="col-sm-6">
                            <select class="form-control" id="<?php echo $phoneRow['id']; ?>" name="<?php echo $phoneRow['id']; ?>">
                
                            <!-- populate the drop down list with Partners allowed to do rotation spot checks -->
                            <?php
                            echo '<option value="0">Not in use</option>';
                            $partnerQuery = "SELECT * FROM `partners` WHERE `canrotationcheck` = '1' ORDER BY `firstname`";
                            $partnerResult = mysqli_query($link, $partnerQuery);
                            if (!$partnerResult) {
                                printf("Error: %s\n", mysqli_error($link));
                                exit();
                            }
    
                            // get the manager currently with this phone in the database
                            $idQuery = "SELECT * FROM `phones` WHERE `id` = '".$phoneRow['id']."'";
                            $idResult = mysqli_query($link, $idQuery);
                            if (!$idResult) {
                                printf("Error: %s\n", mysqli_error($link));
                                exit();
                            }
                            $idRow = mysqli_fetch_array($idResult);
                            $idManager = $idRow['manager'];
    
                            while($partnerRow = mysqli_fetch_array($partnerResult)){
                                $selected = '';
                                if($idManager == $partnerRow['employee']){
                                    $selected =  'selected="selected"';
                                }
                                echo '<option value="'.$partnerRow['employee'].'" '.$selected.'>'.$partnerRow['firstname'].' '.$partnerRow['surname'].'</option>'; 

                            }

                            ?>

                            </select>
                        </div>
                    </div>

                    <?php
                    }
                    ?>

                    <div class="row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary">Save Phones</button>
                        </div>
                    </div>

                </form>
        </div>

        <?php
            
        include 'footer.php';

        ?>

    </div>
</body>

</html>
