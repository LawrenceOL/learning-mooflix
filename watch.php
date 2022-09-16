<?php
require_once("includes/Header.php");

if (!isset($_GET["id"])) {
    ErrorMessage::show("No ID passed into page");
}

$video = new Video($con, $_GET["id"]);
$video->incrementViews();
?>

<div class="watchContainer">

    <div class="videoControls watchNav">
        <button><i class="fa-solid fa-arrow-left"></i></button>
        <h1><?php echo $video->getTitle(); ?></h1>

    </div>

    <video controls autoplay>
        <source src='<?php echo $video->getFilePath(); ?>' type="video/mp4">
    </video>


</div>