<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'header.php';

    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    
    ?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

            $source = '?source=viewquestionchecks';
            include 'checksource.php';
        ?>


            <div class="container">

                <h1>What category for the question</h1>

                <div id="error">
                    <?php echo $error.$successMessage; ?>
                </div>

                <form method="post" action="addquestioncheck.php<?php echo $source ?>">
                    
                    <div class="form-group">
                        <label for="partner"><h4>Partner Being Checked</h4></label>
                        <select class="form-control" id="partner" name="partner">
                        <option selected value="tbd">Choose a partner...</option>
                        <!-- populate the drop down list with Partners allowed to do rotation spot checks -->
                        <?php
                    
                        $query = "SELECT * FROM `partners` WHERE `active`='1' ORDER BY `firstname`";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            include 'selectfromallpartners.php';

                        }
                    
                        ?>
                        </select>

                    </div>
                    
                    <div class="form-group">
                    <label for="partner"><h4>Category for Question</h4></label>
                    <h6>Select the category you would like to test the Partner with.  There is a 1 in 3 chance this gets auto changed to 'Everyone'.</h6>
                    <select class="form-control" id="category" name="category">
                        
                        <option selected value="tbd">Choose a category...</option>
                        <!-- populate the drop down list with category from table -->
                        <?php

                        $query = "SELECT * FROM `categories` ORDER BY `category`";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            echo '<option value="'.$row['category'].'">'.$row['category'].'</option>';

                        }
                    
                    ?>
                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">Generate Question</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>

<script type="text/javascript">
    $("form").submit(function(e) {

        var error = "";

        if ($("#partner").val() == "tbd") {

            error += "Please select a Partner.<br>"

        }

        if ($("#category").val() == "tbd") {

            error += "Please select a category for the question.<br>"

        }

        if (error != "") {

            $("#error").html('<div class="alert alert-danger" role="alert">' + error + '</div>');

            return false;

        } else {

            return true;

        }
    })

</script>

    </div>
</body>

</html>
