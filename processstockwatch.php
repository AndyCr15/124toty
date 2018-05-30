<!DOCTYPE html>

<?php

include 'session.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';

include 'checkloggedin.php';


if ($_POST) {

    // code to add details to database
    
    $linenumber = mysqli_real_escape_string($link, $_POST['linenumber']);
    $product = mysqli_real_escape_string($link, $_POST['product']);      
    $layout = mysqli_real_escape_string($link, $_POST['layout']);      
    $comments = mysqli_real_escape_string($link, $_POST['comments']);      
    $date = mysqli_real_escape_string($link, $_POST['dtp_input2']);      

    $employee = $_SESSION['userData']['employee'];
    
    $sql = "INSERT INTO `stockwatch` (linenumber, product, layout, comments, date, employee) VALUES ('".$linenumber."','".$product."','".$layout."','".$comments."','".$date."','".$employee."')";
    
    if ($link->query($sql) === TRUE) {
        debug_to_console("New diary note added successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    // forward back to index page
    ?>

    <script type="text/javascript">
        location.href = 'viewstockwatch.php';

    </script>

    <?php

}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM stockwatch WHERE id = ".$_GET['remove'];

    if ($link->query($sql) === TRUE) {
        echo "Stock Item removed successfully";
        logMySQL($_SESSION['userData']['employee'], mysqli_real_escape_string($link, $sql));
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    // forward back to index page
    ?>

        <script type="text/javascript">
            location.href = 'viewstockwatch.php';

        </script>

        <?php
        
}

?>
