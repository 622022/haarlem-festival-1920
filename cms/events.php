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
                include('./service/event-service.php');
            for ($i=0; $i < 9; $i++) { 
                include('./parts/event-card.php'); 
            }
            ?>
        </div>
    </body>
</html>