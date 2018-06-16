<!DOCTYPE html>

<?php 

include 'session.php'; 

?>

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

        $type = "Add";
        
        $firstname = "";
        $surname = "";
        $employee = "";
        $team = "";
        $level = "";
        $email = "";
        
        if(isset($_GET["employee"])) {
            
            $empolyee = mysqli_real_escape_string($link, $_GET["employee"]);
            
            $query = "SELECT * FROM `partners` WHERE `employee` = '".$_GET["employee"]."'";
            $result = mysqli_query($link, $query);

            if (!$result) {
                printf("Error: %s\n", mysqli_error($link));
                exit();
            }

            $row = mysqli_fetch_array($result);

            $firstname = $row['firstname'];
            $surname = $row['surname'];
            $team = $row['team'];
            $level = $row['level'];
            $employee = $row['employee'];
            $canrotationcheck = $row['canrotationcheck'];
            $canuniformcheck = $row['canuniformcheck'];
            $canbagcheck = $row['canbagcheck'];
            $email = $row['email'];
            $carreg = $row['carreg'];
        
            $type = "Update";
            
        }
        
        ?>


            <div class="container">

                <h1><?php echo $type; ?> Partner</h1>

                <div id="error">
                    <? echo $error; ?>
                </div>

                <form method="post" action="processnewpartner.php">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="firstname">Firstname <sup><font color="red">*</font></sup></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $firstname ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="surname">Surname <sup><font color="red">*</font></sup></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="surname" id="surname" value="<?php echo $surname ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="employee">Employee Number <sup><font color="red">*</font></sup></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="employee" id="employee" value="<?php echo $employee ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="phone">Phone Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="email">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="carreg">Car Registration</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="carreg" id="carreg" value="<?php echo $carreg ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="team">Team <sup><font color="red">*</font></sup></label>
                        <div class="col-sm-9">
                          <select class="custom-select my-1 mr-sm-2" name="team" id="team">
                            <option selected value="tbd">Choose...</option>
                            <option value="Blue" <?php if($team=="Blue") { echo 'Selected'; } ?>>Blue</option>
                            <option value="Green" <?php if($team=="Green") { echo 'Selected'; } ?>>Green</option>
                            <option value="Red" <?php if($team=="Red") { echo 'Selected'; } ?>>Red</option>
                            <option value="Yellow" <?php if($team=="Yellow") { echo 'Selected'; } ?>>Yellow</option>
                            <option value="Random" <?php if($team=="Random") { echo 'Selected'; } ?>>Random</option>
                          </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="level">Level <sup><font color="red">*</font></sup></label>
                        <div class="col-sm-9">
                          <select class="custom-select my-1 mr-sm-2" name="level" id="level">
                            <option selected value="10">NMP</option>
                            <option value="9" <?php if($level=="9") { echo 'Selected'; } ?>>ATM</option>
                            <option value="8" <?php if($level=="8") { echo 'Selected'; } ?>>TM</option>
                            <option value="7" <?php if($level=="7") { echo 'Selected'; } ?>>DBM</option>
                            <option value="6" <?php if($level=="6") { echo 'Selected'; } ?>>BM</option>
                          </select>
                        </div>
                    </div>
                    
                    <!-- Make some disabled pending level entered? (ie level 10 cannot bagcheck) -->
                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <input class="form-group-input" type="checkbox" value="1" name="rotationcheck" id="rotationcheck" <?php if($canrotationcheck=="1") { echo 'checked'; } ?>>
                            <label class="form-group-label" for="rotationcheck">
                            Can Rotation Spot Check Others
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <input class="form-group-input" type="checkbox" value="1" name="uniformcheck" id="uniformcheck" <?php if($canuniformcheck=="1") { echo 'checked'; } ?>>
                            <label class="form-group-label" for="uniformcheck">
                            Can Uniform Check Others
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <input class="form-group-input" type="checkbox" value="1" name="bagcheck" id="bagcheck" <?php if($canbagcheck=="1") { echo 'checked'; } ?>>
                            <label class="form-group-label" for="bagcheck">
                            Can Perform Partner Searches
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            
                            <label class="form-group-label" for="required">
                                <sup><font color="red">*</font></sup> <font size="1">Required field</font>
                            </label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary"><?php echo $type; ?> Partner</button>
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

                        if ($("#employee").val() < 70000000 || $("#employee").val() > 99999999) {

                            error += "Please enter a valid employee number.<br>"

                        }

                        if ($("#firstname").val() == "" || $("#surname").val() == "") {

                            error += "Please enter both a firstname and surname.<br>"

                        }
                        
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
