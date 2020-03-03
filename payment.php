<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/APIs/vendor/autoload.php";

$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setApiKey("test_bMDdg2EknUscp4fhJzex577AEmVhxA");

$payment = $mollie->payments->create([
    "amount" => [
        "currency" => "EUR",
        "value" => "10.00"
    ],
    "description" => "My first API payment",
    "redirectUrl" => "https://www.thispersondoesnotexist.com/"
]);
header("Location: " . $payment->getCheckoutUrl(), true, 303);
?>