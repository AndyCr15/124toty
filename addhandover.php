<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'header.php';
    include 'functions.php';

//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);
    
    ?>

<!-- to count how many letters used -->
<script language=JavaScript>
<!--
function check_length(my_form)
{
maxLen = 9999; // max number of characters allowed
if (my_form.handover.value.length >= maxLen) {
// Alert message if maximum limit is reached. 
// If required Alert can be removed. 
var msg = "You have reached your maximum limit of characters allowed";
alert(msg);
// Reached the Maximum length so trim the textarea
	my_form.handover.value = my_form.handover.value.substring(0, maxLen);
 }
else{ // Maximum length not reached so update the value of handover counter
	my_form.text_num.value = maxLen - my_form.handover.value.length;
}
}
//-->
</script>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

        ?>


            <div class="container">

                <div id="error">
                    <? echo $error; ?>
                </div>

                <form name=my_form method="post" action="processhandover.php">

                    <div class="form-group">
                        <label for="handover"><h4>Handover</h4></label>
                        <textarea class="form-control" id="handover" name="handover" rows="6" onKeyPress=check_length(this.form); onKeyDown=check_length(this.form);></textarea>
                    </div>
                    <div>
                    <input size=5 value=9999 name=text_num> Characters Left
                    </div>
                    <input type="hidden" name="employee" value="<?php echo $_SESSION['userData']['employee'] ?>">
                    <button type="submit" class="btn btn-primary">Add Handover</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>

<script type="text/javascript">
                    $("form").submit(function(e) {

                        var error = "";

                        if ($("#handover").val() == "") {

                            error += "Please enter a handover.<br>"

                        }

                        if (error != "") {

                            $("#error").html('<div class="alert alert-danger" role="alert">' + error + '</div>');

                            return false;

                        } else {

                            return true;

                        }
                    })

                </script>

                <script type="text/javascript">
                    $(document).ready(function() {
                    $("#handover").focus();
                    });
                </script>

    </div>
</body>

</html>
