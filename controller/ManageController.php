<?php

require_once "model/ImageManager.php";

function manage() {
    if (!empty($_POST['url']) && !empty($_POST['description'])) {
        addImage($_POST['url'], $_POST['description']);
    }

    if (!empty($_POST['id'])) {
        deleteImage($_POST['id']);
    }

    if (!empty($_SESSION['addresponse'])) {
        $addResponse = $_SESSION['addresponse'];
        unset($_SESSION['addresponse']);
    }
    if (!empty($_SESSION['delresponse'])) {
        $delResponse = $_SESSION['delresponse'];
        unset($_SESSION['delresponse']);
    }

    require "view/manageView.php";
}

function addImage($url,$description) {
    if ($url != "" && $description != "") {
        $imageManager = new \Aurore\Model\ImageManager();
        if ($imageManager->add($url,$description,$_SESSION['user'])) {
            $_SESSION['addresponse'] = "Image added.";
        } else {
            $_SESSION['addresponse'] = "Error adding image.";
        }
    } else {
        $_SESSION['addresponse'] = "Please fill all inputs.";
    }
    header("Location: manage");
    exit;
}

function deleteImage($id) {
    if ($id != "" and is_numeric($id)) {
        $imageManager = new \Aurore\Model\ImageManager();
        $image = $imageManager->getImageById($id);
        if (count($image) == 1) {
            if ($imageManager->delete($id)) {
                $_SESSION['delresponse'] = "Image id {$id} deleted successfully.";
            } else {
                $_SESSION['delresponse'] = "Error deleting image.";
            }
        } else {
            $_SESSION['delresponse'] = "Image does not exist.";
        }
    } else {
        $_SESSION['delresponse'] = "Please fill something or a correct image id.";
    }
    header("Location: manage");
    exit;
}