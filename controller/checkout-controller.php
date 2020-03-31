<?php
require_once __DIR__ . "/../APIs/vendor/autoload.php";
require_once(__DIR__ . "/../service/checkout-service.php");
require_once(__DIR__ . "/../service/cart-service.php");

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setApiKey("test_bMDdg2EknUscp4fhJzex577AEmVhxA");

$checkoutService = checkoutService::getInstance();

$method="";
$status="";
$items = $_SESSION["cart"]["items"];


if(isset($_SESSION["cart"])) {
    if(isset($_POST["submit-btn"])) {
        
        if(isset($_POST['fullname']) && isset($_POST['email'])) {
            $_SESSION["fullName"] = $_POST["fullname"];
            $_SESSION["email"] = $_POST["email"];
        }
            
        header("Location: ../payment.php");
    } elseif(isset($_SESSION['mollie_payment_id'])) {
        $payment = $mollie->payments->get($_SESSION['mollie_payment_id']);
        $paymentId;

        if ($payment->isPaid()) {
            if($payment->method == "ideal") {
                $method = 1;
                $status = 0;
                $paymentId = $checkoutService->pushPayment($method,$status,"ideal paid");
            } elseif($payment->method == "creditcard") {
                $method = 2;
                $status = 0;
                $paymentId = $checkoutService->pushPayment($method,$status,"credit paid");
            } elseif($payment->method == "paypal") {
                $method = 3;
                $status = 0;
                $paymentId = $checkoutService->pushPayment($method,$status,"payp paid");
            } elseif($payment->method == "inghomepay") {
                $method = 4;
                $status = 0;
                $paymentId = $checkoutService->pushPayment($method,$status,"ing paid");
            }
            
            if(isset($_SESSION["fullName"]) && !empty($_SESSION["email"])) {
                $customerId = $checkoutService->pushCustomer($_SESSION["fullName"], $_SESSION["email"]);
                $orderId = $checkoutService->pushOrder($customerId, $paymentId);
                for ($i=0; $i < count($items); $i++) { 

                    $events = $_SESSION["cart"]["items"][$i]["event"];
                    $event = cartService::getInstance()->getEvent($events->id);
                    $ids[$i]=$checkoutService->pushTicket($event->id, $orderId, $event->price);
                    $uids[$i]=$checkoutService->getUid($ids[$i]);
                    
                }
                $_SESSION["uid"]=$uids;
                // $_SESSION["id"]=$ids;
                
                
            }
            unset($_SESSION['mollie_payment_id']);
            header("Location: ../after-checkout.php");
            
            // $status=0;
            // $checkoutService->pushPayment(1,$status,"skiddy bu bah");
        } elseif($payment->isOpen()) {
            if($payment->method == "ideal") {
                $method = 1;
                $status = 3;
                $checkoutService->pushPayment($method,$status,"open ideal");
            } elseif($payment->method == "creditcard") {
                $method = 2;
                $status = 3;
                $checkoutService->pushPayment($method,$status,"open ccc");
            } elseif($payment->method == "paypal") {
                $method = 3;
                $status = 3;
                $checkoutService->pushPayment($method,$status,"open pp");
            } elseif($payment->method == "inghomepay") {
                $method = 4;
                $status = 3;
                $checkoutService->pushPayment($method,$status,"open ing");
            }
            // $status=3;
            // $checkoutService->pushPayment(1,$status,"skiddy bu bah");
        } elseif($payment->isFailed()) {
            if($payment->method == "ideal") {
                $method = 1;
                $status = 2;
                $checkoutService->pushPayment($method,$status,"fail id");
            } elseif($payment->method == "creditcard") {
                $method = 2;
                $status = 2;
                $checkoutService->pushPayment($method,$status,"fail cc");
            } elseif($payment->method == "paypal") {
                $method = 3;
                $status = 2;
                $checkoutService->pushPayment($method,$status,"fail pp");
            } elseif($payment->method == "inghomepay") {
                $method = 4;
                $status = 2;
                $checkoutService->pushPayment($method,$status,"fail ing");
            }
        }
    } else {
        http_response_code(400);
    }
} else {
    echo("There is no cart to checkout with.");
}

?>