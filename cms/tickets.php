<?php 
    if (require_once(__DIR__ . '/includes/admin-check.php')) {
?>
<html lang="en">
    <head>
        <?php include(__DIR__ . '/includes/header.php'); ?>
        <title>CMS – Tickets</title>
    </head>
    <body>
        <?php include(__DIR__ . '/includes/sidebar.php'); ?>
    </body>
</html>
<?php 
    } else {
        echo("You do not have access to view this page");
    }
?>