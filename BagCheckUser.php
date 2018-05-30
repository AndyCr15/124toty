<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class BagCheckUser {
    
    var $firstname;
    var $surname;
    var $employee;
    var $pass;
    var $fail;
    var $percentage;
    
    function __construct($userData = array()){
      
        $this->firstname = $userData['firstname'];
        $this->surname = $userData['surname'];
        $this->employee = $userData['employee'];
        $this->pass = countBagCheckPasses($userData['employee']);
        $this->fail = countBagCheckFails($userData['employee']);
        $this->percentage = bagCheckPassPercentage($userData['employee']);
        
    }    
    
}
?>
