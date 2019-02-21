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

function check_length(my_form)
{
    maxLen = 500; // max number of characters allowed
    if (my_form.comment.value.length >= maxLen) {
    // Alert message if maximum limit is reached. 
    // If required Alert can be removed. 
    var msg = "You have reached your maximum limit of characters allowed";
    alert(msg);
    // Reached the Maximum length so trim the textarea
        my_form.comment.value = my_form.comment.value.substring(0, maxLen);
    }
    else{ // Maximum length not reached so update the value of comment counter
        my_form.text_num.value = maxLen - my_form.comment.value.length;
    }
}

</script>

<?php

$rowcount = 0;
$carreg = "";
$comments = Array();

if ($_POST) {
    
    $carreg = mysqli_real_escape_string($link, $_POST['carreg']); 
    
    // remove white spaces
    $carreg = strtoupper(str_replace(' ','',$carreg));

    $query = "SELECT * FROM `carpark` WHERE `carreg`='".$carreg."'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    
    $rowcount = mysqli_num_rows($result);

    if($rowcount > 0){
        $error = '<div class="alert alert-danger" role="alert">This car has already had '.$rowcount.' warning(s)</div>';
    }

    while($row = mysqli_fetch_array($result)){

        array_push($comments, $row['comment'].' (PCN '.$row['pcn'].')');

    }

}

?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

        ?>

            <div class="container">

            <h1>Car Park Excpetions</h1>

                <div id="error">
                    <? echo $error; ?>
                </div>

                <?php

                if(sizeof($comments) > 0){
                    foreach($comments as $comment){
                        echo '<h6>'.$comment.'</h6>';
                    }
                }

                ?>

                <form name=my_form method="post" action="processcarpark.php">
                
                    <div class="form-group">
                        <label for="carreg"><h4>Car Registration</h4></label>
                        <input type="text" class="form-control" id="carreg" name="carreg" value="<?php echo $carreg ?>">
                    </div>
                    <div class="form-group">
                        <label for="pcn"><h4>PCN</h4></label>
                        <input type="number" class="form-control" id="pcn" name="pcn">
                    </div>
                    <div class="form-group">
                        <label for="comment"><h4>Discussion Had</h4></label>
                        <textarea class="form-control" id="comment" name="comment" rows="4" onKeyPress=check_length(this.form); onKeyDown=check_length(this.form);></textarea>
                    </div>
                    <div>
                        <input size=5 value=500 name=text_num> Characters Left
                    </div>
                    <input type="hidden" name="employee" value="<?php echo $_SESSION['userData']['employee'] ?>">
                    <button type="submit" class="btn btn-primary">Add Exception</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>

        <script type="text/javascript">
            $("form").submit(function(e) {

                var error = "";

                if ($("#carreg").val() == "") {

                    error += "Please enter a valid car registration.<br>"

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
            $("#carreg").focus();
            });
        </script>

    </div>
</body>

</html>
