<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    
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

                <h4>Deadlines</h4>

                <div class="row" id="accordion">
                    <?php
                    
                    $expanded = true;
                    $thisClass = 'collapse show';

                    // show items in soonest first order
                    $query = "SELECT * FROM `deadlines` ORDER BY `date` ASC LIMIT 10";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    while($row = mysqli_fetch_array($result)){
                    
                        $header = showDate($row['date']).'  -  '.$row['task'];
                        
                        ?>

                        <div class="panel panel-default col-12">
                            <div class="panel-heading" id="heading<?php echo $row['id'] ?>">
                                <div class="panel-title handoverHeader">
                                    <a data-toggle="collapse" data-target="#collapse<?php echo $row['id'] ?>" aria-expanded="<?php echo $expanded ?>" href="#collapse<?php echo $row['id'] ?>" role="button" aria-controls="collapse<?php echo $row['id'] ?>"><?php echo $header ?></a>
                                </div>

                                <div id="collapse<?php echo $row['id'] ?>" class="<?php echo $thisClass ?>" aria-labelledby="heading<?php echo $row['id'] ?>" data-parent="#accordion">
                                    <div class="panel-body">
                                        <div class="handover">
                                            Comments: <?php echo $row['comments']; ?><br>
                                            <font size="1">Added by: '<?php echo checkPartnerFirstName($row['employee']); ?></font>
                                            - [<a href="processdeadline.php?remove=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure? This will delete this record.')"><font size="2" color="red">Remove</font></a>]
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

                    <a href="adddeadline.php" class="btn btn-light btn-block btn-lg" role="button">Add Deadline</a>

                </div>

            </div>

            <?php
            
            include ('footer.php');

        ?>
    </div>

</body>

</html>
