<?php
require_once(__DIR__ . "/../service/cart-service.php");
$cartService = cartService::getInstance();

$data = [];

if($_GET){
    if(isset($_GET["eventId"])){
        session_start();
        $event = $cartService->getEventById($_GET["eventId"]);

        // EXAMPLE: `$_SESSION["cart"]["items"][0]["event"], $_SESSION["cart"]["items"][0]["count"]`;

        // If the event is already in the cart (as an item) then increment its count. If not, then push it in. 
        for($i = 0; $i < count($_SESSION["cart"]["items"]); $i++) {
            if($_SESSION["cart"]["items"][i]["event"]->id === $event->id) {
                $_SESSION["cart"]["items"][i]["count"]++;
                $data["added" => true] // Set return data
                break;
            } else if ($i === count($_SESSION["cart"]["items"]) - 1) { // If last loop add new item to cart
                array_push($_SESSION["cart"]["items"], ["event" => $event, "count" => 1]);
                $item = $_SESSION["cart"]["items"][$i];
                // Set return data with cart item
                $itemData = ["id"=>$i+1, "image"=>$event->image->url, "name"=>$event->getName(), "count"=>1, "price"=>$event->price];
                array_push($data, ["item" => $itemDate]);
            }
        }
    } else if (isset($_GET["itemId"])) {
        $itemId = $_GET["itemId"];

        if ($_GET["action"] === "remove") {
            unset($_SESSION["cart"]["items"][$itemId]);
        } else if ($_GET["action"] === "increment") {
            $_SESSION["cart"]["items"][$itemId]["count"]++;
        } else if ($_GET["action"] === "decrement") {
            if ($_SESSION["cart"]["items"][$itemId]["count"] > 0 ) {
                $_SESSION["cart"]["items"][$itemId]["count"]--;
            }
        } else if ($_GET["action"] === "setCount") {
            if(isset($_GET["count"]) && $_GET["count"] > 0) {
                $_SESSION["cart"]["items"][$itemId]["count"] = $_GET["count"];
            }
        }
    }
}

echo $data;
?>