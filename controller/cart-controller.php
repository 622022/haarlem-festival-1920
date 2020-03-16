<?php
require_once(__DIR__ . "/../service/cart-service.php");

$cartService = cartService::getInstance();


$data = [];
// EXAMPLE: `$_SESSION["cart"]["items"][0]["event"], $_SESSION["cart"]["items"][0]["count"]`;
if($_GET){
    session_start();

    if(!isset($_SESSION["cart"])) { $_SESSION["cart"] = ["items" => []]; } // Instantiate the cart if it does not already exist.

    $cart = &$_SESSION["cart"];

    if(isset($_GET["eventId"])) {
        require_once(__DIR__ . "/../service/event-service.php");
        $event = eventService::getInstance()->getEvent($_GET["eventId"]);

        // If the event is already in the cart (as an item) then increment its count. If not, then push it in.
        $alreadyExist = false;
        foreach($cart["items"] as $i=>&$item) {
            if($item["event"]->id == $event->id) {
                $item["count"]++;
                $data["added"] = true; // Set return data
                $data["itemId"] = $i;
                $alreadyExist = true;
                break;
            }
        }

        if(!$alreadyExist) { // If it wasn't added to existing item's count then add as new item.
            array_push($cart["items"], ["event" => $event, "count" => 1]);
           
            // Set return data with cart item
            $itemData = [
                "id"    => $i + 1,
                "image" => $event->image->url,
                "name"  => $event->getName(),
                "count" => 1,
                "price" => $event->price
            ];
            $data["item"] = $itemData;
        }
    } else if (isset($_GET["itemId"])) {
        $itemId = $_GET["itemId"];
        if(isset($cart["items"][$itemId])) {
            if ($_GET["action"] === "remove") {
                unset($cart["items"][$itemId]);
                $data["removed"] = true;
            } else if ($_GET["action"] === "increment") {
                $cart["items"][$itemId]["count"]++;
                $data["incremented"] = true;
            } else if ($_GET["action"] === "decrement") {
                if ($cart["items"][$itemId]["count"] > 0 ) {
                    $cart["items"][$itemId]["count"]--;
                    $data["decremented"] = true;
                }
            } else if ($_GET["action"] === "setCount") {
                if(isset($_GET["count"]) && $_GET["count"] > 0) {
                    $cart["items"][$itemId]["count"] = $_GET["count"];
                    $data["countSetTo"] = $_GET["count"];
                }
            }
        } else {
            $data["error"] = "Invalid itemId";
        }
    } else if (isset($_GET["getCart"])) {
        $data["cart"] = [];
        $data["totalPrice"] = 0;
        foreach($cart["items"] as $i=>&$item) {
            $itemData = [
            "id"    => $i,
            "image" => $item["event"]->image->url,
            "name"  => $item["event"]->getName(),
            "count" => $item["count"],
            "price" => $item["event"]->price
            ];
            array_push($data["cart"], $itemData);
            $data["totalPrice"] += $item["event"]->price * $item["count"];
        }
    } else {
        http_response_code(400);
    }
} else {
    http_response_code(400);
}

header('content-type: application/json');
echo json_encode($data);
?>