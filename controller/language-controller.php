<?php 
    isset($_SESSION) || session_start();
    $_SESSION['lang'] = isset($_SESSION['lang']) ? $_SESSION['lang'] === 'en' ? 'nl' : 'en' : 'en';
    header('Location: ' . $_SERVER['HTTP_REFERER'] ?? '../cms/login.php');
?>