<?php

    require_once(__DIR__ . "/service/pdf-service.php");
    $pdfService = pdfService::getInstance();

    $pdfService->generatePdf();
?>