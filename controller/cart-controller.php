<?php
require_once(__DIR__ . "/../service/cart-service.php");
$cartService = loginService::getInstance();

if($_GET){
    if(isset($_GET["eventId"])){
        session_start();
        $event = $cartService->getEventById($_GET["eventId"]);

        // $_SESSION["cart"]["items"][0]["event"];
        // $_SESSION["cart"]["items"][0]["count"];
        for($i = 0; $i < count($_SESSION["cart"]["items"]); $i++) {
            if($_SESSION["cart"]["items"]["event"]->id === $event->id) {
                $_SESSION["cart"]["items"]["count"]++;
                break;
            } else if ($i === count($_SESSION["cart"]["items"])) {
                $_SESSION["cart"]["items"] = array(
                    array("event" = $event, "count" = 1)
                )
            }
        }
    }
}
?>