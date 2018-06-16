<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'header.php';
    include 'functions.php';
    include 'checkmanager.php';

    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    
if ($_POST) {
    
    $currenttracker = mysqli_real_escape_string($link, $_POST['currenttracker']);
    $thisLink = mysqli_real_escape_string($link, $_POST['link']);

    $active = mysqli_real_escape_string($link, $_POST['active']);            
    
    $sql = "REPLACE INTO `124admin` (id, currenttracker, active, link) VALUES ('1', '".$currenttracker."','".$active."','".$thisLink."')";
    
    if ($link->query($sql) === TRUE) {

        $successMessage = '<div class="alert alert-success" role="alert">Tracker updated successfully!</div>';

    } else {

        $error = "Error: " . $sql . "<br>" . $link->error;

    }

    if($_POST['reset'] == '1'){
        //reset all the toggles
        $sql = "UPDATE `partners` SET `yourvoice` = '0'";

        if ($link->query($sql) === TRUE) {

            $successMessage .= '<div class="alert alert-success" role="alert">Tracker reset successfully!</div>';
    
        } else {
    
            $error = "Error: " . $sql . "<br>" . $link->error;
    
        }
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

                <h1>Current Tracker Admin</h1>


            <?php
            $currenttracker = '';
            $thisLink = '';
            $active = '';

            $query = "SELECT * FROM `124admin` ORDER BY `id` LIMIT 1";
            $result = mysqli_query($link, $query);

            //how many tasks are there?
            $num_rows = mysqli_num_rows($result);

            if($num_rows > 0){

                $row = mysqli_fetch_array($result);
                $currenttracker = $row['currenttracker'];
                $thisLink = $row['link'];

                if($row['active'] == '1'){
                    $active = ' checked="checked"';
                }
                
            }
            ?>

                <form method="post">
                    <div class="form-group">
                        <label for="currenttracker"><h4>Current Tracker</h4></label>
                        <input type="text" class="form-control" id="currenttracker" name="currenttracker" value="<?php echo $currenttracker ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="link"><h4>Link To Use</h4></label>
                        <input type="text" class="form-control" id="link" name="link" value="<?php echo $thisLink ?>"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"<?php echo $active ?> name="active" id="active" value="1">
                        <label class="form-check-label" for="active">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="reset" id="reset" value="1">
                        <label class="form-check-label" for="reset">
                            Reset All Toggles
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Task</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>

        <script type="text/javascript">
            $("form").submit(function(e) {

                var error = "";

                if ($("#currenttracker").val() == "") {

                    error += "Please give a name to the tracker.<br>"

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
