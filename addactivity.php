<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'functions.php';
    include 'header.php';

//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);


    include 'checkadmin.php';
    
    ?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

        ?>


            <div class="container">

                <div id="error">
                    <? echo $error.$successMessage; ?>
                </div>

                <form method="post" action="processactivity.php">
                    <div class="form-group">
                        <label for="name"><h4>Activity Name</h4></label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="description"><h4>Description</h4></label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="blue"><h4>Blue Points</h4></label>
                        <input type="number" class="form-control" id="blue" name="blue" placeholder="Blue Points" max="25" list="defaultNumbers">
                    </div>
                    <div class="form-group">
                        <label for="green"><h4>Green Points</h4></label>
                        <input type="number" class="form-control" id="green" name="green" placeholder="Green Points" max="25" list="defaultNumbers">
                    </div>
                    <div class="form-group">
                        <label for="red"><h4>Red Points</h4></label>
                        <input type="number" class="form-control" id="red" name="red" placeholder="Red Points" max="25" list="defaultNumbers">
                    </div>
                    <div class="form-group">
                        <label for="yellow"><h4>Yellow Points</h4></label>
                        <input type="number" class="form-control" id="yellow" name="yellow" placeholder="Yellow Points" max="25" list="defaultNumbers">
                    </div>
                    <button type="submit" id="submit" class="btn btn-primary">Add Activity</button>

                    <datalist id="defaultNumbers">
                      <option value="1">
                      <option value="2">
                      <option value="3">
                      <option value="5">
                      <option value="10">
                      <option value="12">
                      <option value="15">
                      <option value="20">
                    </datalist>


                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>

                <script type="text/javascript">
                    $("form").submit(function(e) {

                        var error = "";

                        if ($("#name").val() == "") {

                            error += "The name field is required.<br>"

                        }

                        if (error != "") {

                            $("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>' + error + '</div>');

                            return false;

                        } else {

                            return true;

                        }
                    })

                </script>

    </div>
</body>

</html>
