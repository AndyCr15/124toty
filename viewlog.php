<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    
    include 'session.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    //include_once 'RotationUser.php';
    include 'connection.php';

    include 'checkadmin.php';
    include 'header.php';
    
    ?>

</head>

<body>
    <div class="bg">

        <?php
        
            include 'functions.php';
            include 'navback.php';

        ?>

            <div class="container">
                <?php
                
                echo '<h1>All Logs</h1>';

                echo '<div class="row">';
                    
                    
                        $query = "SELECT * FROM `log` ORDER BY `id` DESC";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            showLog($row);
                            
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
