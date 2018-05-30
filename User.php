<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class User {
    private $dbHost     = "localhost";
    private $dbUsername = "androida_andyc";
    private $dbPassword = "mYsqlp4ss.";
    private $dbName     = "androida_toty";
    private $userTbl    = 'partners';
    
    function __construct(){
      
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
    
    function checkUser($userData = array()){
        
        if(!empty($userData)){
            $empNum = substr($userData['email'],0,8);
            //Check whether user data already exists in database
            $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE employee = '".$empNum."'";
            $prevResult = $this->db->query($prevQuery);
            
            if($prevResult->num_rows > 0 && strpos($userData['email'],"@waitrose.co.uk")){
                
                //Get user data from the database
                $result = $this->db->query($prevQuery);
                $userData = $result->fetch_assoc();

                //Return user data
                return $userData;
                
             } else if($userData['email'] == "andycr15@gmail.com") {
                
                // While I can't log in with my phone on my work account, sent personal to be admin
                $userData['employee'] = 76630137;
                $userData['admin'] = 1;
                $userData['level'] = 7;
                $userData['canuniformcheck'] = 1;
                $userData['canbagcheck'] = 1;
                $userData['canrotationcheck'] = 1;
                
                return $userData;
            
                
            } else {
                
                return null;
                
            }
            
        }
        
    }
    
    
}
?>
