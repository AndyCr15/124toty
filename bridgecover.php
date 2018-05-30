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

            <h1>Bridge Cover</h1>

            <div id="error">
                <? echo $error; ?>
            </div>

            <form method="post" action="processbridgecover.php">
                
                <?php

                // go through all the slots
                foreach ($slots as $name=>$text){
                    // $name would be 'eight' and $text would be '8:15 - 9:15' as definded in functions.php
                    ?>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="<?php echo $name; ?>"><?php echo $text; ?></label>
                        <div class="col-sm-9">
                        <select class="form-control" id="<?php echo $name; ?>" name="<?php echo $name; ?>">
                            
                        <!-- populate the drop down list with Partners allowed to do rotation spot checks -->
                        <?php

                        $query = "SELECT * FROM `partners` WHERE `canrotationcheck` = '1' ORDER BY `firstname`";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }

                        // get the manager currently in this slot in the database
                        $bridgeQuery = "SELECT manager FROM `bridge` WHERE `slot` = '".$name."'";
                        $bridgeResult = mysqli_query($link, $bridgeQuery);
                        if (!$bridgeResult) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        $bridgeRow = mysqli_fetch_array($bridgeResult);
                        $manager = $bridgeRow['manager'];

                        while($row = mysqli_fetch_array($result)){
                            $selected = '';
                            if($manager == $row['employee']){
                                $selected =  'selected="selected"';
                            }
                            echo '<option value="'.$row['employee'].'" '.$selected.'>'.$row['firstname'].' '.$row['surname'].'</option>'; 

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
                        <button type="submit" class="btn btn-primary">Save Bridge Cover</button>
                    </div>
                </div>

            </form>
        </div>

        <?php
            
        include 'footer.php';

        ?>

                <script type="text/javascript">
                    $("form").submit(function(e) {

                        var error = "";
                        
                        if ($("#team").val() == "tbd") {

                            error += "Please select a team.<br>"

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
