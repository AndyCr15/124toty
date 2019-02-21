<?php

$slots_old = array('eight'=>'Open - 09:15','nine'=>'09:15 - 10:15','ten'=>'10:15 - 11:15','eleven'=>'11:15 - 12:15','twelve'=>'12:15 - 13:15','thirteen'=>'13:15 - 14:15','fourteen'=>'14:15 - 15:15','fifteen'=>'15:15 - 16:15','sixteen'=>'16:15 - 17:15','seventeen'=>'17:15 - 18:15','eighteen'=>'18:15 - 19:15','nineteen'=>'19:15 - End');
$slots = array('eight'=>'07:30 - 10:30','nine'=>'10:30 - 13:15','ten'=>'13:15 - 15:30','eleven'=>'15:30 - 18:00','twelve'=>'18:00 - 21:00');

function check_in_date_range($start_date, $end_date, $date_from_user) {
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

function isManager(){
    return($_SESSION['userData']['level'] < 10);
}

function showUser($userData = array()){

    if(!empty($userData)){
        echo '<div class="col-sm-6 col-lg-4">';
        echo '<div class="'.strtolower($userData['team']).'Background click">';
        echo '<a href="partnerdetails.php?employeenumber='.$userData['employee'].'">';
        echo $userData['firstname'].' '.$userData['surname'].' ('.$userData['employee'].')';
        echo '</a>';
        echo '</div>';
        echo '</div>';
        
    }

}

function showEmployee($employee, $data){

    echo '<div class="col-sm-6 col-lg-4">';
    echo '<div class="'.strtolower(checkTeam($employee)).'Background click">';
    echo '<a href="partnerdetails.php?employeenumber='.$employee.'">';
    echo checkPartnerName($employee).' ('.$data.')';
    echo '</a>';
    echo '</div>';
    echo '</div>';
    
}

function showPartnerAndCount($employee, $count){
    echo '<div class="col-sm-6 col-lg-4">';
    echo '<div class="'.strtolower(checkTeam($employee)).'Background click">';
    echo '<a href="partnerdetails.php?employeenumber='.$employee.'">';
    echo checkPartnerName($employee).' ('.$count.')';
    echo '</a>';
    echo '</div>';
    echo '</div>';
}

function ordinal_suffix($num){
    $num = $num % 100; // protect against large numbers
    if($num < 11 || $num > 13){
         switch($num % 10){
            case 1: return 'st';
            case 2: return 'nd';
            case 3: return 'rd';
        }
    }
    return 'th';
}

function showSick($sickData = array()){

    if($sickData['actioned'] == 0){
        $done = '[<font color="grey"> Notification of Absence Done </font>]';
    } else {
        $done = '[<font color="grey"> Record RTW Done </font>]';
    }

    echo '<div class="col-sm-6 col-lg-4">';
    echo '<div class="'.strtolower(checkTeam($sickData['partner'])).'Background click">';
    echo checkPartnerName($sickData['partner']).' ('.niceDateTime($sickData['time']).')';
    //echo '<br>'.$sickData['reason'].' - '.$sickData['discussion'];
    ?>
    <a href="processsickcall.php?actioned=<?php echo $sickData['actioned']+1; ?>&id=<?php echo $sickData['id'] ?>" onclick="return confirm('Has this been done?')">
    <?php
    echo $done;
    echo '</a>';
    echo '</div>';
    echo '</div>';
}

function canCheck($employee){

    $canCheck = false;
    include 'connection.php';
    $checkQuery = "SELECT * FROM `partners` WHERE `employee` = '".$employee."'";
    $checkResult = mysqli_query($link, $checkQuery);
    if (!$checkResult) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $checkRow = mysqli_fetch_array($checkResult);

    if($checkRow['canrotationcheck'] == 1){
        $canCheck = true;
    }

    if($checkRow['canuniformcheck'] == 1){
        $canCheck = true;
    }

    if($checkRow['level'] < 10){
        $canCheck = true;
    }

    return $canCheck;

}

function showScore($employee, $score){

            echo '<div class="col-sm-6 col-lg-4">';
            echo '<div class="'.strtolower(checkTeam($employee)).'Background click">';
            echo '<a href="partnerdetails.php?employeenumber='.$employee.'">';
            echo checkPartnerName($employee).' - '.$score;
            echo '</a>';
            echo '</div>';
            echo '</div>';
        
    }


    function checkArea($area){
    include 'connection.php';
    $areaQuery = "SELECT * FROM `areas` WHERE `id` = '".$area."'";
    $areaResult = mysqli_query($link, $areaQuery);
    if (!$areaResult) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $areaRow = mysqli_fetch_array($areaResult);

    return $areaRow['name'];
}

function checkPartnerName($employeeNumber){
    include 'connection.php';
    $checkQuery = "SELECT * FROM `partners` WHERE `employee` = '".$employeeNumber."'";
    $checkResult = mysqli_query($link, $checkQuery);
    if (!$checkResult) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $checkRow = mysqli_fetch_array($checkResult);

    return $checkRow['firstname']." ".$checkRow['surname'];
    
}

function checkPartnerFirstName($employeeNumber){
    include 'connection.php';
    $checkQuery = "SELECT * FROM `partners` WHERE `employee` = '".$employeeNumber."'";
    $checkResult = mysqli_query($link, $checkQuery);
    if (!$checkResult) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $checkRow = mysqli_fetch_array($checkResult);
    $name = $checkRow['firstname'];
    $initial = substr($checkRow['surname'],0,1);
    // check how many people with this first name and add first letter of surname if more than one.
    $firstQuery = "SELECT * FROM `partners` WHERE `firstname` = '".$name."'";
    $firstResult = mysqli_query($link, $firstQuery);
    if (!$checkResult) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $rowCount = $firstResult->num_rows;
    if($rowCount > 1){
        $name = $name.' '.$initial;
    }

    return $name;
    
}

function checkPartnerEmail($employeeNumber){
    include 'connection.php';
    $checkQuery = "SELECT * FROM `partners` WHERE `employee` = '".$employeeNumber."'";
    $checkResult = mysqli_query($link, $checkQuery);
    if (!$checkResult) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $checkRow = mysqli_fetch_array($checkResult);

    return $checkRow['email'];
    
}

function countChecksDone ($employeeNumber, $table){
    include 'connection.php';
    $query = "SELECT * FROM `".$table."` WHERE `manager` = '".$employeeNumber."' AND (time BETWEEN NOW() - INTERVAL 3 MONTH AND NOW())";
    $result = mysqli_query($link, $query);
    return mysqli_num_rows($result);
}

function countRotationPasses($employeeNumber){
    include 'connection.php';
    $query = "SELECT * FROM `rotationchecks` WHERE `partner` = '".$employeeNumber."' AND (time BETWEEN NOW() - INTERVAL 3 MONTH AND NOW())";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $passes = 0;
    while($row = mysqli_fetch_array($result)){

        if($row['result'] == "pass"){
            $passes += 1;
        }

    }

    return $passes;
    
}

function countRotationFails($employeeNumber){
    include 'connection.php';
    $query = "SELECT * FROM `rotationchecks` WHERE `partner` = '".$employeeNumber."' AND (time BETWEEN NOW() - INTERVAL 3 MONTH AND NOW())";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $fails = 0;
    while($row = mysqli_fetch_array($result)){

        if($row['result'] == "fail"){
            $fails += 1;
        }

    }

    return $fails;
    
}

function rotationPassPercentage($employeeNumber){
    if((countRotationPasses($employeeNumber) + countRotationFails($employeeNumber)) > 0){
    return round((countRotationPasses($employeeNumber) / (countRotationPasses($employeeNumber) + countRotationFails($employeeNumber)))*100);
    } else {
        return NULL;
    }
}

function countQuestionPasses($employeeNumber){
    include 'connection.php';
    $query = "SELECT * FROM `questionchecks` WHERE `partner` = '".$employeeNumber."'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $passes = 0;
    while($row = mysqli_fetch_array($result)){

        if($row['result'] == "pass"){
            $passes += 1;
        }

    }

    return $passes;
    
}

function countQuestionFails($employeeNumber){
    include 'connection.php';
    $query = "SELECT * FROM `questionchecks` WHERE `partner` = '".$employeeNumber."'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $fails = 0;
    while($row = mysqli_fetch_array($result)){

        if($row['result'] == "fail"){
            $fails += 1;
        }

    }

    return $fails;
    
}

function countCheckType($type, $employeeNumber){

    $count = 0;

    include 'thisweek.php';
    // we now have $startDate and $endDate being for this week

    include 'connection.php';
    $countquery = "SELECT * FROM `rotationchecks` WHERE (`manager`='".$employeeNumber."' AND `type`='".$type."')";
    $countresult = mysqli_query($link, $countquery);
    if (!$countresult) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    while($countrow = mysqli_fetch_array($countresult)){

        if(check_in_date_range($startDate, $endDate, $countrow['time'])){
            $count++;
        }

    }

    return $count;

}

function questionPassPercentage($employeeNumber){
    if((countQuestionPasses($employeeNumber) + countQuestionFails($employeeNumber)) > 0){
    return round((countQuestionPasses($employeeNumber) / (countQuestionPasses($employeeNumber) + countQuestionFails($employeeNumber)))*100);
    } else {
        return NULL;
    }
}

function countBagCheckPasses($employeeNumber){
    include 'connection.php';
    $query = "SELECT * FROM `bagchecks` WHERE `partner` = '".$employeeNumber."'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $passes = 0;
    while($row = mysqli_fetch_array($result)){

        if($row['result'] == "pass"){
            $passes += 1;
        }

    }

    return $passes;
    
}

function countBagCheckFails($employeeNumber){
    include 'connection.php';
    $query = "SELECT * FROM `bagchecks` WHERE `partner` = '".$employeeNumber."'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $fails = 0;
    while($row = mysqli_fetch_array($result)){

        if($row['result'] == "fail"){
            $fails += 1;
        }

    }

    return $fails;
    
}

function bagCheckPassPercentage($employeeNumber){
    if((countBagCheckPasses($employeeNumber) + countBagCheckFails($employeeNumber)) > 0){
    return round((countBagCheckPasses($employeeNumber) / (countBagCheckPasses($employeeNumber) + countBagCheckFails($employeeNumber)))*100);
    } else {
        return NULL;
    }
}

function countUniformCheckPasses($employeeNumber){
    include 'connection.php';
    $query = "SELECT * FROM `uniformchecks` WHERE `partner` = '".$employeeNumber."'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $passes = 0;
    while($row = mysqli_fetch_array($result)){

        if($row['result'] == "pass"){
            $passes += 1;
        }

    }

    return $passes;
    
}

function countUniformCheckFails($employeeNumber){
    include 'connection.php';
    $query = "SELECT * FROM `uniformchecks` WHERE `partner` = '".$employeeNumber."'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $fails = 0;
    while($row = mysqli_fetch_array($result)){

        if($row['result'] == "fail"){
            $fails += 1;
        }

    }

    return $fails;
    
}

function uniformCheckPassPercentage($employeeNumber){
    if((countUniformCheckPasses($employeeNumber) + countUniformCheckFails($employeeNumber)) > 0){
    return round((countUniformCheckPasses($employeeNumber) / (countUniformCheckPasses($employeeNumber) + countUniformCheckFails($employeeNumber)))*100);
    } else {
        return NULL;
    }
}

function countObservationPasses($employeeNumber){
    include 'connection.php';
    $query = "SELECT * FROM `observations` WHERE `partner` = '".$employeeNumber."'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $passes = 0;
    while($row = mysqli_fetch_array($result)){

        if($row['result'] == "pass"){
            $passes += 1;
        }

    }

    return $passes;
    
}

function countObservationFails($employeeNumber){
    include 'connection.php';
    $query = "SELECT * FROM `observations` WHERE `partner` = '".$employeeNumber."'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $fails = 0;
    while($row = mysqli_fetch_array($result)){

        if($row['result'] == "fail"){
            $fails += 1;
        }

    }

    return $fails;
    
}

function observationPassPercentage($employeeNumber){
    if((countObservationPasses($employeeNumber) + countObservationFails($employeeNumber)) > 0){
    return round((countObservationPasses($employeeNumber) / (countObservationPasses($employeeNumber) + countObservationFails($employeeNumber)))*100);
    } else {
        return NULL;
    }
}

function checkTeam($employeeNumber){
    include 'connection.php';
    $checkQuery = "SELECT * FROM `partners` WHERE `employee` = '".$employeeNumber."'";
    $checkResult = mysqli_query($link, $checkQuery);
    if (!$checkResult) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    $checkRow = mysqli_fetch_array($checkResult);

    return $checkRow['team'];
    
}

function showActivity($actData = array()){
        
    $boxColour = "whiteBackground";

    if ($actData['blue'] > $actData['red'] && 
        $actData['blue'] > $actData['yellow'] && 
        $actData['blue'] > $actData['green']) {
        $boxColour = "blueBackground";
    }
    
    if ($actData['green'] > $actData['red'] && 
            $actData['green'] > $actData['yellow'] && 
            $actData['green'] > $actData['blue']) {
            $boxColour = "greenBackground";
        }
    
    if ($actData['red'] > $actData['green'] && 
            $actData['red'] > $actData['yellow'] && 
            $actData['red'] > $actData['blue']) {
            $boxColour = "redBackground";
        }
    
    if ($actData['yellow'] > $actData['red'] && 
            $actData['yellow'] > $actData['blue'] && 
            $actData['yellow'] > $actData['green']) {
            $boxColour = "yellowBackground";
        }
    
        if(!empty($actData)){
            echo '<div class="col-sm-6 col-lg-3">';
                echo '<div class="'.$boxColour.'">';
                    echo '<p>';
                    echo '<strong>'.$actData['name'].'</strong> <br> '.$actData['description'].'<br>';
                    ?>

    <table class="acttable">
        <tr>
            <td class="showacttable blueBackground">
                <?php echo $actData['blue'] ?>
            </td>
            <td class="showacttable greenBackground">
                <?php echo $actData['green'] ?>
            </td>
        </tr>
        <tr>
            <td class="showacttable redBackground">
                <?php echo $actData['red'] ?>
            </td>
            <td class="showacttable yellowBackground">
                <?php echo $actData['yellow'] ?>
            </td>
        </tr>
    </table>

    <?php
            
                        // change back to == 1 to activate
                        if($_SESSION['userData']['admin'] == 2){
                            echo '<br>';
                        echo '<a href="processactivity.php?remove='.$actData['id'].'"><font color="grey"><i>Remove Activity</i></font></a>';
                        }
                    echo '</p>';
                echo '</div>';
            echo '</div>';
            
        }
        
    }

function showRotationCheck($checkData = array()){
        
    include 'connection.php';
    
    $partner = checkPartnerName($checkData['partner']);
    $team = strtolower(checkTeam($checkData['partner']));
    
    $manager = checkPartnerName($checkData['manager']);
    $manTeam = strtolower(checkTeam($checkData['manager']));
    
    if($checkData['result'] == 'fail'){
        // the result is a fail, so add a red border
        $team = 'fail '.$team;
    }
    
    
        if(!empty($checkData)){
            echo '<div class="col-sm-6 col-lg-4">';
                echo '<div class="'.$team.'Background click">';
                    
                    echo '<a href="partnerdetails.php?employeenumber='.$checkData['partner'].'">';
                    echo '<strong>'.$partner.'</strong> : '.strtoupper($checkData['result']);
                    if(isset($checkData['type'])) {
                        echo '<br><strong>Type</strong> : '.$checkData['type'];
                    }
                    if(isset($checkData['category'])) {
                        echo '<br><strong>Category</strong> : '.$checkData['category'];
                    }
                    echo '<br>Checked by: '.$manager.' - '.showDate($checkData['time']).'</a>';

            //if($checkData['manager'] == $_SESSION['userData']['employee']){
                //echo '<i><a href="processrotationcheck.php?remove='.$checkData['partner'].'">Remove</a></i>';
            //}
            echo '</div>';
            echo '</div>';
            
        }
        
    }

function showBagCheck($checkData = array()){
        
    $boxColour = "whiteBackground";
include 'connection.php';
    // get colour of the Partner being checked
    
    $partner = checkPartnerName($checkData['partner']);
    $team = strtolower(checkTeam($checkData['partner']));
    
    $manager = checkPartnerName($checkData['manager']);
    
    if($checkData['result'] == 'fail'){
        // the result is a fail, so add a red border
        $team = 'fail '.$team;
    }
    
        if(!empty($checkData)){
            echo '<div class="col-sm-6 col-lg-4">';
                echo '<div class="'.$team.'Background click">';
                    
                    echo '<a href="partnerdetails.php?employeenumber='.$checkData['partner'].'">';
                    echo '<strong>'.$partner.'</strong> : '.strtoupper($checkData['result']);
                    echo '<br>Checked by: '.$manager.' - '.showDate($checkData['time']).'</a>';
                    
                echo '</div>';
            echo '</div>';
            
        }
        
    }

function showDiaryNote($checkData = array()){
        
    $boxColour = "whiteBackground";
    include 'connection.php';
    // get colour of the Partner being checked
    
    $partner = checkPartnerName($checkData['partner']);
    $team = strtolower(checkTeam($checkData['partner']));
    
    $manager = checkPartnerName($checkData['manager']);
    
        if(!empty($checkData)){
            echo '<div class="col-sm-6 col-lg-4">';
                echo '<div class="'.$team.'Background click">';
                    
                    echo '<a href="partnerdetails.php?employeenumber='.$checkData['partner'].'">';
                    echo '<strong>'.$partner.'</strong><br>';
                    echo substr($checkData['discussion'],0,40).'...';
                    echo '<br>Given by: '.$manager.' - '.showDate($checkData['time']).'</a>';
                    
                echo '</div>';
            echo '</div>';
            
        }
        
    }

    function showLog($logRow = array()){
        
        $boxColour = "whiteBackground";
        include 'connection.php';        

        $manager = $logRow['manager'];

        $log = $logRow['query'];
        $time = $logRow['time'];
        
        
            if(!empty($logRow)){
                echo '<div class="col-sm-6 col-lg-4">';
                    echo '<div class="'.$boxColour.' click">';
                        
                        echo '<p>'.$time.' - '.$manager.'</p>';
                        echo '<p>'.$log.'</p>';
                        
                    echo '</div>';
                echo '</div>';
                
            }
            
        }

    function getFoodSafetyCheck($check){
    include 'connection.php';

    $safetyquery = "SELECT * FROM `foodsafetyquestions` WHERE `id` = '".$check."' ORDER BY `id` DESC LIMIT 1";
    $safetyresult = mysqli_query($link, $safetyquery);
    $safetyrow = mysqli_fetch_array($safetyresult);
    return $safetyrow['question'];

}

function showFoodSafetyCheck($checkData = array()){
    
    $boxColour = "whiteBackground";
    
    // get colour of the Partner being checked
    
    $manager = checkPartnerName($checkData['manager']);
    $team = strtolower(checkTeam($checkData['manager']));
    
    if(!empty($checkData)){
        echo '<div class="col-sm-6 col-lg-4">';
            echo '<div class="'.$team.'Background click">';
                echo '<a href="partnerdetails.php?employeenumber='.$checkData['manager'].'">';
                echo '<strong>'.$manager.'</strong><br>';
                echo substr(getFoodSafetyCheck($checkData['questionid']),0,50).'...';
                echo '<br>Checked on: '.showDate($checkData['time']).'</a>';
            echo '</div>';
        echo '</div>';
        
    }
    
}

function showCheckStats($db, $checkText, $failText, $startDate, $endDate){
    
    $blueChecks = 0;
    $blueFails = 0;

    $greenChecks = 0;
    $greenFails = 0;

    $redChecks = 0;
    $redFails = 0;

    $yellowChecks = 0;
    $yellowFails = 0;
    
    include 'connection.php';
    $query = "SELECT * FROM `".$db."`";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }

    while($row = mysqli_fetch_array($result)){

        if(check_in_date_range($startDate, $endDate, (substr($row['time'], 0, 10)))){

            if(!($db == 'uniformchecks' && $row['result'] == 'pass')){
                switch (strtolower (checkTeam($row['manager']))) {
                    case "blue":
                        $blueChecks++;
                        break;
                    case "green":
                        $greenChecks++;
                        break;
                    case "red":
                        $redChecks++;
                        break;
                    case "yellow":
                        $yellowChecks++;
                        break;
                }
            }
            
            // if fail text is sent in as zzz then we don't need fails to be shown
            if($failText != 'zzz'){

                // diary notes are the only ones that don't have a result row
                // so set it to fail, if it's not diary notes, check the actual result
                // this means all diary notes will be counted
                $thisResult = 'fail';

                if($db != 'diarynotes') {
                    $thisResult = $row['result'];
                }
                
                if($thisResult == 'fail'){

                    switch (strtolower (checkTeam($row['partner']))) {
                        case "blue":
                            $blueFails++;
                            break;
                        case "green":
                            $greenFails++;
                            break;
                        case "red":
                            $redFails++;
                            break;
                        case "yellow":
                            $yellowFails++;
                            break;
                    }
                }
            }
        }
    }

    // code showing checks done and checks failed by team

    echo '<div class="col-sm-6 col-lg-3">';
    echo '<div class="blueBackground">';
    //echo '<a href="viewpartners.php?team=Blue>';
    echo $checkText.' : '.$blueChecks;
    if($failText != 'zzz'){
        echo '<br>'.$failText.' : '.$blueFails;
    }
    //echo '</a>';
    echo '</div>';
    echo '</div>';

    echo '<div class="col-sm-6 col-lg-3">';
    echo '<div class="greenBackground">';
    //echo '<a href="viewpartners.php?team=Red>';
    echo $checkText.' : '.$greenChecks;
    if($failText != 'zzz'){
        echo '<br>'.$failText.' : '.$greenFails;
    }
    //echo '</a>';
    echo '</div>';
    echo '</div>';

    echo '<div class="col-sm-6 col-lg-3">';
    echo '<div class="redBackground">';
    //echo '<a href="viewpartners.php?team=Red>';
    echo $checkText.' : '.$redChecks;
    if($failText != 'zzz'){
        echo '<br>'.$failText.' : '.$redFails;
    }
    //echo '</a>';
    echo '</div>';
    echo '</div>';

    echo '<div class="col-sm-6 col-lg-3">';
    echo '<div class="yellowBackground">';
    //echo '<a href="viewpartners.php?team=Red>';
    echo $checkText.' : '.$yellowChecks;
    if($failText != 'zzz'){
        echo '<br>'.$failText.' : '.$yellowFails;
    }
        //echo '</a>';
    echo '</div>';
    echo '</div>';
    
}

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

function my_comparison_reverse_date($a, $b) {
    $retB = str_replace('-','',substr($b, 0, 10));
    $retA = str_replace('-','',substr($a, 0, 10));
  return ($retB - $retA);
}

function my_comparison_low($a, $b) {
    $retB = ($b->percentage*1000)-($b->fail);
    $retA = ($a->percentage*1000)-($a->fail);
  return ($retA - $retB);
}

function my_comparison_high($a, $b) {
    $retB = ($b->percentage*1000)+($b->pass);
    $retA = ($a->percentage*1000)+($a->pass);
  return ($retB - $retA);
}

function showDate ($date){
    
    $date = substr($date, 0, 10);
    
list($year, $month, $day) = explode("-", $date);

return $day.'/'.$month;    
    
}

function showTime ($date){
    
    $date = substr($date, 11, 10);
    
list($hours, $minutes, $seconds) = explode(":", $date);

return $hours.':'.$minutes;    
    
}

function logMySQL($manager, $query){
    
    include 'connection.php';
    
    $sql = "INSERT INTO `log` (manager, query) VALUES ('".checkPartnerName($manager)."','".$query."')";
        
        if ($link->query($sql) === TRUE) {
            debug_to_console("Action logged successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }
    
}

function foodSafetyStatus($questionID){
    include 'connection.php';

    $today = date('Y-m-d', time());
    debug_to_console($today);

    $foodquery = "SELECT * FROM `foodsafetychecks` WHERE `questionid` = '".$questionID."' ORDER BY `id` DESC LIMIT 1";
    $foodresult = mysqli_query($link, $foodquery);
    $rowCount = $foodresult->num_rows;
    if($rowCount < 1){
        return 0;
    }
    $foodrow = mysqli_fetch_array($foodresult);

    $thisDate = substr($foodrow['time'],0,10);

    if($thisDate == $today){
        //the last result was from today
        debug_to_console('Today! Status: '.$foodrow['status']);
        return $foodrow['status'];
    } else {
        return 0;
    }

}

function whoCompletedFoodSafety($questionID){
    include 'connection.php';

    $foodquery = "SELECT * FROM `foodsafetychecks` WHERE `questionid` = '".$questionID."' ORDER BY `id` DESC LIMIT 1";
    $foodresult = mysqli_query($link, $foodquery);
    $rowCount = $foodresult->num_rows;
    if($rowCount < 1){
        return 0;
    }
    $foodrow = mysqli_fetch_array($foodresult);
    return $foodrow['manager'];

}

function questionCorrect($questionID){
    include 'connection.php';

    $ququery = "SELECT * FROM `questionchecks` WHERE `questionid` = '".$questionID."'";
    $quresult = mysqli_query($link, $ququery);
    $rowCount = $quresult->num_rows;
    if($rowCount < 1){
        return 'na';
    }
    $passes = 0;
    while($row = mysqli_fetch_array($quresult)){

        if($row['result'] == "pass"){
            $passes += 1;
        }

    }
    return (floor(($passes / $rowCount)*100));
}

function currentHour(){
    date_default_timezone_set('Europe/London');
    return date('H', time());
}

function currentMinute(){
    date_default_timezone_set('Europe/London');
    return date('i', time());
}

function trackerActive(){
    include 'connection.php';

    $trackerQuery = "SELECT * FROM `124admin` ORDER BY `id` LIMIT 1";
    $trackerResult = mysqli_query($link, $trackerQuery);
    $trackerRow = mysqli_fetch_array($trackerResult);

    if($trackerRow['active'] == '1'){
        return true;
    } else {
        return false;
    }
    
}

function trackerName(){
    include 'connection.php';

    $trackerQuery = "SELECT * FROM `124admin` ORDER BY `id` LIMIT 1";
    $trackerResult = mysqli_query($link, $trackerQuery);
    $trackerRow = mysqli_fetch_array($trackerResult);

    return $trackerRow['currenttracker'];
    
}

function trackerLink(){
    include 'connection.php';

    $trackerQuery = "SELECT * FROM `124admin` ORDER BY `id` LIMIT 1";
    $trackerResult = mysqli_query($link, $trackerQuery);
    $trackerRow = mysqli_fetch_array($trackerResult);

    return $trackerRow['link'];
    
}

function timeDateNow(){
    date_default_timezone_set('Europe/London');
    return date("Y-m-d G:i:s");
}

function niceDateTime($time){
    return date("j F, g:i a", strtotime($time));
}

function isAdmin(){
    if($_SESSION['userData']['admin'] == 1){
        return true;
    } else {
        return false;
    }
}

function isDutyNow($employee){

    // this allows the slots array, from the top of this page, to be used in this function
    global $slots;

    // get time as a decimal
    $time = currentHour() + (currentMinute()/60);

// loop through the slots
foreach ($slots as $slotName => $slotTime){

    $slotStart = substr ( $slotTime , 0 ,2) + (substr ( $slotTime , 3 ,2))/60;
    $slotEnd = substr ( $slotTime , 8 ,2) + (substr ( $slotTime , 11 ,2))/60;    

    if($time > $slotStart && $time < $slotEnd){
        // we're on the current slot, check if the manager is the user
        
        // connect to the database and check who is duty now
        include 'connection.php';

        $query = "SELECT manager FROM `bridge` WHERE `slot` = '".$slotName."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
    
        // return true or false if the current user is the current duty manager
        debug_to_console('Slot:'.$slotName);
        if($row['manager'] == $employee){
            return true;
        } else {
            return false;
        }

    }
    
}

}

function isThisWeek($date){
    // specify the date range for 'this week'
    if(date("l") == 'Sunday'){
        // it's Sunday so 'last Sunday' would report last week, this makes it today
        $startDate = date('Y-m-d', strtotime("Today"));
    } else {
        $startDate = date('Y-m-d', strtotime("last Sunday"));
    }
    $endDate = date('Y-m-d', strtotime("next Sunday"));

    debug_to_console($date);
    debug_to_console(check_in_date_range($startDate, $endDate, $date));

    return (check_in_date_range($startDate, $endDate, $date));
}

function isLastWeek($date){
    // This calculates the last Saturday and then 6 days previous for the start of last week
    $endDate = strtotime("last Saturday");
    $startDate = strtotime('-6 day', $endDate);
    $startDate = date('Y-m-d', $startDate);
    $endDate = date('Y-m-d', $endDate);

    debug_to_console($date);
    debug_to_console(check_in_date_range($startDate, $endDate, $date));

    return (check_in_date_range($startDate, $endDate, $date));
}

function isThisMonth($date){
    
    $startDate = strtotime("first day of this month");
    $endDate = strtotime("last day of this month");
    $startDate = date('Y-m-d', $startDate);
    $endDate = date('Y-m-d', $endDate);

    debug_to_console($date);
    debug_to_console(check_in_date_range($startDate, $endDate, $date));

    return (check_in_date_range($startDate, $endDate, $date));
}

function isLastMonth($date){
    
    $startDate = strtotime("first day of last month");
    $endDate = strtotime("last day of last month");
    $startDate = date('Y-m-d', $startDate);
    $endDate = date('Y-m-d', $endDate);

    debug_to_console($date);
    debug_to_console(check_in_date_range($startDate, $endDate, $date));

    return (check_in_date_range($startDate, $endDate, $date));
}

function calculateScore($employee){
    echo $employee.'<br>';
}

function monthText($month){
    $dateObj   = DateTime::createFromFormat('!m', $month);
    return $dateObj->format('F');
}

function checkPoolLadder($employee){
    include 'connection.php';

    // if the employee isn't in the poolladder table, create them
    $poolquery = "SELECT * FROM `poolladder` WHERE `employee`='".$employee."'";
    $poolresult = mysqli_query($link, $poolquery);

    if (mysqli_num_rows($poolresult)==0) { 
        // they aren't ranked yet, create new record
        $win = "INSERT INTO `poolladder` (employee) VALUES ('".$employee."')";
        
        debug_to_console("Creating new record");

        if ($link->query($win) === TRUE) {
            debug_to_console("New employee added to pool ladder successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        } 
    }
}

function getPoolRating($employee){
    include 'connection.php';

    $winquery = "SELECT rating FROM `poolladder` WHERE `employee`='".$employee."'";
    $winresult = mysqli_query($link, $winquery);

    if (!$winresult) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    while($winresult = mysqli_fetch_array($winresult)){

        return $winresult['rating'];

    }
}

function updatePoolRating($employee, $rating){
    include 'connection.php';

    $sql = "UPDATE `poolladder` SET `rating` = '".$rating."' WHERE `employee`='".$employee."'";
    if ($link->query($sql) === TRUE) {
        debug_to_console("Rating updated successfully");        
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
}

function poolResult($winner, $loser){
    
    $winRating = getPoolRating($winner);
    $loseRating = getPoolRating($loser);
    debug_to_console("Winner :".$winRating);
    debug_to_console("Loser :".$loseRating);
    $dif = abs($winRating - $loseRating);
    if($dif > 200){
        $dif=200;
    }

    if($winRating == $loseRating){
        // two are the same rating, add 16 to winner and take 16 from loser
        $winRating += 15;
        $loseRating -= 15;

        updatePoolRating($winner, $winRating);
        updatePoolRating($loser, $loseRating);

        return;
    }

    if($winRating > $loseRating){
        // two are the same rating, add 16 to winner and take 16 from loser
        $winRating += (16 - round($dif/16));
        $loseRating -= (16 - round($dif/16));

        updatePoolRating($winner, $winRating);
        updatePoolRating($loser, $loseRating);

        return;
    
    }

    if($winRating < $loseRating){
        // two are the same rating, add 16 to winner and take 16 from loser
        $winRating += (16 + round($dif/16));
        $loseRating -= (16 + round($dif/16));

        updatePoolRating($winner, $winRating);
        updatePoolRating($loser, $loseRating);

        return;
        
    }

}

?>
