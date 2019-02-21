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

    include 'header.php';
    
    ?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

        ?>

            <div class="container">

                <h4>Car Park Exceptions</h4>

                <div id="error">
                </div>

                <div class="topBottom col-12">

                    <form name=my_form method="post" action="addcarpark.php">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="firstname">Car Reg</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="carreg" id="carreg">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <input type="hidden" name="employee" value="<?php echo $_SESSION['userData']['employee'] ?>">
                                <button type="submit" class="btn btn-primary">Check Registration</button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="row" id="accordion">
                    <?php
                    
                        $expanded = true;
                        $thisClass = 'collapse show';

                        $query = "SELECT * FROM `carpark` ORDER BY `id` DESC LIMIT 30";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            $thisDate = niceDateTime($row['time']);

                            $header = $row['carreg'].' - '.date("l", strtotime($row['time'])).' - <font size="2">'.$thisDate.'</font>  -  '.checkPartnerName($row['employee']).' (PCN '.$row['pcn'].')';

                            ?>

                            <div class="panel panel-default col-12">
                                <div class="panel-heading" id="heading<?php echo $row['id'] ?>">
                                    <div class="panel-title handoverHeader">
                                        <a data-toggle="collapse" data-target="#collapse<?php echo $row['id'] ?>" aria-expanded="<?php echo $expanded ?>" href="#collapse<?php echo $row['id'] ?>" role="button" aria-controls="collapse<?php echo $row['id'] ?>"><?php echo $header ?></a>
                                        <?php
                                            if ($row['employee'] == $_SESSION['userData']['employee']) {
                                            
                                            ?>

                                            - [<a href="processcarpark.php?remove=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure? This will delete this record.')"><font size="2" color="red">Remove</font></a>]

                                            <?php
                                            }
                                            ?>
                                    </div>

                                    <div id="collapse<?php echo $row['id'] ?>" class="<?php echo $thisClass ?>" aria-labelledby="heading<?php echo $row['id'] ?>" data-parent="#accordion">
                                        <div class="panel-body">
                                            <div class="handover">
                                            <?php
                                            echo '<pre>'.$row['comment'].'</pre>';
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

                </div>

            <?php
            
            include ('footer.php');

        ?>

        <script type="text/javascript">
            $("form").submit(function(e) {

                var error = "";

                if ($("#carreg").val() == "") {

                    error += "Please enter a valid car registration.<br>"

                }

                if (error != "") {

                    $("#error").html('<div class="alert alert-danger" role="alert">' + error + '</div>');

                    return false;

                } else {

                    return true;

                }
            })

        </script>

    </div>
</body>

</html>
