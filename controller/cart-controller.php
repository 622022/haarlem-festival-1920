<?php
require_once(__DIR__ . "/../service/cart-service.php");
$cartService = loginService::getInstance();

if($_GET){
    if(isset($_GET["event"])){
        $eventId = $_GET["event"];
    }
}
?>