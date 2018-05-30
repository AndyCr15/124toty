<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class UniformCheckUser {
    
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
        $this->pass = countUniformCheckPasses($userData['employee']);
        $this->fail = countUniformCheckFails($userData['employee']);
        $this->percentage = uniformCheckPassPercentage($userData['employee']);
        
    }    
    
}
?>
