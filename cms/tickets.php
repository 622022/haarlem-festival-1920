<?php 
    if (require_once(__DIR__ . '/includes/admin-check.php')) {
?>
<html lang="en">
    <head>
        <?php include(__DIR__ . '/includes/header.php'); ?>
        <title>CMS – <?= $str['cms.tickets'] ?></title>
    </head>
    <body>
        <?php 
            include(__DIR__ . '/includes/sidebar.php'); 
            include(__DIR__ . '/../service/ticket-service.php'); 
            $ticketService = ticketService::getInstance();
            $ticket;
            if (isset($_GET['ticketuid'])) {
                $ticket = $ticketService->getTicket($_GET['ticketuid']);
            }
        ?>
        <h1 id="title-text"><?= $str['cms.scan-ticket'] ?></h1>
        <div id="edit-container">
            <form action="../controller/ticket-controller.php" method="post" name="scan-ticket">
                <div class="textbox-area">
                    <label class="textbox-label"><?= $str['cms.ticket-number'] ?></label>
                    <input type="text" name="ticket-uid" value="<?= $_GET['ticketuid'] ?? '' ?>">
                </div>
                <?php if (isset($_GET['ticketuid'])) { ?>
                    <input type="submit" name="confirm-edit-ticket" value="<?= $str['cms.edit-ticket'] ?>">
                <?php } ?>
                <input type="hidden" name="ticket-uuid-original" value="<?= $_GET['ticketuid'] ?? '' ?>"/>
                <input type="submit" class="button-right" name="confirm-scan-ticket" value="<?= $str['cms.scan-ticket'] ?>">
                <?php if (isset($_GET['ticketuid'])) { ?>
                    <div class="textbox-area">
                        <label class="textbox-label"><?= $str['cms.order-number'] ?></label>
                        <input type="number" name="ticket-orderid" value="<?= $ticket->orderId ?>">
                    </div> 
                    <div class="textbox-area">
                        <label class="textbox-label">Status</label>
                        <select name="ticket-status">
                            <option <?= $ticket->status == 1 ? 'selected' : '' ?> value="valid"><?= $str['cms.valid'] ?></option>
                            <option <?= $ticket->status == 2 ? 'selected' : '' ?> value="redeemed"><?= $str['cms.redeemed'] ?></option>
                            <option <?= $ticket->status == 3 ? 'selected' : '' ?> value="cancelled"><?= $str['cms.cancelled'] ?></option>
                            <option <?= $ticket->status == 4 ? 'selected' : '' ?> value="expired"><?= $str['cms.expired'] ?></option>
                            <option <?= $ticket->status == 5 ? 'selected' : '' ?> value="invalid"><?= $str['cms.invalid'] ?></option>
                            <?= $ticket->status == 69 ? '<option selected value="monkey">I\'m a monkey</option>' : '' ?> 
                        </select>
                    </div> 
                    <div class="textbox-area">
                        <label class="textbox-label"><?= $str['cms.price'] ?></label>
                        <input type="number" name="ticket-price" step="0.01" value="<?= $ticket->price ?>">
                    </div>
                    <?php if (isset($_GET['success'])) { ?>
                        <p id='success-text'><?= $str['cms.ticket'] ?> <?= $_GET['ticketuid'] ?> <?= $str['cms.ticket-updated'] ?></p>
                        <a href="tickets.php"><?= $str['cms.close'] ?></a>
                    <?php } ?>
                <?php } else { ?>
                    <p class="hint-text"><?= $str['cms.ticket-hint'] ?></p>
                <?php } ?>
            </form>
        </div>
    </body>
</html>
<?php 
    } else {
        echo("You do not have permission to view this page");
    }
?>