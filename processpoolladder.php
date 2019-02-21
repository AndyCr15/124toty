<?php include 'session.php'; ?>

<!DOCTYPE html>

<?php

    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';

if ($_POST) {
    
        // code to add details to database
        
        $winner = mysqli_real_escape_string($link, $_POST['winner']);
        $loser = mysqli_real_escape_string($link, $_POST['loser']);
        
        $sql = "INSERT INTO `poolmatches` (winner, loser) VALUES ('".$winner."','".$loser."')";
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("New match added successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }

        checkPoolLadder($winner);
        checkPoolLadder($loser);

        poolResult($winner, $loser);
    
        // forward back to index page
        
        ?>

        <script type="text/javascript">
            location.href = 'poolladder.php';

        </script>

        <?php

}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM poolmatches WHERE id = ".$_GET['remove'];
    
    if ($link->query($sql) === TRUE) {
        echo "Match removed successfully";
        
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
