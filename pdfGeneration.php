<?php
    session_start();

    require_once(__DIR__ . "/service/pdf-service.php");
    $pdfService = pdfService::getInstance();

    $items = $_SESSION["cart"]["items"]; 
    // EXAMPLE: //$_SESSION["cart"]["items"][$i]["count"] $_SESSION["cart"]["items"][$i]["event"]->price
    $totalPrice = $_SESSION["cart"]["totalPrice"];
    $date = date("Y-m-d H:i:s");

    $pdfService->generatePdf($items,$totalPrice,$date);
?>