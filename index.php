<?php

require_once("includes/config.php");
require_once("includes/classes/PreviewProvider.php");
require_once("includes/classes/Entity.php");

if(!isset($_SESSION["userLoggedIn"])) {
    header("Location: register.php");
}

$userLoggedIn = $_SESSION["userLoggedIn"];

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createPreviewVideo(null);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<img src="assets/images/mooflixlogo.png" title="logo" alt="MooFlix">
    <h1>The Best Streaming Site Ever</h1>
    <a href="login.php" class="signInMessage">Already have an account? Sign in here.</a> <br> <br>
    <a href="register.php" class="signInMessage">Need to sign up? Register here.</a>
</body>
</html>