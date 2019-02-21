<?php include 'session.php'; ?>

<!DOCTYPE html>

<?php

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

    
    $sql = "UPDATE `partners` SET `yourvoice`='".$completed."' WHERE `employee`='".$employee."'";

    if ($link->query($sql) === TRUE) {
        debug_to_console("Your voice toggled successfully");

        //logMySQL($_SESSION['userData']['employee'], mysqli_real_escape_string($link, $sql));

    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    ?>

<script type="text/javascript">
    location.href = 'yourvoice.php';

</script>

<?php

}