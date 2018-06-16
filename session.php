<?php
    $lifetime=259200;
    session_set_cookie_params($lifetime,"/");
    session_start();
    //setcookie("id", $_SESSION['userData']['employee'], time() + 60*60*24*7);
?>
