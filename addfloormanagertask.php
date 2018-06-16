<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
    
    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);

    include 'connection.php';
    include 'header.php';
    include 'functions.php';
    include 'checkmanager.php';

    if ($_POST) {
        
        $starthour = mysqli_real_escape_string($link, $_POST['starthour']); 
        $endhour = mysqli_real_escape_string($link, $_POST['endhour']);       
        $task = mysqli_real_escape_string($link, $_POST['task']);       
        
        $sql = "INSERT INTO `floormanagertasks` (starthour, endhour, task) VALUES ('".$starthour."','".$endhour."','".$task."')";
        
        if ($link->query($sql) === TRUE) {

            $successMessage = '<div class="alert alert-success" role="alert">New task added successfully!</div>';

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

                <h1>Add A Floor Manager Task</h1>


            <?php
            $currentHour = currentHour();

            $floorQuery = "SELECT * FROM `floormanagertasks` ORDER BY `starthour`";
            $floorResult = mysqli_query($link, $floorQuery);

            //how many tasks are there?
            $num_rows = mysqli_num_rows($floorResult);

            if($num_rows > 0){

                echo '<h6>Current Tasks</h6>';

                while($floorRow = mysqli_fetch_array($floorResult)){
                    echo '<ul>';
                    echo '<li><h5>'.$floorRow['task'].' from '.$floorRow['starthour'].':00 to '.$floorRow['endhour'].':00</h5></li>';
                    echo '</ul>';
            
                }
            }
            ?>




                <form method="post">

                    <div class="form-group">
                        <label for="starthour"><h4>Start Hour (24hr)</h4></label>
                        <input type="number" class="form-control" id="starthour" name="starthour"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="endhour"><h4>End Hour (24hr)</h4></label>
                        <input type="number" class="form-control" id="endhour" name="endhour"></textarea>
                    </div>
                    <p>Only add the number of hours, so 6 for 6:00am or 20 for 8:00pm.</p>
                    <div class="form-group">
                        <label for="task"><h4>Task</h4></label>
                        <textarea class="form-control" id="task" name="task" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Task</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>

        <script type="text/javascript">
            $("form").submit(function(e) {

                var error = "";

                /*if (($("#starthour").val()) > ($("#endhour").val())) {

                    error += "Start time cannot be after end time.<br>"

                }*/

                if (($("#starthour").val()) == ($("#endhour").val())) {

                    error += "Start time cannot be the same as end time.<br>"

                }

                if ($("#starthour").val() == "") {

                    error += "Please select a starting hour.<br>"

                }

                if ($("#endhour").val() == "") {

                    error += "Please select a hour the task ends on.<br>"

                }

                if ($("#task").val() == "") {

                    error += "Please enter the task to be done.<br>"

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
            $("#task").focus();
            });
        </script>

    </div>
</body>

</html>
