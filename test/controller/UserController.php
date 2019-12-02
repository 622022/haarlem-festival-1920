<?php

session_start();
require_once("../service/UserService.php");
$loginService = new UserService();



$username = $_POST["username"];
$password = $_POST["password"];

$reg_username = $_POST["reg_username"];
$reg_email = $_POST["reg_email"];
$reg_password = $_POST["reg_password"];



if (isset($_POST["login"] )) {
    try {
        $result = $loginService->CheckUser($username,$password);
        header("Location: ../index.php");
    }
    catch(Exception $e){
        echo("Error: '$e->message'");
    }

    if($result){
        echo("Successfull!");
    }
}
else {
    echo("invalid!");
}

if (isset($_POST["registration"])) {
    try {
        $result = $loginService->RegisterUser($reg_username,$reg_email,$reg_password);
        header("Location: ../index.php");
    }
    catch(Exception $e){
        echo("Error: '$e->message'");
    }

    if($result){
        echo("Successfull!");
    }
}
else {
    echo("invalid register!");
}



