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
                    <th><?= $str['cms.status'] ?></th>
                    <th><?= $str['cms.date'] ?></th>
                    <th><?= $str['cms.customer-name'] ?></th>
                    <th><?= $str['cms.customer-email'] ?></th>
                    <th><?= $str['cms.payment-method'] ?></th>
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
        echo("You do not have permission to view this page");
    }
?>