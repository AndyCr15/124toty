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
        
        $partner = mysqli_real_escape_string($link, $_POST['partner']);
        $area = mysqli_real_escape_string($link, $_POST['area']);
        $result = mysqli_real_escape_string($link, $_POST['result']);
        $discussion = mysqli_real_escape_string($link, $_POST['discussion']);
        $manager = mysqli_real_escape_string($link, $_POST['manager']);
        if(isset($_POST['uniform'])) $uniform = 1; else $uniform = 0;
        if(isset($_POST['ready'])) $ready = 1; else $ready = 0;
        if(isset($_POST['greeting'])) $greeting = 1; else $greeting = 0;
        if(isset($_POST['smile'])) $smile = 1; else $smile = 0;
        if(isset($_POST['listening'])) $listening = 1; else $listening = 0;
        if(isset($_POST['personal'])) $personal = 1; else $personal = 0;
        if(isset($_POST['information'])) $information = 1; else $information = 0;
        if(isset($_POST['knowledge'])) $knowledge = 1; else $knowledge = 0;
        if(isset($_POST['display'])) $display = 1; else $display = 0;
        if(isset($_POST['thanks'])) $thanks = 1; else $thanks = 0;
        if(isset($_POST['goodbye'])) $goodbye = 1; else $goodbye = 0;
        
        $sql = "INSERT INTO
        `observations` (
          partner,
          area,
          result,
          discussion,
          manager,
          uniform,
          ready,
          greeting,
          smile,
          listening,
          personal,
          information,
          knowledge,
          display,
          thanks,
          goodbye
        )
      VALUES
        (
          '".$partner."',
          '".$area."',
          '".$result."',
          '".$discussion."',
          '".$manager."',
          '".$uniform."',
          '".$ready."',
          '".$greeting."',
          '".$smile."',
          '".$listening."',
          '".$personal."',
          '".$information."',
          '".$knowledge."',
          '".$dksplay."',
          '".$thanks."',
          '".$goodbye."'
        )
      ";
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("New observation created successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }
    
        // forward back to index page
        include 'forwardafter.php';

}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM observations WHERE id = ".$_GET['remove'];
    
    if ($link->query($sql) === TRUE) {
        echo "Observation removed successfully";
        
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
