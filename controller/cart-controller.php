<?php
require_once(__DIR__ . "/../service/cart-service.php");

$cartService = cartService::getInstance();


$data = [];
// EXAMPLE: `$_SESSION["cart"]["items"][0]["event"], $_SESSION["cart"]["items"][0]["count"]`;
if($_GET){
    session_start();

    if(!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = ["items" => []];
    } 

    $cart = &$_SESSION["cart"];

    if(isset($_GET["eventId"])) {
        require_once(__DIR__ . "/../service/event-service.php");
        $event = eventService::getInstance()->getEvent($_GET["eventId"]);

        // If the event is already in the cart (as an item) then increment its count. If not, then push it in.
        $alreadyExist = false;
        for($i = 0; $i < count($cart["items"]); $i++) {
            if($cart["items"][$i]["event"]->id == $event->id) {
                $cart["items"][$i]["count"]++;
                $data["added"] = true; // Set return data
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
    } else if (isset($_GET["getCart"])) {
        $data["cart"] = [];

        for($i = 0; $i < count($cart["items"]); $i++){ 
            $itemData = [
            "id"    => $i,
            "image" => $cart["items"][$i]["event"]->image->url,
            "name"  => $cart["items"][$i]["event"]->getName(),
            "count" => $cart["items"][$i]["count"],
            "price" => $cart["items"][$i]["event"]->price
            ];
            array_push($data["cart"], $itemData);
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