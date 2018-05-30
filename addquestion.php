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
    
if ($_POST) {
    
    $question = mysqli_real_escape_string($link, $_POST['question']);
    $answer = mysqli_real_escape_string($link, $_POST['answer']);        
    $category = mysqli_real_escape_string($link, $_POST['category']);        
    
    $sql = "INSERT INTO `questions` (category, question, answer) VALUES ('".$category."','".$question."','".$answer."')";
    
    if ($link->query($sql) === TRUE) {

        $successMessage = '<div class="alert alert-success" role="alert">New question added successfully!</div>';

    } else {

        $error = "Error: " . $sql . "<br>" . $link->error;

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

                <div id="error">
                    <?php echo $error.$successMessage; ?>
                </div>

                <h1>Add A Question</h1>

                <form method="post">

                    <div class="form-group">
                        <label for="category"><h4>Category</h4></label>
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

                    <div class="form-group">
                        <label for="question"><h4>Question</h4></label>
                        <textarea class="form-control" id="question" name="question" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="answer"><h4>Answer</h4></label>
                        <textarea class="form-control" id="answer" name="answer" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Question</button>
                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>

        <script type="text/javascript">
            $("form").submit(function(e) {

                var error = "";

                if ($("#category").val() == "tbd") {

                    error += "Please select a category for the question.<br>"

                }

                if ($("#answer").val() == "") {

                    error += "Please enter an answer.<br>"

                }

                if ($("#question").val() == "") {

                    error += "Please enter a question.<br>"

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
