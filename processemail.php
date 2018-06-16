<!DOCTYPE html>

<?php

include 'session.php';

    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);

include 'connection.php';
include 'functions.php';


if ($_POST) {
        
    $team = $_POST['team'];
    $manager = $_POST['manager'];

    $subject = "** 124 Mail ** - ".$_POST['subject'];
    
    $headers = array(
        'From: '.checkPartnerName($manager).' '.checkPartnerEmail($manager),
        'Reply-To: '.checkPartnerEmail($manager)
    );
    $headers = implode("\r\n", $headers);

    $emailTo = "andycr15@gmail.com";
    $message = "Dear Partner,\r\n\r\n".$_POST['message']."\r\n\r\nRegards,\r\n\r\n".checkPartnerFirstName($manager);

    if (mail($emailTo, $subject, $message, $headers)) {
?>
    <script type="text/javascript">
    alert("Email Processed!");
    location.href = 'index.php';
    </script>
<?php

    } else {
?>
    <script type="text/javascript">
    alert("Errors!");
    location.href = 'javascript:history.go(-1)';
    </script>
<?php

    }

}

?>
