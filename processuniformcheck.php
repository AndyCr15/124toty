<?php include 'session.php'; ?>

<!DOCTYPE html>

<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';
// check they are allowed to add uniform checks
include 'checkmanager.php';

if ($_POST) {
    
        // code to add details to database
        
        $partner = mysqli_real_escape_string($link, $_POST['partner']);
        $result = mysqli_real_escape_string($link, $_POST['result']);
        $discussion = mysqli_real_escape_string($link, $_POST['discussion']);
    
        // two options below, first if the drop down is in use for selecting who did the check, the second is for whoever is logged in
        // as it now preselects the logged in user, I can use first option
        $manager = mysqli_real_escape_string($link, $_POST['manager']);
        //$manager = $_SESSION['userData']['employee'];
        
        $sql = "INSERT INTO `uniformchecks` (partner, result, discussion, manager) VALUES ('".$partner."','".$result."','".$discussion."','".$manager."')";
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("New uniform check created successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }
    
        // forward back to index page
        include 'forwardafter.php';

}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM uniformchecks WHERE id = ".$_GET['remove'];
    
    if ($link->query($sql) === TRUE) {
        echo "Uniform check removed successfully";
        
        logMySQL($_SESSION['userData']['employee'], mysqli_real_escape_string($link, $sql));
        
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    // forward back to index page
    ?>

        <script type="text/javascript">
            location.href = 'login.php';

        </script>

        <?php
        
}

?>
