<?php include 'session.php'; ?>

<!DOCTYPE html>

<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';
// check they are allowed to add rotation checks

if ($_POST) {
    
        // code to add details to database
        
        $employee = mysqli_real_escape_string($link, $_POST['employee']);
        $handover = mysqli_real_escape_string($link, $_POST['handover']);        
    
        //$manager = $_SESSION['userData']['employee'];
        
        $sql = "INSERT INTO `handovers` (handover, employee) VALUES ('".$handover."','".$employee."')";
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("New diary note added successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }
    
        // forward back to index page
        ?>

        <script type="text/javascript">
            location.href = 'viewhandovers.php';

        </script>

        <?php

}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM handovers WHERE id = ".$_GET['remove'];
    
    if ($link->query($sql) === TRUE) {
        echo "Handover removed successfully";
        logMySQL($_SESSION['userData']['employee'], mysqli_real_escape_string($link, $sql));
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    // forward back to index page
    ?>

        <script type="text/javascript">
            location.href = 'viewhandovers.php';

        </script>

        <?php
        
}

?>
