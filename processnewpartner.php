<?php include 'session.php'; ?>

<!DOCTYPE html>

<?php

include 'connection.php';
include 'functions.php';

if (!empty($_POST)) {
    
    // code to add details to database
    $employee = mysqli_real_escape_string($link, $_POST['employee']);
    $firstname = mysqli_real_escape_string($link, $_POST['firstname']);
    $surname = mysqli_real_escape_string($link, $_POST['surname']);
    $picture = mysqli_real_escape_string($link, $_POST['picture']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $carreg = mysqli_real_escape_string($link, $_POST['carreg']);
    $team = mysqli_real_escape_string($link, $_POST['team']);
    $level = mysqli_real_escape_string($link, $_POST['level']);
    $canrotationcheck = mysqli_real_escape_string($link, $_POST['rotationcheck']);
    $canuniformcheck = mysqli_real_escape_string($link, $_POST['uniformcheck']);
    $canbagcheck = mysqli_real_escape_string($link, $_POST['bagcheck']);
    $active = mysqli_real_escape_string($link, $_POST['active']);

    if($team == 'Random'){

        // count Partners in each team to find who has the fewest and who has the most

    $query = "SELECT * FROM `partners` WHERE (`team` = 'Blue' AND `active`=1)";
    $result = mysqli_query($link, $query);
    $blueCount=mysqli_num_rows($result);

    $query = "SELECT * FROM `partners` WHERE (`team` = 'Green' AND `active`=1)";
    $result = mysqli_query($link, $query);
    $greenCount=mysqli_num_rows($result);

    $query = "SELECT * FROM `partners` WHERE (`team` = 'Red' AND `active`=1)";
    $result = mysqli_query($link, $query);
    $redCount=mysqli_num_rows($result);

    $query = "SELECT * FROM `partners` WHERE (`team` = 'Yellow' AND `active`=1)";
    $result = mysqli_query($link, $query);
    $yellowCount=mysqli_num_rows($result);

    // find most Partners in a team, lets say 40, deduct from 40 what each team has, add them up and
    // that's what it's out off. The number off 40 (+2) is there chance of getting the partner

    $limit = max($blueCount, $greenCount, $redCount, $yellowCount);

    $blueCount = max($limit - $blueCount, 0) + 2;
    $greenCount = max($limit - $greenCount, 0) + 2;
    $redCount = max($limit - $redCount, 0) + 2;
    $yellowCount = max($limit - $yellowCount, 0) + 2;

    $total = $blueCount + $greenCount + $redCount + $yellowCount;

    debug_to_console('Blue:'.$blueCount);
    debug_to_console('Green:'.$greenCount);
    debug_to_console('Red:'.$redCount);
    debug_to_console('Yellow:'.$yellowCount);
    
    debug_to_console('Total:'.$total);
    $pick = rand(1,$total);
    debug_to_console($pick);

    $team = 'Yellow';
    switch ($pick) {
        case ($pick <= $blueCount):
            $team = 'Blue';
            break;
        case ($pick <= $blueCount + $greenCount):
            $team = 'Green';
            break;
        case ($pick <= $blueCount + $greenCount + $redCount):
            $team = 'Red';
            break;
    }
    debug_to_console($team);

    echo '<script>alert("'.$firstname.' joins '.$team.'!");</script>';
    //echo 'confirm("Test")';

    }

    $sql = "REPLACE INTO `partners` (employee, firstname, surname, picture, phone, email, carreg, team, level, canrotationcheck, canuniformcheck, canbagcheck, active)
    VALUES ('".$employee."','".$firstname."','".$surname."','".$picture."','".$phone."','".$email."','".$carreg."','".$team."','".$level."','".$canrotationcheck."','".$canuniformcheck."','".$canbagcheck."','".$active."')";

    if ($link->query($sql) === TRUE) {
        debug_to_console("Partner updated or created successfully");
        
        logMySQL($_SESSION['userData']['employee'], mysqli_real_escape_string($link, $sql));
        
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    // forward back to index page
    ?>

    <script type="text/javascript">
        location.href = 'index.php';

    </script>

    <?php

}

if(isset($_GET['remove'])){
    
    $sql = "DELETE FROM bagchecks WHERE id = ".$_GET['remove'];
    
    if ($link->query($sql) === TRUE) {
        echo "Bag check removed successfully";
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
