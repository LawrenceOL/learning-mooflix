 <?php

//Turns on output buffering
ob_start(); 

//starts sessions - used to store data in the session until the user closes the browser
session_start();

date_default_timezone_set("America/New_York");

try {
    //create a new PDO object
    $db = new PDO("mysql:host=localhost;dbname=mooflix", "root", "");
    //set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    //if the connection fails, display the error message
    exit( "Connection failed: " . $e->getMessage());
}



?> 