<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
    
    
    include_once 'connection.php';
    include 'functions.php';
    include 'header.php';
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    ?>

</head>

<body>
    <div class="bg">

        <?php
        
            include ('navback.php');

        ?>

            <div class="container">

                <div class="row">
                    <?php

                    $query = "SELECT * FROM `partners` WHERE (`active`='1' AND (`team`!='white' AND `team`!='purple' AND `team`!='brown')) ORDER BY `firstname`";
                    $result = mysqli_query($link, $query);
                    $num_rows = mysqli_num_rows($result);
                    
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    ?>
                    <form class="form-inline" method="post" action="processgroupemail.php">

                    <?php
                    while($row = mysqli_fetch_array($result)) {
                        $team=strtolower($row['team']);

                        if($row['email'] == "") {
                            $team = 'white';
                        }

                        ?>
                        <div class="col-sm-30 <?php echo $team.'Background'; ?>">
                            <input class="form-group-input" type="checkbox" value="<?php echo $row['employee']; ?>" name="<?php echo $row['employee']; ?>" id="<?php echo $row['employee']; ?>" <?php if($team == 'white') { echo 'disabled'; } ?>>
                            <label class="form-checkbox form-label-inlin" for="<?php echo $row['employee']; ?>">
                            <?php echo checkPartnerName($row['employee']); ?>
                            </label>
                        </div>
                        <?php
                    }

                    ?>
                </div>

                <div class="row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary">Send Lieu Time Warning Email</button>
                        </div>
                    </div>

                </form>
            </div>

            <?php
            
            include ('footer.php');

        ?>
    </div>
</body>

</html>
