<?php
    $lifetime=259200;
    session_set_cookie_params($lifetime,"/");
    session_start();
    //setcookie(session_name(),session_id(),time()+$lifetime);
?>
