<!-- populate the drop down list with Partners allowed to do rotation spot checks -->
<?php

$query = "SELECT * FROM `partners` WHERE `canrotationcheck` = '1' ORDER BY `firstname`";
$result = mysqli_query($link, $query);
if (!$result) {
    printf("Error: %s\n", mysqli_error($link));
    exit();
}
while($row = mysqli_fetch_array($result)){

    echo '<option value="'.$row['employee'].'">'.$row['firstname'].' '.$row['surname'].'</option>'; 

}

?>