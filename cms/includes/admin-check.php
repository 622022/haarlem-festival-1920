<?php 
    isset($_SESSION) || session_start();
    require_once(__DIR__ . '/../service/login-service.php');
    return isset($_SESSION['USER']) && loginService::getInstance()->userIsAdmin($_SESSION['USER']);
?>