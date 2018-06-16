<!DOCTYPE html>

<?php

include 'session.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';
// check they are allowed to add rotation checks

$detail = '';
if (isset($_POST['number'])) {
    $type = 'phone';
    $partner = mysqli_real_escape_string($link, $_POST['partner']);
    $detail = mysqli_real_escape_string($link, $_POST['number']);
}

if (isset($_POST['email'])) {
    $type = 'email';
    $partner = mysqli_real_escape_string($link, $_POST['partner']);
    $detail = mysqli_real_escape_string($link, $_POST['email']);
}

if (isset($_POST['carreg'])) {
    $type = 'carreg';
    $partner = mysqli_real_escape_string($link, $_POST['partner']);
    $detail = mysqli_real_escape_string($link, $_POST['carreg']);
}

$sql = "UPDATE `partners` SET `".$type."`='".$detail."' WHERE `employee`='".$partner."'";
        
if ($link->query($sql) === TRUE) {
    debug_to_console("Details updated successfully");
            
    logMySQL($_SESSION['userData']['employee'], mysqli_real_escape_string($link, $sql));

} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

?>

<script type="text/javascript">
    location.href = 'index.php';

</script>

<?php

