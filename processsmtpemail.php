<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    include 'session.php'; 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once 'connection.php';
    include 'functions.php';
    include 'header.php';
    include 'checkloggedin.php';
    
    ?>

</head>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
?>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

        ?>

            <div class="container">
<?php

if ($_POST) {
        
    $team = $_POST['team'];
    $manager = $_POST['manager'];

    // remove after testing
    //$team = 'Green';
    //echo '<script>alert("Team '.$team.'!");</script>';

    $subject = "** 124 Mail ** - ".$_POST['subject'];
    if($team == 'Brown' || $team == 'Purple'){

        // code for all partners
        $query = "SELECT * FROM `partners` WHERE (`active`='1' AND `email`!='') ORDER BY `firstname` ASC";
    
    } else {
    
        $query = "SELECT * FROM `partners` WHERE (`active`='1' AND `team`='".$team."' AND `email`!='') ORDER BY `firstname` ASC";
    
    }
    $result = mysqli_query($link, $query);
    
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }

    while($row = mysqli_fetch_array($result)) {

        $mail = new PHPMailer();
    
        $mail->isSMTP();                                   // Set mailer to use SMTP
        $mail->CharSet = 'UTF-8';
        $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
        $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth = true;                            // Enable SMTP authentication
        $mail->Username = 'wr124mail@gmail.com';          // SMTP username
        $mail->Password = 'ladygaga.';              // SMTP password
        $mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                 // TCP port to connect to
        
        $mail->setFrom(checkPartnerEmail($manager), checkPartnerName($manager));
        $mail->addReplyTo(checkPartnerEmail($manager), checkPartnerName($manager));

        $mail->AddAddress($row['email'], checkPartnerName($row['employee']));
        
        $mail->isHTML(false);  // Set email format to HTML
        
        $bodyContent = "Dear ".checkPartnerFirstName($row['employee']).",\r\n\r\n".$_POST['message']."\r\n\r\nRegards,\r\n\r\n".checkPartnerFirstName($manager);
        
        $mail->Subject = "** 124 Mail ** - ".$_POST['subject'];
        $mail->Body    = $bodyContent;
        
        if(!$mail->send()) {
            
            echo 'Message could not be sent to '.checkPartnerFirstName($row['employee']).'.<br>';
            echo 'Mailer Error: ' . $mail->ErrorInfo;

        } else {
            
            echo checkPartnerFirstName($row['employee']).' mailed.<br>';

        }
    }


}
?>
            <div class="topBottom col-12">

                <a href="index.php" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Back To Main Menu</a>

            </div>

    </div>
</div>

</body>
