<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'functions.php';
    include 'header.php';

    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    
if ($_POST) {
    
    $partner = mysqli_real_escape_string($link, $_POST['partner']);
    $category = mysqli_real_escape_string($link, $_POST['category']);

    // 1 in 3 chance this category gets changed to 'Everyone'
    $rnd = rand(1,3);
    debug_to_console($rnd);

    if($rnd == 1) {
        $category = 'Everyone';
    }

    $query = "SELECT * FROM `questions` WHERE `category`='".$category."' ORDER BY RAND() LIMIT 1;";
    $result = mysqli_query($link, $query);
    
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $row = mysqli_fetch_array($result);

    $question = $row['question'];
    $answer = $row['answer'];
    $questionid = $row['id'];
    
}

    ?>

</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

            $source = 'viewquestionchecks';
            include 'checksource.php';
        ?>


            <div class="container">

                <h1>Ask A Question - Category : <?php echo $category ?></h1>

                <div id="error">
                    <? echo $error.$successMessage; ?>
                </div>

                <form method="post" action="processquestioncheck.php<?php echo $source ?>">

                    <input type="hidden" name="partner" value="<?php echo $partner ?>">
                    <input type="hidden" name="category" value="<?php echo $category ?>">
                    <input type="hidden" name="question" value="<?php echo $question ?>">
                    <input type="hidden" name="questionid" value="<?php echo $questionid ?>">

                    <?php

                    echo '<div class="alert alert-warning" role="alert">'.$question.'</div>';
                    echo '<div class="alert alert-success" role="alert">'.$answer.'</div>';

                    ?>

                    <div class="form-group">
                        <label for="result"><h4>Did they answer correctly?</h4></label>
                        <select class="form-control" id="result" name="result">
                                <option value="pass">Pass</option>
                                <option value="fail">Fail</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="manager"><h4>Partner Completing Check</h4></label>
                        <select class="form-control" id="manager" name="manager">
                        
                            <!-- populate the drop down list with Partners allowed to do rotation spot checks -->
                        <?php
                    
                        $query = "SELECT * FROM `partners` WHERE `canrotationcheck` = '1' ORDER BY `firstname`";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)){

                            // if the option is the logged in user, preselect it
                            if($row['employee'] == $_SESSION['userData']['employee']){
                                
                                echo '<option value="'.$row['employee'].'" selected="selected">'.$row['firstname'].' '.$row['surname'].'</option>';
                                
                            } else {
                            
                            echo '<option value="'.$row['employee'].'">'.$row['firstname'].' '.$row['surname'].'</option>';
                                
                            }
                        }
                    
                        ?>
                        </select>


                    </div>

                    <button type="submit" class="btn btn-primary">Add Result</button>

                </form>
            </div>

            <?php
                
            include 'footer.php';

        ?>



    </div>
</body>

</html>
