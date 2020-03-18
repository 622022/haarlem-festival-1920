<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/APIs/vendor/autoload.php";
require_once(__DIR__ . "/service/payment-service.php");

$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setApiKey("test_bMDdg2EknUscp4fhJzex577AEmVhxA");

$paymentService = paymentService::getInstance();



$orderId = time();


$payment = $mollie->payments->create([
    "amount" => [
        "currency" => "EUR",
        "value" => "10.00"
    ],
    "description" => "My first API payment",
    "redirectUrl" => "http://127.0.0.1/haarlem-festival-1920/controller/payment-controller.php",
    "metadata" => [
        "order_id" => $orderId,
    ],
]);

// save the payment_id for when the user returns
$_SESSION['mollie_payment_id'] = $payment->id ;

header("Location: " . $payment->getCheckoutUrl(), true, 303);

?>