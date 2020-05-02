<?php

require_once "model/UserManager.php";

function session() {
    return isset($_SESSION['user']);
}

function login() {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($username != "" && $password != "") {
            $userManager = new \Aurore\Model\UserManager();
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