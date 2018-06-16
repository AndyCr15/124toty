<?php include 'session.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';
include 'connection.php';

// check if we should auto log the user in due to a cookie or session
if (isset($_COOKIE['id'])) {
    
    $query = "SELECT * FROM `partners` WHERE `employee` = '".$_COOKIE['id']."'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    
    //Storing user data into session
    $_SESSION['userData'] = $row;
    
    ?>
    <script type="text/javascript">
        location.href = 'index.php';

    </script>
    <?php  
    }

if(isset($_GET['code'])){
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}



if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
    //Get user profile data from google
    $gpUserProfile = $google_oauthV2->userinfo->get();    
    
    //Initialize User class
    $user = new User();
    
    //Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'firstname'    => $gpUserProfile['given_name'],
        'lastname'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'picture'       => $gpUserProfile['picture'],
        'employee'      => substr($gpUserProfile['email'],0,8)
    );
        
    $userData = $user->checkUser($gpUserData);
    //$userData = $gpUserData;
    
    //echo 'User Data';
    //echo '<pre>', var_dump($userData), '</pre>';
    
    //Storing user data into session
    $_SESSION['userData'] = $userData;

    //set cookie to enable autologin
    setcookie("id", $_SESSION['userData']['employee'], time() + 60*60*24*10);

    ?>

    <div class="fullScreen">

        <?php 
    
    //Render Google profile data
    if(!empty($userData)){
        //echo 'Session Date';
        //echo '<pre>', var_dump($_SESSION['userData']), '</pre>';
        ?>
        <script type="text/javascript">
            location.href = 'index.php';

        </script>
        <?php
    } else {
        
        echo '<h3 style="color:red">Sorry, you need to be logged in with your work Google account to use this app. <a href="login.php?logout=1">Click here.</a></h3>';
        
    }
} else {
    include 'header.php';
    
    $authUrl = $gClient->createAuthUrl();
    echo '<div class="centerEverything">';
    echo '<a  href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
    echo '</div>';
    
}

include ('footer.php');

?>

    </div>
