<?php
require_once(__DIR__ . "/../service/cart-service.php");
$cartService = loginService::getInstance();

if($_GET){
    if(isset($_GET["eventId"])){
        session_start();
        $event = $cartService->getEventById($_GET["eventId"]);

        // EXAMPLES: `$_SESSION["cart"]["items"][0]["event"], $_SESSION["cart"]["items"][0]["count"]`;

        // If the event is already in the cart (as an item) then increment its count. If not, then push it into it. 
        for($i = 0; $i < count($_SESSION["cart"]["items"]); $i++) {
            if($_SESSION["cart"]["items"][i]["event"]->id === $event->id) {
                $_SESSION["cart"]["items"][i]["count"]++;
                break;
            } else if ($i === count($_SESSION["cart"]["items"]) - 1) {
                array_push($_SESSION["cart"]["items"], array("event" = $event, "count" = 1));
            }
        }
    } else if (isset($_GET["decrement"])) {
        
    }
}
?>