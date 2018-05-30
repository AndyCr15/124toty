<?php include 'session.php'; ?>

<!DOCTYPE html>

<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';


if ($_POST) {

    // code to add details to database
    
    $task = mysqli_real_escape_string($link, $_POST['task']);          
    $comments = mysqli_real_escape_string($link, $_POST['comments']);      
    $date = mysqli_real_escape_string($link, $_POST['dtp_input2']);      

    $employee = $_SESSION['userData']['employee'];
    
    $sql = "INSERT INTO `deadlines` (task, comments, date, employee) VALUES ('".$task."','".$comments."','".$date."','".$employee."')";
    
    if ($link->query($sql) === TRUE) {
        debug_to_console("New deadline added successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    // forward back to index page
    ?>

    <script type="text/javascript">
        location.href = 'viewdeadlines.php';

    </script>

    <?php

}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM deadlines WHERE id = ".$_GET['remove'];
    
    if ($link->query($sql) === TRUE) {
        echo "Deadline removed successfully";
        logMySQL($_SESSION['userData']['employee'], mysqli_real_escape_string($link, $sql));
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    // forward back to index page
    ?>

        <script type="text/javascript">
            location.href = 'viewdeadlines.php';

        </script>

        <?php
        
}

?>
