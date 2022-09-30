<?php

require_once("includes/Header.php");

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createTVShowPreviewVideo(null);

$containers = new CategoryContainers($con, $userLoggedIn);
echo $containers->showAllCategories();