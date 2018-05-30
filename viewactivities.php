<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include_once 'connection.php';
    include 'functions.php';
    include 'checkloggedin.php';
    include 'checkmanager.php';
    include 'header.php';
    
    ?>

</head>

<body>
    <div class="bg">

        <?php
        
            include ('navback.php');

        ?>


            <div class="container">

                <h1>Scoring Activities</h1>

                <div class="row">
                    <?php
                    
                        $query = "SELECT * FROM `activities` ORDER BY `id` DESC";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            showActivity($row);

                        }
                    
                    ?>
                </div>
            </div>

            <?php
            
            include ('footer.php');

        ?>
    </div>
</body>

</html>
