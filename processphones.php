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

    foreach($_POST as $phoneID => $manager) {

        // at the moment, this gives a new time to all phones when they are saved.  Maybe check for just changes?
        $sql="UPDATE phones SET manager = ".$manager.", time = now() WHERE id = ".$phoneID;
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("Bridge cover updated successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }
    }

    

    ?>

    <script type="text/javascript">
        location.href = 'phones.php';

    </script>

    <?php



/*

    // go through all the slots and update the database with manager number
    foreach ($slots as $name=>$text){
        // $name would be 'eight' and $text would be '8:15 - 9:15' as definded in functions.php
        
        $manager = mysqli_real_escape_string($link, $_POST[$name]);
        $sql = "REPLACE INTO `bridge` (slot, manager) VALUES ('".$name."','".$manager."')";
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("Bridge cover updated successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }
    }

    // forward back to index page
    ?>

    <script type="text/javascript">
        location.href = 'bridgecover.php';

    </script>

    <?php
*/
}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM handovers WHERE id = ".$_GET['remove'];
    
    if ($link->query($sql) === TRUE) {
        echo "Handover removed successfully";
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
