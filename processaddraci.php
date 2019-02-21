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

    $wheel = mysqli_real_escape_string($link, $_POST['wheel']);
    $task = mysqli_real_escape_string($link, $_POST['task']);
    $manager = mysqli_real_escape_string($link, $_POST['manager']);

    $sql = "INSERT INTO `racitask` (wheel, task, manager) VALUES ('".$wheel."','".$task."','".$manager."')";
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("New bag check created successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }


        // forward back to index page
        include 'forwardafter.php';

}

?>
