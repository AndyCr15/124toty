<?php

// check and build notifications for the index page

$stockNotiLimit = 7; // amount of days required for a stock warning to show
$deadNotiLimit = 3; // amount of days required for a deadline warning to show
$handNotiLimit = 12; // amount of hours required for a handover to show
$foodNotiLimit = 4; // number of days since a food safety check for noti

$notifications = array(); // to hold the alert
$notiLevel = array(); // this will set the class of the alert

include 'connection.php';

// Check if on duty, if so show what should be done this hour
if(isDutyNow($_SESSION['userData']['employee'])){

    array_push($notifications , '<a href="floormanager.php">You\'re Duty!</a>');
    array_push($notiLevel, 'success');

    $dutyquery =    "SELECT
                        task
                    FROM floormanagertasks
                    WHERE (starthour <= ".currentHour()."
                    AND endhour > ".currentHour().")";
    $dutyresult = mysqli_query($link, $dutyquery);

    if (!$dutyresult) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }

    while($dutyrow = mysqli_fetch_array($dutyresult)){
        array_push($notifications , '<a href="floormanager.php">Floor Manager : '.$dutyrow['task'].'</a>');
        array_push($notiLevel, 'success');
    }
}


// look for sick calls not recorded on PartnerLink
$rtwquery = "SELECT id FROM `sickness` WHERE (`manager`='".$_SESSION['userData']['employee']."' AND `actioned`='0') LIMIT 1";
$rtwresult = mysqli_query($link, $rtwquery);

if (!$rtwresult) {
    printf("Error: %s\n", mysqli_error($link));
    exit();
}

if(mysqli_num_rows($rtwresult) > 0){
    array_push($notifications , '<a href="viewsickcalls.php">Record all sick calls in PartnerLink.</a>');
    array_push($notiLevel, 'warning');
}

// show a handover if there's been one in the last 12 hours and user is TL or above
if($_SESSION['userData']['canrotationcheck'] == 1) {

    $handquery = "SELECT * FROM `handovers` ORDER BY `id` DESC LIMIT 1";
    $handresult = mysqli_query($link, $handquery);
    if (!$handresult) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }

    while($handrow = mysqli_fetch_array($handresult)){
        if(strtotime($handrow['time']) > strtotime('-'.$handNotiLimit.' HOURS') ){

            array_push($notifications , '<a href="viewhandovers.php">Recent Handover by : '.checkPartnerFirstName($handrow['employee']).'</a>');
            array_push($notiLevel, 'info');

        }
    }
}

// check stock watch for any notifications
$stockquery = "SELECT * FROM `stockwatch` ORDER BY `date` ASC LIMIT 5";
$stockresult = mysqli_query($link, $stockquery);

if (!$stockresult) {
    printf("Error: %s\n", mysqli_error($link));
    exit();
}
while($stockrow = mysqli_fetch_array($stockresult)){

    // check if it's within $stockNotiLimit days
    if( strtotime($stockrow['date']) < strtotime('TODAY +'.$stockNotiLimit.' DAYS') ){
        array_push($notifications , '<a href="viewstockwatch.php">Stock Watch [Expiring Soon] : '.$stockrow['product'].'  -  '.showDate($stockrow['date']).'</a>');
        $level = 'warning';
        // turn it red if it's really close
        if( strtotime($stockrow['date']) < strtotime('TODAY +'.($stockNotiLimit/2).' DAYS') ){
            $level = 'danger';
        }
        array_push($notiLevel, $level);
    }
}


// check deadlines for any notifications, only if user is a manager
if($_SESSION['userData']['level'] < 10){
    $deadquery = "SELECT * FROM `deadlines` ORDER BY `date` ASC LIMIT 5";
    $deadresult = mysqli_query($link, $deadquery);

    if (!$deadresult) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    while($deadrow = mysqli_fetch_array($deadresult)){

        // check if it's within $stockNotiLimit days
        if( strtotime($deadrow['date']) < strtotime('TODAY +'.$deadNotiLimit.' DAYS') ){
            array_push($notifications , '<a href="viewdeadlines.php">Deadline : '.$deadrow['task'].'  -  '.showDate($deadrow['date']).'</a>');
            $level = 'warning';
            // turn it red if it's really close
            if( strtotime($deadrow['date']) < strtotime('TODAY +'.($deadNotiLimit/2).' DAYS') ){
                $level = 'danger';
            }
            array_push($notiLevel, $level);
        }
    }
}

// check bridge cover to see if this user is doing any

$bridgeQuery = "SELECT * FROM `bridge` WHERE `manager`='".$_SESSION['userData']['employee']."'";
$bridgeResult = mysqli_query($link, $bridgeQuery);

if (!$bridgeResult) {
    printf("Error: %s\n", mysqli_error($link));
    exit();
}

$bridgeCover = '';
while($bridgeRow = mysqli_fetch_array($bridgeResult)){
    $time = $slots[$bridgeRow['slot']].', ';

    if(substr($bridgeCover, -7, 5) == substr($time,0,5)){
        // this means the end of the last slot is the same as the start of the next slot
        $bridgeCover = substr($bridgeCover, 0, -7);
        $time = substr($time, 8);
    }
    
    if(((substr($time, -7, 2) + 0.25) < (currentHour() + (currentMinute()/60))) && (substr($time, -5, 3) != 'End')){
        // this means the current time is past the end of the slot we're checking, so don't add it.
        // also a check the final time is not 'End' otherwise the last slot will never show up
        $time = '';
    }
    $bridgeCover .= $time;
    
}

if(strlen($bridgeCover) > 0){
    array_push($notifications , '<a href="bridgecover.php">You Have Bridge Cover : '.substr($bridgeCover, 0, -2).'</a>');
    $level = 'info';
    array_push($notiLevel, $level);
}

// check how long ago Food Safety checks where done

$foodquery = "SELECT `time` FROM `foodsafetychecks` ORDER BY `time` DESC LIMIT 1";
$foodresult = mysqli_query($link, $foodquery);

if (!$foodresult) {
    printf("Error: %s\n", mysqli_error($link));
    exit();
}

$rowCount = $foodresult->num_rows;

if($rowCount > 0){

    $foodrow = mysqli_fetch_array($foodresult);

    debug_to_console('foodrow: '.strtotime($foodrow['time']));
    debug_to_console('Checking against: '.strtotime('TODAY -'.$foodNotiLimit.' DAYS'));

    // check how long ago it was
    $now = time(); // or your date as well
    $your_date = strtotime($foodrow['time']);
    $datediff = (round(($now - $your_date) / (60 * 60 * 24)));
    
    debug_to_console($datediff);

    // check if it's within $stockNotiLimit days
    if( strtotime($foodrow['time']) < strtotime('TODAY -'.$foodNotiLimit.' DAYS') ){
        array_push($notifications , '<a href="recordfoodsafetychecks.php">Food safety checks need doing, not done since : '.$deadrow['task'].'  -  '.showDate($foodrow['time']).'</a>');
        $level = 'warning';
        
        if($datediff > ($foodNotiLimit*2)){
            $level = 'danger';
        }
        array_push($notiLevel, $level);
    }
} else {
    // no checks have been found
    array_push($notifications , '<a href="viewfoodsafetychecks.php">No Food safety checks have been done.</a>');
    $level = 'danger';
    array_push($notiLevel, $level);
}

?>
