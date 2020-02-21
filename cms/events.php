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
        <div id="event-container">
            <?php 
                include('../service/event-service.php');
                $events = eventService::getInstance()->getAllEvents(0);
                for ($i=0; $i < count($events); $i++) { 
                    $event = $events[$i];
                    ?>
                        <div class="event-card">
                        <h1><?= $event->getEventName() ?></h1>
                        <h2><?= $event->artist ?></h2>
                        <h3><?= date('F tS – H:i', $event->programmeItem->startsAt) ?> - <?= date('H:i', $event->programmeItem->endsAt) ?></h3>
                        <button>Edit Event</button>
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