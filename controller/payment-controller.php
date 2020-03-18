<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../APIs/vendor/autoload.php";
require_once(__DIR__ . "/../service/payment-service.php");

$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setApiKey("test_bMDdg2EknUscp4fhJzex577AEmVhxA");

$paymentService = paymentService::getInstance();

$method="";
$status="";

//1.ideal
// 2.creditcard
// 3.paypal
// 4.inghomepay

// 0.paid
// 1.refunded
// 2.failed
// 3.open

if(!isset($_SESSION['mollie_payment_id']))
{
    exit;
}
else{
    $payment = $mollie->payments->get($_SESSION['mollie_payment_id']);

    if ($payment->isPaid())
    {
        if($payment->method == "ideal")
        {
            $method=1;
            $status=0;
            $paymentService->storePayment($method,$status,"ideal paid");
        }
        elseif($payment->method == "creditcard")
        {
            $method=2;
            $status=0;
            $paymentService->storePayment($method,$status,"credit paid");
        }
        elseif($payment->method == "paypal")
        {
            $method=3;
            $status=0;
            $paymentService->storePayment($method,$status,"payp paid");
        }
        elseif($payment->method == "inghomepay")
        {
            $method=4;
            $status=0;
            $paymentService->storePayment($method,$status,"ing paid");
        }

        echo "Payment success!";
        // $status=0;
        // $paymentService->storePayment(1,$status,"skiddy bu bah");
    }
    elseif($payment->isOpen())
    {
        if($payment->method == "ideal")
        {
            $method=1;
            $status=3;
            $paymentService->storePayment($method,$status,"open ideal");
        }
        elseif($payment->method == "creditcard")
        {
            $method=2;
            $status=3;
            $paymentService->storePayment($method,$status,"open ccc");
        }
        elseif($payment->method == "paypal")
        {
            $method=3;
            $status=3;
            $paymentService->storePayment($method,$status,"open pp");
        }
        elseif($payment->method == "inghomepay")
        {
            $method=4;
            $status=3;
            $paymentService->storePayment($method,$status,"open ing");
        }
        // $status=3;
        // $paymentService->storePayment(1,$status,"skiddy bu bah");
    }
    elseif($payment->isFailed())
    {
        if($payment->method == "ideal")
        {
            $method=1;
            $status=2;
            $paymentService->storePayment($method,$status,"fail id");
        }
        elseif($payment->method == "creditcard")
        {
            $method=2;
            $status=2;
            $paymentService->storePayment($method,$status,"fail cc");
        }
        elseif($payment->method == "paypal")
        {
            $method=3;
            $status=2;
            $paymentService->storePayment($method,$status,"fail pp");
        }
        elseif($payment->method == "inghomepay")
        {
            $method=4;
            $status=2;
            $paymentService->storePayment($method,$status,"fail ing");
        }
        // $status=3;
        // $paymentService->storePayment(1,$status,"skiddy bu bah");
    }
}
// work in progress
if (isset($_POST["submit-btn"])) {
    try {
        header("Location: ../payment.php");
    } catch(Exception $e) {
        echo($e);
    }
}

?>