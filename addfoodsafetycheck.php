<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'header.php';
    include 'functions.php';

    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    
if ($_POST) {
    
    $area = mysqli_real_escape_string($link, $_POST['area']); 
    $question = mysqli_real_escape_string($link, $_POST['question']);       
    
    $sql = "INSERT INTO `foodsafetyquestions` (area, question) VALUES ('".$area."','".$question."')";
    
    if ($link->query($sql) === TRUE) {

        $successMessage = '<div class="alert alert-success" role="alert">New check added successfully!</div>';

    } else {

        $error = "Error: " . $sql . "<br>" . $link->error;

    }

}

?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

        ?>


            <div class="container">

                <div id="error">
                    <?php echo $error.$successMessage; ?>
                </div>

                <h1>Add A Question</h1>

                <form method="post">

                    <div class="form-group">
                        <label for="area"><h4>Area</h4></label>
                        <textarea class="form-control" id="area" name="area" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="question"><h4>Check To Make</h4></label>
                        <textarea class="form-control" id="question" name="question" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Check</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>

        <script type="text/javascript">
            $("form").submit(function(e) {

                var error = "";

                if ($("#area").val() == "") {

                    error += "Please select an area for the check.<br>"

                }

                if ($("#question").val() == "") {

                    error += "Please enter the check to make.<br>"

                }

                if (error != "") {

                    $("#error").html('<div class="alert alert-danger" role="alert">' + error + '</div>');

                    return false;

                } else {

                    return true;

                }
            })

        </script>

        <script type="text/javascript">
            $(document).ready(function() {
            $("#handover").focus();
            });
        </script>

    </div>
</body>

</html>
