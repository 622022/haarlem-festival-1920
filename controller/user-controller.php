<?php
    session_start();
    require_once(__DIR__ . "/../service/login-service.php");
    require_once(__DIR__ . "/../service/user-service.php");
    require_once(__DIR__ . "/../model/user-model.php");
    $loginService = loginService::getInstance();
    $userService = userService::getInstance();

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

    if (isset($_POST['confirm-edit-user'])) {
        $user = new User($_POST['id'], $_POST['user-email'], $_POST['user-fullname'], '', !empty($_POST['user-admin']));
        $userService->updateUser($user);
        if ($_POST['user-password'] != '') {
            $userService->updatePassword($user->email, $_POST['user-password']);
        }
        header('Location: ../cms/users.php');
    }
?>