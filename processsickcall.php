<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';
// check they are allowed to add rotation checks

if ($_POST) {
    
        // code to add details to database
        
        $partner = mysqli_real_escape_string($link, $_POST['partner']);
        $reason = mysqli_real_escape_string($link, $_POST['reason']);
        $discussion = mysqli_real_escape_string($link, $_POST['discussion']);
        $manager = mysqli_real_escape_string($link, $_POST['manager']);
        
        $time = timeDateNow();
        debug_to_console($time);
        
        $sql = "INSERT INTO `sickness` (time, partner, reason, discussion, manager) VALUES ('".$time."','".$partner."','".$reason."','".$discussion."','".$manager."')";
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("New sickness recorded successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }
    
        // forward back to index page
        include 'forwardafter.php';

}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM sickness WHERE id = ".$_GET['remove'];
    
    if ($link->query($sql) === TRUE) {
        echo "Bag check removed successfully";
        
        logMySQL($_SESSION['userData']['employee'], mysqli_real_escape_string($link, $sql));
        
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    // forward back to index page
    ?>

        <script type="text/javascript">
            location.href = 'viewsickcalls.php';

        </script>

        <?php
        
}

if(isset($_GET['actioned']) and isset($_GET['id'])){
    
    $sql = "UPDATE `sickness` SET actioned='".$_GET['actioned']."', time=time WHERE id='".$_GET['id']."'";
    
    if ($link->query($sql) === TRUE) {
        echo "Sickness actioned successfully";
        
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    // forward back to index page
    ?>

        <script type="text/javascript">
            location.href = 'viewsickcalls.php';

        </script>

        <?php
        
}

?>
