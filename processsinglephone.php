<?php include 'session.php'; ?>

<!DOCTYPE html>

<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';
// check they are allowed to add rotation checks

if ($_GET) {

    $id = mysqli_real_escape_string($link, $_GET['id']);
    $manager = mysqli_real_escape_string($link, $_GET['manager']);

    echo $id;
    echo $manager;

    // at the moment, this gives a new time to all phones when they are saved.  Maybe check for just changes?
    $sql="UPDATE phones SET manager = ".$manager.", time = now() WHERE id = ".$id;
    
    if ($link->query($sql) === TRUE) {
        debug_to_console("Bridge cover updated successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }


    ?>

    <script type="text/javascript">
        location.href = 'phones.php';

    </script>

    <?php

}

?>
