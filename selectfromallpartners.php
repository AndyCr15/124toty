<?php

if(isset($_GET['employee'])){
    $getEmployee = $_GET['employee'];
}

$selected = "";
if($getEmployee == $row['employee']){
    $selected = ' selected="selected"';
}
echo '<option value="'.$row['employee'].'"'.$selected.'>'.$row['firstname'].' '.$row['surname'].'</option>';
?>