<?php
    session_start();
    require_once(__DIR__ . "/../service/ticket-service.php");
    require_once(__DIR__ . "/../model/ticket-model.php");
    $ticketService = ticketService::getInstance();

    if (isset($_POST["confirm-edit-ticket"])) {
        $ticketService->updateTicket(new Ticket($_POST['ticket-orderid'], $_POST['ticket-status'], doubleval($_POST['ticket-price']), $_POST['ticket-uuid-original']));
        header('Location: ../cms/tickets.php?ticketuid=' . $_POST['ticket-uid'] . '&success=1');
    }

    if (isset($_POST["confirm-scan-ticket"])) {
        if ($ticketService->ticketExists($_POST['ticket-uid'])) {
            header('Location: ../cms/tickets.php?ticketuid=' . $_POST['ticket-uid']);
        } else {
            header('Location: ../cms/tickets.php');
        }
    }
?>