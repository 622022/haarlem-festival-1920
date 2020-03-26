<?php 
    if (require_once(__DIR__ . '/includes/admin-check.php')) {
?>
<html lang="en">
    <head>
    <?php include(__DIR__ . '/includes/header.php'); ?>
        <title>CMS – <?= $str['cms.events'] ?></title>
    </head>
    <body>
    <?php include(__DIR__ . '/includes/sidebar.php'); ?>
        <h1 id="title-text"><?= $str['cms.upcoming-events'] ?></h1>
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
                        <h1 id="edit-text"><?= strtoupper($str['cms.edit-event']) ?> <?= $event->id ?></h1>
                        <form action="../controller/event-controller.php" method="post" name="edit-event">
                            <div id="edit-rbuttons">
                                <input type="radio" name="event-type" value="1" <?= $event->id == 1 ? 'checked' : '' ?>>
                                <label><?= $str['cms.dance'] ?></label>
                                <input type="radio" name="event-type" value="2" <?= $event->id == 2 ? 'checked' : '' ?>>
                                <label><?= $str['cms.jazz'] ?></label>
                                <input type="radio" name="event-type" value="3" <?= $event->id == 3 ? 'checked' : '' ?>>
                                <label><?= $str['cms.food'] ?></label>
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.artist'] ?></label>
                                <input type="text" name="event-name" value="<?= $event->artist ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.price'] ?></label>
                                <input type="number" name="event-price" step="0.01" value="<?= $event->price ?>">
                            </div>
                            <div class="textbox-area">
                                <label><?= $str['cms.start-date'] ?></label>
                                <input type="date" name="event-date" value="<?= date('Y-m-d', $event->programmeItem->startsAt) ?>">
                            </div>
                            <div class="textbox-area">
                                <label><?= $str['cms.start-time'] ?></label>
                                <input type="time" name="event-time" value="<?= date('H:i', $event->programmeItem->startsAt) ?>">
                            </div>
                            <div class="textbox-area">
                                <label><?= $str['cms.duration'] ?></label>
                                <input type="number" name="event-duration" value="<?= $duration ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.location'] ?></label>
                                <input type="text" name="event-location" value="<?= $event->programmeItem->location ?>">
                            </div>
                            <input type="hidden" name="id" value="<?= $_GET['eventid'] ?>"/>
                            <input type="submit" name="confirm-edit-event" value="<?= $str['cms.edit-event'] ?>">
                            <a href="events.php"><?= $str['cms.close'] ?></a>
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
                        <a href="events.php?eventid=<?= $event->id ?>" class="card-button button-color<?= $event->eventTypeId ?>"><?= $str['cms.edit-event'] ?></a>
                        </div>
                    <?php
                }
            ?>
        </div>
    </body>
</html>
<?php 
    } else {
        echo("You do not have permission to view this page");
    }
?>