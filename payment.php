<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/APIs/vendor/autoload.php";

$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setApiKey("test_bMDdg2EknUscp4fhJzex577AEmVhxA");

$orderId = time();


$payment = $mollie->payments->create([
    "amount" => [
        "currency" => "EUR",
        "value" => "10.00"
    ],
    "description" => "My first API payment",
    "redirectUrl" => "http://127.0.0.1/haarlem-festival-1920/test.php",
    "metadata" => [
        "order_id" => $orderId,
    ],
]);

// service will be called here to put this in db ($orderId, $payment->status);

header("Location: " . $payment->getCheckoutUrl(), true, 303);

?>