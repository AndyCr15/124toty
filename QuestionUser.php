<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class QuestionUser {
    
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
        $this->pass = countQuestionPasses($userData['employee']);
        $this->fail = countQuestionFails($userData['employee']);
        $this->percentage = questionPassPercentage($userData['employee']);
        
    }    
    
}
?>
