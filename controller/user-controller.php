<?php
    session_start();
    require_once("../service/login-service.php");
    $loginService = new loginService();

    /*if (isset($_POST["login"])) {
        try {
            $result = $loginService->CheckUser($username,$password);
            header("Location: ../index.php");
        } catch(Exception $e) {
            echo($e);
        }

        if ($result) {
            echo("Successfull!");
        }
    } else {
        echo("invalid!");
    }*/

    echo $_POST["register-button"];
    if ($_POST["register-button"]) {
        try {
            $loginService->register($_POST['reg_email'], $_POST['reg_fullname'], $_POST['reg_password']);
            //header("Location: ../index.php");
        } catch(Exception $e) {
            echo($e);
        }
    }
?>