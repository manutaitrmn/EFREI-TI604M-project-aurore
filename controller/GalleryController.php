<?php

require_once "model/ImageManager.php";
require_once "model/UserManager.php";

function gallery() {
    $imageManager = new \Aurore\Model\ImageManager();
    $userManager = new \Aurore\Model\UserManager();

    if (isset($_GET['q'])) {
        $result = $imageManager->getImagesLike($_GET['q']);
    } else {
        $result = $imageManager->getImages();
    }

    $images = [];
    foreach ($result as $image) {
        $image['username'] = $userManager->getUserById($image['user'])['username'];
        $images[] = $image;
    }

    require "view/galleryView.php";
}