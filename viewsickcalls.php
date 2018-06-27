<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include 'connection.php';
    include 'functions.php';
    include 'checkmanager.php';
    include 'header.php';
    
    ?>

</head>

<body>
    <div class="bg">

        <?php
        
            include 'navback.php';

        ?>

            <div class="container">
                <?php
                
                echo '<h1>Sick Calls Still Need Putting on PartnerLink</h1>';

                echo '<div class="row">';

                $query = "SELECT * FROM `sickness` WHERE actioned='0' ORDER BY `id` ASC";
                $result = mysqli_query($link, $query);
                if (!$result) {
                    printf("Error: %s\n", mysqli_error($link));
                    exit();
                }
                while($row = mysqli_fetch_array($result)){

                    showSick($row);
                    
                }
            
                echo '</div>';

                echo '<h1>Return To Works Need Doing</h1>';

                echo '<div class="row">';
                    
                $query = "SELECT * FROM `sickness` WHERE actioned='1' ORDER BY `id` ASC";
                $result = mysqli_query($link, $query);
                if (!$result) {
                    printf("Error: %s\n", mysqli_error($link));
                    exit();
                }
                while($row = mysqli_fetch_array($result)){

                   showSick($row);
                    
                }

                echo '</div>';
                ?>

            </div>

    </div>

    <?php
            
            include ('footer.php');

        ?>
        </div>
</body>

</html>
