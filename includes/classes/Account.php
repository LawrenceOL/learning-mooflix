<?php
class Account
{

    private $con;
    private $errorArray = array();


    public function __construct($con)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->con = $con;
    }

    public function register($fn, $ln, $un, $em, $em2, $pw, $pw2)
    {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUsername($un);
        $this->validateEmails($em, $em2);
        $this->validatePasswords($pw, $pw2);

        if (empty($this->errorArray)) {
            //Insert into database
            return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
        } else {
            return false;
        }
    }

    public function login($un, $pw)
    {
        $pw = hash("sha512", $pw);

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");

        $query->bindValue(":un", $un);
        $query->bindValue(":pw", $pw);

        $query->execute();

        if ($query->rowCount() == 1) {
            return true;
        }
        array_push($this->errorArray, Constants::$loginFailed);
        return false;
    }

    private function insertUserDetails($fn, $ln, $un, $em, $pw)
    {

        $pw = hash("sha512", $pw);

        $query = $this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password) VALUES (:fn, :ln, :un, :em, :pw)");

        $query->bindValue(":fn", $fn);
        $query->bindValue(":ln", $ln);
        $query->bindValue(":un", $un);
        $query->bindValue(":em", $em);
        $query->bindValue(":pw", $pw);

        return $query->execute();
    }

    private function validateFirstName($fn)
    {
        if (strlen($fn) < 2 || strlen($fn) > 25) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }

    private function validateLastName($ln)
    {
        if (strlen($ln) < 2 || strlen($ln) > 25) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    private function validateUserName($un)
    {
        if (strlen($un) < 4 || strlen($un) > 25) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
        $query->bindValue(":un", $un);
        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
        }
    }

    private function validateEmails($em, $em2)
    {
        if ($em != $em2) {
            array_push($this->errorArray, Constants::$emailsDoNotMatch);
            return;
        }

        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindValue(":em", $em);
        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }
    }

    private function validateNewEmail($em, $un)
    {
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em AND username != :un");
        $query->bindValue(":em", $em);
        $query->bindValue(":un", $un);
        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }
    }

    private function validatePasswords($pw, $pw2)
    {
        if ($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDoNotMatch);
            return;
        }
        if (strlen($pw2) < 5 || strlen($pw2) > 25) {
            array_push($this->errorArray, Constants::$passwordLength);
            return;
        }
    }

    public function getError($error)
    {
        if (in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }

    public function updateDetails($fn, $ln, $em, $un)
    {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateNewEmail($em, $un);

        if (empty($this->errorArray)) {
            $query = $this->con->prepare("UPDATE users SET firstName=:fn, lastName=:ln, email=:em
                                            WHERE username=:un");
            $query->bindValue(":fn", $fn);
            $query->bindValue(":ln", $ln);
            $query->bindValue(":em", $em);
            $query->bindValue(":un", $un);

            return $query->execute();
        }

        return false;
    }

    public function getFirstError()
    {
        if (!empty($this->errorArray)) {
            return $this->errorArray[0];
        }
    }

    public function updatePassword($oldpw, $pw, $pw2, $un)
    {
        $this->validateOldPassword($oldpw, $un);
        $this->validatePasswords($pw, $pw2);

        if (empty($this->errorArray)) {
            $query = $this->con->prepare("UPDATE users SET password=:pw WHERE username=:un");
            $pw = hash("sha512", $pw);
            $query->bindValue(":pw", $pw);
            $query->bindValue(":un", $un);

            return $query->execute();
        }
    }

    public function validateOldPassword($oldpw, $un)
    {
        $pw = hash("sha512", $oldpw);

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");

        $query->bindValue(":un", $un);
        $query->bindValue(":pw", $pw);

        $query->execute();

        if ($query->rowCount() == 0) {
            array_push($this->errorArray, Constants::$passwordIncorrect);
        }
    }
}