<!DOCTYPE html>

<?php

include 'session.php';

    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';
// check they are allowed to add rotation checks

if ($_POST) {
    
        // code to add details to database
        
        $partner = mysqli_real_escape_string($link, $_POST['partner']);
        $questionid = mysqli_real_escape_string($link, $_POST['questionid']);
        $category = mysqli_real_escape_string($link, $_POST['category']);
        $result = mysqli_real_escape_string($link, $_POST['result']);
        $discussion = mysqli_real_escape_string($link, $_POST['question']);
        $manager = mysqli_real_escape_string($link, $_POST['manager']);
        $source = mysqli_real_escape_string($link, $_POST['source']);

        //don't record discussion if they passed
        if($result == 'pass'){

            $discussion = "";

        }
        
        $sql = "INSERT INTO `questionchecks` (questionid, partner, category, result, discussion, manager) VALUES ('".$questionid."','".$partner."','".$category."','".$result."','".$discussion."','".$manager."')";
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("New question check created successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }
    
        // forward back to index page
        include 'forwardafter.php';

}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM questionchecks WHERE id = ".$_GET['remove'];
    
    if ($link->query($sql) === TRUE) {
        echo "Rotation check removed successfully";
        
        logMySQL($_SESSION['userData']['employee'], mysqli_real_escape_string($link, $sql));
        
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    // forward back to index page
    ?>

        <script type="text/javascript">
            location.href = 'login.php';

        </script>

        <?php
        
}

?>
