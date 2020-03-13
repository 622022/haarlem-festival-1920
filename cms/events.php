<?php 
    if (require_once(__DIR__ . '/includes/admin-check.php')) {
?>
<html lang="en">
    <head>
        <?php include('./includes/header.php'); ?>
        <title>CMS – Events</title>
    </head>
    <body>
        <?php include('./includes/sidebar.php'); ?>
        <h1 id="event-text">Upcoming Events</h1>
        <?php
            if (isset($_GET['eventid'])) {
                require_once('../service/event-service.php');
                $event = eventService::getInstance()->getEvent(intval($_GET['eventid']));
                if ($event) {
                    $startDate = new DateTime(date("Y-m-d H:i:s", $event->programmeItem->startsAt));
                    $endDate = new DateTime(date("Y-m-d H:i:s", $event->programmeItem->endsAt));
                    $diff = $startDate->diff($endDate);
                    $duration = $diff->h * 60 + $diff->i;
                    ?>
                    <div id="edit-container">
                        <h1 id="edit-text">EDIT EVENT <?= $event->id ?></h1>
                        <form action="../controller/event-controller.php" method="post" name="edit-event">
                            <div id="edit-rbuttons">
                                <input type="radio" name="event-type" value="1" <?= $event->id == 1 ? 'checked' : '' ?>>
                                <label>Dance</label>
                                <input type="radio" name="event-type" value="2" <?= $event->id == 2 ? 'checked' : '' ?>>
                                <label>Jazz</label>
                                <input type="radio" name="event-type" value="3" <?= $event->id == 3 ? 'checked' : '' ?>>
                                <label>Food</label>
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label">Artist</label>
                                <input type="text" name="event-name" value="<?= $event->artist ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label">Price</label>
                                <input type="number" name="event-price" step="0.01" value="<?= $event->price ?>">
                            </div>
                            <div class="textbox-area">
                                <label>Start Date</label>
                                <input type="date" name="event-date" value="<?= date('Y-m-d', $event->programmeItem->startsAt) ?>">
                            </div>
                            <div class="textbox-area">
                                <label>Start Time</label>
                                <input type="time" name="event-time" value="<?= date('H:i', $event->programmeItem->startsAt) ?>">
                            </div>
                            <div class="textbox-area">
                                <label>Duration</label>
                                <input type="number" name="event-duration" value="<?= $duration ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label">Location</label>
                                <input type="text" name="event-location" value="<?= $event->programmeItem->location ?>">
                            </div>
                            <input type="hidden" name="id" value="<?= $_GET['eventid'] ?>"/>
                            <input type="submit" name="confirm-edit-event" value="Edit Event">
                            <a href="events.php">Close</a>
                        </form>
                    </div>
                    <?php
                }
            }
        ?>
        <div id="event-container">
            <?php 
                require_once('../service/event-service.php');
                $events = eventService::getInstance()->getAllEvents(0);
                for ($i=0; $i < count($events); $i++) { 
                    $event = $events[$i];
                    ?>
                        <div class="event-card">
                        <h1><?= $event->getEventName() ?></h1>
                        <h2><?= $event->artist ?></h2>
                        <h3><?= date('F tS – H:i', $event->programmeItem->startsAt) ?> - <?= date('H:i', $event->programmeItem->endsAt) ?></h3>
                        <a href="events.php?eventid=<?= $event->id ?>" class="event-button button-color<?= $event->eventTypeId ?>">Edit Event</a>
                        </div>
                    <?php
                }
            ?>
        </div>
    </body>
</html>
<?php 
    } else {
        echo("You do not have access to view this page");
    }
?>