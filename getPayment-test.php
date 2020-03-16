<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/APIs/vendor/autoload.php";

$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setApiKey("test_bMDdg2EknUscp4fhJzex577AEmVhxA");

$payment->id = "tr_98gFT8MW7b";

$payment = $mollie->payments->get($payment->id);

if ($payment->isPaid())
{
    echo "<li>";
        echo "<strong style='font-family: monospace'>" . htmlspecialchars($payment->id) . "</strong><br />";
        echo htmlspecialchars($payment->description) . "<br />";
        echo htmlspecialchars($payment->amount->currency) . " " . htmlspecialchars($payment->amount->value) . "<br />";

        echo "Status: " . htmlspecialchars($payment->status) . "<br />";


    echo "</li>";
}
?>