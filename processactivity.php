<!DOCTYPE html>

<?php

include 'session.php'; 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

include 'connection.php';
include 'checkadmin.php';

if ($_POST) {
    
    $error = "";
    
    if (!$_POST["name"]) {
        
        $error .= "The name field is required.<br>";
        
    }
    
    if ($error != "") {
            
            echo '<div class="alert alert-danger" role="alert"><p>There were error(s) in your submission:</p>' . $error . '</div>';
        
        } else {
    
        // code to add details to database
        
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $description = mysqli_real_escape_string($link, $_POST['description']);
        $blue = mysqli_real_escape_string($link, $_POST['blue']);
        $green = mysqli_real_escape_string($link, $_POST['green']);
        $red = mysqli_real_escape_string($link, $_POST['red']);
        $yellow = mysqli_real_escape_string($link, $_POST['yellow']);
        
        $sql = "INSERT INTO `activities` (name, description, blue, green, red, yellow) VALUES ('".$name."','".$description."','".$blue."','".$green."','".$red."','".$yellow."')";
        
        if ($link->query($sql) === TRUE) {
            echo "New activity created successfully";
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
    
}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM activities WHERE id = ".$_GET['remove'];
    
    if ($link->query($sql) === TRUE) {
        echo "Activity removed successfully";
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
