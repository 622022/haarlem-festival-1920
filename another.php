<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/APIs/vendor/autoload.php";

$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setApiKey("test_bMDdg2EknUscp4fhJzex577AEmVhxA");

$payment->id = "tr_Ck7wGxh96a";

$payment = $mollie->payments->get($payment->id);

if ($payment->isPaid())
{
    
    echo $payment->method;

   
}
?>