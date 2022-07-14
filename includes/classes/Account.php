<?php
class Account {

    private $con;
    private $errorArray = array();


    public function __construct($con) {
        session_start();
        $this->con = $con;
    }

    public function register($fn, $ln, $un, $em, $em2, $pw, $pw2) {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUsername($un);
        
    }    

    private function validateFirstName($fn) {
        if(strlen($fn) < 2 || strlen($fn) > 25) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
            
        }
    }

    private function validateLastName($ln) {
        if(strlen($ln) < 2 || strlen($ln) > 25) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
            
        }
    }

    private function validateUserName($un) {
        if(strlen($un) < 4 || strlen($un) > 25) {
            array_push($this->errorArray, Constants::$usernameCharacters); 
            return;           
        }

        $query = $this->con->prepare("SELECT username FROM users WHERE username=:un");
        $query->bindValue(":un", $un);
        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
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