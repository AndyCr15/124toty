<?php include 'session.php'; ?>

<!DOCTYPE html>

<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';
// check they are allowed to add rotation checks

if ($_POST) {

    $taskid = mysqli_real_escape_string($link, $_POST['taskid']);
    $subtask = mysqli_real_escape_string($link, $_POST['subtask']);
    $employee = mysqli_real_escape_string($link, $_POST['employee']);
    $frequency = mysqli_real_escape_string($link, $_POST['frequency']);

    $sql = "INSERT INTO `raciresp` (taskid, subtask, employee, frequency) VALUES ('".$taskid."','".$subtask."','".$employee."','".$frequency."')";
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("New bag check created successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }


        // forward back to index page
        include 'forwardafter.php';

}

?>
