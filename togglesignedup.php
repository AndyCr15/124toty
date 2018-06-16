<!DOCTYPE html>

<?php

include 'session.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';
// check they are allowed to add rotation checks

if (isset($_GET['employee'])) {
    
    $employee = mysqli_real_escape_string($link, $_GET['employee']);
    $team = checkTeam($employee);
    $completed = mysqli_real_escape_string($link, $_GET['completed']);
    $db = mysqli_real_escape_string($link, $_GET['db']);
    $source = mysqli_real_escape_string($link, $_GET['source']);

    
    $sql = "UPDATE `partners` SET `".$db."`='".$completed."' WHERE `employee`='".$employee."'";

    if ($link->query($sql) === TRUE) {
        debug_to_console("Toggled successfully");

        //logMySQL($_SESSION['userData']['employee'], mysqli_real_escape_string($link, $sql));

    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    if($source == 'signedup'){
        ?>

        <script>
            location.href = 'signedup.php?team=<?php echo $team; ?>&db=<?php echo $db; ?>';

        </script>

        <?php
    } else {

        ?>

        <script>
            location.href = 'partnerdetails.php?employeenumber=<?php echo $source; ?>';

        </script>

        <?php

    }

}