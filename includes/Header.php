<?php

require_once("includes/config.php");
require_once("includes/classes/PreviewProvider.php");
require_once("includes/classes/CategoryContainers.php");
require_once("includes/classes/Entity.php");
require_once("includes/classes/EntityProvider.php");
require_once("includes/classes/ErrorMessage.php");
require_once("includes/classes/SeasonProvider.php");
require_once("includes/classes/Season.php");
require_once("includes/classes/Video.php");
require_once("includes/classes/VideoProvider.php");

if (!isset($_SESSION["userLoggedIn"])) {
    header("Location: register.php");
}

$userLoggedIn = $_SESSION["userLoggedIn"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MooFlix</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/481196536f.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>

    <div class='wrapper'>

        <div class="topBar">

            <div class="logoContainer">
                <img src="assets/images/mooflixlogo.png" alt="Mooflix logo">
            </div>

            <ul class="navLinks">
                <li><a href="index.php">Home</a></li>
                <li><a href="shows.php">TV Shows</a></li>
                <li><a href="movies.php">Movies</a></li>
            </ul>

            <div class="rightItems">
                <a href="search.php">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>

                <a href="profile.php">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>

        </div>