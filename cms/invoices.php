<?php 
    if (require_once(__DIR__ . '/includes/admin-check.php')) {
?>
<html lang="en">
    <head>
        <?php include(__DIR__ . '/includes/header.php'); ?>
        <title>CMS – Events</title>
    </head>
    <body>
        <?php 
            include(__DIR__ . '/includes/sidebar.php');
            include(__DIR__ . '/../service/invoice-service.php'); 
            $invoiceService = InvoiceService::getInstance();
        ?>
        <div id="edit-container" class="overflow-scroll">
            <table>
                <tr>
                    <th>#</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Payment Method</th>
                </tr>
                <?php
                    foreach ($invoiceService->getInvoices() as $invoice) {
                        ?>
                            <tr>
                                <td><?= $invoice->orderId ?></td>
                                <td><?= $invoice->getStatusString() ?></td>
                                <td><?= date('Y-m-d', $invoice->orderedAt) ?></td>
                                <td><?= $invoice->customerName ?></td>
                                <td><?= $invoice->customerEmail ?></td>
                                <td><?= $invoice->getMethodString() ?></td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </body>
</html>
<?php 
    } else {
        echo("You do not have access to view this page");
    }
?>