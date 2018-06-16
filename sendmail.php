<!DOCTYPE html>

<?php 

include 'session.php'; 

?>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'functions.php';
    include 'checkmanager.php';
    include 'header.php';

//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);

    
    ?>

</head>

<body>
    <div class="bg">

        <?php

        include 'navback.php';
        
        $manager = $_SESSION['userData']['employee'];
        $team = checkTeam($manager);
        
        if($team == 'Purple' || $team == 'Brown') {
            $team = 'All';
        }
        
        ?>


            <div class="container">

                <h1>Email <?php echo $team; ?> Team</h1>

                <div id="error">
                    <? echo $error; ?>
                </div>

                <form method="post" action="processsmtpemail.php">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="subject">Subject <sup><font color="red">*</font></sup></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="subject" id="subject">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="message">Message <sup><font color="red">*</font></sup></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="message" id="message" rows="8"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="team" value="<?php echo $team; ?>">
                    <input type="hidden" name="manager" value="<?php echo $manager; ?>">

                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <label class="form-group-label" for="required">
                                <font size="1">The mail will automatically start "Hello {partner name}," and will finish "Regards,<br> <?php echo checkPartnerFirstName($manager); ?>".<br>Please only enter the actual message you need in the box above.<br>
                                Your subject will also automatically start "** 124 Mail **" so you have no need to use anything to signify it's a work email.</font>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <label class="form-group-label" for="required">
                                <sup><font color="red">*</font></sup> <font size="1">Required field</font>
                            </label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary">Send Email</button>
                        </div>
                    </div>

                </form>
            </div>
        
            <?php
                
            include 'footer.php';

        ?>

                <script type="text/javascript">
                    $("form").submit(function(e) {

                        var error = "";

                        if ($("#subject").val() == "") {

                            error += "Please enter a subject of your email.<br>"

                        }
                        
                        if ($("#message").val() == "") {

                            error += "Please enter a message.<br>"

                        }

                        if (error != "") {

                            $("#error").html('<div class="alert alert-danger" role="alert">' + error + '</div>');

                            return false;

                        } else {

                            if(confirm("Please confirm you would like to send this email?"))
                                document.forms[0].submit();
                              else
                                return false;
   
                        }
                    })

                </script>

    </div>
</body>

</html>
