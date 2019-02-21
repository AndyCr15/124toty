<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once 'connection.php';
    include 'functions.php';
    include 'header.php';
    include 'checkteamleader.php';
    
    ?>

</head>

<body>

    <div class="bg">

        <?php
        
        include ('navback.php');
        
        ?>

            <div class="container">

                <div class="row">

                    <?php
    
                    if(isset($_GET['employeenumber'])){
                        $employee = $_GET['employeenumber'];
                    }
                    debug_to_console('Employee :'.$employee);

                    $query = "SELECT * FROM `partners` WHERE `employee` = '".$employee."'";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    $row = mysqli_fetch_array($result);

                    echo '<div class="col-12">';

                    echo '<div class="'.strtolower($row['team']).'Background">';

                    echo $row['firstname'].' '.$row['surname'].' ('.$row['employee'].')';
                    

                    if(($_SESSION['userData']['level'] < 10) AND ($row['picture']!='')){
                        echo '<font size="1"><a href="'.$row['picture'].'" target="_blank"> <img src="images/picture.png" alt="Partner Photo"></a></font>';
                        }
                    
                    if($_SESSION['userData']['level'] < 9){
                    echo '<font size="1"><a href="addpartner.php?employee='.$row['employee'].'"><img src="images/edit.png" alt="Edit Partner"></a></font>';
                    }


                    echo '</div>';    
                    echo '</div>';
                        

                    //if TL or above and this Partner has a phone number, show the details
                    if(canCheck($_SESSION['userData']['employee'])){
                        
                        $phone = $row['phone'];
                        $reg =  $row['carreg'];
                        
                        /* removed due to GDPR concerns
                        // if they have a phone number, show it. Otherwise link to page to add details.
                        if($row['phone'] == ""){
                            
                            echo '<div class="col-sm-4">';
                            echo '<div class="lightGreenBox click">';
                            echo '<a href="enterphone.php?employeenumber='.$employee.'">Enter Phone Number</a>';
                            echo '</div>';
                            echo '</div>';
                            
                        } else {
                            
                            echo '<div class="col-sm-4">';
                            echo '<div class="lightGreenBox click">';
                            echo 'Phone No. : '.$row['phone'];
                            echo '</div>';
                            echo '</div>';
                        
                        }
                        
                        // if they have a email address, show it. Otherwise link to page to add details.
                        if($row['email'] == ""){

                            echo '<div class="col-sm-4">';
                            echo '<div class="lightGreenBox click">';
                            echo '<a href="enteremail.php?employeenumber='.$employee.'">Enter Email Address</a>';
                            echo '</div>';
                            echo '</div>';
                            
                        } else {
                            
                            echo '<div class="col-sm-4">';
                            echo '<div class="lightGreenBox click">';
                            echo '<a href="mailto:'.$row['email'].'">Email Partner</a>';
                            echo '</div>';
                            echo '</div>';
                        
                        }
                        */

                        if($row['carreg'] == ""){
                            
                            echo '<div class="col-sm-6">';
                            echo '<div class="whiteBackground click">';
                            echo '<a href="entercarreg.php?employeenumber='.$employee.'">Enter Car Registration</a>';
                            echo '</div>';
                            echo '</div>';
                            
                        } else {
                            
                            echo '<div class="col-sm-6">';
                            echo '<div class="'.strtolower($row['team']).'Background click">';
                            echo 'Car Reg : '.$row['carreg'];
                            echo '</div>';
                            echo '</div>';
                        
                        }

                        // show white background if not signed up, team colour if they are
                        if($row['hasphoto'] == "0"){

                            echo '<div class="col-sm-6">';
                            echo '<div class="whiteBackground click">';
                            echo '<a href="togglesignedup.php?employee='.$row['employee'].'&completed=1&db=hasphoto&source='.$row['employee'].'">Needs Wall Photo</a>';
                            echo '</div>';
                            echo '</div>';
                            
                        } else {
                            
                            echo '<div class="col-sm-6">';
                            echo '<div class="'.strtolower($row['team']).'Background click">';
                            echo '<a href="togglesignedup.php?employee='.$row['employee'].'&completed=0&db=hasphoto&source='.$row['employee'].'">Has Wall Photo</a>';
                            echo '</div>';
                            echo '</div>';
                        
                        }

                        if($row['hasfacebook'] == "0"){

                            echo '<div class="col-sm-6">';
                            echo '<div class="whiteBackground click">';
                            echo '<a href="togglesignedup.php?employee='.$row['employee'].'&completed=1&db=hasfacebook&source='.$row['employee'].'">Not on Facebook</a>';
                            echo '</div>';
                            echo '</div>';
                            
                        } else {
                            
                            echo '<div class="col-sm-6">';
                            echo '<div class="'.strtolower($row['team']).'Background click">';
                            echo '<a href="togglesignedup.php?employee='.$row['employee'].'&completed=0&db=hasfacebook&source='.$row['employee'].'">On Facebook</a>';
                            echo '</div>';
                            echo '</div>';
                        
                        }

                        if($row['hasgoogle'] == "0"){

                            echo '<div class="col-sm-6">';
                            echo '<div class="whiteBackground click">';
                            echo '<a href="togglesignedup.php?employee='.$row['employee'].'&completed=1&db=hasgoogle&source='.$row['employee'].'">Not on Google</a>';
                            echo '</div>';
                            echo '</div>';
                            
                        } else {
                            
                            echo '<div class="col-sm-6">';
                            echo '<div class="'.strtolower($row['team']).'Background click">';
                            echo '<a href="togglesignedup.php?employee='.$row['employee'].'&completed=0&db=hasgoogle&source='.$row['employee'].'"> On Google</a>';
                            echo '</div>';
                            echo '</div>';
                        
                        }
                    }

                    echo '<div class="col-sm-4">';
                    echo '<div class="whiteBackground">';
                    echo '<strong>Partner Checks</strong><br>';
                    echo 'Passes: '.countRotationPasses($employee).'  Fails: '.countRotationFails($employee).'<br>';
                    echo 'Percentage: '.rotationPassPercentage($employee).'%';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="col-sm-4">';
                    echo '<div class="whiteBackground">';
                    echo '<strong>Observations</strong><br>';
                    echo 'Passes: '.countObservationPasses($employee).'  Fails: '.countObservationFails($employee).'<br>';
                    echo 'Percentage: '.observationPassPercentage($employee).'%';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="col-sm-4">';
                    echo '<div class="whiteBackground">';
                    echo '<strong>Question Checks</strong><br>';
                    echo 'Passes: '.countQuestionPasses($employee).'  Fails: '.countQuestionFails($employee).'<br>';
                    echo 'Percentage: '.questionPassPercentage($employee).'%';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="col-sm-4">';
                    echo '<div class="whiteBackground">';
                    echo '<strong>Uniform Checks</strong><br>';
                    echo 'Passes: '.countUniformCheckPasses($employee).'  Fails: '.countUniformCheckFails($employee).'<br>';
                    echo 'Percentage: '.uniformCheckPassPercentage($employee).'%';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="col-sm-4">';
                    echo '<div class="whiteBackground">';
                    echo '<strong>Partner Searches</strong><br>';
                    echo 'Passes: '.countBagCheckPasses($employee).'  Fails: '.countBagCheckFails($employee).'<br>';
                    echo 'Percentage: '.bagCheckPassPercentage($employee).'%';
                    echo '</div>';
                    echo '</div>';

//admins can see when the user last logged in
if($_SESSION['userData']['admin'] == "1"){
    //admin is viewing Partner details
    if($row['lastvisit'] != ""){
        // only show if they've ever logged in
        echo '<div class="col-4">';
        echo '<div class="whiteBackground">';
        echo '<strong>Last Logged in: </strong>'.$row['lastvisit'];
        echo '</div>';
        echo '</div>';
    }
}

                    ?>


                        <?php
                    
                    if(canCheck($_SESSION['userData']['employee'])){

                        echo '<div class="col-12">';
                        echo '<h4>Record</h4>';
                        echo '</div>';

                        if($_SESSION['userData']['canrotationcheck'] == 1) {
                            ?>
                
                            <div class="topBottom col-sm-6 col-lg-4">
                
                                <a href="addrotationcheck.php?employee=<?php echo $employee ?>" class="btn btn-light btn-block btn-lg" role="button">Partner Check</a>
                
                            </div>

                            <div class="topBottom col-sm-6 col-lg-4">

                                <a href="addobservation.php?employee=<?php echo $employee ?>" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Observation</a>

                            </div>
                
                            <div class="topBottom col-sm-6 col-lg-4">
                
                                <a href="questioncategory.php?employee=<?php echo $employee ?>" class="btn btn-light btn-block btn-lg" role="button">Ask Question</a>
                
                            </div>
                
                            <?php
                            }
                                    
                            if($_SESSION['userData']['canbagcheck'] == 1) {
                            ?>
                
                            <div class="topBottom col-sm-6 col-lg-4">
                
                                <a href="addbagcheck.php?employee=<?php echo $employee ?>" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Partner Search</a>
                
                            </div>
                
                            <?php
                            }
                                    
                            if($_SESSION['userData']['canuniformcheck'] == 1) {
                            ?>
                
                            <div class="topBottom col-sm-6 col-lg-4">
                
                                <a href="adduniformcheck.php?employee=<?php echo $employee ?>" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Uniform Check</a>
                
                            </div>
                
                            <?php
                            }

                    }


                    if($_SESSION['userData']['level'] < 10){
                        // managers only
                        ?>
                        <div class="topBottom col-sm-6 col-lg-4">
            
                            <a href="addsickcall.php?employee=<?php echo $employee ?>" class="btn btn-light btn-block btn-lg" role="button" aria-pressed="true">Called Sick</a>
            
                        </div>
                        <?php

                        $discussionText = array();

                        echo '<div class="col-12">';
                        echo '<h4>Discussions</h4>';
                        echo '</div>';
                        
                        $query = "SELECT * FROM `rotationchecks` WHERE `partner` = '".$employee."'";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)) {

                            if($row['discussion'] != "") {

                                $admin = '';
                                ?>

                                <script>
                                function confirmDeleteCheck(item) {
                                    var conf = confirm("Delete this item forever?");
                                    if (conf){
                                        console.log("Confirmed");
                                        window.location.replace("processrotationcheck.php?remove=" + item);
                                    } else {
                                        console.log("Denied");
                                    }
                                }
                                </script>
                                
                                <?php
                                if(isAdmin()){
                                    $admin = "<button type='button' class='btn btn-danger btn-sm buttonRight' onclick='confirmDeleteCheck(".$row['id'].")'>Delete</button>";
                                }

                                $discussionText[] = $row['time'].' ['.strtoupper($row['type']).'] '.$row['discussion'].' <br>('.checkPartnerName($row['manager']).') '.$admin;
                                
                            }

                        }

                        $query = "SELECT * FROM `questionchecks` WHERE `partner` = '".$employee."'";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)) {

                            if($row['discussion'] != "") {

                                $discussionText[] = $row['time'].' [FAILED QUESTION] '.$row['discussion'].' <br>('.checkPartnerName($row['manager']).')';
                                
                            }

                        }
                        
                        $query = "SELECT * FROM `uniformchecks` WHERE `partner` = '".$employee."'";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)) {

                            if(($row['discussion'] != "") || ($row['result']) == 'fail') {

                                $admin = '';
                                ?>

                                <script>
                                function confirmDeleteUni(item) {
                                    var conf = confirm("Delete this item forever?");
                                    if (conf){
                                        console.log("Confirmed");
                                        window.location.replace("processuniformcheck.php?remove=" + item);
                                    } else {
                                        console.log("Denied");
                                    }
                                }
                                </script>
                                
                                <?php
                                if(isAdmin()){
                                    $admin = "<button type='button' class='btn btn-danger btn-sm buttonRight' onclick='confirmDeleteUni(".$row['id'].")'>Delete</button>";
                                }

                                $discussionText[] = $row['time'].' [UNIFORM ('.strtoupper($row['result']).')] '.$row['discussion'].' <br>('.checkPartnerName($row['manager']).') '.$admin;

                            }

                        }
                        
                        $query = "SELECT * FROM `bagchecks` WHERE `partner` = '".$employee."'";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)) {

                            if($row['discussion'] != "") {

                                $discussionText[] = $row['time'].' [SEARCH] '.$row['discussion'].' <br>('.checkPartnerName($row['manager']).')';

                            }

                        }
                        
                        $query = "SELECT * FROM `diarynotes` WHERE `partner` = '".$employee."'";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)) {

                            if(($row['discussion'] != "") || ($row['agreement'])) {

                                $discussionText[] = $row['time'].' [DIARY NOTE] '.$row['discussion'].' <br>[AGREEMENT] '.$row['agreement'].'<br>('.checkPartnerName($row['manager']).')';

                            }

                        }

                        $query = "SELECT * FROM `observations` WHERE `partner` = '".$employee."'";
                        $result = mysqli_query($link, $query);
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        while($row = mysqli_fetch_array($result)) {

                            if(($row['discussion'] != "") || ($row['result']) == 'fail') {

                                $discussionText[] = $row['time'].' [OBSERVATION - '.strtoupper($row['area']).' ('.strtoupper($row['result']).')] '.$row['discussion'].' <br>('.checkPartnerName($row['manager']).')';

                            }

                        }
                        
                        //sort the array based on date
                        usort($discussionText, 'my_comparison_reverse_date');
                        
                        echo '<div class="col-12">';
                        for($i=0 ; $i < sizeof($discussionText) ; $i++){
                            
                            // change the date to a friendly format
                            $thisDate = substr($discussionText[$i], 0, 10);
                            $thisText = substr($discussionText[$i], 19);
                            $output = showDate($thisDate).$thisText;
                            
                            echo '<div>';
                            echo '<h6>'.$output.'</h6>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }
                
                    $query = "SELECT * FROM `partners` WHERE `employee` = '".$employee."'";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                    $row = mysqli_fetch_array($result);
                    
                if(($row['canrotationcheck'] + $row['canuniformcheck'] + $row['canbagcheck']) > 0){
                debug_to_console('can check stuff');
                
                    ?>
                            <div class="col-12">
                                <h4>Checks Done</h4>
                            </div>

                            <?php
                
                if($row['canrotationcheck']>0){
                    echo '<div class="col-sm-4">';
                    echo '<div class="whiteBackground">';
                    echo '<strong>Rotation Checks : </strong>'.countChecksDone($employee,'rotationchecks');
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="col-sm-4">';
                    echo '<div class="whiteBackground">';
                    echo '<strong>Observations : </strong>'.countChecksDone($employee,'observations');
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="col-sm-4">';
                    echo '<div class="whiteBackground">';
                    echo '<strong>Questions Asked : </strong>'.countChecksDone($employee,'questionchecks');
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="col-sm-4">';
                    echo '<div class="whiteBackground">';
                    echo '<strong>Food Safety Checks : </strong>'.countChecksDone($employee,'foodsafetychecks');
                    echo '</div>';
                    echo '</div>';
                }
                if($row['canuniformcheck']>0){
                    echo '<div class="col-sm-4">';
                    echo '<div class="whiteBackground">';
                    echo '<strong>Uniform Checks : </strong>'.countChecksDone($employee,'uniformchecks');
                    echo '</div>';
                    echo '</div>';
                }
                if($row['canbagcheck']>0){
                    echo '<div class="col-sm-4">';
                    echo '<div class="whiteBackground">';
                    echo '<strong>Partner Searches : </strong>'.countChecksDone($employee,'bagchecks');
                    echo '</div>';
                    echo '</div>';
                }
                    
                }    
  
            ?>

                </div>
            </div>
    </div>
    <?php
                
            include 'footer.php';

        ?>
</body>

</html>
