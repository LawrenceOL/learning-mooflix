<?php

require_once("includes/Header.php");

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createMoviesPreviewVideo();

$containers = new CategoryContainers($con, $userLoggedIn);
echo $containers->showMovieCategories();