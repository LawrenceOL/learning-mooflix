<?php
class Account {

    private $con;
    private $errorArray = array();


    public function __construct($con) {
        session_start();
        $this->con = $con;
    }

    public function validateFirstName($fn) {
        if(strlen($fn) < 2 || strlen($fn) > 25) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
            
        }
    }

    public function getError($error) {
        if(!in_array($error, $this->errorArray)) {
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

}


?>