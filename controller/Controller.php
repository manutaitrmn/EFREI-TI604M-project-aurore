<?php

use Aurore\Model\ImageManager;
use Aurore\Model\UserManager;

require_once "model/ImageManager.php";
require_once "model/UserManager.php";


function home() {
    require "view/homeView.php";
}

function gallery() {
    $imageManager = new ImageManager();
    $userManager = new UserManager();

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
        $imageManager = new ImageManager();
        if (is_array(getimagesize($url))) {
            if ($imageManager->add($url,$description,$_SESSION['user'])) {
                $_SESSION['addresponse'] = "Image added.";
            } else {
                $_SESSION['addresponse'] = "Error adding image.";
            }
        } else {
            $_SESSION['addresponse'] = "This is not an image !";
        }
    } else {
        $_SESSION['addresponse'] = "Please fill all inputs.";
    }
    header("Location: manage");
    exit;
}

function deleteImage($id) {
    if ($id != "" and is_numeric($id)) {
        $imageManager = new ImageManager();
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

function login() {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = trim(htmlspecialchars($_POST['username']));
        $password = trim(htmlspecialchars($_POST['password']));
        if ($username != "" && $password != "") {
            $userManager = new UserManager();
            $user = $userManager->connectUser($username, $password);
            if ($user != null) {
                $_SESSION['user'] = $user['id'];
                header("Location: gallery");
                exit;
            } else {
                $_SESSION['response'] = "Invalid username or password.";
            }
        } else {
            $_SESSION['response'] = "Please fill all inputs.";
        }
        header("Location: login");
        exit;
    }

    if (!empty($_SESSION['response'])) {
        $response = $_SESSION['response'];
        unset($_SESSION['response']);
    }

    require "view/loginView.php";
}

function logout() {
    unset($_SESSION['user']);
    session_destroy();
    header("Location: gallery");
}