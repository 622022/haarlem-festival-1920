<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/cms.css" />
        <title>CMS – Events</title>
    </head>
    <body>
        <?php include('./parts/sidebar.php'); ?>
        <h1 id="event-text">Upcoming Events</h1>
        <div id="event-container">
            <?php 
                include('../service/event-service.php');
                $events = eventService::getInstance()->getAllEvents(0);
                for ($i=0; $i < count($events); $i++) { 
                    $event = $events[i];
                    ?>
                    <div class=\"event-card\">
                    <h1><?= $event->getEventName() ?></h1>
                    <h2><?= $event->artist ?></h2>
                    <h3>January 1st – 00:00 - 00:00</h3>
                    <button>Edit Event</button>
                    </div>
                    <?php
                }
            ?>
        </div>
    </body>
</html>