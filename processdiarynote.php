<!DOCTYPE html>

<?php

include 'session.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';
// check they are allowed to add rotation checks

if ($_POST) {
    
        // code to add details to database
        
        $partner = mysqli_real_escape_string($link, $_POST['partner']);
        $discussion = mysqli_real_escape_string($link, $_POST['discussion']);
        $agreement = mysqli_real_escape_string($link, $_POST['agreement']);
    
        // two options below, first if the drop down is in use for selecting who did the check, the second is for whoever is logged in
        // as it now preselects the logged in user, I can use first option
        $manager = mysqli_real_escape_string($link, $_POST['manager']);
        //$manager = $_SESSION['userData']['employee'];
        
        $sql = "INSERT INTO `diarynotes` (partner, discussion, agreement, manager) VALUES ('".$partner."','".$discussion."','".$agreement."','".$manager."')";
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("New diary note added successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }
    
        // forward back to index page
        ?>

    <script type="text/javascript">
        location.href = 'index.php';

    </script>

    <?php

}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM diarynotes WHERE id = ".$_GET['remove'];
    
    if ($link->query($sql) === TRUE) {
        echo "Diary note removed successfully";
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
