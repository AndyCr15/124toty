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
    
        // code to add details to database
        
        $employee = mysqli_real_escape_string($link, $_POST['employee']);
        $comment = mysqli_real_escape_string($link, $_POST['comment']);
        $carreg = mysqli_real_escape_string($link, $_POST['carreg']);
        $pcn = mysqli_real_escape_string($link, $_POST['pcn']);
        
        // remove white spaces
        $carreg = strtoupper(str_replace(' ','',$carreg));
    
        //$manager = $_SESSION['userData']['employee'];
        
        $today = timeDateNow();

        $sql = "INSERT INTO `carpark` (carreg, comment, employee, pcn, time) VALUES ('".$carreg."','".$comment."','".$employee."','".$pcn."','".$today."')";
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("New car park exception added successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }
    
        // forward back to index page
        ?>

        <script type="text/javascript">
            location.href = 'viewcarpark.php';

        </script>

        <?php

}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM carpark WHERE id = ".$_GET['remove'];
    
    if ($link->query($sql) === TRUE) {
        echo "Car park removed successfully";
        logMySQL($_SESSION['userData']['employee'], mysqli_real_escape_string($link, $sql));
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    // forward back to index page
    ?>

        <script type="text/javascript">
            location.href = 'viewcarpark.php';

        </script>

        <?php
        
}

?>
