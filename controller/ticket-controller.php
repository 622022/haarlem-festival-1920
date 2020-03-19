<?php
    session_start();
    require_once(__DIR__ . "/../service/ticket-service.php");
    $ticketService = ticketService::getInstance();

    if (isset($_POST["confirm-edit-ticket"])) {
        
    }

    if (isset($_POST["confirm-scan-ticket"])) {
        if ($ticketService->ticketExists($_POST['ticket-uid'])) {
            header('Location: ../cms/tickets.php?ticketuid=' . $_POST['ticket-uid']);
        } else {
            header('Location: ../cms/tickets.php');
        }
    }
?>