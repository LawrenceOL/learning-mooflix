<?php

require_once("includes/Header.php");

if (!isset($_GET["id"])) {
    ErrorMessage::show("No id passed to page");
}

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createCategoryShowPreviewVideo($_GET["id"]);

$containers = new CategoryContainers($con, $userLoggedIn);
echo $containers->showCategory($_GET["id"]);