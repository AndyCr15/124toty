<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class RotationUser {
    
    var $firstname;
    var $surname;
    var $employee;
    var $rotationPass;
    var $rotationFail;
    var $rotationPercentage;
    
    function __construct($userData = array()){
      
        $this->firstname = $userData['firstname'];
        $this->surname = $userData['surname'];
        $this->employee = $userData['employee'];
        $this->pass = countRotationPasses($userData['employee']);
        $this->fail = countRotationFails($userData['employee']);
        $this->percentage = rotationPassPercentage($userData['employee']);
        
    }    
    
}
?>
