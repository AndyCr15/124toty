<?php

if(!isset($_SESSION['userData'])){
// not logged in
            ?>
    <script type="text/javascript">
        location.href = 'login.php';

    </script>
    <?php

}

// record last visited in database

include 'connection.php';

$dt = new DateTime();

$query = "UPDATE `partners` SET `lastvisit`='".($dt->format('Y-m-d H:i:s'))."' WHERE `employee`='".$_SESSION['userData']['employee']."'";
$result = mysqli_query($link, $query);

?>
