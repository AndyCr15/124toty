<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'functions.php';
    include 'checkmanager.php';
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

                <h1>PLEASE NOTE</h1>

                <div class="greenBackground">
                    <p><font size="5">The list of records you are about to see, have been recorded by you or your team.</font></p>
                    <p><font size="5">When you select one, <i>YOU ARE DELETING IT PERMANENTLY</i>.</font></p>
                </div>

                    <button type="submit" class="btn btn-danger" onclick="location.href = 'removerecord.php'">I understand</button>

                
            </div>

            <?php
                
            include 'footer.php';

        ?>



    </div>
</body>

</html>
