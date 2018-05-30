<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include 'checkteamleader.php';
    include 'connection.php';
    include 'functions.php';

    include 'checkloggedin.php';
    include 'header.php';
    
    ?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

        ?>

            <div class="container">

                <h4>Handovers</h4>

                <div class="row" id="accordion">
                    <?php
                    
                        $expanded = true;
                        $thisClass = 'collapse show';

                        $query = "SELECT * FROM `handovers` ORDER BY `id` DESC LIMIT 10";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            $header = date("l", strtotime($row['time'])).' - <font size="2">'.showDate($row['time']).' '.showTime($row['time']).'</font>  -  '.checkPartnerName($row['employee']);

                            ?>

                            <div class="panel panel-default col-12">
                                <div class="panel-heading" id="heading<?php echo $row['id'] ?>">
                                    <div class="panel-title handoverHeader">
                                        <a data-toggle="collapse" data-target="#collapse<?php echo $row['id'] ?>" aria-expanded="<?php echo $expanded ?>" href="#collapse<?php echo $row['id'] ?>" role="button" aria-controls="collapse<?php echo $row['id'] ?>"><?php echo $header ?></a>
                                        <?php
                                            if ($row['employee'] == $_SESSION['userData']['employee']) {
                                            
                                            ?>

                                            - [<a href="processhandover.php?remove=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure? This will delete this record.')"><font size="2" color="red">Remove</font></a>]

                                            <?php
                                        
                                            }
                                            ?>
                                    </div>

                                    <div id="collapse<?php echo $row['id'] ?>" class="<?php echo $thisClass ?>" aria-labelledby="heading<?php echo $row['id'] ?>" data-parent="#accordion">
                                        <div class="panel-body">
                                            <div class="handover">
                                            <?php
                                            echo '<pre>'.$row['handover'].'</pre>';
                                            ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                        $expanded = false;
                        $thisClass = 'collapse';
                        }

                        ?>

                        <div class="topBottom col-12">

                            <a href="addhandover.php" class="btn btn-light btn-block btn-lg" role="button">Add Handover</a>

                        </div>

                    

                </div>

            <?php
            
            include ('footer.php');

        ?>
    </div>
</body>

</html>
