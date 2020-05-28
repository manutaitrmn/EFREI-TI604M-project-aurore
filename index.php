<?php
session_start();

require "controller/Controller.php";

try {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == 'gallery') {
            gallery();
        } elseif ($action == 'login') {
            login();
        } elseif ($action == 'manage') {
            !empty($_SESSION['user'])?manage():header("Location: login");
        } elseif ($action == 'logout') {
            logout();
            if (session_destroy()) {
                home();
            } else {
                throw new Exception('Error when logging out.');
            }
        } else {
            throw new Exception('Error 404, page not found.');
        }
    } else {
        home();
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}