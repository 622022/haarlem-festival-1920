<?php
    session_start();
    require_once(__DIR__ . "/../service/login-service.php");
    $loginService = loginService::getInstance();

    if (isset($_POST["login-button"])) {
        try {
            $loginService->login($_POST['email'], $_POST['password']);
            header("Location: ../cms/events.php");
        } catch(Exception $e) {
            echo($e);
        }
    }

    if (isset($_POST["register-button"])) {
        try {
            if ($loginService->register($_POST['email'], $_POST['fullname'], $_POST['password'])) {
                echo("You were succesfully registered, please wait for an admin to approve your registration");
            } else {
                echo("This user already exists, try logging in or request a password reset");
            }
        } catch(Exception $e) {
            echo($e);
        }
    }
?>