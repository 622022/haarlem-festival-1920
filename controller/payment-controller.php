<?php
require_once(__DIR__ . "/../service/payment-service.php");

$paymentService = paymentService::getInstance();
// work in progress
if (isset($_POST["submit-btn"])) {
    try {
        header("Location: ../payment.php");
    } catch(Exception $e) {
        echo($e);
    }
}